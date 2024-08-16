<?php

namespace App\Traits;

trait WooCommerceProductsTrait
{

    public $currentProduct = null;

    public $products = [];

    public function addToCart(int $id)
    {
        $result = WC()->cart->add_to_cart($id);
        if($result){
            $this->dispatch('getcart');
            $this->dispatch('opencart');
        } else {
            //handle error            
        }
        
    }

    // returns a structured product
    public function getStructuredProduct($product)
    {

        $categoreis = $product->get_category_ids();
        $productVariants = $product->get_children();

        $structuredProduct = [
            'variable' => $productVariants ? true : false,
            'id' => $product->get_id(),
            'name' => $product->get_name(),
            'categories' => $categoreis,
            'price' => $product->get_regular_price(),
            'sale' => $product->get_sale_price(),
            'permalink' => $product->get_permalink(),
            'image' => get_permalink($product->get_image_id()),
            'selectedVariant' => $productVariants ? $productVariants[0] : null,
            'childProducts' =>  $this->getProductVariants($productVariants,$product),
            'stock' => $product->get_stock_quantity(),
            'description' => $product->get_description(),
            'attributes' => [],
        ];
        

        foreach ($product->get_attributes() as $attribute) {
            $structuredProduct['attributes'][] = ($attribute->get_data());
        }
        
        return $structuredProduct;
    }

    // returns the product variants
    public function getProductVariants($productVariants,$product)
    {
        if($productVariants){
            $structuresChildProducts = [];
            foreach ($productVariants as $id) {
                $structuresChildProducts[$id] = $this->getStructuredChildProduct($id,$product);
            }
            return $structuresChildProducts;
        } else {
            return [];
        }
    }

    // returns a structured child product
    public function getStructuredChildProduct($childProductId,$parentProduct)
    {
        $childProduct = wc_get_product($childProductId);

        return [
            'id' => $childProductId,
            'name' => str_replace($parentProduct->get_name(), '', $childProduct->get_name()),
            'price' => $childProduct->get_regular_price(),
            'sale' => $childProduct->get_sale_price(),
            'permalink' => $parentProduct->get_permalink() . '?variation_id=' . $childProductId,
            'image' => $childProduct->get_image_id() ? get_permalink($childProduct->get_image_id()) : get_permalink($parentProduct->get_image_id()),
            'attributes' => $childProduct->get_attributes(),
            'stock' => $childProduct->get_stock_quantity(),
            'description' => $childProduct->get_description(),
        ];
    }
}