<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h3 class="text-gray-500 text-sm">Total Invoices</h3>
                    <p class="text-3xl font-bold text-gray-800">{{ $total_invoice }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h3 class="text-gray-500 text-sm">Total Clients</h3>
                    <p class="text-3xl font-bold text-gray-800">{{ $total_client }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h3 class="text-gray-500 text-sm">Total Revenue</h3>
                    <p class="text-3xl font-bold text-green-600">₹{{ number_format($total_revenue, 2) }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h3 class="text-gray-500 text-sm">Pending Invoices</h3>
                    <p class="text-3xl font-bold text-red-500">{{ $pending_invoice }}</p>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
