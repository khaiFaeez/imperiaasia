<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function show($portfolio = null)
    {
        return view('invoice.show', ["portfolio" => $portfolio]);
    }
}
