<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request as RequestHttp;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class PrintController extends Controller
{
    protected $portfolio;

    public function __construct()
    {
        $this->portfolio = Route::current() ? Route::current()->parameter('portfolio') : '';
    }

    public function index()
    {
        return Inertia::render('Print/Index', [
            'invoices' => Invoice::with('client')->with('state')->orderBy('Id', 'desc')->where('Invoice_Status', 0)->orWhere('Docket_Status', 0)->paginate(20),
            'attribute_name' => csrf_token(),
            'ids' => Request::get('ids'),
            'selected' => [],

        ]);
    }

    public function print_invoices(RequestHttp $request)
    {
        $ids = array_map('intval', explode(',', $request->get('ids')));

        $invoices = Invoice::whereIn('Id', $ids)->get();

        $pdf = new PdfController();
        $pdf->printInvoices($invoices);
    }

    public function print_dockets(RequestHttp $request)
    {
        $ids = array_map('intval', explode(',', $request->get('ids')));

        $invoices = Invoice::whereIn('Id', $ids)->get();

        $pdf = new DocketController();
        $pdf->printDockets($invoices);
    }
}
