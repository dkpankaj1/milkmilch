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
                    <hr>
                    <form>
                        <div class="d-flex flex-column flex-sm-row gap-1">
                            <select class="select-single form-select" name="limit">
                                <option value="10" @if (old('limit', request()->get('limit')) == '10') selected @endif> Show - 10
                                </option>
                                <option value="20" @if (old('limit', request()->get('limit')) == '20') selected @endif> Show - 20
                                </option>
                                <option value="50" @if (old('limit', request()->get('limit')) == '50') selected @endif> Show - 50
                                </option>
                                <option value="100" @if (old('limit', request()->get('limit')) == '100') selected @endif>Show - 100
                                </option>
                            </select>

                            <input type="date" name="date" class="form-control" value="{{ old('date') }}">


                            <select class="select-single js-states form-control" data-live-search="true" name="customer"
                                id="customer_select">
                                <option value=""> -- select customer --</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        @if (old('customer', request()->get('customer')) == $customer->id) selected @endif>
                                        {{ $customer->user->name }} - {{ $customer->user->phone }}
                                    </option>
                                @endforeach
                            </select>


                            <select class="select-single form-select" name="payment">
                                <option value=""> -- paytment --</option>
                                <option value="generated" @if (old('payment', request()->get('payment')) == 'generated') selected @endif> generated
                                </option>
                                <option value="processing" @if (old('payment', request()->get('payment')) == 'processing') selected @endif>processing
                                </option>
                                <option value="completed" @if (old('payment', request()->get('payment')) == 'completed') selected @endif>
                                    generated</option>
                            </select>

                            <button type="submit" class="btn btn-light w-100">
                                <i class="bi bi-funnel"></i>
                                <span>Filter</span>
                            </button>
                        </div>
                    </form>
                    <hr>
                    <div class="table-responsive mb-3">
                        <table class="table table-sm table-bordered v-middle m-0" id="saleDataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Transaction ID</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Mobile</th>
                                    <th>Grand Total ({{ $companyState->currency->symbol }})</th>
                                    <th>Paid Amt ({{ $companyState->currency->symbol }})</th>
                                    <th>Clt Amt ({{ $companyState->currency->symbol }})</th>
                                    <th>Rider</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $key => $transaction)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $transaction->unique_id }}</td>
                                        <td>{{ \Illuminate\Support\Carbon::parse($transaction->date)->format('Y-m-d') }}
                                        </td>
                                        <td>{{ $transaction->customer->user->name }}</td>
                                        <td>{{ $transaction->customer->user->phone }}</td>
                                        <td>{{ $transaction->grand_total }}</td>
                                        <td>{{ $transaction->paid_amount }}</td>
                                        <td>{{ $transaction->collect_amount ? $transaction->collect_amount : 0 }}</td>
                                        <td>{{ $transaction->customer->belongsRider->name }}</td>
                                        <td>
                                            <span
                                                class="badge rounded-pill {{ $transaction->status === 'completed' ? 'shade-green' : ($transaction->status === 'processing' ? 'shade-yellow' : 'shade-red') }}">
                                                {{ $transaction->status }}
                                            </span>
                                        </td>

                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.transaction.print', $transaction) }}"target="_blank"
                                                    title="Download Invoice">
                                                    <i class="bi bi-file-pdf text-success"></i>
                                                </a>

                                                <a href="{{ route('admin.transaction.show', $transaction) }}"
                                                    title="Make Transaction">
                                                    <i class="bi bi-eye text-info"></i>
                                                </a>

                                                <a href="{{ route('admin.transaction-payment.create', $transaction) }}"
                                                    title="Make Transaction">
                                                    <i class="bi bi-cash-coin text-success"></i>
                                                </a>


                                                <a href="#" class="delete-btn"
                                                    data-attr="{{ route('admin.transaction.delete', $transaction) }}">
                                                    <i class="bi bi-trash text-red"></i>
                                                </a>

                                            </div>
                                        </td>
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
