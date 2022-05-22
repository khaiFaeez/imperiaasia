<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class DashboardController extends Controller
{
    //

    public function index()
    {

        $db =  array_keys(config('portfolio.list'));

        // $q1 = DB::table(array_keys(config('portfolio.list'))[0] . '.Invoice')->select('Id');

        // $q2 = DB::table(array_keys(config('portfolio.list'))[1] . '.Invoice')->select('Id');

        // $result = $q2->union($q1)->toSql();

        // dd($result);
        $total_invoice = 0;
        $total_client = 0;
        // $total_invoice = Cache::remember('total_invoice', 60, function () use ($db, $total_invoice) {
        foreach ($db as $portfolio) {
            $total_invoice += DB::table($portfolio . '.Invoice')->count('Id');
            $total_client += DB::table($portfolio . '.Client')->count('id');
        }
        // });


        return Inertia::render('Dashboard', [
            'total_invoice' => $total_invoice,
            'users' => DB::table('users')->count(),
            'clients' => $total_client
        ]);
    }

    //TOTAL INVOICES

}
