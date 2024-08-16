@props(['product'])
<div>
    <div class="relative">
        <div class="relative h-72 w-full overflow-hidden rounded-lg">
            <img src="{{ $product['image'] }}" class="h-full w-full object-cover object-center">
        </div>
        <div class="relative mt-4 flex justify-between">
            <h3 class="text-sm font-medium text-gray-800">{{ $product['name'] }}</h3>
            <x-woo-wire-categories :categoryIds="$product['categories']" />
        </div>
        <div class="absolute inset-x-0 top-0 flex h-72 items-end justify-end overflow-hidden rounded-lg p-4">
            <a href="{{ $product['permalink'] }}" aria-hidden="true" class="absolute inset-x-0 bottom-0 h-full bg-gradient-to-t via-transparent from-black opacity-50"></a>
            <div class="relative text-lg text-white">
                @if ($product['sale'])
                    <span>{{ $product['sale'] }} {!! get_woocommerce_currency_symbol() !!}</span>
                    <span class="line-through text-gray-300">{{ $product['price'] }} {!! get_woocommerce_currency_symbol() !!}</span>
                @else
                    <span>{{ $product['price'] }} {!! get_woocommerce_currency_symbol() !!}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="mt-6">
        @if ($product['stock'] > 0)
            <button wire:click="addToCart({{ $product['id'] }})" class="relative items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium active:bg-gray-200 hover:ring-2 ring-offset-2 ring-gray-100">Add to bag</button>
        @else
            <div class="text-gray-400 text-sm">
                Out of stock
            </div>
        @endif
    </div>
</div>
