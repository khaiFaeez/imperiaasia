<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    //

    public function index()
    {

        return Inertia::render('Dashboard', [
            'total_invoice' => DB::connection('platinum')->table('Invoice')->count(),
            'users' => DB::table('users')->count()
        ]);
    }

    //TOTAL INVOICES

}
