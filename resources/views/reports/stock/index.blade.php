<x-app-layout>
    @section('title', 'Stock report')
    @push('head')
        <!-- Data Tables -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bs5.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bs5-custom.css') }}" />
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
    @endpush
    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.stocks.report') }}
    @endpush


    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <div class="my-3">
                                    <select class="select-single js-states form-control" data-live-search="true"
                                        name="batch" id="customer_select">
                                        <option value="">-- Select Batch --</option>
                                        <option value="">-- All --</option>
                                        @foreach ($batches as $batche)
                                            <option value="{{$batche->id}}">
                                                {{ $batche->batch_code }} ::  {{ $batche->date }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                        <div class="invalid-feedback d-block">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="my-3">
                                    <select class="select-single js-states form-control" data-live-search="true"
                                        name="product" id="customer_select">
                                        <option value="">-- Select Product --</option>
                                        <option value="">-- All --</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">
                                                {{ $product->name }}
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
                                        name="available" id="customer_select">
                                        <option value="">-- Select Availability --</option>
                                        <option value="">-- All --</option>
                                        <option value="in" @if ("in" == request()->get('available')) selected @endif>In Stock</option>
                                        <option value="out" @if ("out" == request()->get('available')) selected @endif>Out Of Stock</option>
                                    
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
                                        name="life" id="customer_select">
                                        <option value="">-- Select Life --</option>
                                        <option value="">-- All --</option>
                                        <option value="good"  @if ("good" == request()->get('life')) selected @endif>Good</option>
                                        <option value="expire"  @if ("expire" == request()->get('life')) selected @endif>Expire</option>
                                       
                                    </select>
                                    @error('customer_id')
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
                <div class="card-header">
                </div>
                <div class="card-body">

                    <div class="table-responsive mb-3">
                        <table class="table v-middle m-0" id="stockTbl">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Batch</th>
                                    <th>Batch Date</th>
                                    <th>Volume(Liter)</th>
                                    <th>MRP</th>
                                    <th>Quentity</th>
                                    <th>Available</th>
                                    <th>Best Befour</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($stocks as $key => $stock)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-{{ $stock->stockStatusColor() }}">
                                            <b>{{ $stock->product->name }}</b>
                                        </td>
                                        <td>{{ $stock->batch->batch_code }}</td>
                                        <td>{{ Illuminate\Support\Carbon::parse($stock->batch->date)->format('Y-m-d') }}
                                        </td>
                                        <td>{{ $stock->volume / 1000 }} L</td>
                                        <td>{{ $companyState->currency->symbol }} {{ $stock->mrp }}</td>
                                        <td><b>{{ $stock->quentity }}</b></td>
                                        <td><b>{{ $stock->available }}</b></td>
                                        <td class="text-{{ $stock->stockStatusColor() }}">
                                            <b>{{ Illuminate\Support\Carbon::parse($stock->best_befour)->format('Y-m-d') }}</b>
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
        <!-- Data Tables -->

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
                $('#stockTbl').DataTable({
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
