<html>

<head>
    <title>Edit Invoices</title>
</head>

<body>
    <h1>Edit Invoices </h1>

    <form action="{{ route('invoices.update' , $invoice->id ) }}" method="POST">
        @method('PATCH')
        @csrf

        <label>Client Name</label>
        <select name="client_id">
            @foreach ($clients as $client)
                <option value="{{ $client->id }}"> {{ $client->client_name }}</option>
            @endforeach
        </select> &nbsp&nbsp

        <input type="date" name="invoice_date"  value="{{ $invoice->invoice_date}}"> &nbsp&nbsp &nbsp&nbsp
        <input type="date" name="due_date" value="{{ $invoice->due_date }}"> &nbsp&nbsp &nbsp&nbsp
        <input type="number" name="tax" placeholder="Enter Tax Slab" value="{{ $invoice->tax }}"> &nbsp&nbsp &nbsp&nbsp
        <input type="number" name="discount" placeholder="Enter Discount" value="{{ $invoice->discount }}"> &nbsp&nbsp &nbsp&nbsp


        <textarea name="notes" placeholder="Enter your Notes" >{{ $invoice->notes }} </textarea> <br></br>


        <div id="items-container">

            @foreach ($items as $item )
            <div class="item-row">
                <input type="text" name="item_name[]" placeholder="Enter Item Name" value="{{ $item->item_name }}">
                <input type="number" name="quantity[]" placeholder="Enter Quantity" value="{{ $item->quantity }}">
                <input type="number" name="price[]" placeholder="Enter Price" value="{{ $item->price }}">
            </div>                
            @endforeach
           
        </div>&nbsp  <br><br>

        <button type="button" id="add-items">Edit Items </button> <br><br>


        <input type="submit" name="" value="Update">

       
        <script>
  
  document.getElementById('add-items').addEventListener('click' , function(){

   var container = document.getElementById('items-container');
    var newRow = document.createElement('div') ;

    newRow.classList.add('item-row') ;

    newRow.innerHTML=`
            <input type="text" name="item_name[]" placeholder="Enter Item Name">
            <input type="number" name="quantity[]" placeholder="Enter Quantity">
            <input type="number" name="price[]" placeholder="Enter Price">
        `;
 
container.appendChild(newRow)

  });
        </script>
    </form>
</body>

</html>
