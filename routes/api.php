<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\InvoiceController;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('invoice', InvoiceController::class)->except('show');
});

// Route::post('login', [AuthController::class, 'login']);
// Route::post('register', [AuthController::class, 'register']);


Route::group(['middleware' => 'auth:sanctum'], function () {
    // list all posts
    Route::get('posts', [InvoiceController::class, 'post']);
    // get a post
    Route::get('posts/{id}', [InvoiceController::class, 'singlePost']);
    // add a new post
    Route::post('posts', [InvoiceController::class, 'createPost']);
    // updating a post
    Route::put('posts/{id}', [InvoiceController::class, 'updatePost']);
    // delete a post
    Route::delete('posts/{id}', [InvoiceController::class, 'deletePost']);
    // add a new user with writer scope
    Route::post('users/writer', [InvoiceController::class, 'createWriter']);
    // add a new user with subscriber scope
    Route::post(
        'users/subscriber',
        [InvoiceController::class, 'createSubscriber']
    );
    // delete a user
    Route::delete('users/{id}', [InvoiceController::class, 'deleteUser']);
});
