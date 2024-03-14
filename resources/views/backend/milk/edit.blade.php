<x-app-layout>
    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.milks.edit',$milk) }}
    @endpush
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Milk</div>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.milks.update',$milk) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <div class="card-border">
                                    <div class="card-border-title">General Information</div>
                                    <div class="card-border-body">
                                        <div class="row">

                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Name <span
                                                            class="text-red">*</span></label>
                                                    <input type="text" name="name" value="{{ old('name',$milk->name) }}"
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
                                                    <input type="number" name="shelf_life" value="{{ old('shelf_life',$milk->shelf_life) }}"
                                                        class="form-control"placeholder="Enter Name">
                                                    @error('shelf_life')
                                                        <div class="invalid-feedback d-block">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Fat Content (%) <span
                                                            class="text-red">*</span></label>
                                                    <input type="number" name="fat_content" value="{{ old('fat_content',$milk->fat_content) }}" min="0" value="0" step="any"
                                                        class="form-control"placeholder="Fat Content 10.5">
                                                    @error('fat_content')
                                                        <div class="invalid-feedback d-block">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Volume (Liter) <span
                                                            class="text-red">*</span></label>
                                                    <input type="number" name="volume" value="{{ old('volume',$milk->volume) }}" min="0" value="0" step="any"
                                                        class="form-control"placeholder="Enter Volume In Liter">
                                                    @error('volume')
                                                        <div class="invalid-feedback d-block">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">MRP ({{$companyState->currency->symbol}}) <span
                                                            class="text-red">*</span></label>
                                                    <input type="number" name="mrp" value="{{ old('mrp',$milk->mrp) }}" min="0" value="0" step="any"
                                                        class="form-control"placeholder="Enter MRP">
                                                    @error('mrp')
                                                        <div class="invalid-feedback d-block">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            

                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">MOP ({{$companyState->currency->symbol}}) <span
                                                            class="text-red">*</span></label>
                                                    <input type="number" name="mop" value="{{ old('mop',$milk->mop) }}" min="0" value="0" step="any"
                                                        class="form-control"placeholder="Enter MOP">
                                                    @error('mop')
                                                        <div class="invalid-feedback d-block">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            

                                            <div class="col-12">
                                                <div class="mb-0">
                                                    <label class="form-label">Description <span
                                                            class="text-red">*</span></label>
                                                    <textarea rows="4" class="form-control" name="description" placeholder="Enter Description">{{ old('description',$milk->description) }}</textarea>
                                                    @error('description')
                                                        <div class="invalid-feedback d-block">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class=" col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Status <span
                                                            class="text-red">*</span></label>
                                                    <select class="form-select" name="status">
                                                        <option value="">-- select --</option>
                                                        <option value="1" @if($milk->status == 1) selected @endif>Active</option>
                                                        <option value="0" @if($milk->status == 0) selected @endif>In-Active</option>
                                                    </select>
                                                    @error('status')
                                                        <div class="invalid-feedback d-block">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-sm-12 col-12">
                                                <hr>
                                                <button class="btn btn-info px-5">Update</button>
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
