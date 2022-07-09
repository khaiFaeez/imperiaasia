<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $connection = Auth::user()->current_portfolio->db_connection;

        $ss = Invoice::whereIn('Product', [1, 5, 6, 7, 8, 9, 13])
            ->selectRaw('DATE(Created_Date) as days, SUM(Qty) as qty')
            ->whereRaw('DATE(Created_Date) >= DATE(NOW()) - INTERVAL 7 DAY')
            ->orderByDesc('days')
            ->groupBy('days')
            ->get();

        $period = CarbonPeriod::create(Carbon::today()->subDays(7), Carbon::today());

        $period->map(function ($date) {
            $date->format('Y-m-d');
        });

        $days = [];
        $total = [];

        foreach ($ss as $s) {
            foreach ($period as $date) {
                if ($date->format('Y-m-d') == $s->days) {
                    $days[] = $date->format('Y-m-d');
                    $total[] = $s->qty;
                } else {
                    $days[] = $date->format('Y-m-d');
                    $total[] = 0;
                }
            }
        }

        return Inertia::render('Dashboard', [
            'total_invoice' => DB::connection($connection)
                ->table('Invoice')
                ->count(),
            'users' => DB::table('users')->count(),
            'clients' => DB::connection($connection)
                ->table('Client')
                ->count(),
            'portfolios' => DB::table('portfolios')
                ->count(),
            'bottles' => [
                'days' => $days,
                'total' => $total,
            ],
        ]);
    }
}
