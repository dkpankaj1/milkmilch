<x-app-layout>

    <!-- Row start -->
    <div class="row">
        <div class="col-xl-12">
            <!-- Card start -->
            <div class="card">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.profile.update') }}">
                        @method('PUT')
                        @csrf
                        <!-- Row start -->
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="d-flex flex-row">
                                            <img src="{{auth()->user()->getFirstMediaUrl('avatar')}}"
                                                class="img-fluid change-img-avatar" alt="Image" id="avatar-preview"
                                                onclick="$('#avatar').click()" style="cursor: pointer">
                                            <input type="file" name="avatar" id="avatar" class="d-none">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="fullName" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="fullName"
                                                placeholder="Full Name" name="name" value="{{ old('name', $user->name) }}">
                                                @error('name')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="emailID" class="form-label">Email ID</label>
                                            <input type="email" class="form-control" id="emailID"
                                                placeholder="reese@meail.com" name="email" value="{{ old('email', $user->email) }}">
                                                @error('email')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="phoneNo" class="form-label">Phone</label>
                                            <input type="number" class="form-control" id="phoneNo"
                                                placeholder="123-456-7890" name="phone" value="{{ old('phone', $user->phone) }}">
                                                @error('phone')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address"
                                                placeholder="Address" name="address" value="{{ old('address', $user->address) }}">
                                                @error('address')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" name="city" class="form-control" id="city" placeholder="City"
                                                value="{{ old('city', $user->city) }}">
                                                @error('city')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="state" class="form-label">State</label>
                                            <input type="text" class="form-control" id="state"
                                                placeholder="State" name="state" value="{{ old('state', $user->state) }}">
                                                @error('state')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="zipCode" class="form-label">Zip Code</label>
                                            <input type="text" class="form-control" id="zipCode"
                                                placeholder="Zip Code"
                                                name="postal_code"
                                                value="{{ old('postal_code', $user->postal_code) }}">
                                                @error('postal_code')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-sm-6 col-12">
                                        <!-- Form Field Start -->
                                        <div class="mb-3">
                                            <label for="country" class="form-label">Country</label>
                                            <input type="text" class="form-control" id="country"
                                                placeholder="Country" name="country" value="{{ old('country', $user->country) }}">
                                                @error('country')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-12">
                            <hr>
                            <button class="btn btn-info">Save Settings</button>
                        </div>
                    </form>
                </div>
                <!-- Row end -->


            </div>
        </div>
        <!-- Card end -->
    </div>
    </div>
    <!-- Row end -->

    @push('scripts')
        <script>
            document.getElementById('avatar').addEventListener('change', function(e) {
                var input = e.target;
                var reader = new FileReader();

                reader.onload = function() {
                    var imagePreview = document.getElementById('avatar-preview');
                    imagePreview.src = reader.result;
                };

                reader.readAsDataURL(input.files[0]);
            });
        </script>
    @endpush

</x-app-layout>
