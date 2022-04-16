<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    protected $inv;
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $portfolio = $request->get('portfolio');
        Cache::put('portfolio', $portfolio);
        if ($portfolio === 'platinum') {
            $invoices = new Invoice;
            $invoices->setConnection($portfolio);
            $invoices = $invoices->paginate(15);
        }

        return view('invoice.index', ["portfolio" => $portfolio, 'invoices' => $invoices]);
    }


    public function show()
    {
    }

    public function changeConnection($portfolio)
    {
        $this->inv = DB::connection($portfolio)->table('Invoice');
    }
}
