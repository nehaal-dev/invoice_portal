<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">My Invoices</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-3">Invoice No</th>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Due Date</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium">{{ $invoice->invoice_number }}</td>
                            <td class="px-4 py-3">{{ $invoice->invoice_date }}</td>
                            <td class="px-4 py-3">{{ $invoice->due_date }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    {{ $invoice->status == 'paid' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $invoice->status == 'unpaid' ? 'bg-red-100 text-red-700' : '' }}
                                    {{ $invoice->status == 'draft' ? 'bg-gray-100 text-gray-700' : '' }}
                                    {{ $invoice->status == 'overdue' ? 'bg-orange-100 text-orange-700' : '' }}">
                                    {{ ucfirst($invoice->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 font-medium">₹{{ number_format($invoice->total, 2) }}</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('portal.show', $invoice->id) }}"
                                   class="bg-gray-100 text-gray-700 px-3 py-1 rounded text-xs hover:bg-gray-200">
                                    View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>