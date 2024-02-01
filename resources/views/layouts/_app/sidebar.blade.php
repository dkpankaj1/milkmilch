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
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                          </svg>
                    </i>
                    <span class="menu-text">Sell</span>
                </a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="{{ route('admin.sells.create') }}">New Sells</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.sells.index') }}">Sells list</a>
                        </li>
                    </ul>
                </div>
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
                        </li> --}}
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
                            <a href="{{ route('admin.milk-storage.index') }}">Milk Storage</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.milk-purchases.index') }}">Milk Purchase</a>
                        </li>

                        <li>
                            <a href="{{ route('admin.milks.index') }}">Milk Categories</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="sidebar-dropdown">
                <a href="#">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-diagram-3" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5zM0 11.5A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm4.5.5A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                        </svg>
                    </i>
                    <span class="menu-text">Stock</span>
                </a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="{{ route('admin.batches.create') }}">Add Batch</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.batches.index') }}">Batch list</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.stocks.index') }}">Stock list</a>
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
