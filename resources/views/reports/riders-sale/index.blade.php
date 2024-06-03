<x-app-layout>
    @section('title', 'rider sale report')

    @push('head')
        <!-- Data Tables -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bs5.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bs5-custom.css') }}" />
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
    @endpush

    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.riders-sale.index') }}
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
                                        name="sale_by">
                                        <option value="">-- Select Rider --</option>
                                        @foreach ($riders as $rider)
                                            <option value="{{ $rider->user->id }}"
                                                @if ($rider->user->id == request()->get('sale_by')) selected @endif>
                                                {{ $rider->user->name }} / {{ $rider->user->phone }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-2">
                                <div class="my-3">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            Date
                                        </span>
                                        <input type="date" class="form-control" name="date"
                                            value="{{ request()->get('date') }}">
                                    </div>
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
                        <table class="table custom-table" id="riderSaleDataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Order Status</th>
                                    <th>Payment Status</th>
                                    <th>Sale Volume (Liter)</th>
                                    <th>Grand Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sumTotle = 0;
                                    $grandTotle = 0;
                                @endphp
                                @forelse ($sells as $sell)
                                    <tr>
                                        <td>#S-{{ $sell->id }}</td>
                                        <td>{{ \Illuminate\Support\Carbon::parse($sell->date)->format('Y-m-d') }}</td>
                                        <td>{{ $sell->customer->user->name }}</td>
                                        <td>{{ $sell->order_status }}</td>
                                        <td>{{ $sell->payment_status }}</td>
                                        <td>{{ $sell->total_volume }} </td>
                                        <td>{{ $companyState->currency->symbol }} {{ $sell->grand_total }}</td>
                                    </tr>

                                    @php
                                        $sumTotle = $sumTotle + $sell->total_volume;
                                        $grandTotle = $grandTotle + $sell->grand_total;
                                    @endphp

                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center"> No recourd found..</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-end"><h5>Total</h5></td>
                                    <td><h5>{{ $sumTotle }} (L) </h5></td>
                                    <td><h5>{{ $grandTotle }} ({{$companyState->currency->symbol}})</h5></td>
                                </tr>
                            </tfoot>
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
                $('#riderSaleDataTable').DataTable({
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
