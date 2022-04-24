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
use App\Models\Product;
use App\Models\State;
use Inertia\Inertia;

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

        $invoices = Invoice::with('client')->with('product')->with('channel')->with('state')->orderBy('Id', 'desc')->paginate(20);

        // $datas = [];
        // foreach ($invoices as $data) {
        //     $datas[] = [
        //         "status" => $data->Status_Inv,
        //         "aging" => $data->Aging,
        //         "inv_no" => $data->Inv_No,
        //         "id_number" => $data->MyKad_SSM,
        //         "client_mobile_number" => $data->client->Mobile_No,
        //         "client_name" => $data->client->Name,
        //         "ship_name" => $data->Ship_Name,
        //         "ship_phone" => $data->Ship_Phone,
        //         "ship_address1" => $data->Ship_Add1,
        //         "ship_address2" => $data->Ship_Add2,
        //         "ship_postcode" => $data->Ship_poscode,
        //         "ship_city" => $data->Ship_City,
        //         "ship_state" => $data->state ? $data->state->Negeri : "",
        //         "ship_country" => $data->Ship_Country,
        //         "product_name" => $data->product ? $data->product->Product_Name : "",
        //         "price" => $data->Price,
        //         "qty" => $data->Qty,
        //         "total_rm" => $data->Total_RM,
        //         "ptp1" => $data->Promise_pay ? \Carbon\Carbon::create($data->Promise_pay)->format('d M Y') : "",
        //         "ptp2" => $data->Promise_pay2 ? \Carbon\Carbon::create($data->Promise_pay2)->format('d M Y') : "",
        //         "ptp3" => $data->Promise_pay3 ? \Carbon\Carbon::create($data->Promise_pay3)->format('d M Y') : "",
        //         "ptp4" => $data->Promise_pay4 ? \Carbon\Carbon::create($data->Promise_pay4)->format('d M Y') : "",
        //         "created_by" => $data->Created_By,
        //         "created_date" => $data->Created_Date ? \Carbon\Carbon::create($data->Created_Date)->format('d M Y') : "",
        //         "grand_total" => "",
        //         "paid_total" => "",
        //         "overdue_amt" => "",
        //         "consultant" => $data->Consultant,
        //         "channel" => $data->channel ? $data->channel->Name : ""

        //     ];
        // }

        // $invoices = $datas;

        return Inertia::render('Invoice/Index', ["portfolio" => $this->portfolio, "invoices" => $invoices]);
    }


    public function show($portfolio, $id)
    {
        Auth::user()->hasPermissionTo('invoice-edit');

        Config::set('database.default', $this->portfolio);

        $invoice = Invoice::find($id);
        $states = DB::table('Negeri')->get();
        $products = DB::table('Product')->get();
        $consultants = Consultant::get();
        $countries = ["Indonesia", "Philippine"];
        $cmd = Collector::get();

        // return view('invoice.show', ["portfolio" => $this->portfolio, "invoice" => $invoice, "client" => $invoice->client, "states" => $states, "countries" => $countries, "products" => $products, "consultants" => $consultants, "cmd" => $cmd]);

        return Inertia::render('Invoice/Show', ["portfolio" => $this->portfolio, "invoice" => $invoice, "client" => $invoice->client, "states" => $states, "countries" => $countries, "products" => $products, "consultants" => $consultants, "cmd" => $cmd]);
    }

    public function create()
    {
        Auth::user()->hasPermissionTo('invoice-create');

        Config::set('database.default', $this->portfolio);

        $states = State::get();
        $products = Product::select('id', 'Code', 'Product_Name')->get();
        $consultants = Consultant::select('id', 'Name')->get();
        $countries = ["Indonesia", "Philippine"];
        $cmd = Collector::select('id', 'Name')->get();
        $clients = Client::select('id', 'Name')->get();

        return Inertia::render('Invoice/Create', ["portfolio" => $this->portfolio, "states" => $states, "countries" => $countries, "products" => $products, "consultants" => $consultants, "cmd" => $cmd]);
    }
}
