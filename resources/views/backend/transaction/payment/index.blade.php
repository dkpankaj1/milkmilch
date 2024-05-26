<x-app-layout>

    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.transaction-payment.index') }}
    @endpush

    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Transaction Payment</div>
                </div>
                <div class="card-body">
                    <hr>
                    <form>
                        <div class="d-flex flex-column flex-sm-row gap-1">
                            <select class="select-single form-select" name="limit">
                                <option value="10" @if (old('limit',request()->get('limit')) == '10') selected @endif> Show - 10
                                </option>
                                <option value="20" @if (old('limit',request()->get('limit')) == '20') selected @endif> Show - 20
                                </option>
                                <option value="50" @if (old('limit',request()->get('limit')) == '50') selected @endif> Show - 50
                                </option>
                                <option value="100" @if (old('limit',request()->get('limit')) == '100') selected @endif>Show - 100
                                </option>
                            </select>

                            <input type="date" name="date" class="form-control" value="{{ old('date') }}">


                            <select class="select-single js-states form-control" data-live-search="true" name="customer"
                                id="customer_select">
                                <option value=""> -- select customer --</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        @if (old('customer',request()->get('customer')) == $customer->id) selected @endif>
                                        {{ $customer->user->name }} -  {{ $customer->user->phone }}
                                    </option>
                                @endforeach
                            </select>


                            <select class="select-single form-select" name="payment">
                                <option value=""> -- paytment --</option>
                                <option value="pending" @if (old('payment',request()->get('payment')) == 'pending') selected @endif> pending
                                </option>
                                <option value="paid" @if (old('payment',request()->get('payment')) == 'paid') selected @endif> paid
                                </option>
                                <option value="partial" @if (old('payment',request()->get('payment')) == 'partial') selected @endif>partial
                                </option>
                                <option value="generated" @if (old('payment',request()->get('payment')) == 'generated') selected @endif>
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
                                    <th>Date</th>
                                    <th>Transaction ID</th>
                                    <th>Customer</th>
                                    <th>Mobile</th>
                                    <th>Grand Total ({{ $companyState->currency->symbol }})</th>
                                    <th>Paid Amount ({{ $companyState->currency->symbol }})</th>
                                    <th>Payment Method</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactionPayments as $key => $transactionPayment)
                                   <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$transactionPayment->date}}</td>
                                    <td>{{$transactionPayment->transaction->unique_id}}</td>
                                    <td>{{$transactionPayment->transaction->customer->user->name}}</td>
                                    <td>{{$transactionPayment->transaction->customer->user->phone}}</td>
                                    <td>{{$transactionPayment->transaction->grand_total}}</td>
                                    <td>{{$transactionPayment->amount}}</td>
                                    <td>{{$transactionPayment->method}}</td>
                                    <td>
                                        <a href="{{ route('admin.transaction-payment.edit', $transactionPayment)}}" >
                                            <i class="bi bi-pencil-square text-info"></i>
                                        </a>
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
                        {{ $transactionPayments->links() }}
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
