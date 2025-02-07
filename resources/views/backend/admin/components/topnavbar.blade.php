<!--**********************************
        Main wrapper start
    ***********************************-->
<div id="main-wrapper">

    <!--**********************************
            Nav header start
        ***********************************-->
    <div class="nav-header">
        <div class="brand-logo">
            <a href="{{ url('/') }}">
                <b class="logo-abbr"><img src="{{ asset('/backendAssets/images/logo.png') }}" alt=""> </b>
                <span class="logo-compact"><img src="{{ asset('/backendAssets/images/logo-compact.png') }}"
                        alt=""></span>
                <span class="brand-title">
                    <img src="{{ asset('/backendAssets/images/logo-text.png') }}" alt="">
                </span>
            </a>
        </div>
    </div>
    <!--**********************************
            Nav header end
        ***********************************-->



    <!--**********************************
            Header start
        ***********************************-->
    <div class="header">
        <div class="header-content clearfix">

            <div class="nav-control">
                <div class="hamburger">
                    <span class="toggle-icon"><i class="icon-menu"></i></span>
                </div>
            </div>

            <div class="header-right">
                <ul class="clearfix">
                    <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                            <i class="mdi mdi-email-outline"></i>
                            @php
                            $unreadMessagesCount = App\Models\Contact::where('status', 0)->count();
                            @endphp

                            <span class="badge badge-pill gradient-1">{{ $unreadMessagesCount }}</span>
                        </a>
                        <div class="drop-down animated fadeIn dropdown-menu">
                            <div class="dropdown-content-heading d-flex justify-content-between">
                                <span class=""> New Messages</span>
                            </div>
                            <div class="dropdown-content-body">
                                <ul>
                                    @php
                                    $unreadMessages = App\Models\Contact::where('status', 0)->get();
                                    @endphp

                                    @foreach($unreadMessages as $message)
                                    <li class="notification-unread">
                                        <a href="{{ url('admin/message-detail/' . $message->id) }}">
                                            <div class="notification-content">
                                                <div class="notification-heading">{{ $message->name }}</div>
                                                <div class="notification-text">{{ Str::limit($message->message, 30)
                                                    }}...</div>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach

                                </ul>

                            </div>
                        </div>
                    </li>
                    <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                            <i class="mdi mdi-bell-outline"></i>
                            @php
                            $unreadOrdersCount = DB::table('orders')->where('read', 0)->count();
                            @endphp

                            <span class="badge badge-pill gradient-2">{{ $unreadOrdersCount }} </span>
                        </a>
                        <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                            <div class="dropdown-content-heading d-flex justify-content-between">
                                <span class=""> New Notifications</span>
                                <a href="javascript:void()" class="d-inline-block">
                                </a>
                            </div>
                            <div class="dropdown-content-body">
                                <ul>
                                    @php
                                    $unreadOrders = App\Models\Order::with('user', 'orderdetails')->where('read',
                                    0)->get();
                                    @endphp

                                    @foreach($unreadOrders as $order)
                                    <li>
                                        <a href="{{ url('admin/order-detail/' . $order->id) }}">
                                            <div class="notification-content">
                                                <h6 class="notification-heading">Order Placed by {{ $order->user->name
                                                    }}</h6>
                                                <span class="notification-text">{{ count($order->orderdetails) }}
                                                    Items</span>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach


                                </ul>

                            </div>
                        </div>
                    </li>
                    {{-- <li class="icons dropdown d-none d-md-flex">
                        <a href="javascript:void(0)" class="log-user" data-toggle="dropdown">
                            <span>English</span> <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                        </a>
                        <div class="drop-down dropdown-language animated fadeIn dropdown-menu">
                            <div class="dropdown-content-body">
                                <ul>
                                    <li><a href="javascript:void()">English</a></li>
                                    <li><a href="javascript:void()">Dutch</a </li>
                                </ul>
                            </div>
                        </div>
                    </li> --}}
                    <li class="icons dropdown">
                        <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                            <span class="activity active"></span>
                            <img src="{{ asset('/backendAssets/images/user/1.png') }}" height="40" width="40" alt="">
                        </div>
                        <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                            <div class="dropdown-content-body">
                                <ul>
                                    <li>
                                        <a href="{{ url('app-profile.html') }}"
                                            style="text-decoration: none; color:black;"><i class="icon-user"></i>
                                            <span>Profile</span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void()" style="text-decoration: none; color:black;">
                                            <i class="icon-envelope-open"></i> <span>Inbox</span>
                                            <div class="badge gradient-3 badge-pill gradient-1">3</div>
                                        </a>
                                    </li>

                                    <hr class="my-2">

                                    <li><a href="{{ url('admin/logout') }}"
                                            style="text-decoration: none; color:black;"><i class="icon-key"></i>
                                            <span>Logout</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--**********************************
            Header end
        ***********************************-->