<div class="max-w-2xl mx-auto border-t border-gray-200 py-4 space-y-2">
    <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6">
        @foreach ($products as $product)
            @if ($product['variable'])
                <x-product-card-variable :product="$product" />
            @else
                <x-product-card-basic :product="$product" />
            @endif
        @endforeach

    </div>
    <div class="flex items-center justify-center w-full pt-8">
        @if ($areThereMoreProducts)
            <button class="relative items-center justify-center rounded-md border border-gray-200 bg-transparent px-8 py-2 text-sm font-medium text-gray-600 hover:border-gray-600" wire:click="moreProducts">
                More
            </button>
        @endif
    </div>
</div>
