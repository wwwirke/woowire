@props(['product'])
<div>
    <div class="relative">
        <div class="relative h-72 w-full overflow-hidden rounded-lg">
            <img src="{{ $product['image'] }}" class="h-full w-full object-cover object-center">
        </div>
        <div class="relative mt-4">
            <h3 class="text-sm font-medium text-gray-900">{{ $product['name'] }}</h3>
            <x-categories :categoryIds="$product['categories']" />
        </div>
        <div class="absolute inset-x-0 top-0 flex h-72 items-end justify-end overflow-hidden rounded-lg p-4">
            <a href="{{ $product['permalink'] }}" aria-hidden="true" class="absolute inset-x-0 bottom-0 h-full bg-gradient-to-t via-transparent from-black opacity-50"></a>
            <p class="relative text-lg font-semibold text-white">{{ $product['price'] }} {!! get_woocommerce_currency_symbol() !!}</p>
        </div>
    </div>
    <div class="mt-6">
        <button wire:click="addToCart({{ $product['id'] }})" class="relative flex w-full items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200">Add to bag<span class="sr-only">, Zip Tote Basket</span></button>
    </div>
</div>
