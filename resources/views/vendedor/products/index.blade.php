<x-guest-layout>
    <div class="max-w-full mx-auto mt-4 p-6 bg-purple-50 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center text-purple-800">Mis Productos</h2>
        <a href="{{ route('vendedor.products.create') }}" class="inline-block bg-purple-600 text-white px-6 py-3 rounded-lg mt-4 shadow hover:bg-purple-700 transition duration-300">Agregar Producto</a>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-6">
            @foreach ($products as $product)
                <div class="bg-white shadow-lg rounded-lg p-6 transition-transform transform hover:scale-105">
                    <h3 class="text-xl font-semibold text-purple-800">Nombre: {{ $product->name }}</h3>
                    <p class="mt-2 text-purple-600">Descripción: {{ $product->description }}</p>
                    <p class="mt-2 text-green-600 font-bold text-lg">Precio: ${{ number_format($product->price) }}</p>
                    
                    <div class="mt-4 flex justify-between items-center">
                        <a href="{{ route('vendedor.products.edit', $product) }}" class="text-purple-500 hover:underline">Editar</a>
                        <form action="{{ route('vendedor.products.destroy', $product) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            <a href="{{ route('vendedor.dashboard') }}" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition duration-300">
                Volver al Dashboard
            </a>
        </div>
    </div>
</x-guest-layout>
