<a href="{{ route('category.show', $category['name']) }}" class="category-card d-block position-relative rounded-4 overflow-hidden text-decoration-none">
    <img src="{{ $category['image'] }}" 
         alt="{{ $category['name'] }}" 
         class="category-image w-100 h-100 object-fit-cover">
    
    <div class="category-overlay"></div>
    
    <div class="category-content position-absolute bottom-0 start-0 p-4 w-100">
        <div class="d-flex align-items-center gap-3 mb-2">
            <div class="category-icon">
                <i class="fas {{ $category['icon'] }}"></i>
            </div>
            <div>
                <h4 class="font-syne fw-bold mb-0 text-white">{{ $category['name'] }}</h4>
                <p class="category-count mb-0">{{ $category['count'] }}</p>
            </div>
        </div>
    </div>

    <div class="category-arrow">
        <i class="fas fa-arrow-up-right-from-square"></i>
    </div>
</a>