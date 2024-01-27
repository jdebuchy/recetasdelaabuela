<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [RecipeController::class, 'index']);
Route::get('/recetas/{slug}', [RecipeController::class, 'show'])->name('recipes.show');
Route::get('/categories', [RecipeController::class, 'categoryIndex'])->name('categories.index');
Route::get('/categories/{slug}', [RecipeController::class, 'showCategory'])->name('categories.show');
