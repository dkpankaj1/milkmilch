<x-app-layout>
    @push('head')
    @endpush

    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.sell-report.index') }}
    @endpush

    <!-- Row start -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <div class="my-3">
                                    <select class="select-single js-states form-control" data-live-search="true"
                                        name="customer" id="customer_select">
                                        <option value="">-- select Customer --</option>
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
                            <div class="col-12 col-lg-2">
                                <div class="my-3">
                                    <select class="select-single js-states form-control" data-live-search="true"
                                        name="payment_status" id="customer_select">
                                        <option value="">-- Payment Status --</option>
                                        @foreach ($paymentStatusEnums as $paymentStatusEnum)
                                            <option value="{{ $paymentStatusEnum }}"  @if ($paymentStatusEnum == request()->payment_status) selected @endif>
                                                {{ $paymentStatusEnum }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                        <div class="invalid-feedback d-block">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-2">
                                <div class="my-3">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            From Date
                                        </span>
                                        <input type="date" class="form-control" name="from_date"
                                            value="{{ request()->get('from_date') }}">
                                    </div>
                                    @error('start_date')
                                        <div class="invalid-feedback d-block">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-2">
                                <div class="my-3">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            To Date
                                        </span>
                                        <input type="date" class="form-control" name="to_date"
                                            value="{{ request()->get('to_date') }}">
                                    </div>
                                    @error('sell_date')
                                        <div class="invalid-feedback d-block">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-2">
                                <div class="my-3">
                                    <button type="submit" class="btn btn-light"><i
                                            class="bi bi-funnel"></i>Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">

                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" data-format="pdf" class="btn btn-danger custom-btn-group exportBtn"><i
                                class="bi bi-file-pdf"></i> PDF</button>
                        <button type="button" data-format="xlsx"class="btn btn-success custom-btn-group exportBtn"><i
                                class="bi bi-file-earmark-ruled"></i> EXCLE</button>
                        <button type="button" data-format="csv" class="btn btn-light custom-btn-group exportBtn"><i
                                class="bi bi-file-earmark-spreadsheet"></i> CSV</button>
                    </div>

                    <div class="table-responsive mb-3">
                        <table class="table custom-table" id="saleDataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Order Status</th>
                                    <th>Payment Status</th>
                                    <th>Grand Total</th>
                                    <th>Paid AMT</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($sells as $sell)
                                    <tr>
                                        <td>#S-{{ $sell->id }}</td>
                                        <td>{{ \Illuminate\Support\Carbon::parse($sell->date)->format('Y-m-d') }}</td>
                                        <td>{{ $sell->customer->user->name }}</td>
                                        <td>{{ $sell->order_status }}</td>
                                        <td>{{ $sell->payment_status }}</td>
                                        <td>{{ $companyState->currency->symbol }} {{ $sell->grand_total }}</td>
                                        <td>{{ $companyState->currency->symbol }} {{ $sell->paid_amt }}</td>
                                        <td>{{ $sell->created_at }}</td>
                                    </tr>
                                @endforeach()
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="col-12">
                        {{ $sells->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.exportBtn').click(function() {
                    let format = $(this).data('format');
                    $.ajax({
                        url : "{{ route('admin.sell-report.export') }}",
                        type:"GET",
                        data : {
                            "format" : format,
                            "payment_status" : "{{ request()->get('payment_status') }}",
                            "customer" : "{{ request()->get('customer_id') }}",
                            "from_date" : "{{ request()->get('from_date') }}",
                            "to_date" : "{{ request()->get('to_date') }}",
                        }
                    });
                });
            });
        </script>
    @endpush

</x-app-layout>
