@props(['product'])
<div class="grid grid-cols-2 gap-4" x-data="variants">
    <div class="relative h-full w-full overflow-hidden rounded-lg">
        @foreach ($product['childProducts'] as $childProduct)
            <img src="{{ $childProduct['image'] }}" class="h-full w-full object-cover object-center" x-show="$wire.currentProduct.selectedVariant == '{{ $childProduct['id'] }}'">
        @endforeach
    </div>
    <div class="space-y-8">
        <div class="flex space-x-2 items-center justify-between">
            <h1 class="text-2xl font-bold">{{ $product['name'] }}</h1>
            @foreach ($product['childProducts'] as $childProduct)
                <p class="relative text-lg" x-show="$wire.currentProduct.selectedVariant == '{{ $childProduct['id'] }}'">{{ $childProduct['price'] }} {!! get_woocommerce_currency_symbol() !!}</p>
            @endforeach
        </div>

        <div class="space-y-4">
            @foreach ($product['attributes'] as $attribute)
                <div class="space-y-2">
                    <h3 class="text-gray-400 text-sm">{{ $attribute['name'] }}</h3>
                    <div class="flex space-x-3">
                        @foreach ($attribute['options'] as $option)
                            @if ($attribute['name'] == 'color')
                                <button class="attribute-{{ $option }} ring-offset-2 w-8 h-8 rounded-full" wire:click="selectChildVariant('{{ $attribute['name'] }}','{{ $option }}')" x-bind:class="isSelected('{{ $attribute['name'] }}', '{{ $option }}') ? 'ring-2' : 'hover:ring-2'"></button>
                            @else
                                <button class="ring-offset-2 ring-gray-100 border rounded px-3 py-1" wire:click="selectChildVariant('{{ $attribute['name'] }}','{{ $option }}')" x-bind:class="isSelected('{{ $attribute['name'] }}', '{{ $option }}') ? 'ring-2 border-gray-100 bg-gray-100' : 'border-gray-100 hover:ring-2'">{{ $option }}</button>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        @foreach ($product['childProducts'] as $childProduct)
            <div x-show="$wire.currentProduct.selectedVariant == {{ $childProduct['id'] }}">
                @if ($childProduct['stock'] < 10 && $childProduct['stock'] > 0)
                    <div class="text-gray-400 text-sm">
                        Only {{ $childProduct['stock'] }} left in stock
                    </div>
                @endif
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
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('variants', () => ({
                isSelected(attribute, option) {
                    if (this.$wire.selectedAttributes[attribute] == option) {
                        return true
                    } else {
                        return false
                    }
                },
            }))
        })
    </script>

</div>
