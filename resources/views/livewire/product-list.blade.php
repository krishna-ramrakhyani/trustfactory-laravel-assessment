@if (session()->has('success'))
    <div class="mb-4 p-4 rounded bg-green-100 text-green-800 border border-green-200">
        {{ session('success') }}
    </div>
@endif
<div class="p-6 max-w-6xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Products</h1>

        <a
            href="{{ route('cart') }}"
            class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-900 transition"
        >
            View Cart
        </a>
    </div>
@if ($products->isEmpty())
        <p class="text-gray-500">No products available.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="border rounded-lg p-6 shadow-sm bg-white">
                    <h2 class="text-lg font-semibold">
                        {{ $product->name }}
                    </h2>

                    <p class="text-gray-600 mt-1">
                        ₹{{ number_format($product->price, 2) }}
                    </p>

                    <p class="text-sm mt-2
        {{ $product->stock_quantity == 0 ? 'text-red-600' : 'text-gray-500' }}">
                        Stock: {{ $product->stock_quantity }}
                    </p>

                    @if($product->stock_quantity > 0)
                        <button
                            wire:click="addToCart({{ $product->id }})"
                            class="mt-4 inline-flex items-center justify-center
                               bg-blue-600 text-white font-medium
                               px-5 py-2 rounded-md
                               hover:bg-blue-700
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                               transition"
                            >
                                Add to Cart
                        </button>
                    @else
                        <span class="mt-4 inline-block
                         bg-gray-200 text-gray-500
                         px-5 py-2 rounded-md
                         cursor-not-allowed">
                                Out of Stock
                        </span>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
