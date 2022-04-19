<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Client;
use App\Models\Consultant;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use App\Models\Collector;

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

        // $invoice = $this->invoiceInstance();
        $invoices = Invoice::paginate(15);

        return view('invoice.index', ["portfolio" => $this->portfolio, "invoices" => $invoices]);
    }


    public function show($portfolio, $id)
    {
        Auth::user()->hasPermissionTo('invoice-edit');

        Config::set('database.default', $this->portfolio);

        // $invoice = $this->invoiceInstance();
        $invoice = Invoice::find($id);

        $states = DB::table('Negeri')->get();
        $products = DB::table('Product')->get();
        $consultants = Consultant::get();
        $countries = ["Indonesia", "Philippine"];
        $cmd = Collector::get();


        return view('invoice.show', ["portfolio" => $this->portfolio, "invoice" => $invoice, "client" => $invoice->client, "states" => $states, "countries" => $countries, "products" => $products, "consultants" => $consultants, "cmd" => $cmd]);
    }

    private function invoiceInstance()
    {

        $this->portfolio = Route::current()->parameter("portfolio");;
        $invoices = new Invoice;
        $invoices->setConnection($this->portfolio);
        return $invoices;
    }
}
