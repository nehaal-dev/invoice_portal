<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Invoice {{ $invoice->invoice_number }}</h2>
            <div class="flex gap-2">
                <a href="{{ route('invoices.pdf', $invoice->id) }}"
                    target="_blank"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700">
                     Download PDF
                 </a>
                <a href="{{ route('invoices.edit', $invoice->id) }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                    Edit
                </a>
                <a href="{{ route('invoices.index') }}"
                   class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-200">
                    Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Invoice Details -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-sm font-semibold text-gray-500 uppercase mb-4">Invoice Details</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-3">
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-sm text-gray-500">Invoice Number</span>
                            <span class="text-sm font-medium">{{ $invoice->invoice_number }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-sm text-gray-500">Invoice Date</span>
                            <span class="text-sm">{{ $invoice->invoice_date }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-sm text-gray-500">Due Date</span>
                            <span class="text-sm">{{ $invoice->due_date }}</span>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-sm text-gray-500">Client</span>
                            <span class="text-sm font-medium">{{ $invoice->client->client_name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-sm text-gray-500">Status</span>
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                {{ $invoice->status == 'paid' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $invoice->status == 'unpaid' ? 'bg-red-100 text-red-700' : '' }}
                                {{ $invoice->status == 'draft' ? 'bg-gray-100 text-gray-700' : '' }}
                                {{ $invoice->status == 'overdue' ? 'bg-orange-100 text-orange-700' : '' }}">
                                {{ ucfirst($invoice->status) }}
                            </span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-sm text-gray-500">Notes</span>
                            <span class="text-sm">{{ $invoice->notes }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <h3 class="text-sm font-semibold text-gray-500 uppercase p-4 border-b">Items</h3>
                <table class="w-full text-sm">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">Item</th>
                            <th class="px-4 py-3 text-left">Qty</th>
                            <th class="px-4 py-3 text-left">Price</th>
                            <th class="px-4 py-3 text-left">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $item->item_name }}</td>
                            <td class="px-4 py-3">{{ $item->quantity }}</td>
                            <td class="px-4 py-3">₹{{ number_format($item->price, 2) }}</td>
                            <td class="px-4 py-3">₹{{ number_format($item->total, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Summary -->
                <div class="p-4 space-y-2 border-t">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Subtotal</span>
                        <span>₹{{ number_format($invoice->subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Tax ({{ $invoice->tax }}%)</span>
                        <span>₹{{ number_format($invoice->subtotal * $invoice->tax / 100, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Discount</span>
                        <span>-₹{{ number_format($invoice->discount, 2) }}</span>
                    </div>
                    <div class="flex justify-between font-bold text-base border-t pt-2">
                        <span>Total</span>
                        <span class="text-green-600">₹{{ number_format($invoice->total, 2) }}</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>