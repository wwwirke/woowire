<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 

class Cart extends Component
{

    public $cartItems = [];

    public $cartTotal = 0;

    public $cartopen = false;

    #[On('getcart')] 
    public function getTheCart()
    {
        $cart = WC()->cart;
        $cartItems = $cart->get_cart();
        foreach ($cartItems as $cartItem) {
            $product = wc_get_product($cartItem['product_id']);
            $this->cartItems[$cartItem['key']] = [
                'name' => $product->get_name(),
                'product_id' => $cartItem['product_id'],
                'quantity' => $cartItem['quantity'],
                'line_subtotal' => $cartItem['line_subtotal'],
                'line_subtotal_tax' => $cartItem['line_subtotal_tax'],
                'line_total' => $cartItem['line_total'],
                'line_tax' => $cartItem['line_tax'],
            ];
        }
        $this->cartTotal = $cart->get_total('edit');
    }

    #[On('opencart')]
    public function openCart()
    {
        $this->cartopen = true;
    }

    public function remove_cart_item(int $id)
    {
        WC()->cart->remove_cart_item($id);
        $this->dispatch('getcart');
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
