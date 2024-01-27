@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Recipe Categories</h2>
        <ul>
            @foreach($categories as $category => $slug)
                <li>
                    <a href="{{ route('categories.show', ['slug' => $slug]) }}">
                        {{ $category }} ({{ count($categoriesWithRecipes[$slug]) }})
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection