<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RecipeService;

class RecipeController extends Controller
{
    protected $recipeService;

    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }

    public function index(RecipeService $recipeService)
    {
        $recipes = $recipeService->listRecipes();

        return view('recipes.index', [
            'recipes' => $recipes,
        ]);
    }

    public function show($filename)
    {
        $recipe = $this->recipeService->parseRecipe("{$filename}.md");

        return view('recipes.show', [
            'recipe' => $recipe,
        ]);
    }

    public function categoryIndex(RecipeService $recipeService)
    {
        return view('categories.index');
    }

    public function showCategory($slug, RecipeService $recipeService)
    {
        $categoriesWithRecipes = $recipeService->groupRecipesByCategory();
        $categoryName = $recipeService->getCategoryNameBySlug($slug); // Get the category name

        $recipesInCategory = [];

        if ($categoryName && array_key_exists($slug, $categoriesWithRecipes)) {
            $recipesInCategory = $categoriesWithRecipes[$slug] ?? [];
        }

        // Assuming you want to pass both the category name and its recipes to the view
        return view('categories.show', [
            'categoryName' => $categoryName, 
            'recipes' => $recipesInCategory
        ]);
    }
}
