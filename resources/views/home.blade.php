@extends('layouts.app')

@section('title', 'Travora — Explore Beyond')

@section('content')

<!-- ============ HERO SECTION ============ -->
<section class="hero-section position-relative overflow-hidden" id="hero">
    
    <div class="hero-bg parallax-layer" data-speed="0.05">
        <img src="https://images.unsplash.com/photo-1533105079780-92b9be482077?q=80&w=2000&auto=format&fit=crop" 
             alt="Background" class="w-100 h-100 object-fit-cover opacity-40">
        <div class="hero-overlay"></div>
    </div>

    <div class="container-fluid px-4 px-md-5 position-relative" style="z-index: 10;">
        <div class="row align-items-center min-vh-100">
            
            <!-- LEFT: Text -->
            <div class="col-lg-7 parallax-layer hero-content-wrapper" data-speed="0.02">
                <p class="travora-subtitle mb-4">YOUR NEXT JOURNEY STARTS HERE</p>
                
                <h1 class="hero-title font-syne mb-4">
                    <span class="d-block text-white">GO</span>
                    <span class="d-block text-outline">BEYOND</span>
                    <span class="d-block text-white position-relative">
                        ORDINARY
                        <span class="accent-square"></span>
                    </span>
                </h1>
                
                <p class="hero-desc mb-5">
                    Discover places that feel unreal. Build journeys around what matters to you, and experience travel differently.
                </p>
                
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('explore') }}" class="btn travora-btn-primary magnetic-btn">
                        Explore destinations <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    <a href="{{ route('ai.assistant') }}" class="btn travora-btn-outline magnetic-btn">
                        <i class="fas fa-wand-magic-sparkles me-2 text-accent"></i> Ask Travora AI
                    </a>
                </div>
            </div>

            <!-- RIGHT: Featured Card -->
            <div class="col-lg-4 offset-lg-1 mt-5 mt-lg-0 parallax-layer" data-speed="0.08">
                @include('components.destination-card', ['destination' => $featuredDestinations[0]])
            </div>
            
        </div>
    </div>

    <div class="scroll-indicator d-none d-md-block">
        <p class="small mb-2 letter-spacing text-white-50">SCROLL TO EXPLORE</p>
        <i class="fas fa-arrow-down text-accent animate-bounce"></i>
    </div>

    <div class="edition-badge d-none d-md-block">
        <p class="small mb-0 text-white-50">2026</p>
        <p class="small fw-bold mb-0 letter-spacing">EDITION</p>
    </div>

</section>

<!-- ============ CATEGORIES SECTION ============ -->
<section class="section-padding">
    <div class="container-fluid px-4 px-md-5">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <p class="travora-subtitle mb-2">BROWSE BY VIBE</p>
                <h2 class="font-syne fw-bold display-5">Find Your Kind of Place</h2>
            </div>
            <a href="{{ route('explore') }}" class="text-accent text-decoration-none d-none d-md-block">
                All categories <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-3">
            @foreach($categories as $index => $category)
                <div class="col-md-6 col-lg-4">
                    @include('components.category-card', ['category' => $category])
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ============ FEATURED DESTINATIONS ============ -->
<section class="section-padding">
    <div class="container-fluid px-4 px-md-5">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <p class="travora-subtitle mb-2">CURATED FOR YOU</p>
                <h2 class="font-syne fw-bold display-5">Featured Escapes</h2>
            </div>
            <a href="{{ route('explore') }}" class="text-accent text-decoration-none d-none d-md-block">
                View all <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($featuredDestinations as $destination)
                <div class="col-md-6 col-lg-4">
                    @include('components.destination-card', ['destination' => $destination])
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ============ WHY TRAVORA (FEATURES) ============ -->
<section class="section-padding features-section position-relative">
    <div class="container-fluid px-4 px-md-5">
        <div class="text-center mb-5">
            <p class="travora-subtitle mb-2">WHY TRAVORA</p>
            <h2 class="font-syne fw-bold display-5 mb-3">Travel Smarter, Not Harder</h2>
            <p class="section-desc mx-auto">
                We combine cutting-edge AI with human-curated experiences to make every journey unforgettable.
            </p>
        </div>

        <div class="row g-4">
            @foreach($features as $feature)
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card glass-card p-4 rounded-4 h-100">
                        <div class="feature-icon mb-4">
                            <i class="fas {{ $feature['icon'] }}"></i>
                        </div>
                        <h4 class="font-syne fw-bold h5 mb-3">{{ $feature['title'] }}</h4>
                        <p class="feature-desc mb-0">{{ $feature['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ============ TESTIMONIALS ============ -->
<section class="section-padding">
    <div class="container-fluid px-4 px-md-5">
        <div class="text-center mb-5">
            <p class="travora-subtitle mb-2">TRAVELER STORIES</p>
            <h2 class="font-syne fw-bold display-5">Loved by Explorers</h2>
        </div>

        <div class="row g-4">
            @foreach($testimonials as $testimonial)
                <div class="col-md-6 col-lg-4">
                    @include('components.testimonial-card', ['testimonial' => $testimonial])
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ============ CTA SECTION (AI PLANNER PROMO) ============ -->
<section class="section-padding">
    <div class="container-fluid px-4 px-md-5">
        <div class="cta-section position-relative rounded-4 overflow-hidden p-5">
            <div class="cta-bg"></div>
            
            <div class="row align-items-center position-relative" style="z-index: 2;">
                <div class="col-lg-7">
                    <p class="travora-subtitle mb-3">AI-POWERED PLANNING</p>
                    <h2 class="font-syne fw-bold display-4 mb-4 text-white">
                        Let AI Plan Your <br>
                        Next Adventure
                    </h2>
                    <p class="section-desc mb-4" style="max-width: 500px;">
                        Tell us your interests, budget, and travel dates — our AI will craft a personalized itinerary in seconds.
                    </p>
                    <a href="{{ route('planner') }}" class="btn travora-btn-primary magnetic-btn">
                        <i class="fas fa-magic me-2"></i> Try AI Planner
                    </a>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="cta-illustration">
                        <i class="fas fa-route"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection