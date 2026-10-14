<a href="#" class="guide-card-link text-decoration-none">
    <div class="glass-card rounded-4 overflow-hidden guide-card h-100">
        
        <!-- Image -->
        <div class="guide-card-image">
            <img src="{{ $guide['image'] }}" alt="{{ $guide['title'] }}" class="w-100 h-100 object-fit-cover">
            <div class="guide-card-category">{{ $guide['category'] }}</div>
        </div>
        
        <!-- Content -->
        <div class="p-4">
            <div class="d-flex gap-3 mb-2">
                <span class="guide-read-time">
                    <i class="far fa-clock me-1"></i> {{ $guide['read_time'] }}
                </span>
            </div>
            <h3 class="font-syne fw-bold h5 mb-3">{{ $guide['title'] }}</h3>
            <p class="guide-excerpt mb-4">{{ Str::limit($guide['excerpt'], 100) }}</p>
            
            <div class="d-flex align-items-center gap-3 pt-3 border-top border-secondary">
                <img src="{{ $guide['author_avatar'] }}" class="guide-author-avatar rounded-circle" alt="{{ $guide['author'] }}">
                <div class="flex-grow-1">
                    <p class="mb-0 fw-semibold small">{{ $guide['author'] }}</p>
                    <p class="guide-date mb-0">{{ $guide['date'] }}</p>
                </div>
                <i class="fas fa-arrow-right guide-arrow"></i>
            </div>
        </div>

    </div>
</a>