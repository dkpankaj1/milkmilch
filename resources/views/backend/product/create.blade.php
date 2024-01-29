<x-app-layout>
    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.products.create') }}
    @endpush
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add Product</div>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-border">
                            <div class="card-border-title">Product Information</div>
                            <div class="card-border-body">
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="row">

                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Code <span class="text-red">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-upc-scan"></i>
                                                        </span>
                                                        <input type="text" name="code" value="{{ old('code') }}" class="form-control"placeholder="Enter Product Code">
                                                    </div>
                                                    @error('code')
                                                        <div class="invalid-feedback d-block">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Categorie <span
                                                            class="text-red">*</span></label>
                                                    <select class="form-select" name="categorie_id">
                                                        <option value="">-- select --</option>
                                                        @foreach ($categories as $categorie)
                                                            <option value="{{ $categorie->id }}">{{ $categorie->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('categorie_id')
                                                        <div class="invalid-feedback d-block">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Name <span
                                                            class="text-red">*</span></label>
                                                    <input type="text" name="name" value="{{ old('name') }}"
                                                        class="form-control"placeholder="Enter Name">
                                                    @error('name')
                                                        <div class="invalid-feedback d-block">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Shelf Lift (Day) <span
                                                            class="text-red">*</span></label>
                                                    <input type="number" name="shelf_life"
                                                        value="{{ old('shelf_life') }}"
                                                        class="form-control"placeholder="Enter Shelf Life">
                                                    @error('shelf_life')
                                                        <div class="invalid-feedback d-block">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Volume (mililiter) <span
                                                            class="text-red">*</span></label>
                                                    <input type="number" name="volume" value="{{ old('volume') }}"
                                                        min="0" value="0" step="any"
                                                        class="form-control"placeholder="Enter Volume In MiliLiter">
                                                    @error('volume')
                                                        <div class="invalid-feedback d-block">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">MRP
                                                        ({{ $companyState->currency->symbol }}) <span
                                                            class="text-red">*</span></label>
                                                    <input type="number" name="mrp" value="{{ old('mrp') }}"
                                                        min="0" value="0" step="any"
                                                        class="form-control"placeholder="Enter MRP">
                                                    @error('mrp')
                                                        <div class="invalid-feedback d-block">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Description <span
                                                            class="text-red">*</span></label>
                                                    <textarea rows="4" class="form-control" name="description" placeholder="Enter Description">{{ old('description') }}</textarea>
                                                    @error('description')
                                                        <div class="invalid-feedback d-block">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Status <span
                                                            class="text-red">*</span></label>
                                                    <select class="form-select" name="status">
                                                        <option value="">-- select --</option>
                                                        <option value="1">Active</option>
                                                        <option value="0">In-Active</option>
                                                    </select>
                                                    @error('status')
                                                        <div class="invalid-feedback d-block">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="row">

                                            <div class="col-12 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Product Image <span
                                                            class="text-red">*</span></label>

                                                    <img src="{{ old('product_image', 'https://placehold.co/200x200') }}"
                                                        style="height: 200px"
                                                        class="img-fluid change-img-avatar border p-1" alt="Image"
                                                        id="product-preview">

                                                    <input type="file" name="product_image" class="form-control"
                                                        id="product-input">

                                                    @error('product_image')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-12">
                                        <hr>
                                        <button class="btn btn-info px-5">Save</button>
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
            document.getElementById('product-input').addEventListener('change', function(e) {
                var input = e.target;
                var reader = new FileReader();

                reader.onload = function() {
                    var imagePreview = document.getElementById('product-preview');
                    imagePreview.src = reader.result;
                };

                reader.readAsDataURL(input.files[0]);
            });
        </script>
    @endpush
</x-app-layout>
