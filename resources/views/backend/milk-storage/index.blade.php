<x-app-layout>
    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.milk-storage.index') }}
    @endpush

    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Milk Storage</div>
                </div>
                <div class="card-body">

                    <div class="table-responsive mb-3">
                        <table class="table v-middle m-0">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Date</th>
                                    <th>Milk Categorie</th>
                                    <th>Shelf Life (Days)</th>
                                    <th>Volume(Liter)</th>
                                    <th>Avalable</th>
                                    <th>Status</th>
                                    {{-- <th>Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($milkStorages as $milkStorage)
                                    <tr>
                                        <td>MS-{{ $milkStorage->id }}</td>
                                        <td><b>{{ Illuminate\Support\Carbon::parse($milkStorage->date)->format('Y-m-d') }}</b></td>
                                        <td>{{ $milkStorage->milk->name }}</td>
                                        <td>{{ $milkStorage->avg_shelf_life  }} Day</td>
                                        <td>{{ $milkStorage->ttl_volume }} L</td>
                                        <td>{{ $milkStorage->avl_volume }} L</td>
                                        <td>
                                            {!!$milkStorage->milkStatus()!!}
                                        </td>
                                        {{-- <td>
                                            <div class="actions"> --}}
                                                {{-- <a href="{{ route('admin.milk-storage.edit', $milkStorage)}}" >
                                                    <i class="bi bi-pencil-square text-info"></i>
                                                </a>
                                                <a href="#" class="delete-btn" data-attr="{{ route('admin.milk-storage.delete', $milkStorage) }}">
                                                    <i class="bi bi-trash text-red"></i>
                                                </a> --}}
                                            {{-- </div>
                                        </td> --}}
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
