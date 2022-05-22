<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrintController;


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('invoice', InvoiceController::class);
    Route::resource('client', ClientController::class);
    Route::get('/invoice/repeat/{invoice_id}', [InvoiceController::class, 'repeatOrder'])->name('invoice.repeat');
    Route::get('/invoice/create/{client_id}', [InvoiceController::class, 'create'])->name('invoice.create');
    Route::get('/invoice/pdf/{invoice}', [PdfController::class, 'printInvoice'])->name('invoice.pdf');
    Route::get('/print/invoice/', [PrintController::class, 'index'])->name('invoice.bulk.pdf');
    Route::get('/invoice_no', [InvoiceController::class, 'invoice_no_list']);
});
