<x-app-layout>

    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.sells.index') }}
    @endpush

    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Sells</div>
                    <a href="{{ route('admin.sells.create') }}" class="btn btn-outline-info"><i
                            class="bi bi-plus-square"></i> Add</a>
                </div>

                <div class="card-body">

                    <hr>

                    <form>

                        <div class="d-flex flex-column flex-sm-row gap-1">

                            <select class="form-select" name="limit">
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

                            <select class="form-control" data-live-search="true" name="customer" id="customer_select">
                                <option value=""> -- select customer --</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        @if (old('customer', request()->get('customer')) == $customer->id) selected @endif>
                                        {{ $customer->user->name }} - {{ $customer->user->phone }}
                                    </option>
                                @endforeach
                            </select>

                            <select class="form-select" name="payment">
                                <option value=""> -- paytment --</option>
                                <option value="pending" @if (old('payment', request()->get('payment')) == 'pending') selected @endif> pending
                                </option>
                                <option value="paid" @if (old('payment', request()->get('payment')) == 'paid') selected @endif> paid
                                </option>
                                <option value="partial" @if (old('payment', request()->get('payment')) == 'partial') selected @endif>partial
                                </option>
                                <option value="generated" @if (old('payment', request()->get('payment')) == 'generated') selected @endif>
                                    generated</option>
                            </select>

                            <select class="form-select" name="sale_by">
                                <option value=""> -- sale by --</option>
                                @foreach ($riders as $rider)
                                    <option value="{{ $rider->user->id }}"
                                        @if (old('sale_by', $saleByInput) == $rider->user->id) selected @endif>{{ $rider->user->name }}
                                    </option>
                                @endforeach
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
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Grand Total</th>
                                    <th>Paid AMT</th>
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                    <th>Sale By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sells as $sell)
                                    <tr>
                                        <td>#S-{{ $sell->id }}</td>
                                        <td>{{ \Illuminate\Support\Carbon::parse($sell->date)->format('Y-m-d') }}</td>
                                        <td>{{ $sell->customer->user->name }}</td>
                                        <td>{{ $companyState->currency->symbol }} {{ $sell->grand_total }}</td>
                                        <td>{{ $companyState->currency->symbol }} {{ $sell->paid_amt }}</td>
                                        <td>
                                            <span
                                                class="badge rounded-pill {{ $sell->payment_status === 'paid' ? 'shade-primary' : ($sell->payment_status === 'partial' ? 'shade-yellow' : 'shade-red') }}">
                                                {{ $sell->payment_status }}
                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge rounded-pill {{ $sell->order_status === 'complete' ? 'shade-green' : ($sell->order_status === 'pending' ? 'shade-red' : 'shade-yellow') }}">
                                                {{ $sell->order_status }}
                                            </span>
                                        </td>
                                        <td>{{ $sell->user->name }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.sells.edit', $sell) }}">
                                                    <i class="bi bi-pencil-square text-info"></i>
                                                </a>
                                                <a href="#" class="delete-btn"
                                                    data-attr="{{ route('admin.sells.delete', $sell) }}">
                                                    <i class="bi bi-trash text-red"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No results found</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

                    <div>
                        {{ $sells->links() }}
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
