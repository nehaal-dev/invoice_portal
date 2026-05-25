<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InvoiceApiController;
use App\Http\Controllers\Api\ClientApiController;

Route::middleware('auth:sanctum')->group(function () {
    
    // Invoice API routes
    Route::get('/invoices', [InvoiceApiController::class, 'index']);
    Route::get('/invoices/{invoice}', [InvoiceApiController::class, 'show']);
    Route::post('/invoices', [InvoiceApiController::class, 'store']);
    
    // Client API routes
    Route::get('/clients', [ClientApiController::class, 'index']);
    Route::post('/clients', [ClientApiController::class, 'store']);

});

Route::post('/login' , function(Request $request){
    $credential=$request->only('email', 'password');

    if(!auth()->attempt($credential)){
        return response()->json(['message' => 'Authentication Failed'] , 401) ;

    } 
$token=auth()->user()->createToken('api-token')->plainTextToken;

return response()->json(['token'=>$token]) ;

});