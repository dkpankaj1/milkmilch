<x-app-layout>
    @push('breadcrumb')
    {{ Breadcrumbs::render('admin.profile') }}
    @endpush

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-sm-12 col-12">
            <div class="profile-header">
                <h1>Welcome, {{ $user->name }}</h1>
                <div class="profile-header-content">
                    <div class="profile-header-tiles">
                        <div class="row gutters">
                            <div class="col-sm-4 col-12">
                                <div class="profile-tile">
                                    <span class="icon">
                                        <i class="bi bi-pentagon"></i>
                                    </span>
                                    <h6>Name - <span>{{ $user->name }}</span></h6>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="profile-tile">
                                    <span class="icon">
                                        <i class="bi bi-inboxes"></i>
                                    </span>
                                    <h6>Email - <span>{{ $user->email }}</span></h6>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="profile-tile">
                                    <span class="icon">
                                        <i class="bi bi-phone"></i>
                                    </span>
                                    <h6>Phone - <span>{{ $user->phone }}</span></h6>
                                </div>
                            </div>
                        </div>

                        <div class="row gutters">
                            <div class="col-sm-4 col-12">
                                <div class="profile-tile">
                                    <span class="icon">
                                        <i class="bi bi-map"></i>
                                    </span>
                                    <h6>Address - <span>{{ $user->address }}</span></h6>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="profile-tile">
                                    <span class="icon">
                                        <i class="bi bi-map"></i>
                                    </span>
                                    <h6>City - <span>{{ $user->city }}</span></h6>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="profile-tile">
                                    <span class="icon">
                                        <i class="bi bi-map"></i>
                                    </span>
                                    <h6>State - <span>{{ $user->state }}</span></h6>
                                </div>
                            </div>
                        </div>

                        <div class="row gutters">
                            <div class="col-sm-4 col-12">
                                <div class="profile-tile">
                                    <span class="icon">
                                        <i class="bi bi-geo"></i>
                                    </span>
                                    <h6>Postal Code - <span>{{ $user->postal_code }}</span></h6>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="profile-avatar-tile">
                        <img src="{{auth()->user()->getFirstMediaUrl('avatar') ?: asset('assets/images/user.svg')}}" class="img-fluid" alt="Bootstrap Gallery" />
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Row end -->

    <!-- Row start -->
    {{-- <div class="row gutters">
        <div class="col-lg-8 col-sm-12 col-12">
            <!-- Row start -->
            <div class="row gutters">
                <div class="col-sm-12 col-12">
                    <!-- Card start -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Activity</div>
                        </div>
                        <div class="card-body">
                            <div class="scroll300">
                                <div class="timeline-activity">
                                    <div class="activity-log">
                                        <p class="log-name">Corey Haggard<small class="log-time">- 9
                                                mins ago</small></p>
                                        <div class="log-details">University dashboard has been
                                            created<span class="text-success ml-1"> #New</span>
                                        </div>
                                    </div>
                                    <div class="activity-log">
                                        <p class="log-name">Gleb Kuznetsov<small class="log-time">-
                                                4 hrs ago</small></p>
                                        <div class="log-details">
                                            Farewell day photos uploaded.
                                            <div class="stacked-images mt-1">
                                                <img class="sm" src="assets/images/user6.png"
                                                    alt="Admin Dashboards">
                                                <img class="sm" src="assets/images/user2.png"
                                                    alt="Admin Dashboards">
                                                <img class="sm" src="assets/images/user3.png"
                                                    alt="Admin Dashboards">
                                                <img class="sm" src="assets/images/user7.png"
                                                    alt="Admin Dashboards">
                                                <span class="plus sm">+5</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="activity-log">
                                        <p class="log-name">Emily Russell<small class="log-time">- 7
                                                hrs ago</small></p>
                                        <div class="log-details">Developed 30 multipurpose Bootstrap
                                            4 Admin Templates</div>
                                    </div>
                                    <div class="activity-log">
                                        <p class="log-name">Nathan James<small class="log-time">- 9
                                                hrs ago</small></p>
                                        <div class="log-details">Best Design Award</div>
                                    </div>
                                    <div class="activity-log">
                                        <p class="log-name">Gleb Kuznetsov<small class="log-time">-
                                                4 hrs ago</small></p>
                                        <div class="log-details">
                                            Farewell day photos uploaded.
                                            <div class="stacked-images mt-1">
                                                <img class="sm" src="assets/images/user5.png"
                                                    alt="Admin Dashboards">
                                                <img class="sm" src="assets/images/user.png" alt="Admin Dashboards">
                                                <span class="plus sm">+7</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="activity-log">
                                        <p class="log-name">Emily Russell<small class="log-time">- 3
                                                hrs ago</small></p>
                                        <div class="log-details">Developed 30 multipurpose Bootstrap
                                            4 Admin Templates</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card end -->
                </div>
            </div>
            <!-- Row end -->
        </div>
        <div class="col-lg-4 col-sm-12 col-12">
            <!-- Row start -->
            <div class="row gutters">

                <div class="col-sm-12 col-12">
                    <!-- Card start -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Orders History</div>
                        </div>
                        <div class="card-body">
                            <div class="scroll370">
                                <ul class="recent-orders">
                                    <li>
                                        <div class="order-img">
                                            <img src="assets/images/food/img5.jpg" alt="Bootstrap Gallery">
                                            <span class="badge bg-primary">Delivered</span>
                                        </div>
                                        <div class="order-details">
                                            <h5 class="order-title">Cake</h5>
                                            <p class="order-desc">Wedding cake with macarons.</p>
                                            <span class="order-date">21 mins ago</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="order-img">
                                            <img src="assets/images/food/img2.jpg" alt="Bootstrap Gallery">
                                            <span class="badge bg-warning">Processing</span>
                                        </div>
                                        <div class="order-details">
                                            <h5 class="order-title">Pasta</h5>
                                            <p class="order-desc">Cheese pasta with berries</p>
                                            <span class="order-date">10 mins ago</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="order-img">
                                            <img src="assets/images/food/img6.jpg" alt="Bootstrap Gallery">
                                            <span class="badge bg-danger">On Hold</span>
                                        </div>
                                        <div class="order-details">
                                            <h5 class="order-title">Stacker</h5>
                                            <p class="order-desc">Creamy stacker with pie</p>
                                            <span class="order-date">32 mins ago</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="order-img">
                                            <img src="assets/images/food/img4.jpg" alt="Bootstrap Gallery">
                                            <span class="badge bg-primary">Delivered</span>
                                        </div>
                                        <div class="order-details">
                                            <h5 class="order-title">Spaghetti</h5>
                                            <p class="order-desc">Cheese spaghetti with almonds</p>
                                            <span class="order-date">17 mins ago</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="order-img">
                                            <img src="assets/images/food/img7.jpg" alt="Bootstrap Gallery">
                                            <span class="badge bg-danger">On Hold</span>
                                        </div>
                                        <div class="order-details">
                                            <h5 class="order-title">Barbeque</h5>
                                            <p class="order-desc">Guilt Free BBQ chicken</p>
                                            <span class="order-date">12 mins ago</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="order-img">
                                            <img src="assets/images/food/img3.jpg" alt="Bootstrap Gallery">
                                            <span class="badge bg-warning">Processing</span>
                                        </div>
                                        <div class="order-details">
                                            <h5 class="order-title">Pecan</h5>
                                            <p class="order-desc">Homemade pecan with olives</p>
                                            <span class="order-date">15 mins ago</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Card end -->
                </div>

            </div>
            <!-- Row end -->
        </div>
    </div> --}}
    <!-- Row end -->

</x-app-layout>
