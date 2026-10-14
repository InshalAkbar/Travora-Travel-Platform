@extends('layouts.app')

@section('title', 'Travel Guides — Travora')

@section('content')

<!-- Page Header -->
@include('components.page-header', [
    'subtitle' => 'STORIES & INSIGHTS',
    'title' => 'Travel Guides',
    'description' => 'In-depth guides, personal stories, and insider tips from travelers and locals around the world.',
    'bgImage' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?q=80&w=2000&auto=format&fit=crop'
])

<!-- Guides Section -->
<section class="section-padding">
    <div class="container-fluid px-4 px-md-5">
        
        <!-- Category Filter -->
        <div class="d-flex flex-wrap gap-2 justify-content-center mb-5" id="guideFilters">
            @foreach($categories as $cat)
                <button class="filter-chip {{ $loop->first ? 'active' : '' }}" 
                        data-category="{{ $cat }}">
                    {{ $cat }}
                </button>
            @endforeach
        </div>

        <!-- Featured Guide (First one) -->
        @php $featured = $guides[0]; @endphp
        <div class="featured-guide mb-5">
            <a href="#" class="featured-guide-link text-decoration-none">
                <div class="glass-card rounded-4 overflow-hidden featured-guide-card">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="featured-guide-image">
                                <img src="{{ $featured['image'] }}" alt="{{ $featured['title'] }}" class="w-100 h-100 object-fit-cover">
                                <div class="featured-badge">FEATURED</div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center">
                            <div class="featured-guide-content p-4 p-md-5">
                                <div class="d-flex gap-3 mb-3">
                                    <span class="guide-category">{{ $featured['category'] }}</span>
                                    <span class="guide-read-time"><i class="far fa-clock me-1"></i> {{ $featured['read_time'] }}</span>
                                </div>
                                <h2 class="font-syne fw-bold display-5 mb-3">{{ $featured['title'] }}</h2>
                                <p class="guide-excerpt mb-4">{{ $featured['excerpt'] }}</p>
                                
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $featured['author_avatar'] }}" class="guide-author-avatar rounded-circle" alt="{{ $featured['author'] }}">
                                    <div>
                                        <p class="mb-0 fw-semibold">{{ $featured['author'] }}</p>
                                        <p class="guide-date mb-0">{{ $featured['date'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Guides Grid -->
        <div class="row g-4" id="guidesGrid">
            @foreach($guides as $index => $guide)
                @if($index === 0) @continue @endif
                <div class="col-md-6 col-lg-4 guide-item" 
                     data-category="{{ $guide['category'] }}">
                    @include('components.guide-card', ['guide' => $guide])
                </div>
            @endforeach
        </div>

    </div>
</section>

@endsection