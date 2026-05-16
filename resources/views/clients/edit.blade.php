<html>
    <head> 
        <title> Edit Client</title>
    </head>
    <body> 
       <h1> Edit  Client</h1>

       <form action="{{ route('clients.update' , $client->id ) }}" method="POST" >
        @method('PATCH')
        @csrf

        <input type="text" name="client_name" value="{{$client->client_name}}" placeholder="Client Name">
        <input type="email" name="email"  value="{{ $client->email }}"  placeholder="Email">
        <input type="text" name="phone" value="{{ $client->phone}}" placeholder="Phone">
        <input type="text" name="client_address"  value="{{ $client->address}}"  placeholder="Address">
        <input type="text" name="city" value="{{ $client->city }}" placeholder="City">
        <input type="text" name="country" value="{{ $client->country }}" placeholder="Country">
 
            <input type="submit" value="Update Client"  >

       </form>



    </body>
    </html>




