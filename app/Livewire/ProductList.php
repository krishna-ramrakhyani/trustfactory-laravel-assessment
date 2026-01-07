<?php

namespace App\Livewire;

use App\Jobs\LowStockJob;
use App\Models\Product;
use Livewire\Component;


class ProductList extends Component
{
    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);

        $cart = auth()->user()->cart()->firstOrCreate([]);

        $item = $cart->items()->where('product_id', $product->id)->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        if ($product->stock_quantity <= 5) {
        LowStockJob::dispatch($product);
        }
    }

    public function render()
    {
        return view('livewire.product-list', [
            'products' => Product::all()
        ])->layout('layouts.app');
    }
}

