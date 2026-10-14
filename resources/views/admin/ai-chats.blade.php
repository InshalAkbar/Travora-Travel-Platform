@extends('layouts.app')

@section('title', 'AI Chats — Admin')

@section('content')

<section class="admin-section">
    <div class="container-fluid px-4 px-md-5">

        <div class="admin-header mb-5">
            <div>
                <p class="travora-subtitle mb-2">ADMIN CONTROL</p>
                <h1 class="font-syne fw-bold display-4 mb-2">AI Conversations</h1>
                <p class="text-white-50 mb-0">All user conversations with Travora AI</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn travora-btn-outline">
                <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
            </a>
        </div>

        <div class="glass-card rounded-4 p-4">
            @if($conversations->count() > 0)
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Message</th>
                                <th>AI Response</th>
                                <th>Intent</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($conversations as $conv)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="user-avatar-sm">
                                                {{ strtoupper(substr($conv->user?->name ?? 'G', 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="mb-0 small fw-semibold">{{ $conv->user?->name ?? 'Guest' }}</p>
                                                <p class="mb-0 small text-white-50">{{ $conv->user?->email ?? '—' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="small" style="max-width: 250px;">
                                        {{ Str::limit($conv->user_message, 80) }}
                                    </td>
                                    <td class="small text-white-50" style="max-width: 350px;">
                                        {{ Str::limit(strip_tags($conv->ai_response), 100) }}
                                    </td>
                                    <td>
                                        <span class="badge-soft">{{ $conv->intent ?? 'general' }}</span>
                                    </td>
                                    <td class="small text-white-50">
                                        {{ $conv->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $conversations->links() }}
                </div>
            @else
                <p class="text-white-50 text-center mb-0 py-5">
                    <i class="fas fa-comments fa-2x mb-3 d-block" style="opacity: 0.3;"></i>
                    No AI conversations yet.
                </p>
            @endif
        </div>

    </div>
</section>

@endsection