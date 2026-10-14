<div class="glass-card p-4 rounded-4 h-100 testimonial-card">
    
    <!-- Stars -->
    <div class="mb-3 text-accent">
        @for($i = 0; $i < $testimonial['rating']; $i++)
            <i class="fas fa-star"></i>
        @endfor
    </div>
    
    <!-- Quote -->
    <p class="testimonial-text mb-4">
        "{{ $testimonial['text'] }}"
    </p>
    
    <!-- Author -->
    <div class="d-flex align-items-center gap-3">
        <img src="{{ $testimonial['avatar'] }}" 
             alt="{{ $testimonial['name'] }}" 
             class="testimonial-avatar rounded-circle">
        <div>
            <h6 class="fw-bold mb-0 text-white">{{ $testimonial['name'] }}</h6>
            <p class="testimonial-location mb-0">{{ $testimonial['location'] }}</p>
        </div>
    </div>
    
</div>