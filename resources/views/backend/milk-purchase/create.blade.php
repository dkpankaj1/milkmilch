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
        {{ Breadcrumbs::render('admin.milk-purchases.create') }}
    @endpush

    <div class="card">
        <div class="card-header">
            <div class="card-title">Purchase Milk</div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.milk-purchases.store') }}" method="POST" onsubmit="return validateForm()"
                id="myForm">
                @csrf

                <div class="card-border">

                    <div class="card-border-body">
                        <div class="row">
                            <div class=" col-sm-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Supplier <span class="text-red">*</span></label>
                                    <select class="select-single js-states form-control" data-live-search="true"
                                        name="supplier" id="supplier">
                                        <option value="">-- select --</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->user->name }}</option>
                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback d-block" id="supplierError"></div>
                                    @error('supplier')
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
                                        <input type="date" class="form-control" name="purchase_date"
                                            id="datepicker">
                                    </div>
                                    <div class="invalid-feedback d-block" id="datepickerError"></div>
                                    @error('purchase_date')
                                        <div class="invalid-feedback d-block">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class=" col-sm-4 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Status <span class="text-red">*</span></label>
                                    <select class="form-select" name="status" id="status">
                                        <option value="">-- select --</option>
                                        <option value="orderd">Orderd</option>
                                        <option value="pending">Pending</option>
                                        <option value="received">Received</option>
                                    </select>
                                    <div class="invalid-feedback d-block" id="statusError"></div>
                                    @error('status')
                                        <div class="invalid-feedback d-block">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-4">
                                    <label class="form-label">Milk Product<span class="text-red">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-upc-scan"></i>
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
                                                <th class="bg-primary text-white">Fat Content (%)</th>
                                                <th class="bg-primary text-white">Shelf Life (Day)</th>
                                                <th class="bg-primary text-white">Volume (ml)</th>
                                                <th class="bg-primary text-white">MRP
                                                    ({{ $companyState->currency->symbol }})</th>
                                                <th class="bg-primary text-white">MOP
                                                    ({{ $companyState->currency->symbol }})</th>
                                                <th class="bg-primary text-white">Total Amount
                                                    ({{ $companyState->currency->symbol }})</th>
                                                <th class="bg-primary text-white">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_body"></tbody>
                                    </table>

                                </div>

                                <div class="row mt-3" id="calculet_amt">
                                    <div class=" col-sm-8 col-12">
                                        <div class="row">
                                            <div class="col-sm-6 mb-3">
                                                <label class="form-label">Notes<span class="text-red">*</span></label>
                                                <textarea name="note" class="form-control" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-12">

                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Discount</span>
                                            <input type="number" name="discount" class="form-control" placeholder="0">
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Discount type</span>
                                            <select name="discount_type" class="form-select">
                                                <option value="percentage" selected>
                                                    Percentage (%)
                                                </option>
                                                <option value="fixed">Fixed
                                                    ({{ $companyState->currency->symbol }})
                                                </option>
                                            </select>
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Other Charges
                                                ({{ $companyState->currency->symbol }})</span>
                                            <input type="number" name="other_charges" class="form-control"
                                                placeholder="0">
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Grand Total
                                                ({{ $companyState->currency->symbol }})</span>
                                            <input type="text" class="form-control" readonly placeholder="0"
                                                name="grandTotalResult" id="grandTotalResult" />
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="col-12">
                                <hr>
                                <button class="btn btn-info px-5">Save</button>
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
            const tableBody = document.getElementById('table_body');
            const discountInput = document.querySelector('[name="discount"]');
            const discountTypeSelect = document.querySelector('[name="discount_type"]');
            const otherChargesInput = document.querySelector('[name="other_charges"]');
            const grandTotalResult = document.getElementById('grandTotalResult');

            myForm.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                }
            });

            const removeItem = (e) => {
                e.closest('tr').remove();
                calculateGrandtotal();
            };

            searchItem.on('keyup', function() {
                if ($(this).val() == '') {
                    $('#search_item_list').html('')
                } else {
                    $.ajax({
                        url: "{{ route('admin.milk-purchase.search_milk_product') }}",
                        data: {
                            search: $(this).val()
                        },
                        success: (data) => $('#search_item_list').html(data)
                    });
                }
            });

            const addItem = (id) => {
                $.ajax({
                    url: "{{ route('admin.milk-purchase.get_milk_product') }}",
                    data: {
                        id
                    },
                    success: (data) => {
                        $('#table_body').append(data);
                        calculateGrandtotal();
                        $('#search_item_list').html('');
                        searchItem.val('');
                    }
                });
            };

            const validateForm = () => {
                const fields = ['supplier', 'datepicker', 'status'];
                for (const field of fields) {
                    const value = document.getElementById(field).value;
                    if (!value) {
                        displayError(field, `Please select ${field}.`);
                        return false;
                    }
                }
                return true;
            };

            const displayError = (fieldId, errorMessage) => {
                document.getElementById(`${fieldId}Error`).textContent = errorMessage;
            };


            const calculateGrandtotal = () => {
                let subtotal = 0;
                tableBody.querySelectorAll('tr').forEach((row) => {
                    const volume = parseFloat(row.querySelector('.volume').value) || 0;
                    const mop = parseFloat(row.querySelector('.mop').value) || 0;
                    const rowTotal = (volume / 1000) * mop;
                    row.querySelector('.total-amt').value = rowTotal.toFixed(2);
                    subtotal += rowTotal;
                });

                const discount = parseFloat(discountInput.value) || 0;
                const discountType = discountTypeSelect.value;
                const discountAmount = discountType === 'percentage' ? (subtotal * discount) / 100 : discount;

                const otherCharges = parseFloat(otherChargesInput.value) || 0;
                const grandTotal = subtotal - discountAmount + otherCharges;
                grandTotalResult.value = grandTotal.toFixed(2);
            };

            const handleTableInput = (event) => {
                const target = event.target;
                if (target.matches('.volume') || target.matches('.mop')) {
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
