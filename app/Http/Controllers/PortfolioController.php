<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    //

    public function change_portfolio($portfolio)
    {

        if (!Auth::user()->portfolios->contains('id', $portfolio)) {
            abort(403);
        }
        User::where('id', Auth::user()->id)->update(['current_portfolio_id' => $portfolio]);
        Session::put('portfolio_db', Auth::user()->currentPortfolio->db_connection);

        return Inertia::location(route('portfolio.dashboard'));
    }
}
