<!DOCTYPE html>
<html>
<head>
    <title>Clients</title>
</head>
<body>

    <h1>My Clients</h1>
    
    <a href="{{ route('clients.create') }}">Add New Client</a>

    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>City</th>
            <th>Action</th>
        </tr>

        @forelse($client as $c)
        <tr>
            <td>{{ $c->client_name }}</td>
            <td>{{ $c->email }}</td>
            <td>{{ $c->phone }}</td>
            <td>{{ $c->city }}</td>
            <td>
                <a href="{{ route('clients.edit', $c->id) }}">Edit</a>
                <a href="{{ route('clients.show', $c->id) }}">View</a>
            </td>
        </tr>
        @empty
            <tr>
                <td colspan="5">No clients found</td>
            </tr>
        @endforelse
    </table>

</body>
</html>