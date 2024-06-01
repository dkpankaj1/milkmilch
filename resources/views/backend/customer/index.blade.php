<x-app-layout>
    @push('breadcrumb')
        {{ Breadcrumbs::render('admin.customers.index') }}
    @endpush

    <!-- Row start -->
    <div class="row">
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Customers</div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <a class="btn btn-success" target="_blank" href="{{route('admin.customer.export')}}">Export</a>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Search.." value="{{request()->search}}">
                                        <button type="submit" class="btn btn-light">
                                            <i class="bi bi-funnel"></i>Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive mb-3">
                        <table class="table v-middle m-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th>City</th>
                                    <th>Country</th>
                                    <th>Postal Code</th>
                                    <th>Wallet Amt ({{ $companyState->currency->symbol }})</th>
                                    <th>Rider</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($customers as $customer)
                                    <tr>

                                        <td>
                                            <div class="media-box">
                                                <img src="{{ $customer->user->avatar ?: asset('assets/images/user.svg') }}"
                                                    class="media-avatar img-fluid" style="height: 50px;width:50px"
                                                    alt="{{ $customer->user->name }} img" />
                                                <div class="media-box-body">
                                                    <div class="text-truncate">{{ $customer->user->name }}</div>
                                                    <p>ID: #{{ $customer->id }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $customer->user->phone }}</td>
                                        <td>
                                            {!! $customer->user->status != 1
                                                ? '<span class="badge shade-red min-70">Blocked</span>'
                                                : '<span class="badge shade-green min-70">Active</span>' !!}
                                        </td>
                                        <td>{{ $customer->user->city }}</td>
                                        <td>{{ $customer->user->country }}</td>
                                        <td>{{ $customer->user->postal_code }}</td>
                                        <td>{{ $customer->wallet }} </td>
                                        <td>{{ $customer->belongsRider->name }} </td>
                                        <td>
                                            <div class="actions">
                                                {{-- <a href="#" class="viewRow">
                                                    <i class="bi bi-list text-green"></i>
                                                </a> --}}
                                                <a href="{{ route('admin.customers.edit', $customer) }}">
                                                    <i class="bi bi-pencil-square text-info"></i>
                                                </a>
                                                <a href="#" class="delete-btn"
                                                    data-attr="{{ route('admin.customers.delete', $customer) }}">
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
                        {{ $customers->links() }}
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
