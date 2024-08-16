<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Traits\WooCommerceProductsTrait;

class WooWireCart extends Component
{
    use WooCommerceProductsTrait;

    public $cartItems = [];

    public $cartTotal = 0;

    public $cartopen = false;

    #[On('getcart')] 
    public function getTheCart()
    {
        $cartItems = [];
        $this->cartItems = $cartItems;
        
        $cart = WC()->cart;
        $cartItems = $cart->get_cart();
        foreach ($cartItems as $key => $cartItem) {
            $product = wc_get_product($cartItem['product_id']);
            $this->cartItems[$cartItem['key']] = array_merge(
                $this->getStructuredProduct($product)
            ,[
                'product_id' => $cartItem['product_id'],
                'variation_id' => $cartItem['variation_id'],
                'variation' => $cartItem['variation'],
                'quantity' => $cartItem['quantity'],
                'line_subtotal' => $cartItem['line_subtotal'],
                'line_subtotal_tax' => $cartItem['line_subtotal_tax'],
                'line_total' => $cartItem['line_total'],
                'line_tax' => $cartItem['line_tax'],
            ]);
        }
        $this->cartTotal = $cart->get_total('edit');
    }

    #[On('opencart')]
    public function openCart()
    {
        $this->cartopen = true;
    }

    public function removeCartItem($key)
    {
        WC()->cart->remove_cart_item($key);
        $this->dispatch('getcart');
        $this->dispatch('opencart');
    }

    public function render()
    {
        return view('livewire.woo-wire-cart');
    }
}
