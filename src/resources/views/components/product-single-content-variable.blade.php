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
            {{-- <select name="variantPicker" x-model="$wire.currentProduct.selectedVariant" class="text-sm font-medium text-gray-900 p-0">
                @foreach ($product['childProducts'] as $childProduct)
                    <option value="{{ $childProduct['id'] }}">{!! $childProduct['name'] !!}</option>
                @endforeach
            </select> --}}
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
                                <button class="ring-offset-2 ring-teal-400 border rounded px-3 py-1" wire:click="selectChildVariant('{{ $attribute['name'] }}','{{ $option }}')" x-bind:class="isSelected('{{ $attribute['name'] }}', '{{ $option }}') ? 'ring-2 border-teal-400 bg-teal-400 text-white' : 'border-gray-200 hover:ring-2'">{{ $option }}</button>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        @foreach ($product['childProducts'] as $childProduct)
            <button x-show="$wire.currentProduct.selectedVariant == '{{ $childProduct['id'] }}'" wire:click="addToCart({{ $childProduct['id'] }})" class="relative items-center justify-center rounded-md border border-transparent bg-teal-400 px-8 py-2 text-sm font-medium text-white active:bg-teal-200 hover:ring-2 ring-offset-2 ring-teal-400">Add to bag</button>
        @endforeach
    </div>
</div>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('variants', () => ({
            isSelected(attribute, option) {
                let selectedVariant = this.$wire.currentProduct.childProducts.find(childProduct => childProduct.id == this.$wire.currentProduct.selectedVariant)
                if (selectedVariant.attributes[attribute] == option) {
                    return true
                } else {
                    return false
                }
            },
        }))
    })
</script>
