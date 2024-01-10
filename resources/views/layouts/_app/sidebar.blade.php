<div class="sidebar-menu">
    <div class="sidebarMenuScroll">
        <ul>
            <li>
                <a href="{{route('admin.dashboard')}}">
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
                        <li>
                            <a href="layout.html">Product List</a>
                        </li>
                        <li>
                            <a href="layout.html">Product Add</a>
                        </li>

                        <li>
                            <a href="{{route('admin.categories.index')}}">Categories List</a>
                        </li>
                        <li>
                            <a href="{{route('admin.categories.create')}}">Categories Add</a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- @role('admin') --}}

            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="bi bi-people"></i>
                    <span class="menu-text">Supplier Setting</span>
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
                    <span class="menu-text">Rider Setting</span>
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
                    <span class="menu-text">User Setting</span>
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
                <a href="starter-page.html">
                    <i class="bi bi-hand-index-thumb"></i>
                    <span class="menu-text">Link</span>
                </a>
            </li>
        </ul>
    </div>
</div>