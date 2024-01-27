<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\View\Composers\RecipeComposer;
use Illuminate\Support\Facades;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Facades\View::composer(
            ['recipes.index', 'categories.index', 'categories.show'], 
            RecipeComposer::class 
        );
    }
}
