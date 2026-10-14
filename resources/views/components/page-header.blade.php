<section class="page-header position-relative overflow-hidden">
    <div class="page-header-bg">
        <img src="{{ $bgImage ?? 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?q=80&w=2000&auto=format&fit=crop' }}" 
             alt="{{ $title }}" class="w-100 h-100 object-fit-cover">
        <div class="page-header-overlay"></div>
    </div>

    <div class="container-fluid px-4 px-md-5 position-relative" style="z-index: 2;">
        <div class="page-header-content">
            <p class="travora-subtitle mb-3">{{ $subtitle }}</p>
            <h1 class="font-syne fw-bold display-3 mb-3">{{ $title }}</h1>
            @if(isset($description))
                <p class="page-header-desc">{{ $description }}</p>
            @endif
        </div>
    </div>
</section>