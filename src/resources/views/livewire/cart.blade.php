<div class="flex flex-col absolute z-20 right-4 top-4 bg-white rounded px-4 py-2 shadow">
    <div x-show="$wire.cartopen" class="border-b mb-2">
        <div class="flex flex-col border-b border-gray-100 py-2">
            @forelse ($cartItems as $cartItem)
                <div>
                    <span>{{ $cartItem['quantity'] }}</span>
                    <span>{{ $cartItem['name'] }}{{ $cartItem['quantity'] > 1 ? "'s" : '' }}</span>
                    <span>for</span>
                    <span>{{ $cartItem['line_total'] + $cartItem['line_tax'] }}{!! get_woocommerce_currency_symbol() !!}</span>
                </div>
            @empty
                Tom
            @endforelse
        </div>
        <div class="font-medium py-2">
            Total: {{ $cartTotal }}{!! get_woocommerce_currency_symbol() !!}
        </div>

    </div>
    <div class="flex justify-end">
        <button x-on:click="$wire.cartopen = !$wire.cartopen">
            <span x-text="$wire.cartopen ? 'Close' : 'Cart'"></span>
        </button>
    </div>
</div>
