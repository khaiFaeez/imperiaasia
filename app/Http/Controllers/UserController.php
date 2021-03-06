<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter = FacadesRequest::input('search');

        $users = User::query()
            ->whereNot('id', 1)
            ->orderBy('id', 'DESC')
            ->withTrashed()
            ->when($filter, function ($query, $filter) {
                $query->where('username', 'LIKE', '%'.$filter.'%');
            })
            ->paginate(5);

        $users->map(function ($query) {
            $query->getRoleNames();
        });

        return Inertia::render('User/Index', [
            'users' => $users,
            'filters' => FacadesRequest::all('search', 'trashed'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $session_team_id = getPermissionsTeamId();

        return Inertia::render('User/Create', [
            'roles' => Role::pluck('name', 'name')->all(),
            'portfolios' => Portfolio::pluck('name', 'id')->all(),
            'roles' => Role::leftJoin('portfolios', 'portfolios.id', 'roles.portfolio_id')
                ->select('roles.id', 'portfolios.name as portfolio', 'roles.name')
                ->whereNot('roles.id', 1)
                ->where('portfolio_id', $session_team_id)
                ->get(),
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
            'roles' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);

        $session_team_id = getPermissionsTeamId();

        $user->syncRoles($request->input('roles'));
        empty($request->input('roles')) ? $user->portfolios()->detach($session_team_id) : $user->portfolios()->attach($session_team_id);

        User::where('id', $user->id)->update(['current_portfolio_id' => $session_team_id]);

        $user->setStatus('pending');

        return redirect()->route('users.index')
            ->with('message', 'User created successfully');
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
        $user = User::withTrashed()->findOrFail($id);

        $session_team_id = getPermissionsTeamId();

        return Inertia::render('User/Edit', [
            'user' => $user,
            'portfolio' => Portfolio::with('roles')->get(),
            'userPortfolio' => $user->portfolios ? $user->portfolios->pluck('id')->all() : [],
            'userRole' => $user->roles->pluck('id')->all(),
            'roles' => Role::leftJoin('portfolios', 'portfolios.id', 'roles.portfolio_id')
                ->whereNot('roles.id', 1)
                ->select('roles.id', 'portfolios.name as portfolio', 'roles.name')
                ->where('portfolio_id', $session_team_id)
                ->get(),
        ]);
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
        $user = User::withTrashed()->find($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'staff_id' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($id)],
        ]);

        $user->update($request->all());

        $session_team_id = getPermissionsTeamId();

        $user->syncRoles($request->input('roles'));
        empty($request->input('roles')) ? $user->portfolios()->detach($session_team_id) : $user->portfolios()->attach($session_team_id);

        return back()
            ->with('message', 'User Updated');
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

        return back()
            ->with('message', 'User Deactivated');
    }

    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();

        return redirect()->route('users.index')
            ->with('message', 'User Reactivated');
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
                if (! isset($input['current_password']) || ! Hash::check($input['current_password'], $user->password)) {
                    $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
                }
            });

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
