<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Stripe\Stripe;
use Stripe\Checkout\Session;

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
 
 

public function checkout(Invoice $invoice)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));

    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'inr',
                'product_data' => [
                    'name' => 'Invoice ' . $invoice->invoice_number,
                ],
                'unit_amount' => $invoice->total * 100,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('invoices.payment.success', $invoice->id) . '?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => route('invoices.show', $invoice->id),
    ]);

    return redirect($session->url);
}

public function paymentSuccess(Invoice $invoice, Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));

    $session = Session::retrieve($request->session_id);

    if ($session->payment_status === 'paid') {
        
        $invoice->update(['status' => 'paid']);

        Payment::create([
            'invoice_id'     => $invoice->id,
            'amount'         => $invoice->total,
            'payment_date'   => now(),
            'payment_method' => 'stripe',
            'transaction_id' => $session->payment_intent,
        ]);
    }

    return redirect()->route('invoices.show', $invoice->id);
}


}
