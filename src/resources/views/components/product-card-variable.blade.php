@props(['product'])
<div class="relative" x-data="{ selectedChild: '{{ $product['selectedVariant'] }}' }">
    <div>
        <div class="relative h-72 w-full overflow-hidden rounded-lg">
            @foreach ($product['childProducts'] as $childProduct)
                <img src="{{ $childProduct['image'] }}" x-show="selectedChild == '{{ $childProduct['id'] }}'" class="h-full w-full object-cover object-center">
            @endforeach
        </div>
        <div class="relative mt-4">
            <div class="flex">
                <h3 class="text-sm font-medium text-gray-900">{{ $product['name'] }}</h3>
                <select name="variantPicker" x-model="selectedChild" class="text-sm font-medium text-gray-900 p-0">
                    @foreach ($product['childProducts'] as $childProduct)
                        <option value="{{ $childProduct['id'] }}">{!! $childProduct['name'] !!}</option>
                    @endforeach
                </select>
            </div>
            <x-categories :categoryIds="$product['categories']" />
        </div>
        <div class="absolute inset-x-0 top-0 flex h-72 items-end justify-end overflow-hidden rounded-lg p-4">
            @foreach ($product['childProducts'] as $childProduct)
                <div x-show="selectedChild == '{{ $childProduct['id'] }}'">
                    <a aria-hidden="true" href="{{ $childProduct['permalink'] }}" class="absolute inset-x-0 bottom-0 h-full bg-gradient-to-t via-transparent from-black opacity-50"></a>
                    <p class="relative text-lg font-semibold text-white">{{ $childProduct['price'] }} {!! get_woocommerce_currency_symbol() !!}</p>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mt-6">
        @foreach ($product['childProducts'] as $childProduct)
            <div x-show="selectedChild == '{{ $childProduct['id'] }}'">
                <button wire:click="addToCart({{ $childProduct['id'] }})" class="relative flex w-full items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200">Add to bag</button>
            </div>
        @endforeach
    </div>
</div>
