<x-app-layout>
    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.categories.edit',$categorie) }}
    @endpush
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Categorie</div>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.categories.update',$categorie) }}" method="POST">
                        @csrf
                        @method('PUT')
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
                                                            <input type="text" name="name"
                                                                value="{{ old('name',$categorie->name) }}"
                                                                class="form-control"placeholder="Enter Name">
                                                            @error('name')
                                                                <div class="invalid-feedback d-block">{{ $message }}
                                                                </div>
                                                            @enderror
                                                            @error('slug')
                                                                <div class="invalid-feedback d-block">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-0">
                                                            <label class="form-label">Description <span
                                                                    class="text-red">*</span></label>
                                                            <textarea rows="4" class="form-control" name="description" placeholder="Enter Description">{{ old('description',$categorie->description) }}</textarea>
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
                                                                <option value="1" @if($categorie->status == 1) selected @endif>Active</option>
                                                                <option value="0" @if($categorie->status == 0) selected @endif>In-Active</option>
                                                            </select>
                                                            @error('status')
                                                                <div class="invalid-feedback d-block">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-12 col-12">
                                                        <hr>
                                                        <button class="btn btn-info">Update Categorie</button>
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
