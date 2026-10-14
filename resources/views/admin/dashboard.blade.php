@extends('layouts.app')

@section('title', 'Admin Dashboard — Travora')

@section('content')

<section class="admin-section">
    <div class="container-fluid px-4 px-md-5">

        <!-- Header -->
        <div class="admin-header mb-5">
            <div>
                <p class="travora-subtitle mb-2">ADMIN CONTROL</p>
                <h1 class="font-syne fw-bold display-4 mb-2">Dashboard</h1>
                <p class="text-white-50 mb-0">Welcome back, {{ Auth::user()->name }}!</p>
            </div>
            <div class="admin-header-actions">
                <a href="{{ route('admin.ai.chats') }}" class="btn travora-btn-outline">
                    <i class="fas fa-comments me-2"></i> AI Chats
                </a>
                <a href="{{ route('admin.users') }}" class="btn travora-btn-outline">
                    <i class="fas fa-users me-2"></i> Users
                </a>
                <a href="{{ route('admin.bookings') }}" class="btn travora-btn-primary magnetic-btn">
                    <i class="fas fa-suitcase me-2"></i> Bookings
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card glass-card rounded-4 p-4">
                    <div class="stat-icon-wrap" style="background: rgba(64, 224, 208, 0.15); color: #40E0D0;">
                        <i class="fas fa-users"></i>
                    </div>
                    <p class="stat-label">Total Users</p>
                    <h3 class="stat-value">{{ $stats['total_users'] }}</h3>
                    <p class="stat-change">
                        <i class="fas fa-arrow-up"></i> {{ $stats['today_users'] }} today
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stat-card glass-card rounded-4 p-4">
                    <div class="stat-icon-wrap" style="background: rgba(255, 71, 87, 0.15); color: #ff4757;">
                        <i class="fas fa-suitcase"></i>
                    </div>
                    <p class="stat-label">Total Bookings</p>
                    <h3 class="stat-value">{{ $stats['total_bookings'] }}</h3>
                    <p class="stat-change">{{ $stats['pending_bookings'] }} pending</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stat-card glass-card rounded-4 p-4">
                    <div class="stat-icon-wrap" style="background: rgba(255, 215, 0, 0.15); color: #FFD700;">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <p class="stat-label">Total Revenue</p>
                    <h3 class="stat-value">${{ number_format($stats['total_revenue'], 0) }}</h3>
                    <p class="stat-change">All time</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stat-card glass-card rounded-4 p-4">
                    <div class="stat-icon-wrap" style="background: rgba(64, 224, 208, 0.15); color: #40E0D0;">
                        <i class="fas fa-comments"></i>
                    </div>
                    <p class="stat-label">AI Chats</p>
                    <h3 class="stat-value">{{ $stats['total_ai_chats'] }}</h3>
                    <p class="stat-change">total messages</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Chart -->
            <div class="col-lg-8">
                <div class="glass-card rounded-4 p-4 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="font-syne fw-bold h5 mb-0">Bookings — Last 7 Days</h4>
                        <span class="badge-soft small">Live</span>
                    </div>
                    <div class="chart-bars">
                        @php $maxCount = max(array_column($chartData, 'count')) ?: 1; @endphp
                        @foreach($chartData as $day)
                            <div class="chart-bar-wrap">
                                <div class="chart-bar" style="height: {{ ($day['count'] / $maxCount) * 100 }}%">
                                    <span class="chart-bar-value">{{ $day['count'] }}</span>
                                </div>
                                <p class="chart-bar-label">{{ $day['date'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Recent Users -->
            <div class="col-lg-4">
                <div class="glass-card rounded-4 p-4 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="font-syne fw-bold h5 mb-0">Recent Users</h4>
                        <a href="{{ route('admin.users') }}" class="text-accent small text-decoration-none">View all</a>
                    </div>
                    @foreach($recentUsers as $user)
                        <div class="admin-list-item">
                            <div class="user-avatar-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                            <div class="flex-grow-1">
                                <p class="mb-0 small fw-semibold">{{ $user->name }}</p>
                                <p class="mb-0 small text-white-50">{{ $user->email }}</p>
                            </div>
                            <span class="small text-white-50">{{ $user->created_at->diffForHumans() }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Recent Bookings + AI Chats -->
        <div class="row g-4 mt-4">
            <div class="col-lg-6">
                <div class="glass-card rounded-4 p-4 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="font-syne fw-bold h5 mb-0">Recent Bookings</h4>
                        <a href="{{ route('admin.bookings') }}" class="text-accent small text-decoration-none">View all</a>
                    </div>
                    @forelse($recentBookings as $booking)
                        <div class="admin-list-item">
                            <div class="stat-icon-wrap" style="width: 36px; height: 36px; font-size: 0.85rem;">
                                <i class="fas fa-plane"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 small fw-semibold">{{ $booking->destination_name }}</p>
                                <p class="mb-0 small text-white-50">{{ $booking->full_name }} • {{ $booking->reference }}</p>
                            </div>
                            <span class="small text-accent fw-bold">${{ number_format($booking->total_price, 0) }}</span>
                        </div>
                    @empty
                        <p class="text-white-50 small mb-0">No bookings yet.</p>
                    @endforelse
                </div>
            </div>

            <!-- Recent AI Chats (NEW) -->
            <div class="col-lg-6">
                <div class="glass-card rounded-4 p-4 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="font-syne fw-bold h5 mb-0">Recent AI Chats</h4>
                        <a href="{{ route('admin.ai.chats') }}" class="text-accent small text-decoration-none">View all</a>
                    </div>
                    @forelse($recentAiChats as $chat)
                        <div class="admin-list-item">
                            <div class="user-avatar-sm">
                                {{ strtoupper(substr($chat->user?->name ?? 'G', 0, 1)) }}
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 small fw-semibold">{{ Str::limit($chat->user_message, 50) }}</p>
                                <p class="mb-0 small text-white-50">
                                    {{ $chat->user?->name ?? 'Guest' }} • {{ $chat->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <span class="badge-soft small">{{ $chat->intent ?? 'general' }}</span>
                        </div>
                    @empty
                        <p class="text-white-50 small mb-0">No AI chats yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="row g-4 mt-4">
            <div class="col-12">
                <div class="glass-card rounded-4 p-4">
                    <h4 class="font-syne fw-bold h5 mb-4">Recent Activity</h4>
                    <div class="activity-feed">
                        @forelse($recentActivities as $activity)
                            <div class="activity-item">
                                <div class="activity-dot"></div>
                                <div class="flex-grow-1">
                                    <p class="mb-0 small">
                                        <strong>{{ $activity->user?->name ?? 'Guest' }}</strong>
                                        <span class="text-white-50">{{ $activity->details }}</span>
                                    </p>
                                    <p class="mb-0 small text-white-50" style="font-size: 0.75rem;">
                                        {{ $activity->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="text-white-50 small mb-0">No activity yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection