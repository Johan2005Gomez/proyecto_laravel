<x-app-layout>
    <div class="container mx-auto mt-12 p-8 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-8 text-center text-purple-600">Carrito de Compras</h1>

        @if(session('success'))
            <div class="mb-4 text-green-500 font-semibold" id="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if(empty($cartItems))
            <div class="text-center">
                <p class="text-gray-500 text-lg">No hay productos en el carrito.</p>
            </div>
        @else
            <table class="min-w-full border border-gray-200 divide-y divide-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 p-4 text-left">Producto</th>
                        <th class="border border-gray-300 p-4 text-left">Cantidad</th>
                        <th class="border border-gray-300 p-4 text-left">Precio</th>
                        <th class="border border-gray-300 p-4 text-left">Total</th>
                        <th class="border border-gray-300 p-4 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($cartItems as $productId => $item)
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="border border-gray-300 p-4 items-center">
                                <span class="font-semibold text-lg">{{ $item['name'] }}</span>
                            </td>
                            <td class="border border-gray-300 p-4">
                                <form action="{{ route('comprador.cart.update', $productId) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-20 border rounded-md p-1 shadow-sm">
                                    <button type="submit" class="ml-2 bg-purple-600 text-white py-1 px-2 rounded-md shadow hover:bg-purple-500 transition duration-200">Actualizar</button>
                                </form>
                            </td>
                            <td class="border border-gray-300 p-4 text-lg">${{ number_format($item['price'], 0) }}</td>
                            <td class="border border-gray-300 p-4 text-lg">${{ number_format($item['price'] * $item['quantity'], 0) }}</td>
                            <td class="border border-gray-300 p-4">
                                <form action="{{ route('comprador.cart.remove', $productId) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white py-1 px-2 rounded-md shadow hover:bg-red-600 transition duration-200">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 font-semibold text-lg">
                <span class="text-xl">Total: </span>
                <span class="text-purple-600 text-xl">${{ number_format($total, 0) }}</span>
            </div>

            <form action="{{ route('comprador.cart.checkout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="w-full bg-purple-600 text-white py-2 px-4 rounded-md shadow hover:bg-purple-500 transition duration-200">Finalizar Compra</button>
            </form>
        @endif
    </div>
    
    <script>
        // Verifica si hay un mensaje de éxito
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            // Oculta el mensaje después de 3 segundos (3000 ms)
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 3000);
        }
    </script>
</x-app-layout>
