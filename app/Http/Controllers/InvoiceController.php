<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Client;
use App\Models\Consultant;
use Illuminate\Support\Facades\Config;
use App\Models\Collector;
use App\Models\Product;
use App\Models\State;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;

class InvoiceController extends Controller
{
    protected $portfolio;

    public function __construct()
    {
        $this->portfolio = Route::current() ? Route::current()->parameter("portfolio") : "";
    }

    public function index()
    {
        Auth::user()->hasPermissionTo('invoice-list');

        Config::set('database.default', $this->portfolio);
        $filter = Request::input('search');
        return Inertia::render('Invoice/Index', [
            "portfolio" => $this->portfolio,
            "invoices" => Invoice::with('client')
                ->with('product')
                ->with('channel')
                ->with('state')
                ->orderBy('Id', 'desc')
                ->when($filter, function ($query, $filter) {
                    $query->where('Inv_No', 'LIKE', '%' . $filter . '%');
                })
                ->paginate(20),
            'filters' => Request::all('search', 'trashed'),
        ]);
    }


    public function show($portfolio, $id)
    {
        Auth::user()->hasPermissionTo('invoice-edit');

        Config::set('database.default', $this->portfolio);

        return Inertia::render('Invoice/Show', [
            "portfolio" => $this->portfolio,
            "invoice" => Invoice::with('client')->with('state')->where('Id', $id)->first(),
            "states" => State::get(),
            "countries" => ["MALAYSIA", "INDONESIA", "PHILIPPINE"],
            "products" => Product::select('id', 'Code', 'Product_Name')->get(),
            "consultants" => Consultant::select('id', 'Name', 'Status', 'Employee_Code')->orderBy('id', 'desc')->get(),
            "cmd" => Collector::select('id', 'Name')->get(),
            'show' => true
        ]);
    }

    public function repeatOrder($portfolio, $id)
    {
        Auth::user()->hasPermissionTo('invoice-edit');

        Config::set('database.default', $this->portfolio);

        return Inertia::render('Invoice/Repeat', [
            "portfolio" => $this->portfolio,
            "invoice" => Invoice::with('client')->with('state')->where('Id', $id)->first(),
            "states" => State::get(),
            "countries" => ["MALAYSIA", "INDONESIA", "PHILIPPINE"],
            "products" => Product::select('id', 'Code', 'Product_Name')->get(),
            // "consultants" => Consultant::select('id', 'Name', 'Status', 'Employee_Code')->orderBy('id', 'desc')->get(),
            // "cmd" => Collector::select('id', 'Name')->get(),
        ]);
    }

    public function create($portfolio, $client_id)
    {
        Auth::user()->hasPermissionTo('invoice-create');

        Config::set('database.default', $this->portfolio);


        return Inertia::render('Invoice/Create', [
            "client" => Client::where('id', $client_id)->first(),
            "portfolio" => $this->portfolio,
            "states" => State::get(),
            "countries" => ["MALAYSIA", "INDONESIA", "PHILIPPINE"],
            "products" => Product::select('id', 'Code', 'Product_Name')->get(),
            "consultants" => Consultant::select('id', 'Name', 'Status', 'Employee_Code')->orderBy('id', 'desc')->get(),
            "cmd" => Collector::select('id', 'Name')->get()
        ]);
    }

    public function store(InvoiceRequest $request)
    {
        Auth::user()->hasPermissionTo('invoice-create');

        Config::set('database.default', $this->portfolio);
        $id = Invoice::create([
            'MyKad_SSM' => $request->MyKad_SSM,
            'Promise_pay' => \Carbon\Carbon::now()
        ]);

        return redirect()->route('portfolio.invoice.show', [
            "portfolio" => $this->portfolio,
            "invoice" => $id->Id
        ])
            ->with('message', 'Invoice created successfully');
    }
}
