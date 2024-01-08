<x-guest-layout>
    <!-- Login box start -->
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="login-box">
            <div class="login-form">
                <a href="index.html" class="login-logo">
                    <img src="{{ asset('assets/images/logo.svg') }}" alt="Vico Admin" />
                </a>
                <div class="login-welcome">
                    In order to access your account,<br />please enter the email id you provided during the
                    registration
                    process.
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
                    <input type="email" class="form-control" name="email" placeholder="Enter your email"
                        value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="login-form-actions">
                    <button type="submit" class="btn"> <span class="icon"> <i
                                class="bi bi-arrow-right-circle"></i> </span>
                        Submit</button>
                </div>
            </div>
        </div>
    </form>
    <!-- Login box end -->
</x-guest-layout>
