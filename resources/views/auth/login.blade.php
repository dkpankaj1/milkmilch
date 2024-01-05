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
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control">
                    @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <label class="form-label">Password</label>
                        <a href="{{ route('password.request') }}" class="btn-link ml-auto">Forgot password?</a>
                    </div>
                    <input type="password" class="form-control">
                    @error('email')
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
