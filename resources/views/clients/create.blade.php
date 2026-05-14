<html>
    <head> 
        <title> Add Client</title>
    </head>
    <body> 
       <h1> Add Client</h1>

       <form action="{{ route('clients.store') }}" method="POST">
        @csrf

        <input type="text" name="client_name" placeholder="Client Name">
        <input type="email" name="email" placeholder="Email">
        <input type="text" name="phone" placeholder="Phone">
        <input type="text" name="client_address" placeholder="Address">
        <input type="text" name="city" placeholder="City">
        <input type="text" name="country" placeholder="Country">
 
            <input type="submit" value="Save Client"  >

       </form>



    </body>
    </html>




