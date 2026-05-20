<html>
    <head>
        <title>  </title>
    </head>
    <body>
        <a href="{{ route('invoices.pdf', $invoice->id) }}"><button>Download PDF </button> </a>
<ul> 
    <li> Invoice  Id : {{$invoice->id}}</li>
    <li>   User Id : {{$invoice->user_id}}</li>
    <li> Client Id: {{$invoice->client_id}}</li>
    <li> Invoice  Number: {{$invoice->invoice_number }}</li>
    <li> Invoice  Date: {{$invoice->invoice_date }}</li>
    <li> Due Date: {{$invoice->due_date}}</li>
    <li> Subtotal: {{$invoice->subtotal}}</li>
    <li> Tax : {{$invoice->tax}}</li>
    <li> Discount: {{$invoice->discount}}</li>
    <li> Total: {{$invoice->total}}</li>
    <li> Notes: {{$invoice->notes}}</li>


    @foreach ($items as $item )
    <li> item_name : {{$item->item_name }}</li>
    <li> quantity : {{$item->quantity }}</li>
    <li> Price: {{$item->price}}</li>
    <li>Total: {{ $item->total }} </li>
        
    @endforeach
  
  
</ul>
    </body>
    </html>