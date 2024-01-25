<x-app-layout>
    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.milk-purchases.index') }}
    @endpush

    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Milk Purchases</div>
                    <a href="{{ route('admin.milk-purchases.create') }}" class="btn btn-outline-info"><i
                            class="bi bi-plus-square"></i> Add</a>
                </div>
                <div class="card-body">

                    <div class="table-responsive mb-3">
                        <table class="table v-middle m-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Supplier</th>
                                    <th>Amount</th>
                                    <th>Order Status</th>
                                    <th>Payment</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($milk_purchases as $milk_purchase)
                                    <tr>
                                        <td>MP-{{ $milk_purchase->id }}</td>
                                        <td>{{ Illuminate\Support\Carbon::parse($milk_purchase->purchase_date)->format('Y-m-d') }} </td>
                                        <td>{{ $milk_purchase->supplier->user->name }}</td>
                                        <td>{{ $milk_purchase->grand_total }}</td>
                                        <td>
                                            <span class="badge shade-{{$milk_purchase->order_status == 'orderd' ? 'red' : 'green' }} min-70">{{$milk_purchase->order_status}}</span>

                                        </td>
                                        <td>{{ $milk_purchase->payment_status }}</td>
                                        <td>
                                            <div class="actions">
                                                <a href="{{ route('admin.milk-purchases.invoice', $milk_purchase) }}" target="_blank">
                                                    <i class="bi bi-file-pdf text-success"></i>
                                                </a>
                                                <a href="{{ route('admin.milk-purchases.edit', $milk_purchase) }}">
                                                    <i class="bi bi-pencil-square text-info"></i>
                                                </a>
                                                <a href="#" class="delete-btn"
                                                    data-attr="{{ route('admin.milk-purchases.delete', $milk_purchase) }}">
                                                    <i class="bi bi-trash text-red"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach()

                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        {{ $milk_purchases->links() }}
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
