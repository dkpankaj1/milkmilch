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
        {{ Breadcrumbs::render('admin.sells.edit', $sell) }}
    @endpush

    <div class="card">
        <div class="card-header">
            <div class="card-title">Edit Sale</div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.sells.update',$sell) }}" method="POST" id="myForm">
                @csrf
                @method('put')

                <div class="card-border">

                    <div class="card-border-body">
                        <div class="row">

                            <div class=" col-sm-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Customer <span class="text-red">*</span></label>
                                    <select class="select-single js-states form-control" data-live-search="true"
                                        name="customer" aria-readonly="true">
                                        <option value="">-- select --</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                @if ($customer->id == old('customer', $sell->customer_id)) selected @endif>
                                                {{ $customer->user->name }} / {{ $customer->user->phone }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('customer')
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
                                        <input type="date" class="form-control" name="sell_date" id="datepicker"
                                            value="{{ old('purchase_date', \Illuminate\Support\Carbon::parse($sell->date)->format('Y-m-d')) }}">
                                    </div>
                                    @error('sell_date')
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
                                            <i class="bi bi-upc-scan"></i>
                                        </span>
                                        <input type="text" class="form-control" id="search_item">

                                    </div>
                                    @error('product')
                                        <div class="invalid-feedback d-block">{{ $message }}
                                        </div>
                                    @enderror
                                    <span id="search_item_list">

                                    </span>
                                </div>

                                <div class="table-responsive mb-3">
                                    <table class="table m-0 text-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="bg-primary text-white">Product Name</th>
                                                <th class="bg-primary text-white">Available</th>
                                                <th class="bg-primary text-white">Quentity</th>
                                                <th class="bg-primary text-white">MRP
                                                    ({{ $companyState->currency->symbol }})</th>

                                                <th class="bg-primary text-white">Total Amount
                                                    ({{ $companyState->currency->symbol }})</th>

                                                <th class="bg-primary text-white">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_body">

                                            @foreach ($sell->items as $item)
                                            <tr>
                                                <td>
                                                    <span class="form-control">{{ $item->stock->product->name }}</span>
                                                    <input type="hidden" name="product[id][]" value="{{ $item->stock_id }}">
                                                    <input type="hidden" name="product[name][]" value="{{ $item->name }}">
                                                </td>
                                            
                                                <td> <input type="number" class="form-control available" name="product[available][]" value="{{$item->stock->available}}" readonly /> </td>
                                            
                                                <td> <input type="number" class="form-control quentity" name="product[quentity][]" value="{{$item->quentity}}" /> </td>
                                            
                                                <td> <input type="number" class="form-control mrp" name="product[mrp][]" value="{{ number_format($item->mrp) }}" /> </td>
                                            
                                                <td> <input type="number" class="form-control total-amt" name="product[total_amt][]" value="{{ number_format($item->mrp) }}" readonly /> </td>
                                            
                                                <td> <button type="button" class="btn btn-outline btn-danger" onclick="removeItem(this)"><i class="bi bi-trash"></i></button></td>
                                                
                                            </tr>
                                            
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                                <div class="row mt-5" id="calculet_amt">
                                    <div class=" col-md-8 col-12">
                                        <div class="row">
                                            <div class="col-sm-8 mb-3">
                                                <textarea name="note" class="form-control" rows="5" placeholder="Write sell notes"></textarea>
                                                @error('note')
                                                    <div class="invalid-feedback d-block">{{ $message }}
                                                    </div>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">

                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Discount</span>
                                            <input type="number" name="discount" class="form-control" placeholder="0"
                                                value="{{ old('discount', $sell->discount) }}">
                                            @error('discount')
                                                <div class="invalid-feedback d-block">{{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Discount type</span>
                                            <select name="discount_type" class="form-select">
                                                <option value="percentage"
                                                    @if (old('discount_type', $sell->discount_type) == 'percentage') selected @endif>
                                                    Percentage (%)
                                                </option>
                                                <option value="fixed"
                                                    @if (old('discount_type', $sell->discount_type) == 'fixed') selected @endif>Fixed
                                                    ({{ $companyState->currency->symbol }})
                                                </option>
                                            </select>
                                            @error('discount_type')
                                                <div class="invalid-feedback d-block">{{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Other Charges
                                                ({{ $companyState->currency->symbol }})</span>
                                            <input type="number" name="other_charges" class="form-control"
                                                placeholder="0" value="{{ old('other_charges', $sell->other_amt) }}">
                                            @error('other_charges')
                                                <div class="invalid-feedback d-block">{{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Grand Total
                                                ({{ $companyState->currency->symbol }})</span>
                                            <input type="text" class="form-control" readonly placeholder="0"
                                                name="grandTotalResult" id="grandTotalResult"
                                                value="{{ old('grandTotalResult', $sell->grand_total) }}" />
                                            @error('grandTotalResult')
                                                <div class="invalid-feedback d-block">{{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr>
                                <button class="btn btn-info px-5">Update</button>
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
            const tableBody = document.getElementById('table_body');
            const discountInput = document.querySelector('[name="discount"]');
            const discountTypeSelect = document.querySelector('[name="discount_type"]');
            const otherChargesInput = document.querySelector('[name="other_charges"]');
            const grandTotalAmt = document.getElementById('grandTotalResult');

            const myForm = document.getElementById('myForm');
            const searchItem = $('#search_item');


            myForm.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                }
            });

            const removeItem = (e) => {
                e.closest('tr').remove();
                calculateGrandtotal()
            };

            const searchProduct = (search) => {
                $.ajax({
                    url: "{{ route('admin.sells.stocks_search') }}",
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
                    type: "GET",
                    url: "{{ route('admin.sells.stocks_get') }}",
                    data: {
                        stock: id
                    },
                    success: (data) => {
                        $('#table_body').append(data);
                        $('#search_item_list').html('');
                        calculateGrandtotal();
                        searchItem.val('');
                    }
                });
            };

            const calculateGrandtotal = () => {
                let subtotal = 0;
                tableBody.querySelectorAll('tr').forEach((row) => {
                    const qnt = parseFloat(row.querySelector('.quentity').value) || 0;
                    const mrp = parseFloat(row.querySelector('.mrp').value) || 0;
                    const totalAmt = qnt * mrp;
                    row.querySelector('.total-amt').value = totalAmt.toFixed(2);
                    subtotal += totalAmt;
                });

                const discount = parseFloat(discountInput.value) || 0;
                const discountType = discountTypeSelect.value;
                const discountAmount = discountType === 'percentage' ? (subtotal * discount) / 100 : discount;

                const otherCharges = parseFloat(otherChargesInput.value) || 0;
                const grandTotal = subtotal - discountAmount + otherCharges;
                console.log(grandTotal);
                grandTotalAmt.value = grandTotal.toFixed(2);
            };

            const handleTableInput = (event) => {
                const target = event.target;
                if (target.matches('.quentity') || target.matches('.mrp')) {
                    calculateGrandtotal();
                }
            };

            const handleCalculetAmt = (event) => {
                const target = event.target;
                if (target.matches('[name="discount"]') || target.matches('[name="discount_type"]') || target.matches(
                        '[name="other_charges"]')) {
                    calculateGrandtotal();
                }
            };


            tableBody.addEventListener('input', handleTableInput);
            document.getElementById('calculet_amt').addEventListener('input', handleCalculetAmt);
        </script>
    @endpush
</x-app-layout>
