@extends('layouts.app')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <x-categories-sidebar :categories="$categories" :categoriesWithRecipes="$categoriesWithRecipes" />
            </div>
            <div class="col-md-9">
                <h1>{{ $categoryName }}</h1>
                <hr>
                <x-recipes-grid :recipes="$recipes" />
            </div><!-- .col-md-9 -->
        </div><!-- .row -->
    </div><!-- .container -->
</section>
@endsection