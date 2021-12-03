        <!-- Navigation Bar-->

        <header id="topnav">

            <div class="topbar-main">

                <div class="container">



                    <!-- LOGO -->

                    <div class="topbar-left">

                        <a href="#" class="logo">

                            <i class="zmdi zmdi-group-work icon-c-logo"></i>

                            <span>DAZZLE KNOTS</span>

                        </a>

                    </div>

                    <!-- End Logo container-->





                    <div class="menu-extras navbar-topbar">



                        <ul class="list-inline float-right mb-0">



                            <li class="list-inline-item">

                                <!-- Mobile menu toggle-->

                                <a class="navbar-toggle">

                                    <div class="lines">

                                        <span></span>

                                        <span></span>

                                        <span></span>

                                    </div>

                                </a>

                                <!-- End mobile menu toggle-->

                            </li>



                            <li class="list-inline-item dropdown notification-list">

                               

                                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">

                                    <!-- item-->

                                    <div class="dropdown-item noti-title">

                                        <h5><small><span class="label label-danger float-right">7</span>Notification</small></h5>

                                    </div>



                                    <!-- item-->

                                    



                                    <!-- item-->

                                    <a href="javascript:void(0);" class="dropdown-item notify-item">

                                        <div class="notify-icon bg-info"><i class="icon-user"></i></div>

                                        <p class="notify-details">New user registered.<small class="text-muted">1min ago</small></p>

                                    </a>



                                    <!-- item-->

                                    <a href="javascript:void(0);" class="dropdown-item notify-item">

                                        <div class="notify-icon bg-danger"><i class="icon-like"></i></div>

                                        <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">1min ago</small></p>

                                    </a>



                                    <!-- All-->

                                    <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">

                                        View All

                                    </a>



                                </div>

                            </li>



                            <li class="list-inline-item dropdown notification-list">

                               

                                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-arrow-success dropdown-lg" aria-labelledby="Preview">

                                    <!-- item-->

                                    <div class="dropdown-item noti-title bg-success">

                                        <h5><small><span class="label label-danger float-right">7</span>Messages</small></h5>

                                    </div>



                                    <!-- item-->

                                    <a href="javascript:void(0);" class="dropdown-item notify-item">

                                        <div class="notify-icon bg-faded">

                                            <img src="assets/images/users/avatar-2.jpg" alt="img" class="rounded-circle img-fluid">

                                        </div>

                                        <p class="notify-details">

                                            <b>Robert Taylor</b>

                                            <span>New tasks needs to be done</span>

                                            <small class="text-muted">1min ago</small>

                                        </p>

                                    </a>



                                    <!-- item-->

                                    <a href="javascript:void(0);" class="dropdown-item notify-item">

                                        <div class="notify-icon bg-faded">

                                            <img src="assets/images/users/avatar-3.jpg" alt="img" class="rounded-circle img-fluid">

                                        </div>

                                        <p class="notify-details">

                                            <b>Carlos Crouch</b>

                                            <span>New tasks needs to be done</span>

                                            <small class="text-muted">1min ago</small>

                                        </p>

                                    </a>



                                    <!-- item-->

                                    <a href="javascript:void(0);" class="dropdown-item notify-item">

                                        <div class="notify-icon bg-faded">

                                            <img src="assets/images/users/avatar-4.jpg" alt="img" class="rounded-circle img-fluid">

                                        </div>

                                        <p class="notify-details">

                                            <b>Robert Taylor</b>

                                            <span>New tasks needs to be done</span>

                                            <small class="text-muted">1min ago</small>

                                        </p>

                                    </a>



                                    <!-- All-->

                                    <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">

                                        View All

                                    </a>



                                </div>

                            </li>



                            <li class="list-inline-item dropdown notification-list">

                                

                            </li>



                            <li class="list-inline-item dropdown notification-list">

                                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"

                                   aria-haspopup="false" aria-expanded="false">

                                    <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user" class="rounded-circle">

                                </a>

                                <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">

                                    <!-- item-->

                                    <div class="dropdown-item noti-title">

                                        <h5 class="text-overflow"><small>Welcome ! {{Auth::guard('admin')->user()->name}}</small> </h5>

                                    </div>



                                    <!-- item-->

                                    <a href="{{ URL::to('manage/changepassword') }}" class="dropdown-item notify-item">

                                        <i class="zmdi zmdi-account-circle"></i> <span>Change Password</span>

                                    </a>

                                    <!-- item-->

                                    <a href="{{ URL::to('manage/logout') }}" class="dropdown-item notify-item">

                                        <i class="zmdi zmdi-power"></i> <span>Logout</span>

                                    </a>



                                </div>

                            </li>



                        </ul>



                    </div> <!-- end menu-extras -->

                    <div class="clearfix"></div>



                </div> <!-- end container -->

            </div>

            <!-- end topbar-main -->





            <div class="navbar-custom">
                <div class="container">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                            <li>
                                <a href="{{ URL::to('manage/dashboard') }}"><i class="zmdi zmdi-view-dashboard"></i> 
                                    <span style="font-size: 9px;">Dashboard</span> </a>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="zmdi zmdi-format-underlined"></i> 
                                    <span style="font-size: 9px;">Catalog</span> </a>
                                <ul class="submenu megamenu">
                                    <li>
                                        <ul>
                                            <li><a href="{{ URL::to('manage/categories') }}">categories</a></li>
                                            <li><a href="{{ URL::to('manage/products') }}">Products Luxury</a></li>
                                            <li><a href="{{ URL::to('manage/normalproducts') }}">Products Normal</a></li>
                                            <li><a href="{{ URL::to('manage/offers') }}">Offers</a></li>
                                            <li><a href="{{ URL::to('manage/coupons') }}">Coupons</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ URL::to('manage/banner') }}"><i class="zmdi zmdi-view-dashboard"></i> 
                                <span style="font-size: 9px;">Banner Mangement</span> 
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::to('manage/segments') }}"><i class="zmdi zmdi-case"></i> 
                                    <span style="font-size: 9px;"> Segment Mangement </span> </a>
                            </li>
                            <li>
                                <a href="{{ URL::to('manage/orders') }}"><i class="zmdi zmdi-case"></i> 
                                    <span style="font-size: 9px;"> Order Mangement </span> </a>
                            </li>
                            <li>
                                <a href="{{ URL::to('manage/customdesigning') }}"><i class="zmdi zmdi-case"></i> 
                                    <span style="font-size: 9px;">Custom Design</span> </a>
                            </li>
                            <li>
                                <a href="{{ URL::to('manage/pages') }}"><i class="zmdi zmdi-case"></i> 
                                    <span style="font-size: 9px;">CMS pages</span> </a>
                            </li>
                            <li>
                                <a href="{{ URL::to('manage/notification') }}"><i class="zmdi zmdi-case"></i> 
                                    <span style="font-size: 9px;">Notification</span> </a>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="zmdi zmdi-format-underlined"></i> 
                                    <span style="font-size: 9px;"> Masters </span> </a>
                                <ul class="submenu megamenu">
                                    <li>
                                        <ul>
                                            <li><a href="{{ URL::to('manage/colours') }}">Colours</a></li>
                                            <li><a href="{{ URL::to('manage/size') }}">Size</a></li>
                                            <li><a href="{{ URL::to('manage/dresstype') }}">Dress Type</a></li>
                                            <li><a href="{{ URL::to('manage/dressmaterial') }}">Dress Material</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>


                        </ul>

                        <!-- End navigation menu  -->

                    </div>

                </div>

            </div>

        </header>

        <!-- End Navigation Bar-->