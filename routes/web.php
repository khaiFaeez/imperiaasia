<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Auth;
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

// This serves as the create token page
Route::get('dashboard', function () {

    return view('dashboard');
    // if (Auth::check() && Auth::user()->hasRole('superadmin')) {
    //     return auth()
    //         ->user()
    //         ->createToken('auth_token', ['superadmin'])
    //         ->plainTextToken;
    // }
    // return redirect("/");
})->middleware('auth')->name('dashboard');


require __DIR__ . '/auth.php';

Route::get('clear/token', function () {
    if (Auth::check() && Auth::user()->hasRole('superadmin')) {
        Auth::user()->tokens()->delete();
    }

    return 'Token Cleared';
})->middleware('auth');

Route::group(['middleware' => ['auth', 'restrictothers']], function () {
    Route::resource('roles', RoleController::class)->except(['create', 'store', 'show', 'destroy']);
    Route::resource('users', UserController::class)->except('destroy');
    Route::post('register', [RegisteredUserController::class, 'register']);
    Route::get('edit-password', [RegisterController::class, 'register']);
});
