<div class="row">
    @if ($recipes)
        @foreach($recipes as $recipe)
            <div class="col-md-4 mb-4">
                <div class="card bg-dark text-white">
                    @if(!empty($recipe['image']))
                        <div class="ratio ratio-4x3">
                            <img src="{{ asset($recipe['image']) }}" class="object-fit-cover card-img" alt="{{ $recipe['title'] }}">
                        </div>
                    @endif
                    <div class="card-img-overlay d-flex justify-content-center align-items-center bg-dark" style="--bs-bg-opacity: .8;">
                        <h5 class="card-title">{{ $recipe['title'] }}</h5>
                        <a href="{{ url('/recetas/' . $recipe['slug']) }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>Faltan cargar recetas aquí.</p>
    @endif
</div>