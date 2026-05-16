<!DOCTYPE html>
<html>
<head>
    <title>Clients</title>
</head>
<body>

    <h1>My Clients</h1>
    
    <a href="{{ route('clients.create') }}">Add New Client</a>

    <table  class="table" border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address </th>
            <th>City</th>
            <th>Country</th>
            <th>EDIT</th>
            <th>DELETE</th>
            <th>Show<th>
        </tr>

     @foreach ($client as  $c)
     <tr>  
        <td>{{ $c ->client_name }} </td>
        <td>{{ $c ->email }}  </td>
        <td>{{ $c ->phone}} </td>
        <td>{{ $c ->address }} </td>
        <td>{{ $c->city }} </td>
        <td>{{ $c->country }} </td>

        <td>
            <a href="{{ route('clients.edit' , $c->id  ) }}" >  <button> Edit</button>  </a>
        </td>
        <td>
            <form action="{{ route('clients.destroy' , $c->id ) }}" method="POST">
                @csrf
         @method('DELETE')

                <button type="submit">DELETE  </button>
            </form>
            
         </td>

         <td> <a href="{{ route('clients.show' , $c->id) }}"  >  <button>Show</button>  </a></td>
       


     </tr>
         
     @endforeach
    </table>

</body>
</html>