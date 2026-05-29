<?php

namespace App\Mail;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public Invoice $invoice;


    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice ' . $this->invoice->invoice_number . '  -Invoice Portal ',

        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'emails.invoice',
        );
    }


    public function attachments(): array
    {
        $items = $this->invoice->items;
    
        $clint = $this->invoice->client;
    
        $pdf = Pdf::loadView('invoices.pdf', [
            'invoice' => $this->invoice,
            'items' => $items,
            'clint' => $clint,
        ]);
    
        return [
            Attachment::fromData(
                fn () => $pdf->output(),
                'Invoice-' . $this->invoice->invoice_number . '.pdf'
            )->withMime('application/pdf'),
        ];
    }
}
