<?php

namespace App\Livewire;

use Livewire\Component;
use App\Traits\WooCommerceProductsTrait;

class ProductSingle extends Component
{

    use WooCommerceProductsTrait;

    public $currentProduct;

    public $selectedAttributes = [];

    public function parseWooCommerceSingleQuery()
    {
        global $wp_query;

        $query = $wp_query->query_vars;

        return $query;
    }

    public function getProduct()
    {
        $query = $this->parseWooCommerceSingleQuery();
        $wcProducts = wc_get_products([
            'limit' => 1,
            'name' => $query['name'],
        ]);

        foreach ($wcProducts as $product) {
            $this->products[$product->get_id()] = $this->getStructuredProduct($product);
        }

        $currentProductId = array_key_first($this->products);
        $this->currentProduct = $this->products[$currentProductId];

        $selectedVariantId = request()->get('variation_id');
        if(!$selectedVariantId){
            if($this->currentProduct['childProducts']){
                $selectedVariantId = $this->currentProduct['childProducts'][0]['id'];
            } else {
                $selectedVariantId = null;
            }
        }
        $this->currentProduct['selectedVariant'] = $selectedVariantId;


        if($this->currentProduct['childProducts']){
            $childProducts = collect($this->currentProduct['childProducts']);
            $childProduct = $childProducts->where('id', $selectedVariantId)->first();
            $this->selectedAttributes = $childProduct['attributes'];
        }
    }


    public function selectChildVariant($attribute, $value)
    {
        $this->selectedAttributes[$attribute] = $value;

        if(count($this->currentProduct['attributes']) === count($this->selectedAttributes)){            
            $this->currentProduct['selectedVariant'] = collect($this->currentProduct['childProducts'])
            ->where('attributes', $this->selectedAttributes)
            ->first()['id'];
        }

    }


    public function mount()
    {
        $this->getProduct();
        $this->dispatch('getcart');

    }
    
    public function render()
    {
        return view('livewire.product-single');
    }
}
