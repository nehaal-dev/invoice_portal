<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\InvoiceItem;

class InvoiceController extends Controller
{

    public function index() {}


    public function create()
    {
        $clients = Client::where('user_id', auth()->id())->get();
        return view('invoices.create', compact('clients'));
    }


    public function store(Request $request)
    {
// dd($request->all());
        $request->validate([
            'invoice_date' => 'date|nullable',
            'due_date'  => 'date|nullable',
            'tax'  => 'numeric|nullable',
            'discount' => 'numeric|nullable',
            'notes' => 'string|nullable',
            'item_name.*' => 'string|nullable',
            'quantity.*' => 'numeric|nullable',
            'price.*' => 'numeric|nullable',

        ]);

        $invoice=Invoice::create([
            'user_id' =>auth()->id(),
            'client_id' => $request->client_id,
            'invoice_number'  => 'INV-'.str_pad(Invoice::count() +1 ,3,'0' ,STR_PAD_LEFT ) ,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'tax' => $request->tax,
            'discount' => $request->discount,
            'notes' => $request->notes

        ]);
 

            foreach($request->item_name as $index=>$item_name){
                InvoiceItem::create([
                    'invoice_id' =>$invoice->id,
                    'item_name' => $item_name,
                    'quantity' => $request->quantity[$index],
                    'price' => $request->price[$index],
                    'total' => $request->price[$index]*$request->quantity[$index]

                ]);
            } 
            return redirect()->route('invoices.index'); 
    }


    public function show(Invoice $invoice) {}


    public function edit(Invoice $invoice) {}


    public function update(Request $request, Invoice $invoice) {}


    public function destroy(Invoice $invoice) {}
}
