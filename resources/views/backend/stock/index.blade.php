<x-app-layout>
    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.stocks.index') }}
    @endpush

    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">

                    <div class="table-responsive mb-3">
                        <table class="table v-middle m-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Batch</th>
                                    <th>Batch Date</th>
                                    <th>Shelf Life (Days)</th>
                                    <th>Volume(ml)</th>
                                    <th>MRP</th>
                                    <th>Quentity</th>
                                    <th>Available</th>
                                    <th>Best Befour</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($stocks as $key =>$stock)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $stock->product->name }}</td>
                                        <td>{{ $stock->batch->batch_code }}</td>
                                        <td>{{ Illuminate\Support\Carbon::parse( $stock->batch->date)->format('Y-m-d H:i:s')  }}</td>
                                        <td>{{ $stock->shelf_life }} Day</td>
                                        <td>{{ $stock->volume }} ml</td>
                                        <td>{{$companyState->currency->symbol}} {{ $stock->mrp }}</td>
                                        <td>{{ $stock->quentity }}</td>
                                        <td>{{ $stock->available }}</td>
                                        <td>{{ $stock->best_befour }}</td>
                                       
                                    </tr>
                                @endforeach()

                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        {{ $stocks->links() }}
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
