@extends('layouts.app')

@section('title', 'Booking Confirmed — Travora')

@section('content')

<section class="section-padding" style="padding-top: 180px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <div class="glass-card rounded-4 p-4 p-md-5 text-center booking-success-card">
                    
                    <!-- Success Icon -->
                    <div class="success-icon mx-auto mb-4">
                        <i class="fas fa-check"></i>
                    </div>

                    <p class="travora-subtitle mb-2">BOOKING CONFIRMED</p>
                    <h1 class="font-syne fw-bold display-5 mb-3">You're All Set! 🎉</h1>
                    <p class="text-white-50 mb-5" style="max-width: 500px; margin: 0 auto;">
                        Your booking has been received. We've sent a confirmation email with all the details.
                    </p>

                    <!-- Reference -->
                    <div class="booking-reference mb-5">
                        <p class="small text-white-50 mb-1">Booking Reference</p>
                        <p class="reference-code">{{ $booking->reference }}</p>
                    </div>

                    <!-- Booking Summary -->
                    <div class="booking-summary text-start">
                        <h4 class="font-syne fw-bold h5 mb-4 text-center">Booking Summary</h4>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="summary-item">
                                    <p class="summary-label">Destination</p>
                                    <p class="summary-value">{{ $booking->destination_name }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="summary-item">
                                    <p class="summary-label">Country</p>
                                    <p class="summary-value">{{ $booking->destination_country }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="summary-item">
                                    <p class="summary-label">Traveler Name</p>
                                    <p class="summary-value">{{ $booking->full_name }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="summary-item">
                                    <p class="summary-label">Email</p>
                                    <p class="summary-value">{{ $booking->email }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="summary-item">
                                    <p class="summary-label">Travel Date</p>
                                    <p class="summary-value">{{ $booking->travel_date->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="summary-item">
                                    <p class="summary-label">Travelers</p>
                                    <p class="summary-value">{{ $booking->travelers }} {{ $booking->travelers > 1 ? 'people' : 'person' }}</p>
                                </div>
                            </div>
                            @if($booking->return_date)
                            <div class="col-md-6">
                                <div class="summary-item">
                                    <p class="summary-label">Return Date</p>
                                    <p class="summary-value">{{ $booking->return_date->format('M d, Y') }}</p>
                                </div>
                            </div>
                            @endif
                            @if($booking->travel_style)
                            <div class="col-md-6">
                                <div class="summary-item">
                                    <p class="summary-label">Travel Style</p>
                                    <p class="summary-value">{{ $booking->travel_style }}</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Total -->
                        <div class="booking-total mt-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Total Amount</span>
                                <span class="total-amount">${{ number_format($booking->total_price, 0) }}</span>
                            </div>
                            <p class="small text-white-50 mb-0 mt-1">Status: <span class="text-accent">Pending Confirmation</span></p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex flex-wrap justify-content-center gap-3 mt-5">
                        <a href="{{ route('home') }}" class="btn travora-btn-outline">
                            <i class="fas fa-home me-2"></i> Back to Home
                        </a>
                        <a href="{{ route('explore') }}" class="btn travora-btn-primary magnetic-btn">
                            <i class="fas fa-compass me-2"></i> Explore More
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection