<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Traits\WooCommerceProductsTrait;

class WooWireProductArchive extends Component
{

    use WooCommerceProductsTrait;

    public int $paginationPage = 1;

    public string $sort = 'ASC';
    
    public string $orderby = 'title';

    public int $columns = 2;

    public int $rows = 3;

    public int $limit = 0;

    public string $category = '';

    public bool $areThereMoreProducts = true;
    
    public function parseWooCommerceArchiveQuery()
    {
        global $wp_query;

        $query = $wp_query->query_vars;
        
        if(!isset($query['product_cat'])) {
            $query['product_cat'] = '';
        } else {
            $this->category = $query['product_cat'];
        }

        if(!isset($query['posts_per_page'])) {
            $query['posts_per_page'] = -1;
        } else {
            $this->limit = $query['posts_per_page'];
        }

        $columns = get_option('woocommerce_catalog_columns');
        if($columns) {
            $this->columns = $columns;
        }

        $rows = get_option('woocommerce_catalog_rows');
        if($rows) {
            $this->rows = $rows;
        }

    }

    public function getAllProducts()
    {
        $wcProducts = wc_get_products([
            'limit' => $this->limit,
            'product_cat' => $this->category,
            'page' => $this->paginationPage,
            'sort' => $this->sort,
            'orderby' => $this->orderby,
        ]);
        
        foreach ($wcProducts as $product) {
            $this->products[$product->get_id()] = $this->getStructuredProduct($product);
        }

        // return true or false to indicate wheter there are more products to load
        if($this->limit !== count($wcProducts)){
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
        $this->parseWooCommerceArchiveQuery();
        $this->areThereMoreProducts = $this->getAllProducts();
        $this->dispatch('getcart');
    }

    #[Layout('layouts.livewire')]
    public function render()
    {
        return view('livewire.woo-wire-product-archive');
    }
}
