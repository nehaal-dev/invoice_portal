{{-- <nav x-data="{ open: false }" class="bg-white border-b border-gray-100"> --}}
<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-24">
            <div class="flex">
                <!-- Logo -->

                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-4">

                        <div
                            class="h-14 w-14 rounded-2xl bg-gradient-to-br from-indigo-600 via-blue-600 to-cyan-500 flex items-center justify-center text-white text-xl font-extrabold shadow-lg">
                            IP
                        </div>

                        <div class="hidden sm:block">
                            <h1 class="text-xl font-extrabold text-gray-900 tracking-tight">
                                Invoice Portal
                            </h1>

                            <p class="text-sm text-gray-500 font-medium">
                                Smart Billing & Payments
                            </p>
                        </div>

                    </a>
                </div>


                <!-- Navigation Links -->

                <div class="hidden sm:flex items-center gap-3 ml-14">
                    @if (auth()->user()->role === 'owner')
                        <a href="{{ route('dashboard') }}"
                            class="px-4 py-1 rounded-xl text-sm font-medium transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg px-5 py-2' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('clients.index') }}"
                            class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300 {{ request()->routeIs('clients.*') ? 'bg-indigo-600 text-white shadow-lg px-5 py-2' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Clients
                        </a>
                        <a href="{{ route('invoices.index') }}"
                            class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300 {{ request()->routeIs('invoices.*') ? 'bg-indigo-600 text-white shadow-lg px-5 py-2' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Invoices
                        </a>
                        <a href="{{ route('subscription.index') }}"
                            class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300 {{ request()->routeIs('subscription.*') ? 'bg-indigo-600 text-white shadow-lg px-5 py-2' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Subscription
                        </a>
                    @endif
                    @if (auth()->user()->role === 'client')
                        <a href="{{ route('portal.index') }}"
                            class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300 {{ request()->routeIs('portal.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            My Invoices
                        </a>
                    @endif

                </div>



            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center gap-3 px-4 py-2 rounded-2xl border border-gray-200 bg-white hover:shadow-lg hover:border-indigo-200 transition-all duration-300">

                            <div
                                class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-600 to-cyan-500 flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <div class="text-left">
                                <p class="text-sm font-semibold text-gray-900">
                                    {{ Auth::user()->name }}
                                </p>

                                <p class="text-xs text-gray-500">
                                    Account
                                </p>
                            </div>

                            <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>

                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            {{-- client and invoice section menu add for responsiveness --}}
            <x-responsive-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')">
                {{ __('Clients') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('invoices.index')" :active="request()->routeIs('invoices.*')">
                {{ __('Invoices') }}
            </x-responsive-nav-link>


        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
