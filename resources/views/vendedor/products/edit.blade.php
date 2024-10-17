<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-center text-purple-800 mb-6">Editar Producto</h2>

            <form method="POST" action="{{ route('vendedor.products.update', $product) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <x-label for="name" value="{{ __('Nombre') }}" class="text-gray-700" />
                    <x-input id="name" type="text" name="name" value="{{ $product->name }}" class="mt-1 block w-full" required />
                </div>

                <div class="mb-4">
                    <x-label for="description" value="{{ __('Descripción') }}" class="text-gray-700" />
                    <textarea id="description" name="description" class="mt-1 block w-full rounded-md shadow-sm border-gray-300">{{ $product->description }}</textarea>
                </div>

                <div class="mb-4">
                    <x-label for="price" value="{{ __('Precio') }}" class="text-gray-700" />
                    <x-input id="price" type="number" name="price" value="{{ intval($product->price) }}" class="mt-1 block w-full" required />
                </div>

                <div class="flex justify-center">
                    <x-button class="bg-purple-600 hover:bg-purple-500 transition duration-200 px-4 py-2 rounded-lg text-white">
                        {{ __('Actualizar Producto') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
