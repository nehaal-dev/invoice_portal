<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">My Clients</h2>
            <a href="{{ route('clients.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                + Add New Client
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg overflow-x-auto">
                {{-- <table class="w-full text-sm text-left">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Phone</th>
                            <th class="px-6 py-3">City</th>
                            <th class="px-6 py-3">Country</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($client as $c)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">{{ $c->client_name }}</td>
                            <td class="px-6 py-4">{{ $c->email }}</td>
                            <td class="px-6 py-4">{{ $c->phone }}</td>
                            <td class="px-6 py-4">{{ $c->city }}</td>
                            <td class="px-6 py-4">{{ $c->country }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('clients.show', $c->id) }}"
                                       class="bg-gray-100 text-gray-700 px-3 py-1 rounded text-xs hover:bg-gray-200">
                                        View
                                    </a>
                                    <a href="{{ route('clients.edit', $c->id) }}"
                                       class="bg-blue-100 text-blue-700 px-3 py-1 rounded text-xs hover:bg-blue-200">
                                        Edit
                                    </a>
                                    <form action="{{ route('clients.destroy', $c->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-100 text-red-700 px-3 py-1 rounded text-xs hover:bg-red-200">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> --}}

                <!-- Desktop View -->
                <div class="hidden md:block bg-white shadow-sm rounded-lg overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="px-6 py-3">Name</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Phone</th>
                                <th class="px-6 py-3">City</th>
                                <th class="px-6 py-3">Country</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($client as $c)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium">{{ $c->client_name }}</td>
                                    <td class="px-6 py-4">{{ $c->email }}</td>
                                    <td class="px-6 py-4">{{ $c->phone }}</td>
                                    <td class="px-6 py-4">{{ $c->city }}</td>
                                    <td class="px-6 py-4">{{ $c->country }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            <a href="{{ route('clients.show', $c->id) }}"
                                                class="bg-gray-100 px-3 py-1 rounded text-xs">View</a>
                                            <a href="{{ route('clients.edit', $c->id) }}"
                                                class="bg-blue-100 px-3 py-1 rounded text-xs">Edit</a>
                                            <form method="POST" action="{{ route('clients.destroy', $c->id) }}">
                                                @csrf @method('DELETE')
                                                <button class="bg-red-100 px-3 py-1 rounded text-xs">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile View -->
                <div class="md:hidden space-y-4">
                    @foreach ($client as $c)
                        <div class="bg-white shadow-sm rounded-lg p-4 border">
                            <div class="font-semibold">{{ $c->client_name }}</div>
                            <div class="text-sm text-gray-600">{{ $c->email }}</div>
                            <div class="text-sm text-gray-600">{{ $c->phone }}</div>
                            <div class="text-sm text-gray-600">{{ $c->city }}, {{ $c->country }}</div>

                            <div class="flex gap-2 mt-3">
                                <a href="{{ route('clients.show', $c->id) }}"
                                    class="text-xs bg-gray-200 px-2 py-1 rounded">View</a>
                                <a href="{{ route('clients.edit', $c->id) }}"
                                    class="text-xs bg-blue-200 px-2 py-1 rounded">Edit</a>
                                <form method="POST" action="{{ route('clients.destroy', $c->id) }}">
                                    @csrf @method('DELETE')
                                    <button class="text-xs bg-red-200 px-2 py-1 rounded">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
