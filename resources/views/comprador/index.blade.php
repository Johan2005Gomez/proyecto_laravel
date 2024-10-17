<!-- resources/views/comprador/index.blade.php -->
<x-app-layout>
    <div class="container mx-auto mt-12 p-8 bg-white rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold text-center text-gray-800">Productos Disponibles</h1>

        <!-- Mostrar mensaje de éxito -->
        @if (session('success'))
            <div id="success-message" class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach($products as $product)
                <div class="border rounded-lg p-4 transition-transform transform hover:scale-105 hover:shadow-lg">
                    <h2 class="text-xl font-semibold text-purple-700">{{ $product->name }}</h2>
                    <p class="text-gray-600">{{ $product->description }}</p>
                    <p class="font-bold text-purple-600">${{ number_format($product->price, 0) }}</p>
                    <form action="{{ route('comprador.cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="mt-2 bg-purple-700 hover:bg-purple-800 text-white rounded-lg py-2 px-4 transition duration-200">Comprar</button>
                    </form>
                </div>
            @endforeach
        </div>
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
