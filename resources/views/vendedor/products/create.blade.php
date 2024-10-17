<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-center text-purple-800 mb-6">Agregar Producto</h2>

            <form method="POST" action="{{ route('vendedor.products.store') }}" class="space-y-4">
                @csrf

                <div>
                    <x-label for="name" value="{{ __('Nombre') }}" class="text-gray-700" />
                    <x-input id="name" type="text" name="name" class="mt-1 block w-full" required />
                </div>

                <div>
                    <x-label for="description" value="{{ __('Descripción') }}" class="text-gray-700" />
                    <textarea id="description" name="description" class="mt-1 block w-full rounded-md shadow-sm border-gray-300" required></textarea>
                </div>

                <div>
                    <x-label for="price" value="{{ __('Precio') }}" class="text-gray-700" />
                    <x-input id="price" type="number" name="price" step="0.01" class="mt-1 block w-full" required />
                </div>

                <div class="flex justify-center">
                    <x-button class="bg-purple-600 hover:bg-purple-500 transition duration-200 px-4 py-2 rounded-lg text-white">
                        {{ __('Agregar Producto') }}
                    </x-button>
                </div>
            </form>

            <!-- Botón para volver al Dashboard -->
            <div class="mt-6 text-center">
                <a href="{{ route('vendedor.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
                    Volver al Dashboard
                </a>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
