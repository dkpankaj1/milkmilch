<x-app-layout>
    @push('head')
        <link rel="stylesheet" href="{{ asset('assets/vendor/bs-select/bs-select.css') }}">
        <style>
            .item_search_list {
                max-height: 200px;
                overflow-y: auto;
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .item_search_list li {
                width: 100%;
                padding: 0.5rem;
                margin-bottom: 1px;
                cursor: pointer;
            }

            .item_search_list li:hover {
                color: #fff;
                background-color: #1c6cdc;
            }
        </style>
    @endpush

    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.batches.edit',$batch) }}
    @endpush

    <div class="card">
        <div class="card-header">
            <div class="card-title">Edit Batch</div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.batches.update',$batch) }}" method="POST" onsubmit="return validateForm()"
                id="myForm">
                @csrf
                @method("PUT")

                <div class="card-border">

                    <div class="card-border-body">
                        <div class="row">

                            <div class=" col-sm-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Storage <span class="text-red">*</span></label>
                                    <select class="select-single js-states form-control" data-live-search="true"
                                        name="storage">
                                        <option value="">-- select --</option>
                                        @foreach ($storages as $storage)
                                            <option value="{{ $storage->id }}" @if($storage->id == old('storage',$batch->milk_storage_id)) selected @endif>
                                                MS-{{ $storage->id }}/{{ Illuminate\Support\Carbon::parse($storage->date)->format('Y-m-d') }}/{{ $storage->milk->name }}/AVL Volume : {{ $storage->avl_volume }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('storage')
                                        <div class="invalid-feedback d-block">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class=" col-sm-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Volume Used (ml) <span class="text-red">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-rulers"></i>
                                        </span>
                                        <input type="number" class="form-control" name="volume" value="{{old('volume',$batch->volume)}}">
                                    </div>

                                    @error('volume')
                                        <div class="invalid-feedback d-block">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Date <span class="text-red">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar4"></i>
                                        </span>
                                        <input type="date" class="form-control" name="date" value="{{old('date', Illuminate\Support\Carbon::parse($batch->date)->format('Y-m-d'))}}">
                                    </div>
                                    @error('date')
                                        <div class="invalid-feedback d-block">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-4">
                                    <label class="form-label">Add Product<span class="text-red">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-bag"></i>
                                        </span>
                                        <input type="text" class="form-control" id="search_item">
                                    </div>
                                    <span id="search_item_list">

                                    </span>
                                </div>

                                <div class="table-responsive mb-3">
                                    <table class="table m-0 text-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="bg-primary text-white">Product Name</th>
                                                <th class="bg-primary text-white">Shelf Life (Day)</th>
                                                <th class="bg-primary text-white">Volume (ml)</th>
                                                <th class="bg-primary text-white">Quentity</th>
                                                <th class="bg-primary text-white">MRP
                                                    ({{ $companyState->currency->symbol }})</th>
                                                <th class="bg-primary text-white">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_body">

                                            @foreach($batch->stocks as $stock)
                                                <tr>
                                                    <td>
                                                        <span class="form-control">{{$stock->product->name}}</span> <input name="product[name][]" class="d-none" value="{{$stock->product->name}}" /> 
                                                        <input type="hidden" name="product[id][]" value="{{$stock->product->id}}">
                                                    </td>
                                                    <td> <input type="number" class="form-control shelf-life" name="product[shelf_life][]" value="{{$stock->shelf_life}}"/> </td>
                                                    <td> <input type="number" class="form-control volume" name="product[volume][]" value="{{$stock->volume}}"/> </td>
                                                    <td> <input type="number" class="form-control mop" name="product[quentity][]" value="{{$stock->quentity}}"/> </td>
                                                    <td> <input type="number" class="form-control mrp" name="product[mrp][]" value="{{$stock->mrp}}"/> </td>
                                                    <td> <button type="button" class="btn btn-outline btn-danger" onclick="removeItem(this)"><i class="bi bi-trash"></i></button></td>
                                                </tr>
                                            @endforeach
        
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr>
                                <button class="btn btn-info px-5">update</button>
                            </div>

                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    @push('scripts')
        {{-- select 2 --}}
        <script src="{{ asset('assets/vendor/bs-select/bs-select.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/bs-select/bs-select-custom.js') }}"></script>

        <script>
            const myForm = document.getElementById('myForm');
            const searchItem = $('#search_item');


            myForm.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                }
            });

            const removeItem = (e) => {
                e.closest('tr').remove();
            };

            const searchProduct = (search) => {
                $.ajax({
                    url: "{{ route('admin.batches.search_product') }}",
                    data: {
                        search: search
                    },
                    success: (data) => $('#search_item_list').html(data)
                });
            }

            searchItem.on('keyup', function() {
                $(this).val() == '' ? $('#search_item_list').html('') : searchProduct($(this).val());
            });

            const addItem = (id) => {
                $.ajax({
                    url: "{{ route('admin.batches.add_product') }}",
                    data: {
                        product_id: id
                    },
                    success: (data) => {
                        $('#table_body').append(data);
                        $('#search_item_list').html('');
                        searchItem.val('');
                    }
                });
            };
        </script>
    @endpush
</x-app-layout>
