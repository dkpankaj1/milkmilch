<x-app-layout>
    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.products.index') }}
    @endpush

    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Product</div>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-outline-info"><i
                            class="bi bi-plus-square"></i> Add</a>
                </div>
                <div class="card-body">

                    <div class="table-responsive mb-3">
                        <table class="table v-middle m-0">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Categorie</th>
                                    <th>Unit</th>
                                    <th>Shelf Life (Days)</th>
                                    <th>Volume(Liter)</th>
                                    <th>MRP ({{ $companyState->currency->symbol }})</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->code }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->categorie->name }}</td>
                                        <td>{{ $product->unit->name }}</td>
                                        <td>{{ $product->shelf_life }} Day</td>
                                        <td>{{ $product->volume }} L</td>
                                        <td>{{ $companyState->currency->symbol }} {{ $product->mrp }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>
                                            {!! $product->status != 1
                                                ? '<span class="badge shade-red min-70">Blocked</span>'
                                                : '<span class="badge shade-green min-70">Active</span>' !!}
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <a href="{{ route('admin.products.edit', $product) }}">
                                                    <i class="bi bi-pencil-square text-info"></i>
                                                </a>
                                                <a href="#" class="delete-btn"
                                                    data-attr="{{ route('admin.products.delete', $product) }}">
                                                    <i class="bi bi-trash text-red"></i>
                                                </a>

                                                <a href="{{ route('admin.barcode', ['text' => $product->code]) }}">
                                                    <i class="bi bi-upc-scan text-info"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach()

                                @if (count($products) == 0)
                                    <tr>
                                        <td colspan="9" class="text-center">No Products !!
                                        <td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        {{ $products->links() }}
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
