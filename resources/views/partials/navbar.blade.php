@php
    $favoriteCount = count(session()->get('favorites', []));
@endphp

<nav class="navbar navbar-expand-lg fixed-top travora-navbar" id="mainNavbar">
    <div class="container-fluid px-4 px-md-5">
        <a class="navbar-brand travora-logo" href="{{ route('home') }}">TRAVORA</a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <i class="fas fa-bars text-white"></i>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navMenu">
            <ul class="navbar-nav align-items-lg-center gap-lg-4 me-lg-4 mb-3 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link travora-link {{ request()->routeIs('explore') ? 'active-link' : '' }}" 
                       href="{{ route('explore') }}">Explore</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link travora-link {{ request()->routeIs('planner') ? 'active-link' : '' }}" 
                       href="{{ route('planner') }}">Planner</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link travora-link {{ request()->routeIs('guides') ? 'active-link' : '' }}" 
                       href="{{ route('guides') }}">Guides</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link travora-link ai-planner-link {{ request()->routeIs('ai.assistant') ? 'active-link' : '' }}" 
                       href="{{ route('ai.assistant') }}">
                        <i class="fas fa-wand-magic-sparkles"></i> AI Assistant
                        <span class="ai-badge">NEW</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link travora-link favorites-link {{ request()->routeIs('favorites.index') ? 'active-link' : '' }}" 
                       href="{{ route('favorites.index') }}">
                        <i class="fas fa-heart me-1"></i> Favorites
                        <span class="favorites-count {{ $favoriteCount > 0 ? '' : 'd-none' }}" id="navFavCount">{{ $favoriteCount }}</span>
                    </a>
                </li>
            </ul>

            @auth
                {{-- Logged in: User Dropdown --}}
                <div class="dropdown">
                    <button class="btn user-menu-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <div class="user-avatar-circle">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        @if(Auth::user()->isAdmin())
                            <span class="admin-badge">ADMIN</span>
                        @endif
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end user-dropdown">
                        @if(Auth::user()->isAdmin())
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.users') }}">
                                    <i class="fas fa-users me-2"></i> Users
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.bookings') }}">
                                    <i class="fas fa-suitcase me-2"></i> Bookings
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.ai.chats') }}">
                                    <i class="fas fa-comments me-2"></i> AI Chats
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                        @endif
                        <li>
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user me-2"></i> My Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('favorites.index') }}">
                                <i class="fas fa-heart me-2"></i> My Favorites
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                {{-- Guest: Only Login button --}}
                <a href="{{ route('login') }}" class="btn nav-login-btn">Login</a>
            @endauth
        </div>
    </div>
</nav>