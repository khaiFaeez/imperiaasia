<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request as RequestHttp;
use Inertia\Inertia;

class PrintController extends Controller
{
    protected $portfolio;
    public function __construct()
    {
        $this->portfolio = Route::current() ? Route::current()->parameter("portfolio") : "";
    }

    public function index()
    {
        $filter = Request::all();


        $from = $filter['from'] ?? '';
        $to = $filter['to'] ?? '';
        $limit = $filter['limit'] ?? 10;

        if ($filter) {
            $invoice = Invoice::with('client')
                ->with('state')
                ->orderBy('Id', 'desc')
                ->when($filter, function ($query, $filter) {
                    $query->whereBetween('Inv_No', [$filter['from'], $filter['to']]);
                })
                ->limit($limit)
                ->get();
        } else {
            $invoice = [];
        }



        return Inertia::render('Print/Index', [
            'invoices' => $invoice,
            'value_help' => Invoice::orderBy('Id', 'desc')->limit(1000)->pluck('Inv_No')->toArray(),
            'limit' => $limit,
            'from' => $from,
            'to'   => $to,
            'attribute_name' => csrf_token(),
            'ids' => is_array($invoice) ?  $invoice : $invoice->pluck('Id')

        ]);
    }

    public function print_invoices(RequestHttp $request)
    {
        $ids = array_map('intval', explode(',', $request->get('ids')));

        $invoices  = Invoice::whereIn("Id", $ids)->get();

        $pdf = new PdfController();
        $pdf->printInvoices($invoices);
    }

    public function print_dockets(RequestHttp $request)
    {
        $ids = array_map('intval', explode(',', $request->get('ids')));

        $invoices  = Invoice::whereIn("Id", $ids)->get();

        $pdf = new DocketController();
        $pdf->printDockets($invoices);
    }
}
