<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use Inertia\Inertia;
use App\Models\Client;
use Illuminate\Support\Facades\Config;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ClientController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        Auth::user()->hasPermissionTo('invoice-list');

        $filter = Request::input('search');
        $clients = Client::with('state')
            ->when($filter, function ($query, $filter) {
                $query->where('MyKad_SSM', 'LIKE', '%' . $filter . '%');
            })
            ->paginate(20);

        $clients->map(function ($query) {
            $query->invoice = $query->getAllInvoice()->sortByDesc('Created_Date')->first()->Inv_No;
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
        Auth::user()->hasPermissionTo('invoice-create');

        return Inertia::render('Client/Create', [
            'states' => State::get(),
            'countries' => ["Malaysia", "Indonesia", "Philippine"]
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
        Auth::user()->hasPermissionTo('invoice-create');

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
    public function edit($id)
    {
        //
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
        //
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
