<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WooWireCategories extends Component
{
    public $categories = [];
    /**
     * Create a new component instance.
     */
    public function __construct($categoryIds)
    {
        foreach($categoryIds as $categoryId) {
            $category = get_term($categoryId, 'product_cat');
            $this->categories[] = [
                'name' => $category->name,
                'slug' => $category->slug,
                'link' => get_term_link($category),
            ];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.woo-wire-categories');
    }
}
