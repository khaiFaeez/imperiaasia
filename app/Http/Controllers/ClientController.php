<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use Inertia\Inertia;
use App\Models\Client;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;

class ClientController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:client-list|client-create|client-edit|client-delete', ['only' => ['index', 'store', 'show']]);
        $this->middleware('permission:client-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:client-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:client-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $filter = Request::input('search');
        $clients = Client::query()
            ->with('state:id,Negeri')
            ->when($filter, function ($query, $filter) {
                $query->where('MyKad_SSM', 'LIKE', '%' . $filter . '%');
                $query->orWhere('Mobile_No', 'LIKE', '%' . $filter . '%');
            })
            ->select('id', 'Name', 'MyKad_SSM', 'Created_Date', 'Mobile_No', 'State')
            ->paginate(20);

        $clients->map(function ($query) {
            $query->invoice = $query->getAllInvoice()->sortByDesc('Created_Date')->first() ? $query->getAllInvoice()->sortByDesc('Created_Date')->first()->Inv_No : "";
        });

        return Inertia::render('Client/Index', [
            'clients' => $clients,
            'filters' => Request::all('search', 'trashed'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return Inertia::render('Client/Create', [
            'states' => State::get(),
            'countries' => config('countries')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {

        $id = Client::create($request->validated());

        return redirect()->route('portfolio.client.show', [
            "client" => $id->id
        ])
            ->with('message', 'Client created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($portfolio, $id)
    {

        $client = Client::with('state')->where('id', $id)->first();
        $client->invoices = $client->getAllInvoice();
        return Inertia::render('Client/Show', [
            'client' => $client,
            'states' => State::get(),
            'countries' => config('countries')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($portfolio, $id)
    {

        $client = Client::with('state')->where('id', $id)->firstOrFail();
        return Inertia::render('Client/Edit', [
            'client' => $client,
            'states' => State::get(),
            'countries' => config('countries')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $portfolio, $id)
    {

        $id = Client::where('id', $id)->update($request->validated());

        return back()->with('message', 'Client saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getICNumber(Request $request)
    {

        $data = Client::where('MyKad_SSM', 'LIKE', '%' . $request->keyword . '%')->get();


        return response()->json($data);
    }
}
