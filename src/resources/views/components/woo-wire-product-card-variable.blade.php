@props(['product'])
<div class="relative" x-data="{ selectedChild: '{{ $product['selectedVariant'] }}' }">
    <div>
        <div class="relative h-72 w-full overflow-hidden rounded-lg">
            @foreach ($product['childProducts'] as $childProduct)
                <img src="{{ $childProduct['image'] }}" x-show="selectedChild == '{{ $childProduct['id'] }}'" class="h-full w-full object-cover object-center">
            @endforeach
        </div>
        <div class="relative mt-4 flex justify-between">
            <div class="flex">
                <h3 class="text-sm font-medium text-gray-800">{{ $product['name'] }}</h3>
                <select name="variantPicker" x-model="selectedChild" class="text-sm font-medium text-gray-900 p-0">
                    @foreach ($product['childProducts'] as $childProduct)
                        <option value="{{ $childProduct['id'] }}">{!! $childProduct['name'] !!}</option>
                    @endforeach
                </select>
            </div>
            <x-woo-wire-categories :categoryIds="$product['categories']" />
        </div>
        <div class="absolute inset-x-0 top-0 flex h-72 items-end justify-end overflow-hidden rounded-lg p-4">
            @foreach ($product['childProducts'] as $childProduct)
                <div x-show="selectedChild == '{{ $childProduct['id'] }}'">
                    <a aria-hidden="true" href="{{ $childProduct['permalink'] }}" class="absolute inset-x-0 bottom-0 h-full bg-gradient-to-t via-transparent from-black opacity-50"></a>
                    <div class="relative text-lg text-white">
                        @if ($childProduct['sale'])
                            <span>{{ $childProduct['sale'] }} {!! get_woocommerce_currency_symbol() !!}</span>
                            <span class="line-through text-gray-300">{{ $childProduct['price'] }} {!! get_woocommerce_currency_symbol() !!}</span>
                        @else
                            <span>{{ $childProduct['price'] }} {!! get_woocommerce_currency_symbol() !!}</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mt-6">
        @foreach ($product['childProducts'] as $childProduct)
            <div x-show="selectedChild == '{{ $childProduct['id'] }}'">
                @if ($childProduct['stock'] > 0)
                    <button wire:click="addToCart({{ $childProduct['id'] }})" class="relative items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium active:bg-gray-200 hover:ring-2 ring-offset-2 ring-gray-100">Add to bag</button>
                @else
                    <div class="text-gray-400 text-sm">
                        Out of stock
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
