<div class="max-w-2xl mx-auto">
    @if ($currentProduct['variable'])
        <x-woo-wire-product-single-content-variable :product="$currentProduct" />
    @else
        <x-woo-wire-product-single-content-basic :product="$currentProduct" />
    @endif
</div>
