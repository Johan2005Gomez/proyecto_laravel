<x-guest-layout>
    <nav x-data="{ open: false }" class="bg-white border-b border-purple-200">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <x-authentication-card-logo />

                    <!-- Navegación y enlaces -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        @if(Auth::check())
                        @if(Auth::user()->role === 'vendedor')
                        <x-nav-link href="{{ route('vendedor.dashboard') }}" :active="request()->routeIs('vendedor.dashboard')">
                            {{ __('Dashboard Vendedor') }}
                        </x-nav-link>
                        @elseif(Auth::user()->role === 'comprador')
                        <x-nav-link href="{{ route('comprador.dashboard') }}" :active="request()->routeIs('comprador.dashboard')">
                            {{ __('Dashboard Comprador') }}
                        </x-nav-link>
                        @endif
                        @endif
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <!-- Settings Dropdown -->
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-purple-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                    @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-purple-50 active:bg-purple-50 transition ease-in-out duration-150">
                                            {{ Auth::user()->name }}
                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                    @endif
                                </x-slot>

                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-purple-400">{{ __('Manage Account') }}</div>
                                    <x-dropdown-link href="{{ route('profile.show') }}">{{ __('Profile') }}</x-dropdown-link>
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">{{ __('Log Out') }}</x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-purple-400 hover:text-purple-500 hover:bg-purple-100 focus:outline-none focus:bg-purple-100 focus:text-purple-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link href="{{ route('vendedor.dashboard') }}" :active="request()->routeIs('vendedor.dashboard')">
                        {{ __('Dashboard Vendedor') }}
                    </x-responsive-nav-link>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-purple-200">
                    <div class="flex items-center px-4">
                        <div>
                            <div class="font-medium text-base text-purple-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-purple-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">{{ __('Profile') }}</x-responsive-nav-link>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">{{ __('Log Out') }}</x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-12 p-8 bg-white rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold text-center text-purple-800">Dashboard Vendedor</h1>
        <p class="mt-2 text-center text-purple-600 text-lg">Bienvenid@, {{ Auth::user()->name }}.</p>

        <!-- Enlaces para gestionar productos -->
        <div class="mt-8">
            <h2 class="text-3xl font-semibold mb-4 text-purple-800">Gestión de Productos</h2>
            <ul class="mt-2 space-y-3">
                <li>
                    <a href="{{ route('vendedor.products.index') }}" class="block px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-500 transition duration-200 text-center">
                        Ver Productos
                    </a>
                </li>
                <li>
                    <a href="{{ route('vendedor.products.create') }}" class="block px-4 py-2 bg-teal-500 text-white rounded-md hover:bg-teal-400 transition duration-200 text-center">
                        Agregar Producto
                    </a>
                </li>
            </ul>
        </div>
    </div>
</x-guest-layout>
