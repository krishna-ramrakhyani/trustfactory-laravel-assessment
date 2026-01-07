<?php

namespace App\Livewire;

use App\Models\CartItem;
use Livewire\Component;

class CartView extends Component
{
    public function updateQuantity(CartItem $item, $quantity)
    {
        $item->update(['quantity' => $quantity]);
    }

    public function removeItem(CartItem $item)
    {
        $item->delete();
    }

    public function render()
    {
        return view('livewire.cart-view', [
            'cart' => auth()->user()->cart?->load('items.product')
        ])->layout('layouts.app');
    }
}

