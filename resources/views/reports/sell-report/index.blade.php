<x-app-layout>
    @section('title','sale report')
    @push('head')
        <!-- Data Tables -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bs5.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bs5-custom.css') }}" />
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
        
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
                                        <option value="">-- Select Customer --</option>
                                        <option value="">-- All --</option>
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
                                        <option value="">-- All --</option>
                                        @foreach ($paymentStatusEnums as $paymentStatusEnum)
                                            <option value="{{ $paymentStatusEnum }}"
                                                @if ($paymentStatusEnum == request()->payment_status) selected @endif>
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
        <!-- Data Tables -->
        {{-- <script src="{{ asset('assets/vendor/datatables/dataTables.min.js') }}"></script> --}}        
        {{-- <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap.min.js') }}"></script> --}}
        
        <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>

        <script>
            // Basic DataTable
            $(function() {
                $('#saleDataTable').DataTable({
                    processing: true,
                    "lengthMenu": [
                        [10, 25, 50, "All"]
                    ],

                    layout: {
                        topStart: {
                            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                        }
                    }
                });
            });
        </script>
    @endpush

</x-app-layout>
