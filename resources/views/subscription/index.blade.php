<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-4xl font-extrabold tracking-tight">
                <span class="text-slate-900">Subscription</span>
                <span class="text-indigo-600">Plans</span>
            </h2>
            <p class="text-base text-slate-600 mt-2 font-medium">
                Choose a plan that fits your business needs.
            </p>
        </div>
    </x-slot>


    <div class="py-12 bg-gradient-to-b from-slate-50 via-white to-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">

                {{-- free plan --}}

                <div
                    class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <span
                        class="inline-flex px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold mb-4">
                        STARTER
                    </span>
                    <h3 class="text-2xl font-bold text-slate-900">Free Plan</h3>


                    <p class="text-5xl font-extrabold text-slate-900 mt-4">
                        ₹0
                        <span class="text-base font-medium text-slate-500">
                            /month
                        </span>
                    </p>
                    <ul class="space-y-4 mt-8 text-slate-700">

                        <li class="flex items-center gap-3">
                            <span class="text-green-500 font-bold">✓</span>
                            5 invoices/month
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-green-500 font-bold">✓</span>
                            Client management
                        </li>

                        <li class="flex items-center gap-3">
                            <span class="text-green-500 font-bold">✓</span>
                            PDF download
                        </li>


                        <li class="flex items-center gap-3">
                            <span class="text-green-500 font-bold">✓</span>
                            Limited invoice
                        </li>
                    </ul>
                    @if (!$subscription || $subscription->plan_name === 'free')
                        <span
                            class="inline-flex items-center justify-center w-full py-3 rounded-2xl bg-slate-100 text-slate-700 font-semibold mt-8">
                            Current Plan
                        </span>
                    @endif
                </div>

                <!-- Pro Plan -->

                <div
                    class="relative bg-gradient-to-br from-indigo-600 via-blue-600 to-cyan-500 rounded-3xl p-8 text-white shadow-2xl hover:scale-[1.02] hover:shadow-3xl transition-all duration-300">
                    <div class="absolute -top-3 left-6">
                        <span class="bg-yellow-400 text-slate-900 px-4 py-1 rounded-full text-xs font-bold shadow-lg">
                            MOST POPULAR
                        </span>
                    </div>

                    <h3 class="text-2xl font-bold">
                        Pro Plan
                    </h3>

                    <p class="text-5xl font-extrabold mt-4">
                        ₹999
                    </p>

                    <p class="text-blue-100 mt-1">
                        per month
                    </p>
                    <ul class="space-y-4 mt-8">
                        <li class="flex items-center gap-3">
                            <span class="font-bold">✓</span>
                            Unlimited invoices
                        </li>

                        <li class="flex items-center gap-3">
                            <span class="font-bold">✓</span>
                            Client management
                        </li>

                        <li class="flex items-center gap-3">
                            <span class="font-bold">✓</span>
                            PDF download
                        </li>

                        <li class="flex items-center gap-3">
                            <span class="font-bold">✓</span>
                            Priority support
                        </li>
                    </ul> <br>
                    @if ($subscription && $subscription->plan_name === 'pro' && $subscription->status === 'active')
                    <span
                    class="inline-flex items-center justify-center w-full py-4 rounded-2xl bg-white/20 backdrop-blur text-white font-semibold">
                    Current Plan ✓
                </span>
                    @else
                        <a href="{{ route('subscription.checkout') }}"
                        class="block w-full text-center py-4 rounded-2xl bg-white text-indigo-700 font-bold shadow-lg hover:scale-105 transition-all duration-300">
                            Upgrade to Pro
                        </a>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
