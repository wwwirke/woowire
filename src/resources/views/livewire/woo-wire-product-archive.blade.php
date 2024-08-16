<div class="max-w-2xl mx-auto border-t border-gray-200 py-4 space-y-2">
    <div class="mt-8 grid grid-cols-1 gap-y-12 sm:gap-x-6 {{ $columns >= 2 ? 'sm:grid-cols-2' : '' }} {{ $columns >= 3 ? 'md:grid-cols-3' : '' }} {{ $columns >= 4 ? 'lg:grid-cols-4' : '' }} {{ $columns >= 5 ? 'xl:grid-cols-5' : '' }}">
        @foreach ($products as $product)
            @if ($product['variable'])
                <x-woo-wire-product-card-variable :product="$product" />
            @else
                <x-woo-wire-product-card-basic :product="$product" />
            @endif
        @endforeach

    </div>
    <div class="flex items-center justify-center w-full pt-8">
        @if ($areThereMoreProducts)
            <button class="relative items-center justify-center rounded-md border border-gray-100 px-8 py-2 text-sm font-medium active:bg-gray-200 hover:ring-2 ring-offset-2 ring-gray-100" wire:click="moreProducts">
                More
            </button>
        @endif
    </div>
</div>
