<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\RegisteredUserController;

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
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('roles', RoleController::class)->except(['store', 'show', 'destroy']);
    Route::resource('users', UserController::class)->except('destroy');
    Route::post('register', [RegisteredUserController::class, 'register']);
});
