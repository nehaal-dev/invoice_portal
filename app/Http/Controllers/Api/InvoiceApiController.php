<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceApiController extends Controller
{
    public function index()
    {
        $invoice_api_data = Invoice::where('user_id', auth()->id())->get();
        return response()->json($invoice_api_data); //we have to 
    }


    public function show(Invoice $invoice)
    {
        return response()->json('invoice');  //here we use route model binding , all data already stored in $invoice varable. 
    }

    public function store(Request  $request){
       $invoice= Invoice::create([

            'user_id' => auth()->id(),
            'client_id' => $request->client_id,
            'invoice_number' =>'INV -' .str_pad(Invoice::count()+1 , 3 , 0 , STR_PAD_LEFT),
            
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'status' => $request->status ?? 'draft',
            'subtotal' => 0,
            'tax' =>$request->tax,
            'discount' =>$request->discount,
            'total' => 0,
            'notes' => $request->notes

        ]);

        return response( ) -> json([
            'message' => 'Invoice created successfully',
            'invoice' => $invoice
        ] , 201 ) ;
         


    }
 
}
