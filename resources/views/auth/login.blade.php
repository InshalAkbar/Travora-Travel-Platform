@extends('layouts.app')

@section('title', 'Login — Travora')

@section('content')

<section class="auth-section">
    <div class="auth-bg">
        <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?q=80&w=2000&auto=format&fit=crop" alt="Login">
        <div class="auth-overlay"></div>
    </div>

    <div class="container position-relative" style="z-index: 2;">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-lg-5 col-md-7">
                
                <div class="auth-card glass-card rounded-4 p-4 p-md-5">
                    
                    <div class="text-center mb-4">
                        <a href="{{ route('home') }}" class="auth-logo">TRAVORA</a>
                        <p class="auth-subtitle">Welcome Back</p>
                        <p class="text-white-50 small mb-0">Login to continue your journey</p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger mb-4">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="planner-label">Email Address</label>
                            <div class="auth-input-wrap">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" class="form-control planner-input" 
                                       value="{{ old('email') }}" placeholder="you@example.com" required autofocus>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="planner-label">Password</label>
                            <div class="auth-input-wrap">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" class="form-control planner-input" 
                                       placeholder="Enter your password" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label text-white-50 small" for="remember">Remember me</label>
                            </div>
                            <a href="#" class="text-accent small text-decoration-none">Forgot password?</a>
                        </div>

                        <button type="submit" class="btn travora-btn-primary w-100 magnetic-btn mb-4">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </button>

                        <p class="text-center text-white-50 small mb-0">
                            Don't have an account? 
                            <a href="{{ route('register') }}" class="text-accent text-decoration-none fw-semibold">Register now</a>
                        </p>

                    </form>

                    <!-- Demo User Credentials (sirf user) -->
                    <div class="demo-creds mt-4">
                        <p class="small mb-2 text-white-50"><i class="fas fa-info-circle me-1"></i> Demo Account:</p>
                        <button type="button" class="demo-cred-btn" onclick="fillDemo('user@travora.com', 'user123')">
                            <i class="fas fa-user"></i>
                            <span><strong>User:</strong> user@travora.com / user123</span>
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    function fillDemo(email, password) {
        document.querySelector('input[name="email"]').value = email;
        document.querySelector('input[name="password"]').value = password;
    }
</script>
@endpush