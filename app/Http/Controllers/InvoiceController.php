<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\Client;
use App\Models\Collector;
use App\Models\Consultant;
use App\Models\Invoice;
use App\Models\InvoiceNote;
use App\Models\Product;
use App\Models\State;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:invoice-list|invoice-create|invoice-edit|invoice-delete', ['only' => ['index', 'store', 'show']]);
        $this->middleware('permission:invoice-create', ['only' => ['create', 'store', 'repeatOrder']]);
        $this->middleware('permission:invoice-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:invoice-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $filter = Request::input('search');

        return Inertia::render('Invoice/Index', [
            'invoices' => Invoice::with('client')
                ->with('product')
                ->with('channel')
                ->with('state')
                ->with('consultant')
                ->orderBy('Id', 'desc')
                ->when($filter, function ($query, $filter) {
                    $query->where('Inv_No', 'LIKE', '%'.$filter.'%');
                })
                ->paginate(20),
            'filters' => Request::all('search', 'trashed'),
        ]);
    }

    public function show($portfolio, $id)
    {
        return Inertia::render('Invoice/Show', [
            'invoice' => Invoice::with('client')->with('notes:Inv_No,Notes,Created_By,Created_On')->with('product')->with('product2')->with('product3')->with('product4')->with('product5')->with('state')->with('consultant')->where('Id', $id)->first(),
            'states' => State::get(),
            'countries' => config('countries'),
            'products' => Product::select('id', 'Code', 'Product_Name')->get(),
            'consultants' => Consultant::select('id', 'Name', 'Status', 'Employee_Code')->get(),
            'cmd' => Collector::select('id', 'Name')->get(),
        ]);
    }

    public function repeatOrder($portfolio, $id)
    {
        return Inertia::render('Invoice/Repeat', [
            'invoice' => Invoice::with('client')->with('state')->where('Id', $id)->first(),
            'states' => State::get(),
            'countries' => config('countries'),
            'products' => Product::select('id', 'Code', 'Product_Name')->get(),
            'consultants' => Consultant::select('id', 'Name', 'Status', 'Employee_Code')->get(),
            'cmd' => Collector::select('id', 'Name')->get(),
        ]);
    }

    public function create($portfolio, $client_id)
    {
        return Inertia::render('Invoice/Create', [
            'client' => Client::where('id', $client_id)->first(),
            'states' => State::get(),
            'countries' => config('countries'),
            'products' => Product::select('id', 'Code', 'Product_Name')->get(),
            'consultants' => Consultant::select('id', 'Name', 'Status', 'Employee_Code')->get(),
            'cmd' => Collector::select('id', 'Name')->get(),
        ]);
    }

    public function store(InvoiceRequest $request)
    {
        $consultantName = $request->sales['consultant'] ? Consultant::where('id', $request->sales['consultant'])->value('Name') : '';

        $id = Invoice::create([
            'MyKad_SSM' => $request->client,
            'Name' => $request->client,
            'Aging' => $this->calculateAging(),
            'Date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'Phone' => $request->client,
            'Off_Phone' => $request->client,
            'Address' => $request->client,
            'Address_2' => $request->client,
            'Poscode' => $request->client,
            'City' => $request->client,
            'State' => $request->client,
            'Country' => $request->client,
            'Ship_Phone' => $request->shipping['Ship_Phone'],
            'Ship_Name' => $request->shipping['Ship_Name'],
            'Ship_Add1' => $request->shipping['Ship_Add1'],
            'Ship_Add2' => $request->shipping['Ship_Add2'],
            'Ship_poscode' => $request->shipping['Ship_poscode'],
            'Ship_City' => $request->shipping['Ship_City'],
            'Ship_State' => $request->shipping['Ship_State'],
            'Ship_Country' => $request->shipping['Ship_Country'],
            'Product' => $request->products['items'][0]['product'],
            'Price' => $request->products['items'][0]['price'],
            'Qty' => $request->products['items'][0]['qty'],
            'Discount' => $request->products['items'][0]['discount'],
            'Total_RM' => $request->products['items'][0]['total'],

            'Product_2' => $request->products['items'][1]['product'],
            'Price_2' => $request->products['items'][1]['price'],
            'Qty_2' => $request->products['items'][1]['qty'],
            'Discount_2' => $request->products['items'][1]['discount'],
            'Total_RM_2' => $request->products['items'][1]['total'],

            'Product_3' => $request->products['items'][2]['product'],
            'Price_3' => $request->products['items'][2]['price'],
            'Qty_3' => $request->products['items'][2]['qty'],
            'Discount_3' => $request->products['items'][2]['discount'],
            'Total_RM_3' => $request->products['items'][2]['total'],

            'Product_4' => $request->products['items'][3]['product'],
            'Price_4' => $request->products['items'][3]['price'],
            'Qty_4' => $request->products['items'][3]['qty'],
            'Discount_4' => $request->products['items'][3]['discount'],
            'Total_RM_4' => $request->products['items'][3]['total'],

            // 'Product_5' => $request->products['items'][4]['product'],
            // 'Price_5' => $request->products['items'][4]['price'],
            // 'Qty_5' => $request->products['items'][4]['qty'],
            // 'Discount_5' => $request->products['items'][4]['discount'],
            // 'Total_RM_5' => $request->products['items'][4]['total'],

            // 'Product_6' => $request->products['items'][5]['product'],
            // 'Price_6' => $request->products['items'][5]['price'],
            // 'Qty_6' => $request->products['items'][5]['qty'],
            // 'Discount_6' => $request->products['items'][5]['discount'],
            // 'Total_RM_6' => $request->products['items'][5]['total'],

            // 'Product_7' => $request->products['items'][6]['product'],
            // 'Price_7' => $request->products['items'][6]['price'],
            // 'Qty_7' => $request->products['items'][6]['qty'],
            // 'Discount_7' => $request->products['items'][6]['discount'],
            // 'Total_RM_7' => $request->products['items'][6]['total'],

            // 'Product_8' => $request->products['items'][7]['product'],
            // 'Price_8' => $request->products['items'][7]['price'],
            // 'Qty_8' => $request->products['items'][7]['qty'],
            // 'Discount_8' => $request->products['items'][7]['discount'],
            // 'Total_RM_8' => $request->products['items'][7]['total'],

            'Grand_Total' => $request->products['grand_total'],

            'occupation_code' => $request->payment['occupation'],

            'Promise_pay' => $request->payment['items'][0]['ptp'] ? \Carbon\Carbon::parse($request->payment['items'][0]['ptp'])->format('Y-m-d') : '0000-00-00',
            'Payment1' => $request->payment['items'][0]['settlement'],
            'Promise_pay2' => $request->payment['items'][1]['ptp'] ? \Carbon\Carbon::parse($request->payment['items'][1]['ptp'])->format('Y-m-d') : null,
            'Payment2' => $request->payment['items'][1]['settlement'],
            'Promise_pay3' => $request->payment['items'][2]['ptp'] ? \Carbon\Carbon::parse($request->payment['items'][2]['ptp'])->format('Y-m-d') : null,
            'Payment3' => $request->payment['items'][2]['settlement'],
            'Promise_pay4' => $request->payment['items'][3]['ptp'] ? \Carbon\Carbon::parse($request->payment['items'][3]['ptp'])->format('Y-m-d') : null,
            'Payment4' => $request->payment['items'][3]['settlement'],

            'Consultant' => $request->sales['consultant'],
            'Consultant2' => $consultantName,
            'Channel' => $request->sales['channel'],
            'closing_code' => $request->sales['closing'],
            'Created_By' => Auth::user()->username,
            'Created_Date' => \Carbon\Carbon::now(),
            'Orderstatus' => $request->Orderstatus,
        ]);

        return redirect()->route('portfolio.invoice.show', [
            'invoice' => $id->Id,
        ])
            ->with('message', 'Invoice created successfully');
    }

    public function edit($portfolio, $id)
    {
        return Inertia::render('Invoice/Edit', [
            'invoice' => Invoice::with('client')->with('consultant')->find($id),
            'states' => State::get(),
            'countries' => config('countries'),
            'products' => Product::select('id', 'Code', 'Product_Name')->get(),
            'consultants' => Consultant::select('id', 'Name', 'Status', 'Employee_Code')->get(),
            'cmd' => Collector::select('id', 'Name')->get(),
        ]);
    }

    public function update(InvoiceRequest $request, $portfolio, $id)
    {
        Invoice::where('Id', $id)->update([
            'Status_Inv' => $request->Status_Inv,
            'Ship_Phone' => $request->shipping['Ship_Phone'],
            'Ship_Name' => $request->shipping['Ship_Name'],
            'Ship_Add1' => $request->shipping['Ship_Add1'],
            'Ship_Add2' => $request->shipping['Ship_Add2'],
            'Ship_poscode' => $request->shipping['Ship_poscode'],
            'Ship_City' => $request->shipping['Ship_City'],
            'Ship_State' => $request->shipping['Ship_State'],
            'Ship_Country' => $request->shipping['Ship_Country'],
            'Product' => $request->products['items'][0]['product'],
            'Price' => $request->products['items'][0]['price'],
            'Qty' => $request->products['items'][0]['qty'],
            'Discount' => $request->products['items'][0]['discount'],
            'Total_RM' => $request->products['items'][0]['total'],
            'Product_2' => $request->products['items'][1]['product'],
            'Price_2' => $request->products['items'][1]['price'],
            'Qty_2' => $request->products['items'][1]['qty'],
            'Discount_2' => $request->products['items'][1]['discount'],
            'Total_RM_2' => $request->products['items'][1]['total'],

            'Product_3' => $request->products['items'][2]['product'],
            'Price_3' => $request->products['items'][2]['price'],
            'Qty_3' => $request->products['items'][2]['qty'],
            'Discount_3' => $request->products['items'][2]['discount'],
            'Total_RM_3' => $request->products['items'][2]['total'],

            'Product_4' => $request->products['items'][3]['product'],
            'Price_4' => $request->products['items'][3]['price'],
            'Qty_4' => $request->products['items'][3]['qty'],
            'Discount_4' => $request->products['items'][3]['discount'],
            'Total_RM_4' => $request->products['items'][3]['total'],

            // 'Product_5' => $request->products['items'][4]['product'],
            // 'Price_5' => $request->products['items'][4]['price'],
            // 'Qty_5' => $request->products['items'][4]['qty'],
            // 'Discount_5' => $request->products['items'][4]['discount'],
            // 'Total_RM_5' => $request->products['items'][4]['total'],

            // 'Product_6' => $request->products['items'][5]['product'],
            // 'Price_6' => $request->products['items'][5]['price'],
            // 'Qty_6' => $request->products['items'][5]['qty'],
            // 'Discount_6' => $request->products['items'][5]['discount'],
            // 'Total_RM_6' => $request->products['items'][5]['total'],

            // 'Product_7' => $request->products['items'][6]['product'],
            // 'Price_7' => $request->products['items'][6]['price'],
            // 'Qty_7' => $request->products['items'][6]['qty'],
            // 'Discount_7' => $request->products['items'][6]['discount'],
            // 'Total_RM_7' => $request->products['items'][6]['total'],

            // 'Product_8' => $request->products['items'][7]['product'],
            // 'Price_8' => $request->products['items'][7]['price'],
            // 'Qty_8' => $request->products['items'][7]['qty'],
            // 'Discount_8' => $request->products['items'][7]['discount'],
            // 'Total_RM_8' => $request->products['items'][7]['total'],

            'Grand_Total' => $request->products['grand_total'],

            'occupation_code' => $request->payment['occupation'],

            'Promise_pay' => $request->payment['items'][0]['ptp'] ? \Carbon\Carbon::parse($request->payment['items'][0]['ptp'])->format('Y-m-d') : '0000-00-00',
            'Payment1' => $request->payment['items'][0]['settlement'],
            'Promise_pay2' => $request->payment['items'][1]['ptp'] ? \Carbon\Carbon::parse($request->payment['items'][1]['ptp'])->format('Y-m-d') : null,
            'Payment2' => $request->payment['items'][1]['settlement'],
            'Promise_pay3' => $request->payment['items'][2]['ptp'] ? \Carbon\Carbon::parse($request->payment['items'][2]['ptp'])->format('Y-m-d') : null,
            'Payment3' => $request->payment['items'][2]['settlement'],
            'Promise_pay4' => $request->payment['items'][3]['ptp'] ? \Carbon\Carbon::parse($request->payment['items'][3]['ptp'])->format('Y-m-d') : null,
            'Payment4' => $request->payment['items'][3]['settlement'],

            'Consultant' => $request->sales['consultant'],
            'Channel' => $request->sales['channel'],
            'closing_code' => $request->sales['closing'],
            'Last_Edited_By' => Auth::user()->username,
            'Last_Edited_Date' => \Carbon\Carbon::now(),
        ]);

        return redirect()->route('portfolio.invoice.show', [
            'invoice' => $id,
        ])->with('message', 'Invoice updated successfully');
    }

    public function invoice_no_list()
    {
        return Invoice::select('Id', 'Inv_No')->pluck('Id', 'Inv_No')->toJson();
    }

    public function calculateAging()
    {
        return 0;
    }

    public function storeNote(HttpRequest $request)
    {
        $this->validate($request, [
            'invoice_id' => 'required',
        ]);

        InvoiceNote::create([
            'Inv_No' => $request->invoice_id,
            'Notes' => $request->note,
            'Created_By' => Auth::user()->username,
            'Created_On' => \Carbon\Carbon::now(),
        ]);

        return back();
    }
}
