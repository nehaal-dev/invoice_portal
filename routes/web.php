<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\AiController;

Route::get('/', function () {
   
    return Redirect()->route('login');
});

 

Route::get('/dashboard' , [DashboardController::class , 'index'])
->middleware(['auth' ,'verified'])
->name('dashboard') ;



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::patch('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');


    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::get('/invoices/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
    Route::patch('/invoices/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
    Route::delete('/invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');


    Route::get('/invoices/{invoice}/pdf' , [InvoiceController::class , 'downloadPdf'])->name('invoices.pdf');
});

Route::get('/invoices/{invoice}/checkout', [InvoiceController::class, 'checkout'])->name('invoices.checkout');
Route::get('/invoices/{invoice}/payment-success', [InvoiceController::class, 'paymentSuccess'])->name('invoices.payment.success');


Route::get('/invoices/{invoice}/send-email',[InvoiceController::class, 'sendEmail'])->name('invoices.send.email');


Route::get('/subscription', [SubscriptionController::class, 'index'])->name('subscription.index');
Route::get('/subscription/checkout', [SubscriptionController::class, 'checkout'])->name('subscription.checkout');
Route::get('/subscription/success', [SubscriptionController::class, 'success'])->name('subscription.success');

Route::get('/invoices/create', [InvoiceController::class, 'create']) ->middleware('check.subscription') ->name('invoices.create');

//AI Integration 
Route::post('/ai/generate-description', [AiController::class, 'generateDescription'])->name('ai.generate');

Route::middleware(['auth' , 'client'])->group(function(){
    Route::get('/portal' , [ClientController::class , 'index'] )->name('portal.index');
    Route::get('/portal/invoices/{invoice}', [ClientController::class , 'show'])->name('portal.show');
});


require __DIR__ . '/auth.php';


