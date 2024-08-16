@props(['product'])
<div class="flex flex-col divide-y divide-gray-200">
    <div class="grid grid-cols-2 gap-4 py-3" x-data="{ selectedChild: '{{ $product['selectedVariant'] }}' }">
        <div class="relative h-72 w-full overflow-hidden rounded-lg">
            <img src="{{ $product['image'] }}" class="h-full w-full object-cover object-center">
        </div>
        <div class="space-y-8">
            <div class="flex space-x-2 items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-800">{{ $product['name'] }}</h1>
                <div class="relative text-lg">
                    @if ($product['sale'])
                        <span>{{ $product['sale'] }} {!! get_woocommerce_currency_symbol() !!}</span>
                        <span class="line-through text-gray-400">{{ $product['price'] }} {!! get_woocommerce_currency_symbol() !!}</span>
                    @else
                        <span>{{ $product['price'] }} {!! get_woocommerce_currency_symbol() !!}</span>
                    @endif
                </div>
            </div>
            <div>
                @if ($product['stock'] < 10 && $product['stock'] > 0)
                    <div class="text-gray-400 text-sm">
                        Only {{ $product['stock'] }} left in stock
                    </div>
                @endif
                @if ($product['stock'] > 0)
                    <button wire:click="addToCart({{ $product['id'] }})" class="relative items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium active:bg-gray-200 hover:ring-2 ring-offset-2 ring-gray-100">Add to bag</button>
                @else
                    <div class="text-gray-400 text-sm">
                        Out of stock
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if ($product['description'])
        <div class="flex flex-col py-3">
            <h2 class="text-gray-400">{{ __('Description') }}</h2>
            <p class="text-gray-600">{!! $product['description'] !!}</p>
        </div>
    @endif
</div>
