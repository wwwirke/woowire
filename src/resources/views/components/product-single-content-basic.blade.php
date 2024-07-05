@props(['product'])
<div class="grid grid-cols-2 gap-4" x-data="{ selectedChild: '{{ $product['selectedVariant'] }}' }">
    <div class="relative h-72 w-full overflow-hidden rounded-lg">
        <img src="{{ $product['image'] }}" class="h-full w-full object-cover object-center">
    </div>
    <div>
        <div class="text-2xl font-bold flex space-x-2">
            <h1>{{ $product['name'] }}</h1>
        </div>
        <p class="relative text-lg font-semibold">{{ $product['price'] }} {!! get_woocommerce_currency_symbol() !!}</p>
        <button wire:click="addToCart({{ $product['id'] }})" class="relative  items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200">Add to bag</button>
    </div>
</div>
