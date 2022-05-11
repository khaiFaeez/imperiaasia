<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use Inertia\Inertia;
use App\Models\Client;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->portfolio = Route::current() ? Route::current()->parameter("portfolio") : "";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        Auth::user()->hasPermissionTo('invoice-list');
        Config::set('database.default', $this->portfolio);
        $filter = Request::input('search');
        $clients = Client::with('state')
            ->when($filter, function ($query, $filter) {
                $query->where('MyKad_SSM', 'LIKE', '%' . $filter . '%');
            })
            ->paginate(20);
        $clients->map(function ($query) {
            $query->invoice = $query->getLastInvoice($query);
        });
        return Inertia::render('Client/Index', [
            "portfolio" => $this->portfolio,
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
        Config::set('database.default', $this->portfolio);

        return Inertia::render('Client/Create', [
            "portfolio" => $this->portfolio,
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

        Config::set('database.default', $this->portfolio);
        $id = Client::create($request->validated());

        return redirect()->route('portfolio.client.show', [
            "portfolio" => $this->portfolio,
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
        Config::set('database.default', $this->portfolio);

        return Inertia::render('Client/Show', [
            "portfolio" => $this->portfolio,
            'client' => Client::with('state')->where('id', $id)->with('invoices')->with('invoices.product')->first(),
            'states' => State::get(),
            'countries' => ["Malaysia", "Indonesia", "Philippine"]
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

        Config::set('database.default', $this->portfolio);
        $data = Client::where('MyKad_SSM', 'LIKE', '%' . $request->keyword . '%')->get();


        return response()->json($data);
    }
}
