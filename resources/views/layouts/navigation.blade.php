
<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <span class="text-xl font-bold text-gray-800 dark:text-white">
                            Aplikasi Penjualan
                        </span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')"
                        :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link :href="route('report.sales')"
                        :active="request()->routeIs('report.sales')">
                        Laporan Penjualan
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <span class="text-sm text-gray-700 dark:text-gray-300">
                    {{ Auth::user()->name ?? 'Pengguna' }}
                </span>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="p-2 rounded-md text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none"
                        viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }"
                            class="inline-flex" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }"
                            class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')"
                :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('report.sales')"
                :active="request()->routeIs('report.sales')">
                Laporan Penjualan
            </x-responsive-nav-link>
        </div>
    </div>
</nav>
