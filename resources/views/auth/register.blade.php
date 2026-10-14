@extends('layouts.app')

@section('title', 'Register — Travora')

@section('content')

<section class="auth-section">
    <div class="auth-bg">
        <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?q=80&w=2000&auto=format&fit=crop" alt="Register">
        <div class="auth-overlay"></div>
    </div>

    <div class="container position-relative" style="z-index: 2;">
        <div class="row justify-content-center align-items-center min-vh-100 py-5">
            <div class="col-lg-5 col-md-7">
                
                <div class="auth-card glass-card rounded-4 p-4 p-md-5">
                    
                    <div class="text-center mb-4">
                        <a href="{{ route('home') }}" class="auth-logo">TRAVORA</a>
                        <p class="auth-subtitle">Create Account</p>
                        <p class="text-white-50 small mb-0">Start your journey today</p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="planner-label">Full Name</label>
                            <div class="auth-input-wrap">
                                <i class="fas fa-user"></i>
                                <input type="text" name="name" class="form-control planner-input" 
                                       value="{{ old('name') }}" placeholder="John Doe" required autofocus>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="planner-label">Email Address</label>
                            <div class="auth-input-wrap">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" class="form-control planner-input" 
                                       value="{{ old('email') }}" placeholder="you@example.com" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="planner-label">Country</label>
                            <div class="auth-input-wrap">
                                <i class="fas fa-globe"></i>
                                <input type="text" name="country" class="form-control planner-input" 
                                       value="{{ old('country') }}" placeholder="Pakistan">
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="planner-label">Password</label>
                                <div class="auth-input-wrap">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" name="password" class="form-control planner-input" 
                                           placeholder="Min 6 characters" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="planner-label">Confirm</label>
                                <div class="auth-input-wrap">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" name="password_confirmation" class="form-control planner-input" 
                                           placeholder="Re-enter" required>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn travora-btn-primary w-100 magnetic-btn mb-4">
                            <i class="fas fa-user-plus me-2"></i> Create Account
                        </button>

                        <p class="text-center text-white-50 small mb-0">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="text-accent text-decoration-none fw-semibold">Login</a>
                        </p>

                    </form>

                </div>

            </div>
        </div>
    </div>
</section>

@endsection