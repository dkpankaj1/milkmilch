<x-guest-layout>
    <!-- Login box start -->
    {{-- @php
        print_r(Session::all());
    @endphp --}}

    <form method="POST">
        @csrf
        <div class="login-box">
            <div class="login-form">
                <a href="" class="login-logo">
                    <img src="assets/images/logo.svg" alt="Vico Admin" />
                </a>
                <div class="login-welcome">
                    Welcome back, <br />Please login to your account.
                </div>

                
                @if (Session::has('success'))
                    <x-alert class="alert-success">
                        {{ session('success') }}
                    </x-alert>
                @endif

                @if (Session::has('error'))
                    <x-alert class="alert-danger">
                        {{ session('error') }}
                    </x-alert>
                @endif

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <label class="form-label">Password</label>
                        <a href="{{ route('password.request') }}" class="btn-link ml-auto">Forgot password?</a>
                    </div>
                    <input type="password" class="form-control" name="password">
                    @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="login-form-actions">
                    <button type="submit" class="btn"> <span class="icon">
                            <i class="bi bi-arrow-right-circle"></i> </span>
                        Login</button>
                </div>
            </div>
        </div>
    </form>
    <!-- Login box end -->
</x-guest-layout>
