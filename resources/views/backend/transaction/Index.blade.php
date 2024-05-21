<x-app-layout>
    @push('head')
    @endpush

    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.transaction.index') }}
    @endpush

    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Transaction</div>
                    <a href="{{ route('admin.transaction.create') }}" class="btn btn-outline-info"><i
                            class="bi bi-plus-square"></i>Create</a>
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
                                    <th>Paid Amount ({{ $companyState->currency->symbol }})</th>
                                    <th>Rider</th>
                                    <th>Status</th>
                                    {{-- <th>Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td>#PM-{{ $transaction->id }}</td>
                                        <td>{{ \Illuminate\Support\Carbon::parse($transaction->date)->format('Y-m-d') }}
                                        </td>
                                        <td>{{ $transaction->customer->user->name }}</td>
                                        <td>{{ $transaction->customer->user->phone }}</td>
                                        <td>{{ $transaction->grand_total }}</td>
                                        <td>{{ $transaction->paid_amount }}</td>
                                        <td>{{ $transaction->customer->belongsRider->name }}</td>
                                        <td>
                                            <span
                                                class="badge rounded-pill {{ $transaction->status === 'paid' ? 'shade-primary' : ($transaction->status === 'partial' ? 'shade-yellow' : 'shade-red') }}">
                                                {{ $transaction->status }}
                                            </span>
                                        </td>

                                        {{-- <td>
                                            <div class="actions">
                                                <a href="{{ route('admin.payment.invoice', $transaction) }}"
                                                    target="_blank" title="Download Invoice">
                                                    <i class="bi bi-file-pdf text-success"></i>
                                                </a>
                                                <a href="{{ route('admin.transaction.create', $transaction) }}"
                                                    title="Make Transaction">
                                                    <i class="bi bi-credit-card text-info"></i>
                                                </a>
                                                <a href="#" class="delete-btn" data-attr="{{ route('admin.payment.delete', $payment) }}">
                                                    <i class="bi bi-trash text-red"></i>
                                                </a>
                                            </div>
                                        </td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No records found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                    <div class="col-12">
                        {{ $transactions->links() }}
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
