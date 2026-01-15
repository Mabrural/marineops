@extends('auth.layouts.main')

@section('container')
    <div class="login-page">
        <div class="login-card">
            @include('auth.layouts.logo')
            <p class="login-subtitle">Please enter your new password below.</p>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Hidden Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-icon">
                        <span class="input-icon-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email', $request->email) }}" required autofocus
                            autocomplete="username" placeholder="Enter your email">
                    </div>
                    @error('email')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="form-group mt-4">
                    <label for="password">New Password</label>
                    <div class="input-icon">
                        <span class="input-icon-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" required autocomplete="new-password" placeholder="Enter new password">
                    </div>
                    @error('password')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group mt-4">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="input-icon">
                        <span class="input-icon-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                            placeholder="Confirm new password">
                    </div>
                    @error('password_confirmation')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary btn-reset">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
@endsection
