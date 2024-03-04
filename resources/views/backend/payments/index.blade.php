<x-app-layout>
    @push('head')
    @endpush

    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.payment.index') }}
    @endpush

    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Payment</div>
                    <a href="{{ route('admin.payment.create') }}" class="btn btn-outline-info"><i
                            class="bi bi-plus-square"></i>generate</a>
                </div>
                <div class="card-body">

                    <div class="table-responsive mb-3">
                        <table class="table custom-table" id="saleDataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Mobile</th>
                                    <th>Grand Total ({{ $companyState->currency->symbol }})</th>
                                    <th>Payment Status</th>
                                    <th>User</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>#PM-{{ $payment->id }}</td>
                                        <td>{{ \Illuminate\Support\Carbon::parse($payment->date)->format('Y-m-d') }}
                                        </td>
                                        <td>{{ $payment->customer->user->name }}</td>
                                        <td>{{ $payment->customer->user->phone }}</td>
                                        <td>{{ $payment->grand_total }}</td>
                                        <td>{{ $payment->payment_status }}</td>
                                        <td>{{ $payment->user->name }}</td>

                                        <td>
                                            <div class="actions">
                                                <a href="{{ route('admin.payment.invoice', $payment) }}"
                                                    target="_blank" title="Download Invoice">
                                                    <i class="bi bi-file-pdf text-success"></i>
                                                </a>
                                                <a href="{{ route('admin.transaction.create', $payment) }}"
                                                    title="Make Transaction">
                                                    <i class="bi bi-credit-card text-info"></i>
                                                </a>
                                                {{-- <a href="#" class="delete-btn"
                                                    data-attr="{{ route('admin.payment.delete', $payment) }}">
                                                    <i class="bi bi-trash text-red"></i>
                                                </a> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach()
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->


    @push('scripts')
        <script src="{{ asset('assets/js/confirm.js') }}"></script>
    @endpush

</x-app-layout>
