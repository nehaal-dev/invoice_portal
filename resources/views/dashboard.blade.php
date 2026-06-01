<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">
                    Welcome back, {{ Auth::user()->name }}
                </h2>

                <p class="text-sm text-gray-600 mt-2">
                    Track invoices, payments and client activity in real time.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

                <!-- Total Invoices -->
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Total Invoices
                            </p>

                            <h3 class="mt-3 text-4xl font-bold text-gray-900">
                                {{ $total_invoice }}
                            </h3>
                        </div>

                        <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center text-2xl">
                            📄
                        </div>
                    </div>
                </div>

                <!-- Total Clients -->
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Total Clients
                            </p>

                            <h3 class="mt-3 text-4xl font-bold text-gray-900">
                                {{ $total_client }}
                            </h3>
                        </div>

                        <div class="w-14 h-14 rounded-xl bg-purple-100 flex items-center justify-center text-2xl">
                            👥
                        </div>
                    </div>
                </div>

                <!-- Revenue -->
                <div
                    class="bg-gradient-to-br from-emerald-500 to-green-600 text-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-100">
                                Total Revenue
                            </p>

                            <h3 class="mt-3 text-2xl font-bold text-white">
                                ₹{{ number_format($total_revenue, 2) }}
                            </h3>
                        </div>

                        <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center text-2xl">
                            💰
                        </div>
                    </div>
                </div>

                <!-- Pending -->
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Pending Invoices
                            </p>

                            <h3 class="mt-3 text-4xl font-bold text-red-500">
                                {{ $pending_invoice }}
                            </h3>
                        </div>

                        <div class="w-14 h-14 rounded-xl bg-red-100 flex items-center justify-center text-2xl">
                            ⏳
                        </div>
                    </div>
                </div>

            </div>

            {{-- subscription --}}
            <div class="mt-4">
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">

                    <div class="flex items-center justify-between">                      
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">
                                Current Subscription
                            </h3>
                            <h3
                                class="text-xl font-bold mt-1
                                {{ $subscription && $subscription->plan_name === 'pro' ? 'text-indigo-600' : 'text-gray-900' }}">
                                {{ $subscription?->plan_name ? ucfirst($subscription->plan_name) . ' Plan' : 'Free Plan' }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $subscription && $subscription->plan_name === 'pro'
                                    ? 'Unlimited invoices available.'
                                    : 'Create up to 5 invoices.' }}
                            </p>
                        </div>                    
                        @if ($subscription && $subscription->plan_name === 'pro' && $subscription->status === 'active')
                            <span class="px-4 py-2 bg-green-100 text-green-700 rounded-xl text-sm font-semibold">
                                ✓ Pro Active
                            </span>
                        @else
                            <a href="{{ route('subscription.index') }}"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-medium hover:bg-indigo-700 transition">
                                Upgrade Plan
                            </a>
                        @endif

                    </div>

                </div>
            </div>

            <!-- Quick Overview Section -->
            <div class="mt-4">
                <div
                    class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-700 rounded-3xl p-8 text-white shadow-lg">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 text-xs font-semibold text-slate-300 mb-4">
                        🚀 Smart Billing Platform
                    </span>
                    <h3 class="text-2xl font-bold">
                        Invoice Portal Pro
                    </h3>

                    <p class="mt-3 text-slate-300">
                        Create invoices, manage clients, track payments and run your business efficiently.
                    </p>


                    <div class="mt-6 flex flex-wrap gap-3">

                        <a href="{{ route('invoices.create') }}"
                            class="bg-white text-indigo-700 font-semibold px-5 py-3 rounded-xl hover:bg-gray-100 transition">
                            + Create Invoice
                        </a>

                        <a href="{{ route('clients.create') }}"
                            class="bg-indigo-500 text-white font-semibold px-5 py-3 rounded-xl hover:bg-indigo-400 transition">
                            + Add Client
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
