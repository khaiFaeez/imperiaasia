<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ClientController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});


require __DIR__ . '/auth.php';


Route::group(['middleware' => ['auth']], function () {
    Route::get('clear/token', function () {
        if (Auth::check() && Auth::user()->hasRole('superadmin')) {
            Auth::user()->tokens()->delete();
        }
        return 'Token Cleared';
    });

    Route::get('update-password', function () {
        return view('update-password');
    })->name('password.edit');

    Route::post('update-password', [UserController::class, 'updatePassword'])->name('password.store');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    //SUB-DOMAIN
    Route::domain('{portfolio}.' . env('SESSION_DOMAIN'))->name('portfolio.')->group(function () {
        Route::resource('invoice', InvoiceController::class);
        Route::resource('client', ClientController::class);
        Route::get('dashboard', function () {
            return view('dashboard', ['portfolio' => 'platinum']);
        })->name('dashboard');
    });
});

Route::group(['middleware' => ['auth', 'restrictothers']], function () {
    Route::resource('roles', RoleController::class)->except(['create', 'store', 'show', 'destroy']);
    Route::resource('users', UserController::class)->except('destroy');
    Route::post('register', [RegisteredUserController::class, 'register']);
});
