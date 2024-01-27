<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoriesSidebar extends Component
{
    public $categories;
    public $categoriesWithRecipes;
    
    /**
     * Create a new component instance.
     */
    public function __construct($categories, $categoriesWithRecipes)
    {
        $this->categories = $categories;
        $this->categoriesWithRecipes = $categoriesWithRecipes;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.categories-sidebar');
    }
}
