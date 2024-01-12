<x-app-layout>
    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.currencies.edit',$currency) }}
    @endpush
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Currency</div>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.currencies.update',$currency) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <div class="row">
                            <div class="col-12">
                                <div class="card-border">
                                    <div class="card-border-title">General Information</div>
                                    <div class="card-border-body">

                                        <div class="row">
                                            <div class="col-sm-6 col-12">

                                                <div class="row">

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Name <span
                                                                    class="text-red">*</span></label>
                                                            <input type="text" name="name" value="{{ old('name',$currency->name) }}" class="form-control"placeholder="Enter Currency Name">
                                                            @error('name')
                                                                <div class="invalid-feedback d-block">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Code <span
                                                                    class="text-red">*</span></label>
                                                            <input type="text" name="code" value="{{ old('code',$currency->code) }}" class="form-control"placeholder="Enter Currency Code">
                                                            @error('code')
                                                                <div class="invalid-feedback d-block">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Symbol <span
                                                                    class="text-red">*</span></label>
                                                            <input type="text" name="symbol" value="{{ old('symbol',$currency->symbol) }}" class="form-control"placeholder="Enter Currency Symbol">
                                                            @error('symbol')
                                                                <div class="invalid-feedback d-block">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-0">
                                                            <label class="form-label">Description <span
                                                                    class="text-red">*</span></label>
                                                            <textarea rows="4" class="form-control" name="description" placeholder="Enter Description">{{ old('description',$currency->description) }}</textarea>
                                                            @error('description')
                                                                <div class="invalid-feedback d-block">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-12">
                                                        <hr>
                                                        <button class="btn btn-info">Update Currency</button>
                                                    </div>

                                                </div>
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
