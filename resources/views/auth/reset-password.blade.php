<x-guest-layout>
    <!-- Login box start -->
    {{-- @php
        print_r(Session::all());
    @endphp --}}

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <div class="login-box">
            <div class="login-form">
                <a href="" class="login-logo">
                    <img src="{{asset('assets/images/logo.svg')}}" alt="Vico Admin" />
                </a>
                <div class="login-welcome">
                    Password reset.
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
                    <input type="text" class="form-control" name="email" value="{{ old('email',$request->email) }}">
                    @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Opt</label>
                    <input type="number" class="form-control" name="otp">
                    @error('otp')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" >
                    @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation">
                    @error('password_confirmation')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="login-form-actions">
                    <button type="submit" class="btn"> <span class="icon">
                            <i class="bi bi-arrow-right-circle"></i> </span>
                            Reset Password
                    </button>
                </div>
            </div>
        </div>
    </form>
    <!-- Login box end -->
</x-guest-layout>
