<x-app-layout>
    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.milks.index') }}
    @endpush

    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Milks</div>
                    <a href="{{route('admin.milks.create')}}" class="btn btn-outline-info"><i class="bi bi-plus-square"></i> Add</a>
                </div>
                <div class="card-body">

                    <div class="table-responsive mb-3">
                        <table class="table v-middle m-0">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Fat Content</th>
                                    <th>Shelf Life (Days)</th>
                                    <th>Volume(ml)</th>
                                    <th>MOP</th>
                                    <th>MRP</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($milks as $milk)
                                    <tr>
                                        <td>M-{{ $milk->id }}</td>
                                        <td>{{ $milk->name }}</td>
                                        <td>{{ $milk->fat_content }} %</td>
                                        <td>{{ $milk->shelf_life }} Day</td>
                                        <td>{{ $milk->volume }} ml</td>
                                        <td>{{$companyState->currency->symbol}} {{ $milk->mop }}</td>
                                        <td>{{$companyState->currency->symbol}} {{ $milk->mrp }}</td>
                                        <td>{{ $milk->description }}</td>
                                        <td>
                                            {!! $milk->status != 1
                                                ? '<span class="badge shade-red min-70">Blocked</span>'
                                                : '<span class="badge shade-green min-70">Active</span>' !!}
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <a href="{{ route('admin.milks.edit', $milk)}}" >
                                                    <i class="bi bi-pencil-square text-info"></i>
                                                </a>
                                                <a href="#" class="delete-btn" data-attr="{{ route('admin.milks.delete', $milk) }}">
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
