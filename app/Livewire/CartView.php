<?php

namespace App\Livewire;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CartView extends Component
{
    public function updateQuantity($itemId, $newQuantity)
    {
        if ($newQuantity < 1) return;

        DB::transaction(function () use ($itemId, $newQuantity) {
            $item = CartItem::with('product')->findOrFail($itemId);
            $product = $item->product;

            $currentQuantity = $item->quantity;
            $difference = $newQuantity - $currentQuantity;

            if ($difference > 0) {
                // User wants more; check stock
                if ($product->stock_quantity >= $difference) {
                    $product->decrement('stock_quantity', $difference);
                    $item->update(['quantity' => $newQuantity]);
                } else {
                    session()->flash('error', 'Not enough stock available.');
                }
            } elseif ($difference < 0) {
                $product->increment('stock_quantity', abs($difference));
                $item->update(['quantity' => $newQuantity]);
            }
        });
    }

    public function removeItem($itemId)
    {
        DB::transaction(function () use ($itemId) {
            $item = CartItem::findOrFail($itemId);

            $item->product->increment('stock_quantity', $item->quantity);

            $item->delete();
        });

        session()->flash('success', 'Item removed from cart.');
    }

    public function render()
    {
        return view('livewire.cart-view', [
            'cart' => auth()->user()->cart?->load('items.product')
        ])->layout('layouts.app');
    }
}
