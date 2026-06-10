<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Client;



class ClientPortalController extends Controller
{

    public function index()
    {

        $invoices = Invoice::where('client_id', auth()->user()->client_id)->get();

        return view('client-portal.index', compact('invoices'));
    }

    public function show(Invoice $invoice) {
        if ($invoice->client_id != auth()->user()->client_id) {
            return redirect()
                ->route('portal.index')
                ->with('error', 'You are not authorized to view this invoice.');
        }

        $items = InvoiceItem::where('invoice_id', $invoice->id)->get();
        return view('client-portal.show', compact('invoice', 'items'));
    }

    public function downloadPdf(Invoice $invoice)
    {
        if ($invoice->client_id != auth()->user()->client_id) {
            return redirect()
                ->route('portal.index')
                ->with('error', 'You are not authorized to download this invoice.');
        }
        
        $items = InvoiceItem::where('invoice_id', $invoice->id)->get();
        $clint = Client::find($invoice->client_id);
        $pdf = Pdf::loadView('invoices.pdf', compact(
            'invoice',
            'items',
            'clint'
        ));

        return $pdf->download('Invoice-' . $invoice->invoice_number . '.pdf');
    }
}

$exist=Invoice::where('name' , $req->name)->find();

if($exist){
    return back()->with('error' , 'Category name already exist');
 
}

$exist=Invoice::where('name', $req->name)->find()
->orwhere('email', $req->email)
->orWhere('phone', $req->phone)
->exist() ;

if($exist){
    return back()->with('error' , 'All fields already entered');
}
