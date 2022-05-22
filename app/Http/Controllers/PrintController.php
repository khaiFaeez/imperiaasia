<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
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
        Config::set('database.default', $this->portfolio);
        // Cache::remember('invoice_id', 60, function () {
        //     return Invoice::select('Id', 'Inv_No')->pluck('Id', 'Inv_No');
        // })
        return Inertia::render('Print/Index', ['invoices' => Inertia::lazy(fn () => Invoice::select('Id')->pluck('Id'))]);
    }
}
