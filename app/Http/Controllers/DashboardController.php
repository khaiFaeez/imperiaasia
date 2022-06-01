<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    //

    public function index()
    {

        return Inertia::render('Dashboard', [
            'total_invoice' => DB::connection(Auth::user()->current_portfolio->db_connection)->table('Invoice')->count(),
            'users' => DB::table('users')->count(),
            'clients' => DB::connection(Auth::user()->current_portfolio->db_connection)->table('Client')->count(),
            'portfolios' => DB::table('portfolios')->count()
        ]);
    }

    //TOTAL INVOICES

}
