<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RecipesGrid extends Component
{
    public $recipes;

    /**
     * Create a new component instance.
     */
    public function __construct($recipes)
    {
        $this->recipes = $recipes;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.recipes-grid');
    }
}
