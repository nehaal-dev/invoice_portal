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
                        @foreach($client as $c)
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
                </table>
            </div>
        </div>
    </div>
</x-app-layout>