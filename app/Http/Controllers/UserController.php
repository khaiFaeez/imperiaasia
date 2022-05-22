<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::whereNot('id', 1)->orderBy('id', 'DESC')->paginate(5);
        $users->map(function ($query) {
            $query->getRoleNames();
        });
        // return view('users.index', compact('data'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);

        return Inertia::render('User/Index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return Inertia::render('User/Create', [
            'roles' => Role::pluck('name', 'name')->all(),
            'portfolios' => Portfolio::pluck('name', 'id')->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'staff_id' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'portfolios' => ['required'],
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = FacadesHash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        $user->setStatus('pending');

        return redirect()->route('users.index')
            ->with('status', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Auth::user()->hasPermissionTo('user-edit');
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $portfolios = Portfolio::pluck('name', 'id')->all();
        $userPortfolio = $user->portfolios ? $user->portfolios->pluck('id', 'name')->all() : [];

        return Inertia::render('User/Edit', compact('user', 'roles', 'userRole', 'portfolios', 'userPortfolio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Auth::user()->hasPermissionTo('user-edit');
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'staff_id' =>  ['required', 'string', 'max:255', Rule::unique('users')->ignore($id)],
            'portfolios' => ['required'],
            'roles' => 'required'
        ]);

        $input = $request->all();
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->portfolios()->attach($request->input('portfolios'));

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('message', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('message', 'User deleted successfully');
    }

    public function updatePassword(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            $input = $request->all();
            Validator::make($input, [
                'current_password' => ['required', 'string'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ])->after(function ($validator) use ($user, $input) {
                if (!isset($input['current_password']) || !Hash::check($input['current_password'], $user->password)) {
                    $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
                }
            })->validateWithBag('updatePassword');

            $user->forceFill([
                'password' => Hash::make($input['password']),
            ])->save();

            return redirect()->route('password.edit')
                ->with('message', 'Password updated successfully');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
