@extends('layouts.app')

@section('title', 'Bookings — Admin')

@section('content')

<section class="admin-section">
    <div class="container-fluid px-4 px-md-5">

        <div class="admin-header mb-5">
            <div>
                <p class="travora-subtitle mb-2">ADMIN CONTROL</p>
                <h1 class="font-syne fw-bold display-4 mb-2">Bookings</h1>
                <p class="text-white-50 mb-0">All bookings made on Travora — manage status below</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn travora-btn-outline">
                <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

        <!-- Filter Chips -->
        <div class="d-flex flex-wrap gap-2 mb-4" id="bookingStatusFilter">
            <button class="filter-chip active" data-status="all">All</button>
            <button class="filter-chip" data-status="pending">Pending</button>
            <button class="filter-chip" data-status="confirmed">Confirmed</button>
            <button class="filter-chip" data-status="cancelled">Cancelled</button>
        </div>

        <div class="glass-card rounded-4 p-4">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Destination</th>
                            <th>Customer</th>
                            <th>Travel Date</th>
                            <th>Travelers</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                            <tr data-booking-status="{{ $booking->status }}" data-booking-id="{{ $booking->id }}">
                                <td>
                                    <span class="text-accent fw-bold small">{{ $booking->reference }}</span>
                                </td>
                                <td>
                                    <p class="mb-0 fw-semibold">{{ $booking->destination_name }}</p>
                                    <p class="mb-0 small text-white-50">{{ $booking->destination_country }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 small">{{ $booking->full_name }}</p>
                                    <p class="mb-0 small text-white-50">{{ $booking->email }}</p>
                                </td>
                                <td class="small">{{ $booking->travel_date->format('M d, Y') }}</td>
                                <td class="small text-center">{{ $booking->travelers }}</td>
                                <td class="text-accent fw-bold">${{ number_format($booking->total_price, 0) }}</td>
                                <td>
                                    <span class="status-badge status-{{ $booking->status }}" data-status-badge>
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn status-dropdown-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-cog me-1"></i> Change
                                        </button>
                                        <ul class="dropdown-menu status-dropdown-menu">
                                            <li>
                                                <button class="dropdown-item status-action" data-status="pending" data-id="{{ $booking->id }}">
                                                    <i class="fas fa-clock text-warning me-2"></i> Pending
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item status-action" data-status="confirmed" data-id="{{ $booking->id }}">
                                                    <i class="fas fa-check-circle text-accent me-2"></i> Confirmed
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item status-action" data-status="cancelled" data-id="{{ $booking->id }}">
                                                    <i class="fas fa-times-circle text-danger me-2"></i> Cancelled
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-white-50 py-4">No bookings yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $bookings->links() }}
            </div>
        </div>

    </div>
</section>

@endsection

@push('styles')
<style>
/* Status Dropdown Button */
.status-dropdown-btn {
    background: rgba(64, 224, 208, 0.08);
    border: 1px solid rgba(64, 224, 208, 0.25);
    color: #40E0D0;
    padding: 0.4rem 0.9rem;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 500;
    transition: all 0.3s ease;
}
.status-dropdown-btn:hover {
    background: rgba(64, 224, 208, 0.15);
    border-color: #40E0D0;
    color: #40E0D0;
}
.status-dropdown-btn::after {
    margin-left: 0.4rem;
    vertical-align: middle;
}

/* Status Dropdown Menu */
.status-dropdown-menu {
    background: rgba(7, 19, 24, 0.98);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    padding: 0.4rem;
    min-width: 180px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
}
.status-dropdown-menu .dropdown-item {
    color: rgba(255, 255, 255, 0.85);
    padding: 0.55rem 0.9rem;
    border-radius: 7px;
    font-size: 0.85rem;
    transition: all 0.2s ease;
}
.status-dropdown-menu .dropdown-item:hover {
    background: rgba(64, 224, 208, 0.1);
    color: #ffffff;
}

/* Disable current status */
.status-dropdown-menu .dropdown-item.disabled {
    opacity: 0.35;
    pointer-events: none;
}

/* Row fade-in animation on status change */
@keyframes statusFlash {
    0% { background: rgba(64, 224, 208, 0.25); }
    100% { background: transparent; }
}
.status-flash {
    animation: statusFlash 1.2s ease;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const csrf = document.querySelector('meta[name="csrf-token"]')?.content;

    // ===== STATUS CHANGE =====
    document.querySelectorAll('.status-action').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            const bookingId = this.getAttribute('data-id');
            const newStatus = this.getAttribute('data-status');
            const row = document.querySelector(`tr[data-booking-id="${bookingId}"]`);

            if (!row) return;

            // Disable button while processing
            const dropdownBtn = row.querySelector('.status-dropdown-btn');
            if (dropdownBtn) {
                dropdownBtn.disabled = true;
                dropdownBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> ...';
            }

            fetch(`/admin/bookings/${bookingId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success) throw new Error('Update failed');

                // Update badge
                const badge = row.querySelector('[data-status-badge]');
                if (badge) {
                    badge.classList.remove('status-pending', 'status-confirmed', 'status-cancelled');
                    badge.classList.add('status-' + data.status);
                    badge.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
                }

                // Update row data attribute
                row.setAttribute('data-booking-status', data.status);

                // Flash row
                row.classList.remove('status-flash');
                void row.offsetWidth; // trigger reflow
                row.classList.add('status-flash');

                // Restore button
                if (dropdownBtn) {
                    dropdownBtn.disabled = false;
                    dropdownBtn.innerHTML = '<i class="fas fa-cog me-1"></i> Change';
                }

                // Show toast
                showStatusToast(data.message, data.status);
            })
            .catch(err => {
                console.error('Status update error:', err);
                if (dropdownBtn) {
                    dropdownBtn.disabled = false;
                    dropdownBtn.innerHTML = '<i class="fas fa-cog me-1"></i> Change';
                }
                alert('Failed to update status. Please try again.');
            });
        });
    });

    // ===== TOAST =====
    function showStatusToast(message, status) {
        const existing = document.querySelector('.travora-toast');
        if (existing) existing.remove();

        const iconMap = {
            'pending': 'fa-clock',
            'confirmed': 'fa-check-circle',
            'cancelled': 'fa-times-circle'
        };
        const colorMap = {
            'pending': '#FFD700',
            'confirmed': '#40E0D0',
            'cancelled': '#ff4757'
        };

        const toast = document.createElement('div');
        toast.className = 'travora-toast';
        toast.style.borderColor = colorMap[status] || '#40E0D0';
        toast.innerHTML = `
            <i class="fas ${iconMap[status] || 'fa-info-circle'}" style="color:${colorMap[status] || '#40E0D0'}"></i>
            <span>${message}</span>
        `;
        document.body.appendChild(toast);

        setTimeout(() => toast.classList.add('show'), 50);
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 400);
        }, 2500);
    }

    // ===== FILTER CHIPS =====
    const filterChips = document.querySelectorAll('#bookingStatusFilter .filter-chip');
    filterChips.forEach(chip => {
        chip.addEventListener('click', function () {
            filterChips.forEach(c => c.classList.remove('active'));
            this.classList.add('active');

            const status = this.getAttribute('data-status');
            document.querySelectorAll('tr[data-booking-status]').forEach(row => {
                if (status === 'all' || row.getAttribute('data-booking-status') === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

});
</script>
@endpush