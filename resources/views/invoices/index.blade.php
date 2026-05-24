<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Invoices</h2>
            <a href="{{ route('invoices.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                + Create Invoice
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg overflow-x-auto">
                <!-- Desktop View -->
                <div class="hidden md:block bg-white shadow-sm rounded-lg overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="px-4 py-3">Invoice No</th>
                                <th class="px-4 py-3">Client</th>
                                <th class="px-4 py-3">Date</th>
                                <th class="px-4 py-3">Due Date</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Total</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium">{{ $invoice->invoice_number }}</td>
                                    <td class="px-4 py-3">{{ $invoice->client->client_name ?? 'N/A' }}</td>
                                    <td class="px-4 py-3">{{ $invoice->invoice_date }}</td>
                                    <td class="px-4 py-3">{{ $invoice->due_date }}</td>
                                    <td class="px-4 py-3">{{ ucfirst($invoice->status) }}</td>
                                    <td class="px-4 py-3">₹{{ number_format($invoice->total, 2) }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex gap-2">
                                            <a href="{{ route('invoices.show', $invoice->id) }}"
                                                class="bg-gray-100 px-2 py-1 rounded text-xs">View</a>
                                            <a href="{{ route('invoices.edit', $invoice->id) }}"
                                                class="bg-blue-100 px-2 py-1 rounded text-xs">Edit</a>
                                            <a href="{{ route('invoices.pdf', $invoice->id) }}"
                                                class="bg-green-100 px-2 py-1 rounded text-xs">PDF</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile View -->
                <div class="md:hidden space-y-4">
                    @foreach ($invoices as $invoice)
                        <div class="bg-white shadow-sm rounded-lg p-4 border">
                            <div class="font-semibold">#{{ $invoice->invoice_number }}</div>
                            <div class="text-sm text-gray-600">{{ $invoice->client->client_name ?? 'N/A' }}</div>
                            <div class="text-sm">₹{{ number_format($invoice->total, 2) }}</div>

                            <div class="mt-2 text-xs">
                                Status: {{ ucfirst($invoice->status) }}
                            </div>

                            <div class="flex gap-2 mt-3">
                                <a href="{{ route('invoices.show', $invoice->id) }}"
                                    class="text-xs bg-gray-200 px-2 py-1 rounded">View</a>
                                <a href="{{ route('invoices.edit', $invoice->id) }}"
                                    class="text-xs bg-blue-200 px-2 py-1 rounded">Edit</a>
                                <a href="{{ route('invoices.pdf', $invoice->id) }}"
                                    class="text-xs bg-green-200 px-2 py-1 rounded">PDF</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
