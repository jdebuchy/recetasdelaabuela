<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Services\RecipeService;

class RecipeComposer
{
    protected $recipeService;

    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }

    public function compose(View $view)
    {
        $view->with('categories', $this->recipeService->getCategories());
        $view->with('categoriesWithRecipes', $this->recipeService->groupRecipesByCategory());
    }
}