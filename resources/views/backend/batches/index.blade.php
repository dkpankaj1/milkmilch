<x-app-layout>
    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.batches.index') }}
    @endpush

    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Batches</div>
                    <a href="{{route('admin.batches.create')}}" class="btn btn-outline-info"><i class="bi bi-plus-square"></i> Add</a>
                </div>
                <div class="card-body">

                    <div class="table-responsive  mb-3">
                        <table class="table table-bordered v-middle m-0">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Date</th>
                                    <th>Storage </th>
                                    <th>Volume Used (L) </th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($batches as $batch)
                                    <tr>
                                        <td>{{ $batch->batch_code }}</td>
                                        <td>{{ Illuminate\Support\Carbon::parse($batch->date)->format('Y-m-d') }}</td>
                                        <td>MS-{{ $batch->milk_storage_id }}</td>
                                        <td>{{ $batch->volume }}</td>
                
                                        <td>
                                            <div class="">
                                                <a href="{{ route('admin.batches.edit', $batch)}}" >
                                                    <i class="bi bi-pencil-square text-info"></i>
                                                </a>

                                                <a href="{{ route('admin.batches.edit', $batch)}}" >
                                                    <i class="bi bi-eye text-primary"></i>
                                                </a>
                                                <a href="#" class="delete-btn"
                                                    data-attr="{{ route('admin.batches.delete', $batch) }}">
                                                    <i class="bi bi-trash text-red"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach()

                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $batches->links() }}
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
