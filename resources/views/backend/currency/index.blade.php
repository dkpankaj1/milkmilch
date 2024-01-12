<x-app-layout>
    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.currencies.index') }}
    @endpush

    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Currencies</div>
                    <a href="{{route('admin.currencies.create')}}" class="btn btn-outline-info"><i class="bi bi-plus-square"></i> Add</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-3">
                        <table class="table v-middle m-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>symbol</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($currencies as $currency)
                                    <tr>
                                        <td>CR-{{ $currency->id }}</td>
                                        <td>{{ $currency->code }}</td>
                                        <td>{{ $currency->name }}</td>
                                        <td>{{ $currency->symbol }}</td>
                                        <td>{{ $currency->description }}</td>
                                        <td>
                                            <div class="actions">
                                                {{-- <a href="#" class="viewRow">
                                                    <i class="bi bi-list text-green"></i>
                                                </a> --}}
                                                <a href="{{ route('admin.currencies.edit', $currency)}}" >
                                                    <i class="bi bi-pencil-square text-info"></i>
                                                </a>
                                                <a href="#" class="delete-btn" data-attr="{{ route('admin.currencies.delete', $currency) }}">
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
                        {{ $currencies->links() }}
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
