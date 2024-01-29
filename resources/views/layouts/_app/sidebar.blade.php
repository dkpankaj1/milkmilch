<div class="sidebar-menu">
    <div class="sidebarMenuScroll">
        <ul>
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-house"></i>
                    <span class="menu-text">Dashboards</span>
                </a>
            </li>

            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="bi bi-handbag"></i>
                    <span class="menu-text">Product</span>
                </a>
                <div class="sidebar-submenu">
                    <ul>
                        {{-- <li>
                            <a href="layout.html">Product List</a>
                        </li>--}}
                        <li>
                            <a href="{{ route('admin.products.index') }}">Product</a>
                        </li> 

                        <li>
                            <a href="{{ route('admin.categories.index') }}">Categories List</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="sidebar-dropdown">
                <a href="#">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-buildings" viewBox="0 0 16 16">
                            <path
                                d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022M6 8.694 1 10.36V15h5zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5z" />
                            <path
                                d="M2 11h1v1H2zm2 0h1v1H4zm-2 2h1v1H2zm2 0h1v1H4zm4-4h1v1H8zm2 0h1v1h-1zm-2 2h1v1H8zm2 0h1v1h-1zm2-2h1v1h-1zm0 2h1v1h-1zM8 7h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zM8 5h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zm0-2h1v1h-1z" />
                        </svg>
                    </i>
                    <span class="menu-text">Milk Fectory</span>
                </a>
                <div class="sidebar-submenu">
                    <ul>

                        <li>
                            <a href="{{ route('admin.milk-purchases.index') }}">Milk Purchase</a>
                        </li>

                        <li>
                            <a href="{{ route('admin.milks.index') }}">Milk Categories</a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- @role('admin') --}}

            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="bi bi-people"></i>
                    <span class="menu-text">Customer</span>
                </a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="{{ route('admin.customers.create') }}">Add New</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.customers.index') }}">List</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="bi bi-people"></i>
                    <span class="menu-text">Supplier</span>
                </a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="{{ route('admin.suppliers.create') }}">Add New</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.suppliers.index') }}">List</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="bi bi-person"></i>
                    <span class="menu-text">Rider</span>
                </a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="{{ route('admin.riders.create') }}">Add New</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.riders.index') }}">List</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="bi bi-person-workspace"></i>
                    <span class="menu-text">User</span>
                </a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="{{ route('admin.users.create') }}">Add New</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index') }}">List</a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- @endrole --}}

            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="bi bi-sliders"></i>
                    <span class="menu-text">Master</span>
                </a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="{{ route('admin.units.index') }}">Unit Master</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.currencies.index') }}">Currency Master</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.companys.index') }}">Company Master</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <a href="#">
                    <i class="bi bi-hand-index-thumb"></i>
                    <span class="menu-text">Upgrade</span>
                </a>
            </li>
        </ul>
    </div>
</div>
