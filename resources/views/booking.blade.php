@extends('layouts.app')

@section('title', 'Book ' . $destination['title'] . ' — Travora')

@section('content')

<!-- Page Header -->
@include('components.page-header', [
    'subtitle' => 'COMPLETE YOUR BOOKING',
    'title' => 'Book ' . $destination['title'],
    'description' => 'Fill in your details below. Our team will confirm your booking within 24 hours.',
    'bgImage' => $destination['image']
])

<section class="section-padding">
    <div class="container-fluid px-4 px-md-5">
        <div class="row g-5">
            
            <!-- LEFT: Booking Form -->
            <div class="col-lg-8">
                <div class="glass-card rounded-4 p-4 p-md-5">
                    <h2 class="font-syne fw-bold h3 mb-4">Traveler Information</h2>

                    @if($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
                        @csrf
                        <input type="hidden" name="destination_id" value="{{ $destination['id'] }}">

                        <!-- Personal Info -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="planner-label">Full Name *</label>
                                <input type="text" name="full_name" class="form-control planner-input" 
                                       value="{{ old('full_name') }}" placeholder="John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="planner-label">Email *</label>
                                <input type="email" name="email" class="form-control planner-input" 
                                       value="{{ old('email') }}" placeholder="you@example.com" required>
                            </div>
                            <div class="col-md-6">
                                <label class="planner-label">Phone *</label>
                                <input type="tel" name="phone" class="form-control planner-input" 
                                       value="{{ old('phone') }}" placeholder="+92 300 1234567" required>
                            </div>
                            <div class="col-md-6">
                                <label class="planner-label">Travel Style</label>
                                <select name="travel_style" class="form-control planner-input">
                                    <option value="">Select style</option>
                                    <option value="Solo" {{ old('travel_style') === 'Solo' ? 'selected' : '' }}>Solo</option>
                                    <option value="Couple" {{ old('travel_style') === 'Couple' ? 'selected' : '' }}>Couple</option>
                                    <option value="Family" {{ old('travel_style') === 'Family' ? 'selected' : '' }}>Family</option>
                                    <option value="Friends" {{ old('travel_style') === 'Friends' ? 'selected' : '' }}>Friends</option>
                                    <option value="Business" {{ old('travel_style') === 'Business' ? 'selected' : '' }}>Business</option>
                                </select>
                            </div>
                        </div>

                        <!-- Travel Dates -->
                        <h4 class="font-syne fw-bold h5 mb-3 mt-5">Travel Details</h4>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label class="planner-label">Departure Date *</label>
                                <input type="date" name="travel_date" class="form-control planner-input" 
                                       value="{{ old('travel_date') }}" 
                                       min="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="planner-label">Return Date</label>
                                <input type="date" name="return_date" class="form-control planner-input" 
                                       value="{{ old('return_date') }}" 
                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="planner-label">Number of Travelers *</label>
                                <input type="number" name="travelers" id="travelersInput" 
                                       class="form-control planner-input" 
                                       value="{{ old('travelers', 1) }}" 
                                       min="1" max="20" required>
                            </div>
                        </div>

                        <!-- Special Requests -->
                        <div class="mb-4">
                            <label class="planner-label">Special Requests (Optional)</label>
                            <textarea name="special_requests" class="form-control planner-input" 
                                      rows="4" placeholder="Dietary restrictions, accessibility needs, room preferences...">{{ old('special_requests') }}</textarea>
                        </div>

                        <!-- Submit -->
                        <div class="d-flex justify-content-between align-items-center pt-4 border-top border-secondary flex-wrap gap-3">
                            <a href="{{ route('destination.show', $destination['id']) }}" class="btn travora-btn-outline">
                                <i class="fas fa-arrow-left me-2"></i> Back
                            </a>
                            <button type="submit" class="btn travora-btn-primary magnetic-btn">
                                <i class="fas fa-check-circle me-2"></i> Confirm Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- RIGHT: Destination Summary -->
            <div class="col-lg-4">
                <div class="glass-card rounded-4 overflow-hidden position-sticky" style="top: 100px;">
                    
                    <!-- Destination Image -->
                    <div class="booking-dest-image">
                        <img src="{{ $destination['image'] }}" alt="{{ $destination['title'] }}" class="w-100 h-100 object-fit-cover">
                    </div>

                    <div class="p-4">
                        <p class="text-accent small mb-1 letter-spacing">{{ $destination['country'] }}</p>
                        <h3 class="font-syne fw-bold h4 mb-3">{{ $destination['title'] }}</h3>

                        <!-- Destination Meta -->
                        <div class="d-flex gap-3 mb-4 flex-wrap">
                            <span class="badge-soft"><i class="fas fa-star text-accent me-1"></i> {{ $destination['rating'] }}</span>
                            <span class="badge-soft"><i class="fas fa-clock text-accent me-1"></i> {{ $destination['days'] }}</span>
                        </div>

                        <!-- Price Breakdown -->
                        <div class="booking-price-box">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-white-50">Base price</span>
                                <span id="basePrice">{{ $destination['price'] }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-white-50">Travelers</span>
                                <span id="travelersCount">× 1</span>
                            </div>
                            <div class="d-flex justify-content-between pt-3 border-top border-secondary">
                                <span class="fw-bold">Total</span>
                                <span class="fw-bold text-accent" id="totalPrice" style="font-size: 1.3rem;">{{ $destination['price'] }}</span>
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="mt-4 p-3 rounded-3" style="background: rgba(64, 224, 208, 0.05); border: 1px solid rgba(64, 224, 208, 0.15);">
                            <p class="small mb-1 text-accent"><i class="fas fa-info-circle me-1"></i> Free cancellation</p>
                            <p class="small text-white-50 mb-0">Up to 48 hours before departure</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection