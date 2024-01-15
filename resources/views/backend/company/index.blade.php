<x-app-layout>
    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.companys.index') }}
    @endpush
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Company Profile</div>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.companys.update', $company) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">
                                <div class="card-border">
                                    <div class="card-border-title">General Information</div>
                                    <div class="card-border-body">

                                        <div class="row">

                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Name <span
                                                            class="text-red">*</span></label>
                                                    <input type="text" name="name"
                                                        value="{{ old('name', $company->name) }}"
                                                        class="form-control"placeholder="Enter Name">
                                                    @error('name')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="card-border">
                                    <div class="card-border-title">Contact Information</div>
                                    <div class="card-border-body">
                                        <div class="row">

                                            <div class="col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Email <span
                                                            class="text-red">*</span></label>
                                                    <input type="email" name="email"
                                                        value="{{ old('email', $company->email) }}"
                                                        class="form-control"placeholder="eample@email.com">
                                                    @error('email')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Phone <span
                                                            class="text-red">*</span></label>
                                                    <input type="text" name="phone"
                                                        value="{{ old('phone', $company->phone) }}"
                                                        class="form-control"placeholder="+91 - 9919xxxx55">
                                                    @error('phone')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Address <span
                                                            class="text-red">*</span></label>
                                                    <input type="text" name="address"
                                                        value="{{ old('address', $company->address) }}"
                                                        class="form-control"placeholder="Enter Address">
                                                    @error('address')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">City <span
                                                            class="text-red">*</span></label>
                                                    <input type="text" name="city"
                                                        value="{{ old('city', $company->city) }}"
                                                        class="form-control"placeholder="Enter City">
                                                    @error('city')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">State <span
                                                            class="text-red">*</span></label>
                                                    <input type="text" name="state"
                                                        value="{{ old('state', $company->state) }}"
                                                        class="form-control"placeholder="Enter State">
                                                    @error('state')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Postal Code <span
                                                            class="text-red">*</span></label>
                                                    <input type="text" name="postal_code"
                                                        value="{{ old('postal_code', $company->postal_code) }}"
                                                        class="form-control"placeholder="Enter Postal Code  ">
                                                    @error('postal_code')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Country <span
                                                            class="text-red">*</span></label>
                                                    <input type="text" name="country"
                                                        value="{{ old('country', $company->country) }}"
                                                        class="form-control"placeholder="Enter country">
                                                    @error('country')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>


                                <div class="card-border">
                                    <div class="card-border-title">Additional Information</div>
                                    <div class="card-border-body">
                                        <div class="row">

                                            <div class="col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">GST Number <span
                                                            class="text-red">*</span></label>
                                                    <input type="text" name="gst_number"
                                                        value="{{ old('gst_number', $company->gst_number) }}"
                                                        class="form-control"placeholder="Enter GST Number">
                                                    @error('gst_number')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">PAN Number <span
                                                            class="text-red">*</span></label>
                                                    <input type="text" name="pan_number"
                                                        value="{{ old('pan_number', $company->pan_number) }}"
                                                        class="form-control"placeholder="Enter PAN Number">
                                                    @error('pan_number')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Websiet <span
                                                            class="text-red">*</span></label>
                                                    <input type="text" name="website"
                                                        value="{{ old('website', $company->website) }}"
                                                        class="form-control"placeholder="Enter Website URL">
                                                    @error('website')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="card-border">
                                    <div class="card-border-title">Payment Information</div>
                                    <div class="card-border-body">
                                        <div class="row">

                                            <div class="col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">UPI ID<span
                                                            class="text-red">*</span></label>
                                                    <input type="text" name="upi"
                                                        value="{{ old('upi', $company->upi) }}"
                                                        class="form-control"placeholder="Enter UPI Id">
                                                    @error('upi')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-100"></div>

                                            <div class="col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">UPI Barcode <span
                                                            class="text-red">*</span></label>

                                                    <img src="{{$company->upi_barcode}}"
                                                    style="height: 100px"
                                                        class="img-fluid change-img-avatar border p-1" alt="Image"
                                                        id="barcode-preview">

                                                    <input type="file" name="upi_barcode" class="form-control" id="barcode-input">

                                                    @error('upi_barcode')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="card-border">
                                    <div class="card-border-title">Logo And Fevicon</div>
                                    <div class="card-border-body">
                                        <div class="row">

                                            <div class="col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Logo <span class="text-red">*</span></label>
                                                    <img src="{{$company->logo}}" style="height: 60px;" class="img-fluid change-img-avatar border p-1" alt="Image" id="logo-preview">
                                                    <input type="file" name="logo" class="form-control"placeholder="Enter PAN Number" id="logo-input">
                                                    @error('logo')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Fevicon <span class="text-red">*</span></label>
                                                    <img style="height: 60px" src="{{$company->fevicon}}" class="img-fluid change-img-avatar border p-1" alt="Image" id="fevicon-preview">
                                                    <input type="file" name="fevicon" class="form-control" id="fevicon-input">
                                                    @error('fevicon')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="card-border">
                                    <div class="card-border-title">Other Information</div>
                                    <div class="card-border-body">
                                        <div class="row">

                                            <div class="col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Default Currency <span
                                                            class="text-red">*</span></label>
                                                    <select class="form-select" name="currencies_id"
                                                        aria-label="Default select example">
                                                        <option value="">-- select --</option>
                                                        @foreach ($currencies as $currency)
                                                            <option
                                                                {{ $company->currencies_id == $currency->id ? 'selected' : '' }}
                                                                value="{{ $currency->id }}">{{ $currency->name }} |
                                                                {{ $currency->symbol }}</option>
                                                        @endforeach

                                                    </select>
                                                    @error('currencies_id')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-12">
                                                <hr>
                                                <button class="btn btn-info">Save Customer</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>


                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('barcode-input').addEventListener('change', function(e) {
            var input = e.target;
            var reader = new FileReader();

            reader.onload = function() {
                var imagePreview = document.getElementById('barcode-preview');
                imagePreview.src = reader.result;
            };

            reader.readAsDataURL(input.files[0]);
        });

        document.getElementById('logo-input').addEventListener('change', function(e) {
            var input = e.target;
            var reader = new FileReader();

            reader.onload = function() {
                var imagePreview = document.getElementById('logo-preview');
                imagePreview.src = reader.result;
            };

            reader.readAsDataURL(input.files[0]);
        });

        document.getElementById('fevicon-input').addEventListener('change', function(e) {
            var input = e.target;
            var reader = new FileReader();

            reader.onload = function() {
                var imagePreview = document.getElementById('fevicon-preview');
                imagePreview.src = reader.result;
            };

            reader.readAsDataURL(input.files[0]);
        });
    </script>
@endpush

</x-app-layout>
