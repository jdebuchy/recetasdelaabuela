@extends('layouts.app')

@section('title', 'Recipe Title')

@section('content')
<section class="pb-110">
    <div class="position-relative text-bg-dark">
        <div class="block-background">
            <div class="ratio" style="--bs-aspect-ratio: 20%;">
                @if(!empty($recipe['metadata']['image']))
                    <img src="{{ asset($recipe['metadata']['image']) }}" alt="{{ $recipe['metadata']['title'] }}" class="object-fit-cover">
                @endif
            </div>
        </div>
        <div class="block-foreground position-absolute w-100 h-100 top-0 start-0 bg-dark d-flex flex-column justify-content-center" style="--bs-bg-opacity: .8;">
            <div class="container">
                <div class="text-center">
                    <h1>{{ $recipe['metadata']['title'] ?? 'Recipe' }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Recetas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $recipe['metadata']['title'] ?? 'Recipe' }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6">
                <div class="ratio ratio-16x9">
                    {!! $recipe['metadata']['video_embed'] !!}
                    {{-- <iframe src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" title="YouTube video" allowfullscreen></iframe> --}}
                </div>
            </div>

            <div class="col-md-6">
                {!! $recipe['content'] !!}
            </div>
        </div>
    </div>
</section>
@endsection