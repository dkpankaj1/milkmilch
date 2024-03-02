<x-app-layout>
    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.sells.index') }}
    @endpush

    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Milks</div>
                    <a href="{{route('admin.sells.create')}}" class="btn btn-outline-info"><i class="bi bi-plus-square"></i> Add</a>
                </div>
                <div class="card-body">

                    <div class="table-responsive mb-3">
                        <table class="table v-middle m-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Order Status</th>
                                    <th>Payment Status</th>
                                    <th>Grand Total</th>
                                    {{-- <th>Paid AMT</th> --}}
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($sells as $sell)
                                    <tr>
                                        <td>S-{{ $sell->id }}</td>
                                        <td>{{ \Illuminate\Support\Carbon::parse($sell->date)->format('Y-m-d') }}</td>
                                        <td>{{ $sell->customer->user->name }}</td>
                                        <td>{{ $sell->order_status }}</td>
                                        <td>{{ $sell->payment_status }}</td>
                                        <td>{{$companyState->currency->symbol}} {{ $sell->grand_total }}</td>
                                        {{-- <td>{{$companyState->currency->symbol}} {{ $sell->paid_amt }}</td> --}}
                                        
                                        <td>
                                            <div class="actions">
                                                <a href="{{ route('admin.sells.edit', $sell)}}" >
                                                    <i class="bi bi-pencil-square text-info"></i>
                                                </a>
                                                <a href="#" class="delete-btn" data-attr="{{ route('admin.sells.delete', $sell) }}">
                                                    <i class="bi bi-trash text-red"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach()

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->


    @push('scripts')
        <script src="{{ asset('assets/js/confirm.js') }}" ></script>
    @endpush

</x-app-layout>
