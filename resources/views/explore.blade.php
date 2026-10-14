@extends('layouts.app')

@section('title', 'Explore Destinations — Travora')

@section('content')

<!-- Page Header -->
@include('components.page-header', [
    'subtitle' => 'DISCOVER THE WORLD',
    'title' => 'Explore Destinations',
    'description' => 'Browse through our curated collection of extraordinary places. Filter by category, region, or your travel vibe.',
    'bgImage' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?q=80&w=2000&auto=format&fit=crop'
])

<!-- Explore Content -->
<section class="section-padding">
    <div class="container-fluid px-4 px-md-5">
        
        <!-- Filter Bar -->
        <div class="filter-bar glass-card p-4 rounded-4 mb-5">
            <div class="row g-3 align-items-center">
                
                <!-- Search -->
                <div class="col-lg-4">
                    <div class="search-box position-relative">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" 
                               class="form-control search-input" 
                               id="searchInput"
                               placeholder="Search destinations...">
                    </div>
                </div>

                <!-- Category Filter -->
                <div class="col-lg-5">
                    <div class="category-filters d-flex flex-wrap gap-2" id="categoryFilters">
                        @foreach($categories as $cat)
                            <button class="filter-chip {{ $loop->first ? 'active' : '' }}" 
                                    data-category="{{ $cat }}">
                                {{ $cat }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Result Count -->
                <div class="col-lg-3 text-lg-end">
                    <p class="result-count mb-0">
                        <span id="resultCount">{{ count($destinations) }}</span> destinations found
                    </p>
                </div>
            </div>
        </div>

        <!-- Destinations Grid -->
        <div class="row g-4" id="destinationsGrid">
            @foreach($destinations as $destination)
                <div class="col-md-6 col-lg-4 destination-item" 
                     data-category="{{ $destination['category'] }}"
                     data-title="{{ strtolower($destination['title'] . ' ' . $destination['country'] . ' ' . $destination['region']) }}">
                    @include('components.destination-card', ['destination' => $destination])
                </div>
            @endforeach
        </div>

        <!-- No Results Message -->
        <div class="no-results text-center py-5 d-none" id="noResults">
            <i class="fas fa-compass fa-3x mb-3" style="color: rgba(64, 224, 208, 0.3);"></i>
            <h3 class="font-syne fw-bold mb-2">No destinations found</h3>
            <p class="text-white-50">Try adjusting your filters or search terms.</p>
        </div>

    </div>
</section>

@endsection