<div class="max-w-2xl mx-auto">
    @if ($currentProduct['variable'])
        <x-product-single-content-variable :product="$currentProduct" />
    @else
        <x-product-single-content-basic :product="$currentProduct" />
    @endif
</div>
