<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Subscription</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                <!-- Free Plan -->
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Free Plan</h3>
                    <p class="text-3xl font-bold text-gray-800 mb-4">₹0 <span class="text-sm font-normal text-gray-500">/month</span></p>
                    <ul class="space-y-2 text-sm text-gray-600 mb-6">
                        <li>5 invoices/month</li>
                        <li>Client management</li>
                        <li>PDF download</li>
                        <li>Limited invoices</li>
                    </ul>
                    @if(!$subscription || $subscription->plan_name === 'free')
                        <span class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm">Current Plan</span>
                    @endif
                </div>

                <!-- Pro Plan -->
                <div class="bg-white shadow-sm rounded-lg p-6 border-2 border-blue-500">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Pro Plan</h3>
                    <p class="text-3xl font-bold text-blue-600 mb-4">₹999 <span class="text-sm font-normal text-gray-500">/month</span></p>
                    <ul class="space-y-2 text-sm text-gray-600 mb-6">
                        <li>Unlimited invoices</li>
                        <li>Client management</li>
                        <li>PDF download</li>
                        <li>Priority support</li>
                    </ul>
                    @if($subscription && $subscription->plan_name === 'pro' && $subscription->status === 'active')
                        <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-lg text-sm">Current Plan</span>
                    @else
                        <a href="{{ route('subscription.checkout') }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                            Upgrade to Pro
                        </a>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>