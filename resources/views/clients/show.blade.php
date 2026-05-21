<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Client Details</h2>
            <div class="flex gap-2">
                <a href="{{ route('clients.edit', $client->id) }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                    Edit
                </a>
                <a href="{{ route('clients.index') }}"
                   class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-200">
                    Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <div class="space-y-4">

                    <div class="grid grid-cols-2 gap-4 border-b pb-3">
                        <span class="text-sm font-medium text-gray-500">Client Name</span>
                        <span class="text-sm text-gray-800">{{ $client->client_name }}</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4 border-b pb-3">
                        <span class="text-sm font-medium text-gray-500">Email</span>
                        <span class="text-sm text-gray-800">{{ $client->email }}</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4 border-b pb-3">
                        <span class="text-sm font-medium text-gray-500">Phone</span>
                        <span class="text-sm text-gray-800">{{ $client->phone }}</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4 border-b pb-3">
                        <span class="text-sm font-medium text-gray-500">Address</span>
                        <span class="text-sm text-gray-800">{{ $client->address }}</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4 border-b pb-3">
                        <span class="text-sm font-medium text-gray-500">City</span>
                        <span class="text-sm text-gray-800">{{ $client->city }}</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <span class="text-sm font-medium text-gray-500">Country</span>
                        <span class="text-sm text-gray-800">{{ $client->country }}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>