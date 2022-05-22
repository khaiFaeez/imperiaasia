<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class SetDefaultPortfolioForUrls
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, Closure $next)
    {
        if (Route::current('portfolio.*')) {
            URL::defaults(['portfolio' => $request->user()->currentPortfolio->name ?? ""]);
        }

        return $next($request);
    }
}
