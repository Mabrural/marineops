@extends('auth.layouts.main')

@section('container')

<div class="login-page">
        <div class="login-card">
            @include('auth.layouts.logo')

            <p class="login-subtitle">
                Forgot your password? No worries.<br>
                Enter your email address and we’ll send you a link to reset your password.
            </p>

            <!-- Status Message -->
            @if (session('status'))
                <div class="alert alert-success text-sm mb-3">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Forgot Password Form -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Input -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-icon">
                        <span class="input-icon-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autofocus
                               placeholder="Enter your email">
                    </div>
                    @error('email')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary btn-reset">
                        Send Password Reset Link
                    </button>
                </div>
            </form>

        </div>
    </div>

@endsection