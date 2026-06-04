<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\InvoiceItem;
use Barryvdh\DomPDF\Facade\Pdf;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Payment;

use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
use App\Mail\PaymentConfirmationMail;


class InvoiceController extends Controller
{

    // public function index()
    // {
    //     $invoices = Invoice::where('user_id', auth()->id())->get();
    //     return view('invoices.index', compact('invoices'));
    // }
    public function index(Request $request)
    {
        $invoices = Invoice::where('user_id', auth()->id())
            ->when($request->search, function ($q) use ($request) {
                $q->where('invoice_number', 'like', '%' . $request->search . '%')
                    ->orWhereHas('client', function ($q) use ($request) {
                        $q->where('client_name', 'like', '%' . $request->search . '%');
                    });
            })
            ->when($request->status, function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->get();

        return view('invoices.index', compact('invoices'));
    }


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

        $sub_total = 0;
        foreach ($request->item_name  as $index => $name) {

            $sub_total += $request->quantity[$index] * $request->price[$index];
        }
        $total = $sub_total + ($sub_total * $request->tax / 100) - $request->discount;

        $invoice = Invoice::create([
            'user_id' => auth()->id(),
            'client_id' => $request->client_id,
            'invoice_number'  => 'INV-' . str_pad(Invoice::max('id') + 1, 3, '0', STR_PAD_LEFT),
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'status' => $request->status,  //add here status
            'subtotal' => $sub_total,
            'total' => $total,
            'tax' => $request->tax,
            'discount' => $request->discount,
            'notes' => $request->notes

        ]);


        foreach ($request->item_name as $index => $item_name) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'item_name' => $item_name,
                'quantity' => $request->quantity[$index],
                'price' => $request->price[$index],
                'total' => $request->price[$index] * $request->quantity[$index]

            ]);
        }
        return redirect()->route('invoices.index');
    }


    public function show(Invoice $invoice)
    {
        $invoice->load('payment');
        $items = InvoiceItem::where('invoice_id', $invoice->id)->get();
        return view('invoices.show', compact('invoice', 'items'));
    }


    public function edit(Invoice $invoice)
    {
        $clients = Client::where('user_id', auth()->id())->get();
        $items = InvoiceItem::where('invoice_id', $invoice->id)->get();

        return view('invoices.edit', compact('invoice', 'clients', 'items'));
    }



    public function update(Request $request, Invoice $invoice)
    {

        $invoice->update([

            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'status' => $request->status, // add here status
            'tax' => $request->tax,
            'discount' => $request->discount,
            'notes' => $request->notes
        ]);

        $invoice->items()->delete();
        foreach ($request->item_name as $index => $item_name) {

            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'item_name' => $item_name,
                'quantity' => $request->quantity[$index],
                'price'  => $request->price[$index],
                'total' => $request->quantity[$index] * $request->price[$index]
            ]);
        }



        return redirect()->route('invoices.index');
    }


    public function destroy(Invoice $invoice)
    {
        //$invoice->delete(); ye bhi sahi h
        Invoice::destroy($invoice->id);
        return redirect()->route('invoices.index');
    }






    public function downloadPdf(Invoice $invoice)
    {
        $invoice->load('payment');

        $items = InvoiceItem::where('invoice_id', $invoice->id)->get();
        $clint = Client::find($invoice->client_id);
        $pdf = Pdf::loadView('invoices.pdf', compact('invoice', 'items', 'clint'));
        return $pdf->download('Invoice-' . $invoice->invoice_number . '.pdf');
        // return $pdf->stream('Invoice-' . $invoice->invoice_number . '.pdf'); for testing in browser use stream()
    }

//     public function sendEmail(Invoice $invoice){
//     Mail::to($invoice->client->email)
//         //->queue(new InvoiceMail($invoice));
//         ->send(new InvoiceMail($invoice));

//     return redirect()
//         ->route('invoices.show', $invoice->id)
//         ->with('success', 'Invoice email queued successfully!');

//         Mail::to($invoice->client->email)  
// }

public function sendEmail(Invoice $invoice)
{
    try {
        Mail::to($invoice->client->email)
            ->send(new InvoiceMail($invoice));

        return "MAIL SENT";
    } catch (\Throwable $e) {
        return response()->json([
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ]);
    }
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

            $existingPayment = Payment::where(
                'transaction_id',
                $session->payment_intent
            )->first();

            if (!$existingPayment) {

                $payment = Payment::create([
                    'invoice_id'     => $invoice->id,
                    'amount'         => $invoice->total,
                    'payment_date'   => now(),
                    'payment_method' => 'stripe',
                    'transaction_id' => $session->payment_intent,
                ]);

                //dd($payment);

                $invoice->update([
                    'status' => 'paid'
                ]);
                Mail::to($invoice->client->email)->send(new PaymentConfirmationMail($invoice));
            }

            return redirect()
                ->route('invoices.show', $invoice->id)
                ->with('success', 'Payment completed successfully!');
        }

        return redirect()
            ->route('invoices.show', $invoice->id)
            ->with('error', 'Payment failed!');
    }
}
