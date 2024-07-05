<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Traits\WooCommerceProductsTrait;

class ProductArchive extends Component
{

    use WooCommerceProductsTrait;

    public int $paginationPage = 1;

    public string $sort = 'ASC';
    
    public string $orderby = 'title';

    public bool $areThereMoreProducts = true;
    
    public function parseWooCommerceArchiveQuery()
    {
        global $wp_query;

        $query = $wp_query->query_vars;
        
        if(!isset($query['product_cat'])) {
            $query['product_cat'] = '';
        }

        if(!isset($query['posts_per_page'])) {
            $query['posts_per_page'] = -1;
        }


        return $query;
    }

    public function getAllProducts()
    {
        $query = $this->parseWooCommerceArchiveQuery();
        $wcProducts = wc_get_products([
            'limit' => $query['posts_per_page'],
            'product_cat' => $query['product_cat'],
            'page' => $this->paginationPage,
            'sort' => $this->sort,
            'orderby' => $this->orderby,
        ]);
        
        foreach ($wcProducts as $product) {
            $this->products[$product->get_id()] = $this->getStructuredProduct($product);
        }

        // return true or false to indicate wheter there are more products to load
        if($query['posts_per_page'] !== count($wcProducts)){
            return false;
        }
        return true;
    }

    public function moreProducts()
    {
        $this->paginationPage++;
        $this->areThereMoreProducts = $this->getAllProducts();
    }

    public function mount()
    {
        $this->areThereMoreProducts = $this->getAllProducts();
        $this->dispatch('getcart');
    }

    #[Layout('layouts.livewire')]
    public function render()
    {
        return view('livewire.product-archive');
    }
}
