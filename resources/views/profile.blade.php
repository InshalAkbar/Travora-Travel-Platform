@extends('layouts.app')

@section('title', 'My Profile — Travora')

@section('content')

@php
    $user = Auth::user();
    $initials = strtoupper(substr($user->name, 0, 1));
@endphp

<!-- Page Header -->
@include('components.page-header', [
    'subtitle' => 'YOUR ACCOUNT',
    'title' => 'My Profile',
    'description' => 'Manage your account, view bookings, and see your saved destinations.',
    'bgImage' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?q=80&w=2000&auto=format&fit=crop'
])

<section class="section-padding">
    <div class="container-fluid px-4 px-md-5">

        <!-- Profile Header Card -->
        <div class="glass-card rounded-4 p-4 p-md-5 mb-5 profile-header-card">
            <div class="row align-items-center g-4">
                <div class="col-auto">
                    <div class="profile-avatar-large">
                        @if($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}">
                        @else
                            {{ $initials }}
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex align-items-center gap-3 flex-wrap mb-2">
                        <h1 class="font-syne fw-bold display-5 mb-0">{{ $user->name }}</h1>
                        @if($user->isAdmin())
                            <span class="admin-badge">ADMIN</span>
                        @endif
                    </div>
                    <p class="text-white-50 mb-1"><i class="fas fa-envelope me-2 text-accent"></i>{{ $user->email }}</p>
                    @if($user->country)
                        <p class="text-white-50 mb-1"><i class="fas fa-globe me-2 text-accent"></i>{{ $user->country }}</p>
                    @endif
                    @if($user->phone)
                        <p class="text-white-50 mb-0"><i class="fas fa-phone me-2 text-accent"></i>{{ $user->phone }}</p>
                    @endif
                </div>
                <div class="col-auto">
                    <div class="text-md-end">
                        <p class="small text-white-50 mb-1">Member since</p>
                        <p class="fw-bold mb-0">{{ $user->created_at->format('M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Row -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stat-card glass-card rounded-4 p-4">
                    <div class="stat-icon-wrap" style="background: rgba(64, 224, 208, 0.15); color: #40E0D0;">
                        <i class="fas fa-suitcase"></i>
                    </div>
                    <p class="stat-label">Total Bookings</p>
                    <h3 class="stat-value">{{ count($bookings) }}</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card glass-card rounded-4 p-4">
                    <div class="stat-icon-wrap" style="background: rgba(255, 71, 87, 0.15); color: #ff4757;">
                        <i class="fas fa-heart"></i>
                    </div>
                    <p class="stat-label">Saved Favorites</p>
                    <h3 class="stat-value">{{ count($favorites) }}</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card glass-card rounded-4 p-4">
                    <div class="stat-icon-wrap" style="background: rgba(255, 215, 0, 0.15); color: #FFD700;">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <p class="stat-label">Total Spent</p>
                    <h3 class="stat-value">${{ number_format($bookings->sum('total_price'), 0) }}</h3>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-pills profile-tabs mb-4" id="profileTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="bookings-tab" data-bs-toggle="pill" data-bs-target="#bookings-pane" type="button">
                    <i class="fas fa-suitcase me-2"></i> Bookings
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="favorites-tab" data-bs-toggle="pill" data-bs-target="#favorites-pane" type="button">
                    <i class="fas fa-heart me-2"></i> Favorites
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="activity-tab" data-bs-toggle="pill" data-bs-target="#activity-pane" type="button">
                    <i class="fas fa-clock me-2"></i> Activity
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="profileTabsContent">

            <!-- Bookings Tab -->
            <div class="tab-pane fade show active" id="bookings-pane" role="tabpanel">
                <div class="glass-card rounded-4 p-4">
                    @if(count($bookings) > 0)
                        <div class="table-responsive">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Reference</th>
                                        <th>Destination</th>
                                        <th>Travel Date</th>
                                        <th>Travelers</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                        <tr>
                                            <td><span class="text-accent fw-bold small">{{ $booking->reference }}</span></td>
                                            <td>
                                                <p class="mb-0 fw-semibold">{{ $booking->destination_name }}</p>
                                                <p class="mb-0 small text-white-50">{{ $booking->destination_country }}</p>
                                            </td>
                                            <td class="small">{{ $booking->travel_date->format('M d, Y') }}</td>
                                            <td class="small text-center">{{ $booking->travelers }}</td>
                                            <td class="text-accent fw-bold">${{ number_format($booking->total_price, 0) }}</td>
                                            <td>
                                                <span class="status-badge status-{{ $booking->status }}">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="empty-icon mb-3">
                                <i class="fas fa-suitcase"></i>
                            </div>
                            <h4 class="font-syne fw-bold mb-2">No bookings yet</h4>
                            <p class="text-white-50 mb-4">Start exploring and book your first adventure!</p>
                            <a href="{{ route('explore') }}" class="btn travora-btn-primary magnetic-btn">
                                <i class="fas fa-compass me-2"></i> Explore Destinations
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Favorites Tab -->
            <div class="tab-pane fade" id="favorites-pane" role="tabpanel">
                @if(count($favorites) > 0)
                    <div class="row g-4">
                        @foreach($favorites as $destination)
                            <div class="col-md-6 col-lg-4">
                                @include('components.destination-card', ['destination' => $destination])
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="glass-card rounded-4 p-5 text-center">
                        <div class="empty-icon mb-3">
                            <i class="far fa-heart"></i>
                        </div>
                        <h4 class="font-syne fw-bold mb-2">No favorites yet</h4>
                        <p class="text-white-50 mb-4">Tap the heart icon on any destination to save it here.</p>
                        <a href="{{ route('explore') }}" class="btn travora-btn-primary magnetic-btn">
                            <i class="fas fa-compass me-2"></i> Explore Destinations
                        </a>
                    </div>
                @endif
            </div>

            <!-- Activity Tab -->
            <div class="tab-pane fade" id="activity-pane" role="tabpanel">
                <div class="glass-card rounded-4 p-4">
                    @if(count($activities) > 0)
                        <div class="activity-feed">
                            @foreach($activities as $activity)
                                <div class="activity-item">
                                    <div class="activity-dot"></div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0 small">
                                            <strong class="text-accent">{{ ucfirst(str_replace('_', ' ', $activity->action)) }}</strong>
                                            <span class="text-white-50">{{ $activity->details }}</span>
                                        </p>
                                        <p class="mb-0 small text-white-50" style="font-size: 0.75rem;">
                                            {{ $activity->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-white-50 text-center mb-0 py-4">No activity yet.</p>
                    @endif
                </div>
            </div>

        </div>

    </div>
</section>

@endsection