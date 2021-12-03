@php

$profileimage = Auth::user()->profileimage;
$segment = Request::segment(2); 
@endphp

        <aside class="col-lg-4 pt-4 pt-lg-0">

        <div class="cz-sidebar-static rounded-lg box-shadow-lg px-0 pb-0 mb-5 mb-lg-0">

            <div class="px-4 mb-4">

              <div class="media align-items-center">

                <div class="img-thumbnail rounded-circle position-relative" style="width: 6.375rem;">

                  @if(!empty($profileimage))

                  <img class="rounded-circle" src="{{ asset(env('CUSTOMER_IMAGE'))}}/{{ $profileimage }}" alt="{{Auth::user()->name}}">

                  @else

                 <img class="rounded-circle" src="{{ asset('frontend/images/avatar.png') }}" alt="{{Auth::user()->name}}">

                  @endif

                	

                 </div>

                <div class="media-body pl-3">

                  <h3 class="font-size-base mb-0">{{Auth::user()->name}}</h3><span class="text-accent font-size-sm">{{Auth::user()->email}}</span>

                </div>

              </div>

            </div>

            <div class="bg-secondary px-4 py-3">

              <h3 class="font-size-sm mb-0 text-muted">Dashboard</h3>

            </div>

            <ul class="list-unstyled mb-0">

              <li class="border-bottom mb-0">

              	<a class="nav-link-style d-flex align-items-center px-4 py-3 @if($segment == 'orders') active @endif" href="{{ URL::to('customer/orders') }}">

              	<i class="fa fa-cart-plus" aria-hidden="true"></i><div class="titles">Orders</div></a>

              </li>

              <li class="border-bottom mb-0">

                <a class="nav-link-style d-flex align-items-center px-4 py-3 @if($segment == 'testimonials') active @endif" href="{{ URL::to('customer/testimonials') }}">

                  <i class="fa fa-heart" aria-hidden="true"></i>

                  <div class="titles">Testimonials</div></a>

              </li>


            </ul>

            <div class="bg-secondary px-4 py-3">

              <h3 class="font-size-sm mb-0 text-muted">Account settings</h3>

            </div>

            <ul class="list-unstyled mb-0">

              <li class="border-bottom mb-0">

              	<a class="nav-link-style d-flex align-items-center px-4 py-3 @if($segment == 'account') active @endif" href="{{ URL::to('customer/account') }}">

              		<i class="fa fa-user-o" aria-hidden="true"></i>

              	    <div class="titles">Profile info</div></a>

              </li>

              <li class="border-bottom mb-0">

              	<a class="nav-link-style d-flex align-items-center px-4 py-3 @if($segment == 'addresses') active @endif" href="{{ URL::to('customer/addresses') }}">

              		<i class="fa fa-map-marker" aria-hidden="true"></i>

              	    <div class="titles">Addresses</div></a>

              </li>

              <li class="border-bottom mb-0">

              	<a class="nav-link-style d-flex align-items-center px-4 py-3 @if($segment == 'custompaynow') active @endif" href="{{ URL::to('customer/custompaynow') }}">

              		<i class="fa fa-credit-card-alt" aria-hidden="true"></i>

              	    <div class="titles">pay online</div></a>

              </li>

              <li class="border-bottom mb-0">

              	<a href="{{ URL::to('customer/logout') }}" class="nav-link-style d-flex align-items-center px-4 py-3 @if($segment == 'logout') active @endif" href="">

              		<i class="fa fa-sign-out" aria-hidden="true"></i>

              	    <div class="titles">Sign out</div></a>

              </li>

              

            </ul>

          </div>

        </aside>