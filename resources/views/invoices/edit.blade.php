<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Invoice</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <form action="{{ route('invoices.update', $invoice->id) }}" method="POST" class="space-y-5">
                    @method('PATCH')
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                            <select name="client_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ $invoice->client_id == $client->id ? 'selected' : '' }}>
                                        {{ $client->client_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="draft" {{ $invoice->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="unpaid" {{ $invoice->status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                <option value="paid" {{ $invoice->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="overdue" {{ $invoice->status == 'overdue' ? 'selected' : '' }}>Overdue</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Invoice Date</label>
                            <input type="date" name="invoice_date" value="{{ $invoice->invoice_date }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                            <input type="date" name="due_date" value="{{ $invoice->due_date }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tax (%)</label>
                            <input type="number" name="tax" value="{{ $invoice->tax }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Discount (₹):</label>
                            <input type="number" name="discount" value="{{ $invoice->discount }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                        <textarea name="notes" rows="2"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $invoice->notes }}</textarea>
                    </div>

                    <!-- Items Section -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Items</label>
                        <div id="items-container" class="space-y-2">
                            @foreach($items as $item)
                            <div class="item-row grid grid-cols-1 sm:grid-cols-3 gap-2">
                                <input type="text" name="item_name[]" value="{{ $item->item_name }}"
                                       class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <input type="number" name="quantity[]" value="{{ $item->quantity }}"
                                       class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <input type="number" name="price[]" value="{{ $item->price }}"
                                       class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-items"
                                class="mt-2 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-200">
                            + Add Item
                        </button>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit"
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg text-sm hover:bg-blue-700">
                            Update Invoice
                        </button>
                        <a href="{{ route('invoices.index') }}"
                           class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg text-sm hover:bg-gray-200">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-items').addEventListener('click', function() {
            var container = document.getElementById('items-container');
            var newRow = document.createElement('div');
            newRow.classList.add('item-row', 'grid', 'grid-cols-1', 'sm:grid-cols-3', 'gap-2');
            newRow.innerHTML = `
                <input type="text" name="item_name[]" placeholder="Item Name"
                       class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="number" name="quantity[]" placeholder="Qty"
                       class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="number" name="price[]" placeholder="Price"
                       class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            `;
            container.appendChild(newRow);
        });
    </script>
</x-app-layout>