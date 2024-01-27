<div class="col-md-3">
    <div class="card">
        <header class="card-header">
            Categorías
        </header>

        <ul class="list-group list-group-flush">
            @foreach($categories as $category => $slug)
                <li class="list-group-item">
                    <a href="{{ route('categories.show', ['slug' => $slug]) }}">
                        {{ $category }} ({{ count($categoriesWithRecipes[$slug]) }})
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>