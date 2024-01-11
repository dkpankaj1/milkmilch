<div class="sidebar-menu">
    <div class="sidebarMenuScroll">
        <ul>
            <li>
                <a href="{{route('admin.dashboard')}}">
                    <i class="bi bi-house"></i>
                    <span class="menu-text">Dashboards</span>
                </a>
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
                            <a href="{{route('admin.customers.create')}}">Add New</a>
                        </li>
                        <li>
                            <a href="{{route('admin.customers.index')}}">List</a>
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
                            <a href="{{route('admin.suppliers.create')}}">Add New</a>
                        </li>
                        <li>
                            <a href="{{route('admin.suppliers.index')}}">List</a>
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
                            <a href="{{route('admin.riders.create')}}">Add New</a>
                        </li>
                        <li>
                            <a href="{{route('admin.riders.index')}}">List</a>
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
                            <a href="{{route('admin.users.create')}}">Add New</a>
                        </li>
                        <li>
                            <a href="{{route('admin.users.index')}}">List</a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- @endrole --}}
            <li>
                <a href="#">
                    <i class="bi bi-hand-index-thumb"></i>
                    <span class="menu-text">Help</span>
                </a>
            </li>
        </ul>
    </div>
</div>