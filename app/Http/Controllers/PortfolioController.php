<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    //

    public function __invoke($portfolio)
    {

        if (!Auth::user()->portfolios->contains('id', $portfolio)) {
            abort(403);
        }
        User::where('id', Auth::user()->id)->update(['current_portfolio_id' => $portfolio]);

        return Inertia::location(route('portfolio.dashboard', ['portfolio' => Portfolio::where('id', $portfolio)->first()->db_connection]));
    }
}
