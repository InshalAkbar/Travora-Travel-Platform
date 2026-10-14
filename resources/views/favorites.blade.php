@extends('layouts.app')

@section('title', 'My Favorites — Travora')

@section('content')

<!-- Page Header -->
@include('components.page-header', [
    'subtitle' => 'YOUR SAVED PLACES',
    'title' => 'My Favorites',
    'description' => 'All the destinations you\'ve saved for later. Ready to turn dreams into journeys?',
    'bgImage' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?q=80&w=2000&auto=format&fit=crop'
])

<section class="section-padding">
    <div class="container-fluid px-4 px-md-5">
        
        @if(count($favorites) > 0)
            
            <!-- Header with count + clear -->
            <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
                <p class="result-count mb-0">
                    <span id="favPageCount">{{ count($favorites) }}</span> destinations saved
                </p>
                <button class="btn travora-btn-outline" id="clearFavoritesBtn">
                    <i class="fas fa-trash-alt me-2"></i> Clear All
                </button>
            </div>

            <!-- Favorites Grid -->
            <div class="row g-4" id="favoritesGrid">
                @foreach($favorites as $destination)
                    <div class="col-md-6 col-lg-4" data-fav-id="{{ $destination['id'] }}">
                        @include('components.destination-card', ['destination' => $destination])
                    </div>
                @endforeach
            </div>

        @else
            
            <!-- Empty State -->
            <div class="empty-state text-center py-5">
                <div class="empty-icon mb-4">
                    <i class="far fa-heart"></i>
                </div>
                <h2 class="font-syne fw-bold mb-3">No favorites yet</h2>
                <p class="text-white-50 mb-4" style="max-width: 500px; margin: 0 auto;">
                    Start exploring and tap the heart icon on any destination to save it here for later.
                </p>
                <a href="{{ route('explore') }}" class="btn travora-btn-primary magnetic-btn">
                    <i class="fas fa-compass me-2"></i> Explore Destinations
                </a>
            </div>

        @endif

    </div>
</section>

@endsection