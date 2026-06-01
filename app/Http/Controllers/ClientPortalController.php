<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;


class ClientPortalController extends Controller
{
    
    public function index(){

        $invoices=Invoice::where('client_id' , auth()->user()->client_id)->get();

        return view('client-portal.index' , compact('invoices')) ;
    }

    public function show(Invoice $invoice){

        $items=InvoiceItem::where('invoice_id',$invoice->id)->get();
        return view('client-portal.show' , compact('items'));
    }

}
