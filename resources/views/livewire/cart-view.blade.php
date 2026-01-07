<div class="p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Your Cart</h1>

    @if (!$cart || $cart->items->isEmpty())
        <p class="text-gray-500">Your cart is empty.</p>
    @else
        <div class="space-y-4">
            @foreach ($cart->items as $item)
                <div class="flex items-center justify-between border p-4 rounded bg-white">
                    <div>
                        <h2 class="font-semibold">
                            {{ $item->product->name }}
                        </h2>
                        <p class="text-sm text-gray-500">
                            ₹{{ number_format($item->product->price, 2) }}
                        </p>
                    </div>

                    <div class="flex items-center space-x-3">
                        <input
                            type="number"
                            min="1"
                            class="w-20 border rounded px-2 py-1"
                            wire:change="updateQuantity({{ $item->id }}, $event.target.value)"
                            value="{{ $item->quantity }}"
                        />

                        <button
                            wire:click="removeItem({{ $item->id }})"
                            class="text-red-600 hover:underline"
                        >
                            Remove
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
