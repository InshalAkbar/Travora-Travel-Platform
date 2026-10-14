@php
    $isFavorite = in_array($destination['id'], session()->get('favorites', []));
@endphp

<div class="glass-card p-3 p-md-4 rounded-4 position-relative overflow-hidden h-100 destination-card">
    
    <!-- Heart Button -->
    <button class="favorite-btn {{ $isFavorite ? 'active' : '' }}" 
            data-id="{{ $destination['id'] }}"
            title="{{ $isFavorite ? 'Remove from favorites' : 'Add to favorites' }}">
        <i class="{{ $isFavorite ? 'fas' : 'far' }} fa-heart"></i>
    </button>

    <!-- Card Image (Clickable) -->
    <a href="{{ route('destination.show', $destination['id']) }}" class="text-decoration-none">
        <div class="card-image-wrapper position-relative rounded-3 overflow-hidden mb-4">
            <img src="{{ $destination['image'] }}" 
                 alt="{{ $destination['title'] }}" 
                 class="w-100 h-100 object-fit-cover card-image">
            
            <div class="badge-featured">FEATURED ESCAPE</div>
            <div class="badge-number">{{ $destination['number'] }}</div>
            
            <!-- Rating Badge -->
            <div class="badge-rating">
                <i class="fas fa-star"></i> {{ $destination['rating'] ?? '4.8' }}
            </div>
        </div>
    </a>
    
    <!-- Card Details -->
    <div class="d-flex justify-content-between align-items-end">
        <div>
            <p class="text-accent small mb-1 letter-spacing">{{ $destination['country'] }}</p>
            <a href="{{ route('destination.show', $destination['id']) }}" class="text-decoration-none">
                <h3 class="font-syne fw-bold h4 mb-2 card-title">{{ $destination['title'] }}</h3>
            </a>
            <p class="card-meta mb-0">
                <i class="far fa-clock me-1"></i> {{ $destination['days'] ?? '5 Days' }}
                <span class="mx-2">•</span>
                {{ $destination['price'] ?? '$1,200' }}
            </p>
        </div>
        <a href="{{ route('destination.show', $destination['id']) }}" class="btn arrow-btn rounded-circle">
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
    
</div>