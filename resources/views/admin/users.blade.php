@extends('layouts.app')

@section('title', 'Users — Admin')

@section('content')

<section class="admin-section">
    <div class="container-fluid px-4 px-md-5">

        <div class="admin-header mb-5">
            <div>
                <p class="travora-subtitle mb-2">ADMIN CONTROL</p>
                <h1 class="font-syne fw-bold display-4 mb-2">Users</h1>
                <p class="text-white-50 mb-0">All registered users on Travora</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn travora-btn-outline">
                <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
            </a>
        </div>

        <div class="glass-card rounded-4 p-4">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>Bookings</th>
                            <th>Last Login</th>
                            <th>Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="user-avatar-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                        <span class="fw-semibold">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="text-white-50">{{ $user->email }}</td>
                                <td>{{ $user->country ?? '—' }}</td>
                                <td><span class="badge-soft">{{ $user->bookings_count }}</span></td>
                                <td class="text-white-50 small">
                                    {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}
                                </td>
                                <td class="text-white-50 small">{{ $user->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-white-50 py-4">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>

    </div>
</section>

@endsection