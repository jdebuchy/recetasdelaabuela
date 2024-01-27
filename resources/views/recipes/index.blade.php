@extends('layouts.app')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <x-categories-sidebar :categories="$categories" :categoriesWithRecipes="$categoriesWithRecipes" />
            </div>
            <div class="col-md-9">
                <x-recipes-grid :recipes="$recipes" />
            </div>
        </div>
    </div>
</section>
@endsection