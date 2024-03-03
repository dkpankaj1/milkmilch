<x-app-layout>
    @push('head')
        <link rel="stylesheet" href="{{ asset('assets/vendor/bs-select/bs-select.css') }}">
        <style>
            .table-responsive {
                max-height: 300px;
            }
        </style>
    @endpush

    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.payment.create') }}
    @endpush

    <div class="card">
        <div class="card-header">
            <div class="card-title">Generate Payment</div>
        </div>
        <div class="card-body">
            <div class="card-border">

                <div class="card-border-body">
                    <div class="row">
                        <div class="col-12">
                            <form>
                                <div class="row">
                                    <div class="col-12 col-lg-3">
                                        <div class="mb-3">
                                            <select class="select-single js-states form-control" data-live-search="true"
                                                name="customer" id="customer_select">
                                                <option value="">-- select --</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}"
                                                        @if ($customer->id == $selected_customer) selected @endif>
                                                        {{ $customer->user->name }} / {{ $customer->user->phone }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('customer_id')
                                                <div class="invalid-feedback d-block">{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    Start Date
                                                </span>
                                                <input type="date" class="form-control" name="start_date"
                                                    value="{{ request()->get('start_date') }}">
                                            </div>
                                            @error('start_date')
                                                <div class="invalid-feedback d-block">{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    End Date
                                                </span>
                                                <input type="date" class="form-control" name="end_date"
                                                    value="{{ request()->get('end_date') }}">
                                            </div>
                                            @error('sell_date')
                                                <div class="invalid-feedback d-block">{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-3">
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-light"><i
                                                    class="bi bi-funnel"></i>Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-12 mt-3">
                            <form action="{{ route('admin.payment.store') }}" method="POST" id="myForm">
                                @csrf
                                <input type="hidden" name="customer_id" value="{{ $selected_customer }}">
                                <div class="table-responsive mb-3 border">
                                    <table class="table m-0 text-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="bg-primary text-white">
                                                    <input type="checkbox" class="form-check-input check_all">
                                                </th>
                                                <th class="bg-primary text-white">ID</th>
                                                <th class="bg-primary text-white">Date</th>
                                                <th class="bg-primary text-white">Order Status</th>
                                                <th class="bg-primary text-white">Payment Status</th>
                                                <th class="bg-primary text-white">Grand
                                                    Total({{ $companyState->currency->symbol }})</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sales as $sale)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="id[]"
                                                            class="form-check-input single_check"
                                                            value="{{ $sale->id }}">
                                                    </td>
                                                    <td>{{ $sale->id }}</td>
                                                    <td>{{ $sale->date }}</td>
                                                    <td>{{ $sale->order_status }}</td>
                                                    <td>{{ $sale->payment_status }}</td>
                                                    <td style="width:150px"><input type="text"
                                                            value="{{ $sale->grand_total }}" name="grand_total_input[]"
                                                            style="border: none" readonly></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row mt-5" id="calculet_amt">
                                    <div class=" col-md-8 col-12">

                                    </div>
                                    <div class="col-md-4 col-12">

                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Discount</span>
                                            <input type="number" name="discount" class="form-control" placeholder="0"
                                                value="{{ old('discount') }}">
                                            @error('discount')
                                                <div class="invalid-feedback d-block">{{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Discount type</span>
                                            <select name="discount_type" class="form-select">
                                                <option value="percentage"
                                                    @if (old('discount_type') == 'percentage') selected @endif>
                                                    Percentage (%)
                                                </option>
                                                <option value="fixed"
                                                    @if (old('discount_type') == 'fixed') selected @endif>Fixed
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
                                                placeholder="0" value="{{ old('other_charges') }}">
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
                                                value="{{ old('grandTotalResult') }}" />
                                            @error('grandTotalResult')
                                                <div class="invalid-feedback d-block">{{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    @error('id')
                                        <div class="invalid-feedback d-block py-2-">{{ $message }}
                                        </div>
                                    @enderror
                                    <hr>
                                    <button class="btn btn-info px-5">Generate</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('assets/vendor/bs-select/bs-select.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/bs-select/bs-select-custom.js') }}"></script>
        <script>
            $(document).ready(function() {
                // Function to calculate grand total
                function calculateGrandTotal() {
                    var grandTotal = 0;

                    // Iterate through each selected row
                    $(".single_check:checked").each(function() {
                        var grandTotalInput = $(this).closest("tr").find("input[name='grand_total_input[]']")
                            .val();
                        grandTotal += parseFloat(grandTotalInput);
                    });

                    // Apply discount
                    var discount = parseFloat($("input[name='discount']").val() || 0);
                    var discountType = $("select[name='discount_type']").val();
                    if (discountType === "percentage") {
                        grandTotal *= (100 - discount) / 100;
                    } else {
                        grandTotal -= discount;
                    }

                    // Add other charges
                    var otherCharges = parseFloat($("input[name='other_charges']").val() || 0);
                    grandTotal += otherCharges;


                    // Update grand total field
                    $("#grandTotalResult").val(grandTotal.toFixed(2));
                }

                // Call calculateGrandTotal function whenever there's a change in input fields, single_check checkboxes
                $("#calculate_amt input, #calculate_amt select, .single_check").change(
                    function() {
                        calculateGrandTotal();
                        updateCheckAll();
                    });

                // Check/uncheck all checkboxes
                $(".check_all").change(function() {
                    $(".single_check").prop("checked", $(this).prop("checked"));
                    calculateGrandTotal();
                });

                // Update check_all checkbox based on single_check checkboxes
                function updateCheckAll() {
                    var allChecked = $(".single_check:checked").length === $(".single_check").length;
                    $(".check_all").prop("checked", allChecked);
                }

                // Recalculate grand total when discount, discount type, or other amount is changed
                $("input[name='discount'], select[name='discount_type'], input[name='other_charges']").change(
                    function() {
                        calculateGrandTotal();
                    });
            });
        </script>
    @endpush

</x-app-layout>
