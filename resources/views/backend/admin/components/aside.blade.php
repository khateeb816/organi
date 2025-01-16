
        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    {{-- <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('./index.html') }}">Home 1</a></li>
                            <!-- <li><a href="{{ url('./index-2.html') }}">Home 2</a></li> -->
                        </ul>
                    </li> --}}
                    <li>
                        <a href="{{ url('/admin/dash') }}" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/user') }}" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">User</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/catagory') }}" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Catagory</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/brand') }}" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Brands</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
