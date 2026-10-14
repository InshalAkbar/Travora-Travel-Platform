@extends('layouts.app')

@section('title', $category . ' — Travora')

@section('content')

<!-- Page Header -->
@include('components.page-header', [
    'subtitle' => 'BROWSE BY CATEGORY',
    'title' => $category,
    'description' => $categoryInfo['description'],
    'bgImage' => $categoryInfo['image']
])

<section class="section-padding">
    <div class="container-fluid px-4 px-md-5">

        <!-- Back + Count -->
        <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
            <a href="{{ route('explore') }}" class="btn travora-btn-outline">
                <i class="fas fa-arrow-left me-2"></i> All Categories
            </a>
            <p class="result-count mb-0">
                <span>{{ count($destinations) }}</span> destinations in {{ $category }}
            </p>
        </div>

        <!-- Destinations Grid -->
        <div class="row g-4">
            @foreach($destinations as $destination)
                <div class="col-md-6 col-lg-4">
                    @include('components.destination-card', ['destination' => $destination])
                </div>
            @endforeach
        </div>

        <!-- Other Categories -->
        <div class="mt-5 pt-5 border-top border-secondary">
            <p class="travora-subtitle mb-3">EXPLORE OTHER CATEGORIES</p>
            <div class="d-flex flex-wrap gap-2">
                @foreach(['Beaches', 'Mountains', 'Cities', 'Deserts', 'Forests', 'Islands'] as $cat)
                    @if($cat !== $category)
                        <a href="{{ route('category.show', $cat) }}" class="filter-chip text-decoration-none">
                            {{ $cat }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>

    </div>
</section>

@endsection