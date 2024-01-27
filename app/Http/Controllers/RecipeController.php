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
        return view('recipes.index', ['recipes' => $recipes]);
    }

    public function show($filename)
    {
        $recipe = $this->recipeService->parseRecipe("{$filename}.md");

        // Assuming you have a view named 'recipe.show'
        return view('recipes.show', [
            'recipe' => $recipe,
        ]);
    }
}
