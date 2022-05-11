<?php

use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\DashboardController;

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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //SUB-DOMAIN
    Route::domain('{portfolio}.' . env('SESSION_DOMAIN'))->name('portfolio.')->group(function () {
        Route::resource('invoice', InvoiceController::class);
        Route::resource('client', ClientController::class);
        Route::get('/invoice/repeat/{invoice_id}', [InvoiceController::class, 'repeatOrder'])->name('invoice.repeat');
        Route::get('/invoice/create/{client_id}', [InvoiceController::class, 'create'])->name('invoice.create');
        Route::get('/invoice/pdf/{invoice}', [PdfController::class, 'printInvoice'])->name('invoice.pdf');
        Route::get('/print/invoice/', [PdfController::class, 'index'])->name('invoice.bulk.pdf');
    });
});

Route::group(['middleware' => ['auth', 'restrictothers']], function () {
    Route::resource('roles', RoleController::class)->except(['store', 'show', 'destroy']);
    Route::resource('users', UserController::class)->except('destroy');
    Route::post('register', [RegisteredUserController::class, 'register']);
});
