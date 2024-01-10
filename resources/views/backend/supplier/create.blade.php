<x-app-layout>
    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.suppliers.create') }}
    @endpush
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add New Supplier</div>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.suppliers.store') }}" method="POST">
                        @csrf
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
                                                    <input type="text" name="name" value="{{ old('name') }}"
                                                        class="form-control"placeholder="Enter Name">
                                                    @error('name')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Email <span
                                                            class="text-red">*</span></label>
                                                    <input type="email" name="email" value="{{ old('email') }}"
                                                        class="form-control"placeholder="eample@email.com">
                                                    @error('email')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Phone <span
                                                            class="text-red">*</span></label>
                                                    <input type="text" name="phone" value="{{ old('phone') }}"
                                                        class="form-control"placeholder="+91 - 9919xxxx55">
                                                    @error('phone')
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

                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Address <span
                                                            class="text-red">*</span></label>
                                                    <input type="text" name="address" value="{{ old('address') }}"
                                                        class="form-control"placeholder="Enter Address">
                                                    @error('address')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">City <span
                                                            class="text-red">*</span></label>
                                                    <input type="text" name="city" value="{{ old('city') }}"
                                                        class="form-control"placeholder="Enter City">
                                                    @error('city')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">State <span
                                                            class="text-red">*</span></label>
                                                    <input type="text" name="state" value="{{ old('state') }}"
                                                        class="form-control"placeholder="Enter State">
                                                    @error('state')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Postal Code <span
                                                            class="text-red">*</span></label>
                                                    <input type="text" name="postal_code"
                                                        value="{{ old('postal_code') }}"
                                                        class="form-control"placeholder="Enter Postal Code  ">
                                                    @error('postal_code')
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
                                            
                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Status <span
                                                            class="text-red">*</span></label>
                                                    <select class="form-select" name="status"
                                                        aria-label="Default select example">
                                                        <option value="">-- select --</option>
                                                        <option value="1">Active</option>
                                                        <option value="0">In-Active</option>
                                                    </select>
                                                    @error('status')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-12">
                                                <hr>
                                                <button class="btn btn-info">Save User</button>
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
</x-app-layout>
