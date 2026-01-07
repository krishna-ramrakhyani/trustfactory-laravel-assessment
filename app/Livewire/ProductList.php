<?php

namespace App\Livewire;

use App\Jobs\LowStockJob;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductList extends Component
{
    public function addToCart($productId)
    {
        DB::transaction(function () use ($productId) {
            $product = Product::lockForUpdate()->findOrFail($productId);

            if ($product->stock_quantity < 1) {
                session()->flash('error', 'Product is out of stock.');
                return;
            }

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

            $product->decrement('stock_quantity');

            if ($product->stock_quantity <= 5) {
                LowStockJob::dispatch($product);
            }
        });

        session()->flash('success', 'Product added to cart successfully!');
    }

    public function render()
    {
        return view('livewire.product-list', [
            'products' => Product::all()
        ])->layout('layouts.app');
    }
}
