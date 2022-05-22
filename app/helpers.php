<?php

use App\Models\Invoice;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;


if (!function_exists('invoice_number')) {
    function invoice_number()
    {
        // $portfolio = Route::current() ? Route::current()->parameter("portfolio") : "";

        // Config::set('database.default', $portfolio);
        return Invoice::select('Id', 'Inv_No')->pluck('Id', 'Inv_No');
    }
}
