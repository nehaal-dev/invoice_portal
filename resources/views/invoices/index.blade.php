<html>

<head>
    <title> </title>
</head>
<h1> Invoice Data </h1>

<body>
    <table border="2">
        <tr>
            <th>ID</th>
            <th>User Id </th>
            <th>Client Id</th>
            <th>Invoice No</th>
            <th>Invoice Date</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Sub Total </th>
            <th>Tax</th>
            <th>Discount</th>
            <th>Total</th>
            <th>Notes</th>
            <th>Action</th>
        </tr>

        @foreach ($invoices as $invoice)
            <tr>
                <td>{{ $invoice->id }} </td>
                <td>{{ $invoice->user_id }} </td>
                <td>{{ $invoice->client_id }} </td>
                <td>{{ $invoice->invoice_number }} </td>
                <td>{{ $invoice->invoice_date }} </td>
                <td>{{ $invoice->due_date }} </td>
                <td>{{ $invoice->status }} </td>
                <td>{{ $invoice->subtotal }} </td>
                <td>{{ $invoice->tax }} </td>
                <td>{{ $invoice->discount }} </td>
                <td>{{ $invoice->total }} </td>
                <td>{{ $invoice->notes }} </td>

                <td>
                    <a href="{{ route('invoices.edit', $invoice->id) }}"> <button>Edit </button> </a> &nbsp&nbsp

                    <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                   <a href="{{ route('invoices.show' , $invoice->id) }}"  >  <button>Show</button>  </a> 
                </td>
            </tr>
        @endforeach


    </table>
</body>

</html>
