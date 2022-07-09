<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::post('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::post('register', [RegisteredUserController::class, 'register']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('/portfolio/change/{portfolio}', PortfolioController::class)->name('portfolio.change');
});
