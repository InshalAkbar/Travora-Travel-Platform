@extends('layouts.app')

@section('title', $destination['title'] . ' — Travora')

@section('content')

@php
    $isFavorite = in_array($destination['id'], session()->get('favorites', []));
    $allDestinations = \App\Http\Controllers\ExploreController::getDestinations();
    $categoryDestinations = collect($allDestinations)
        ->where('category', $destination['category'])
        ->where('id', '!=', $destination['id'])
        ->values()
        ->all();
@endphp

<!-- ============ DESTINATION HERO ============ -->
<section class="destination-hero position-relative overflow-hidden">
    <div class="destination-hero-bg">
        <img src="{{ $destination['image'] }}" alt="{{ $destination['title'] }}" class="w-100 h-100 object-fit-cover">
        <div class="destination-hero-overlay"></div>
    </div>

    <div class="container-fluid px-4 px-md-5 position-relative" style="z-index: 2;">
        <div class="destination-hero-content">
            <!-- Breadcrumb -->
            <nav class="breadcrumb-nav mb-3">
                <a href="{{ route('home') }}">Home</a>
                <i class="fas fa-chevron-right mx-2"></i>
                <a href="{{ route('explore') }}">Explore</a>
                <i class="fas fa-chevron-right mx-2"></i>
                <a href="{{ route('category.show', $destination['category']) }}">{{ $destination['category'] }}</a>
                <i class="fas fa-chevron-right mx-2"></i>
                <span>{{ $destination['title'] }}</span>
            </nav>

            <p class="travora-subtitle mb-3">{{ $destination['country'] }} • {{ $destination['region'] }}</p>
            <h1 class="font-syne fw-bold display-2 mb-4">{{ $destination['title'] }}</h1>
            
            <div class="d-flex flex-wrap gap-4 mb-4">
                <div class="dest-meta-item">
                    <i class="fas fa-star text-accent"></i>
                    <span>{{ $destination['rating'] }} Rating</span>
                </div>
                <div class="dest-meta-item">
                    <i class="far fa-clock text-accent"></i>
                    <span>{{ $destination['days'] }}</span>
                </div>
                <div class="dest-meta-item">
                    <i class="fas fa-tag text-accent"></i>
                    <span>{{ $destination['price'] }} / person</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex flex-wrap gap-3">
                <a href="{{ route('booking.create', $destination['id']) }}" class="btn travora-btn-primary magnetic-btn book-btn">
                    <i class="fas fa-suitcase me-2"></i> Book Now
                </a>
                <button class="btn travora-btn-outline magnetic-btn favorite-btn-large {{ $isFavorite ? 'active' : '' }}"
                        data-id="{{ $destination['id'] }}">
                    <i class="{{ $isFavorite ? 'fas' : 'far' }} fa-heart me-2"></i>
                    <span class="fav-text">{{ $isFavorite ? 'Saved to Favorites' : 'Add to Favorites' }}</span>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- ============ MAIN CONTENT ============ -->
<section class="section-padding">
    <div class="container-fluid px-4 px-md-5">
        <div class="row g-5">
            
            <!-- LEFT -->
            <div class="col-lg-8">
                
                <!-- About -->
                <div class="detail-block mb-5">
                    <h2 class="font-syne fw-bold h3 mb-4">About {{ $destination['title'] }}</h2>
                    <p class="detail-text">{{ $destination['description'] }}</p>
                </div>

                <!-- Highlights -->
                <div class="detail-block mb-5">
                    <h2 class="font-syne fw-bold h3 mb-4">Highlights</h2>
                    <div class="row g-3">
                        @foreach($destination['highlights'] as $highlight)
                            <div class="col-md-6">
                                <div class="highlight-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ $highlight }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Gallery -->
                <div class="detail-block">
                    <h2 class="font-syne fw-bold h3 mb-4">Gallery</h2>
                    <div class="row g-3">
                        @foreach($destination['gallery'] as $index => $img)
                            <div class="col-md-4 col-6">
                                <div class="gallery-item">
                                    <img src="{{ $img }}" alt="Gallery {{ $index + 1 }}" class="w-100 h-100 object-fit-cover">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- RIGHT: Sidebar -->
            <div class="col-lg-4">
                <div class="info-sidebar glass-card rounded-4 p-4 position-sticky" style="top: 100px;">
                    
                    <h4 class="font-syne fw-bold mb-4">Trip Information</h4>

                    <div class="info-list">
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-calendar-alt"></i></div>
                            <div>
                                <p class="info-label">Best Time to Visit</p>
                                <p class="info-value">{{ $destination['best_time'] }}</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-language"></i></div>
                            <div>
                                <p class="info-label">Language</p>
                                <p class="info-value">{{ $destination['language'] }}</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-coins"></i></div>
                            <div>
                                <p class="info-label">Currency</p>
                                <p class="info-value">{{ $destination['currency'] }}</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-clock"></i></div>
                            <div>
                                <p class="info-label">Timezone</p>
                                <p class="info-value">{{ $destination['timezone'] }}</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-mountain"></i></div>
                            <div>
                                <p class="info-label">Category</p>
                                <p class="info-value">
                                    <a href="{{ route('category.show', $destination['category']) }}" class="text-accent text-decoration-none">
                                        {{ $destination['category'] }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Price Box -->
                    <div class="price-box mt-4">
                        <p class="price-label">Starting from</p>
                        <p class="price-value">{{ $destination['price'] }}</p>
                        <p class="price-per">per person</p>
                        <a href="{{ route('booking.create', $destination['id']) }}" class="btn travora-btn-primary w-100 mt-3 magnetic-btn">
                            <i class="fas fa-suitcase me-2"></i> Book This Trip
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- ============ MORE FROM THIS CATEGORY (NEW) ============ -->
@if(count($categoryDestinations) > 0)
<section class="section-padding pt-0">
    <div class="container-fluid px-4 px-md-5">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <p class="travora-subtitle mb-2">EXPLORE MORE</p>
                <h2 class="font-syne fw-bold display-5">More {{ $destination['category'] }}</h2>
            </div>
            <a href="{{ route('category.show', $destination['category']) }}" class="text-accent text-decoration-none d-none d-md-block">
                View all <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($categoryDestinations as $item)
                <div class="col-md-6 col-lg-4">
                    @include('components.destination-card', ['destination' => $item])
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ============ SIMILAR DESTINATIONS ============ -->
@if(count($similar) > 0)
<section class="section-padding pt-0">
    <div class="container-fluid px-4 px-md-5">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <p class="travora-subtitle mb-2">YOU MIGHT ALSO LIKE</p>
                <h2 class="font-syne fw-bold display-5">Similar Destinations</h2>
            </div>
            <a href="{{ route('explore') }}" class="text-accent text-decoration-none d-none d-md-block">
                View all <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($similar as $item)
                <div class="col-md-6 col-lg-4">
                    @include('components.destination-card', ['destination' => $item])
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection