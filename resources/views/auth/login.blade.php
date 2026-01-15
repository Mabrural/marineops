@extends('auth.layouts.main')

@section('container')
    <div class="login-page">
        <div class="login-card">
            @include('auth.layouts.logo')
            <p class="login-subtitle">Please log in to access the MarineOps system</p>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Input -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-icon">
                        <span class="input-icon-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                    </div>
                    @error('email')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-icon">
                        <span class="input-icon-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" required placeholder="Enter your password">
                    </div>
                    @error('password')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="form-group d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                        <label class="form-check-label" for="remember_me">Remember me</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-primary">Forgot password?</a>
                </div>

                <!-- Login Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-login">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
