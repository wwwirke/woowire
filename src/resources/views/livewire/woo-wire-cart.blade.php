<div class="flex flex-col absolute z-20 right-4 top-4 space-y-2">
    <div class="flex justify-end">
        <button class="relative items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium active:bg-gray-200 hover:ring-2 ring-offset-2 ring-gray-100" x-on:click="$wire.cartopen = !$wire.cartopen">
            <span x-text="$wire.cartopen ? 'Close' : 'Cart'"></span>
        </button>
    </div>
    <div x-show="$wire.cartopen" class="border-b bg-white rounded shadow w-80">
        <div class="flex flex-col border-b border-gray-200 divide-y divide-gray-200 px-4">
            @forelse ($cartItems as $key => $cartItem)
                <div class="flex space-x-2 py-4">
                    <div>
                        <img src="{{ $cartItem['image'] }}" class="h-20 w-20 max-w-none object-cover object-center rounded border border-gray-100">
                    </div>
                    <div class="flex justify-between w-full space-x-4">
                        <div class="flex flex-col justify-between">
                            <div class="flex flex-col">
                                <span class="text-lg">{{ $cartItem['name'] }}</span>
                                @if ($cartItem['variation_id'])
                                    <span class="text-gray-500 text-sm">{{ $cartItem['childProducts'][$cartItem['variation_id']]['name'] }}</span>
                                @endif
                            </div>
                            <div class="text-sm">
                                <span>{{ $cartItem['quantity'] }}</span>
                            </div>
                        </div>
                        <div class="flex flex-col justify-between items-end text-sm">
                            <span>{{ $cartItem['line_total'] + $cartItem['line_tax'] }}{!! get_woocommerce_currency_symbol() !!}</span>
                            <button class="underline" wire:click="removeCartItem('{{ $key }}')">Remove</button>
                        </div>
                    </div>
                </div>
            @empty
                Tom
            @endforelse
        </div>
        <div class="flex flex-col p-4 space-y-2">
            <div class="text-sm flex justify-between">
                <span>Total: </span>
                <span>{{ $cartTotal }}{!! get_woocommerce_currency_symbol() !!}</span>
            </div>
            <a class="relative items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium active:bg-gray-200 hover:ring-2 ring-offset-2 ring-gray-100 text-center" href="{{ wc_get_checkout_url() }}">Checkout</a>
        </div>
    </div>
</div>
