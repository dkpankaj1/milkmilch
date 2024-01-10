<x-app-layout>
    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.users.index') }}
    @endpush

    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Staff</div>
                </div>
                <div class="card-body">

                    <div class="table-responsive mb-3">
                        <table class="table v-middle m-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>City</th>
                                    <th>Country</th>
                                    <th>Postal Code</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $user)
                                    <tr>

                                        <td>
                                            <div class="media-box">
                                                <img src="{{ $user->getFirstMediaUrl('avatar', 'avatar') ?: asset('assets/images/user.svg') }}"
                                                    class="media-avatar img-fluid" style="height: 50px;width:50px"
                                                    alt="{{ $user->name }} img" />
                                                <div class="media-box-body">
                                                    <div class="text-truncate">{{ $user->name }}</div>
                                                    <p>ID: #{{ $user->id }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            {!! $user->status != 1
                                                ? '<span class="badge shade-red min-70">Blocked</span>'
                                                : '<span class="badge shade-green min-70">Active</span>' !!}
                                        </td>
                                        <td>{{ $user->city }}</td>
                                        <td>{{ $user->country }}</td>
                                        <td>{{ $user->postal_code }}</td>
                                        <td>
                                            <div class="actions">
                                                {{-- <a href="#" class="viewRow">
                                                    <i class="bi bi-list text-green"></i>
                                                </a> --}}
                                                <a href="{{ route('admin.users.edit', $user) }}" >
                                                    <i class="bi bi-pencil-square text-info"></i>
                                                </a>
                                                <a href="#" class="delete-btn" data-attr="{{ route('admin.users.delete', $user) }}">
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
                        {{ $users->links() }}
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
