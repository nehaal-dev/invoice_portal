<html>

<head>
    <title>Add Invoices</title>
</head>

<body>
    <h1>Add Invoices </h1>

    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf

        <label>Client Name</label>
        <select name="client_id">
            @foreach ($clients as $client)
                <option value="{{ $client->id }}"> {{ $client->client_name }}</option>
            @endforeach
        </select> &nbsp&nbsp

        <input type="date" name="invoice_date"> &nbsp&nbsp &nbsp&nbsp
        <input type="date" name="due_date"> &nbsp&nbsp &nbsp&nbsp
        <input type="number" name="tax" placeholder="Enter Tax Slab"> &nbsp&nbsp &nbsp&nbsp
        <input type="number" name="discount" placeholder="Enter Discount"> &nbsp&nbsp &nbsp&nbsp


        <textarea name="notes" placeholder="Enter your Notes"> </textarea> <br></br>


        <div id="items-container">
            <div class="item-row">
                <input type="text" name="item_name[]" placeholder="Enter Item Name">
                <input type="number" name="quantity[]" placeholder="Enter Quantity">
                <input type="number" name="price[]" placeholder="Enter Price">
            </div>
        </div>&nbsp  <br><br>

        <button type="button" id="add-items">Add Items </button> <br><br>


        <input type="submit" name="" value="Save">

       
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
