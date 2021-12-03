 <!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}"/>

        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/owl-slider.css') }}"/>

        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/settings.css') }}"/>

        <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.png') }}" />

        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,500,700,300' rel='stylesheet' type='text/css'>

        <script type="text/javascript" src="{{ asset('frontend/js/jquery-1.11.1.min.js') }}"></script>

        <title>::Dazzle Knots</title>

        <style type="text/css">
        select{
          width: 85px;
          height: 30px;
          padding: 5px;
          color: #9d9d9d;
          margin-left: 14px;
        }
        select option { color: #9d9d9d; }
        select option:first-child{
          color:#9d9d9d;
        }
        .customalert {
            background-color: #D4AF37;
            border-color: #d6e9c6;
            color: #000000;
        }
        </style>

    </head>

    <body>

    <div id="preloader">

        <div class="sk-cube-grid">

          <div class="sk-cube sk-cube1"></div>

          <div class="sk-cube sk-cube2"></div>

          <div class="sk-cube sk-cube3"></div>

          <div class="sk-cube sk-cube4"></div>

          <div class="sk-cube sk-cube5"></div>

          <div class="sk-cube sk-cube6"></div>

          <div class="sk-cube sk-cube7"></div>

          <div class="sk-cube sk-cube8"></div>

          <div class="sk-cube sk-cube9"></div>

        </div>

    </div>



    @php

    

    if(!empty(Auth::user())){
    $carts = DB::table('carts')
            ->select('products.Id','products.product_name','products.product_price','carts.quantity','carts.id AS cartId','productId')
             ->join('products', 'carts.productId', '=', 'products.Id')
              ->where('product_quantity' ,'>',0)
             ->where('carts.UserId',Auth::user()->id)
             ->get();
               
              $offerswhole = DB::table('offers')->where('type','=','wholewebsite')->first(); 
        
    } else {
    $carts = '';
    }
     
     $grandtotal = [];
    @endphp
    @if(!empty(Auth::user()))
    <div class="pushmenu pushmenu-left cart-box-container">
        <div class="cart-list">
            <span id="close-pushmenu">Close</span>
            <ul class="list">
                @foreach($carts as $cart)
                @php
                 $offers = DB::table('offers')->where('productid',$cart->productId)->first();
                  if(!empty($offers))
        {
       $disc =$offers ->percentage;
       $offeramt =$cart->product_price - ($cart->product_price * ( $offers ->percentage/100));
        }       
                 
        elseif(!empty($offerswhole))
        {
       $disc = $offerswhole->percentage;
       $offeramt =$cart->product_price - ($cart->product_price * ( $disc/100));
        }
        else{
         $offeramt= $cart->product_price;
        }
                $image = DB::table('productsimages')
                         ->select('image_url')
                         ->where('productId',$cart->Id)
                         ->first();
                 $grandtotal[] = $offeramt * $cart->quantity;
                @endphp
                <li>
                    <a href="Product Details.html" title="" class="cart-product-image"><img src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image->image_url }}" alt="Product"></a>
                    <div class="text" >
                        <p class="product-name" style="font-size: 9px;">{{$cart->product_name}}</p>
                        <p class="product-price">{!! Helper::currency_conversion( $offeramt) !!}</p>  
                        <p class="qty">QTY:{{$cart->quantity}}</p>  
                        <a href="{{ URL::to('customer/deleteitem/'.Crypt::encrypt($cart->cartId)) }}" class="delete-item"></a>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="cart-bottom">
                <p class="total"><span>Subtotal:</span> {!! \Helper::currency_conversion(array_sum($grandtotal)); !!}</p>
                <a class="checkout" href="{{ URL::to('customer/checkout') }}" title="">Check out <i class="link-icon-white"></i></a>
                <a class="edit-cart" href="{{ URL::to('customer/carts/') }}" title="edit cart">Edit cart</a>
            </div>
            <!-- End cart bottom -->
        </div>

    </div>

    @else 
    @php
    $sessionid = Session::get('sessionid'); 
    $carts = DB::table('quest_cart')
            ->select('quest_cart.id','products.Id','products.product_name','products.product_price','quest_cart.quantity','quest_cart.price','products.product_type','productId')
             ->join('products', 'quest_cart.productId', '=', 'products.Id')
              ->where('product_quantity' ,'>',0)
             ->where('quest_cart.sessionid',$sessionid)
             ->get(); 
    @endphp
    <div class="pushmenu pushmenu-left cart-box-container">
        <div class="cart-list">
            <span id="close-pushmenu">Close</span>
            <ul class="list">
                @foreach($carts as $cart)
                @php
                   $offers = DB::table('offers')->where('productid',$cart->productId)->first();
                  if(!empty($offers))
        {
       $disc =$offers ->percentage;
       $offeramt =$cart->product_price - ($cart->product_price * ( $offers ->percentage/100));
        }       
                 
        elseif(!empty($offerswhole))
        {
       $disc = $offerswhole->percentage;
       $offeramt =$cart->product_price - ($cart->product_price * ( $disc/100));
        }
        else{
         $offeramt= $cart->product_price;
        }
                $image = DB::table('productsimages')
                         ->select('image_url')
                         ->where('productId',$cart->Id)
                         ->first();
                 $grandtotal[] =  $offeramt * $cart->quantity;
                @endphp
                <li>
                    @if($cart->product_type == 'normal')
                    <a href="{{ URL::to('productdetail/'.Crypt::encrypt($cart->Id)) }}" title="" class="cart-product-image"><img src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image->image_url }}" alt="Product"></a>
                    @else
                    <a href="{{ URL::to('luxury/'.Crypt::encrypt($cart->Id)) }}" title="" class="cart-product-image"><img src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image->image_url }}" alt="Product"></a>
                    @endif
                    
                    <div class="text" >
                        <p class="product-name" style="font-size: 9px;">{{$cart->product_name}}</p>
                        <!-- <p class="product-price">${{$cart->product_price}}</p> -->
                        <p class="product-price">{!! Helper::currency_conversion( $offeramt) !!}</p>
                        <p class="qty">QTY:{{$cart->quantity}}</p>
                        <a href="{{ URL::to('customer/deleteitem/'.Crypt::encrypt($cart->id)) }}" class="delete-item"></a>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="cart-bottom">
                <p class="total"><span>Subtotal:</span> {!! \Helper::currency_conversion(array_sum($grandtotal)); !!}</p> 
                <a class="checkout" href="{{ URL::to('customer/checkout') }}" title="">Check out <i class="link-icon-white"></i></a>
                <a class="edit-cart" href="{{ URL::to('customer/carts/') }}" title="edit cart">Edit cart</a>
            </div>

        </div>
    </div>
    @endif

    <!-- End cart -->



    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>

                    <h4 class="modal-title" id="myLargeModalLabel">Search Here</h4>

                </div>

                <div class="modal-body">
                    <form method="post" class="search_form" action="{{ URL::to('productsearch') }}">
                        {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" class="form-control control-search" name="keyword" placeholder="Type & hit enter...">
                          <span class="input-group-btn">
                            <button class="btn btn-default button_search" type="button"><i data-toggle="dropdown" class="icons icon-magnifier dropdown-toggle"></i></button>

                          </span>

                    </div><!-- /input-group -->
                    </form>



                </div>

            </div><!-- /.modal-content -->

        </div><!-- /.modal-dialog -->

    </div>

    <!-- End pushmenu -->

    <div class="wrappage">

        <header id="header" class="header-v1 header-top-absolute">

            <div id="topbar">

                <div class="container">

                    <div class="topbar-left">

                        <div class="social">

                            <a href="#" title="twitter"><i class="fa fa-twitter"></i></a>

                            <a href="#" title="facebook"><i class="fa fa-facebook"></i></a>

                            <a href="#" title="google plus"><i class="fa fa-google-plus"></i></a>

                            <a href="#" title="pinter"><i class="fa fa-pinterest-p"></i></a>

                            <a href="#" title="rss"><i class="fa fa-rss"></i></a>

                        </div>

                        <!-- End Social -->

                    </div>

                    <!-- End topBar-left -->

                    <div class="topbar-right">

                        <div class="sign-in">

                            <a href="mailto:info@dazzleknots.ca" title="info@dazzleknots.ca"><i class="icons icon-envelope"></i><span>info@dazzleknots.ca</span></a>

                             @if(!empty(Auth::user()))

                             <a href="{{ URL::to('customer/account') }}" title="login"><i class="icon-user icons"></i><span>My Account</span></a>

                             @else

                             <a href="{{ URL::to('loginregister') }}" title="login"><i class="icon-user icons"></i><span>Login</span></a>

                             @endif

                             

                            <a href="{{ URL::to('customer/wishlist') }}" title="wishlist"><i class="icon-heart icons"></i><span>Wishlist</span></a>
                            
                            

                             

                            <div class="search dropdown" data-toggle="modal" data-target=".bs-example-modal-lg">

                                <i class="icons icon-magnifier dropdown-toggle"></i><span>Search</span>

                            </div>

                            @php
                            $curr = Session::get('currency'); 
                            $basecurr = env('BASE_CURR');
                            @endphp

                            <select name="currencyid" id="currencyid">
                                @if(empty($curr))
                                <option value="cad" selected>CAD</option>
                                <option value="usd">USD</option>
                                @else
                                @php 
                                $code = strtolower($curr);
                                @endphp
                                <option value="cad" @if($code == 'cad') selected    @endif>CAD</option>
                                <option value="usd" @if($code == 'usd') selected    @endif>USD</option>
                                @endif
                                
                                </select>

                            <!-- End search -->

                        </div>

                        <!-- End SignIn -->

                    </div>

                    <!-- End topbar-right -->

                </div>

                <!-- End container -->

            </div>

            <!-- End Top Bar -->
@php
$notification = DB::table('notification')->first(); 
$segment = Request::segment(2); 
$status = session()->get('noti_status'); 
$id = session()->get('noti_id'); 
@endphp
@if(!empty($notification) && empty($segment))
    @if($status !='disable' && $id !=$notification->id )
    <input type="hidden" id="notificationid" value="{{ $notification->id }}">
    <div class="alert alert-success alert-dismissible customalert">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {{$notification->notification_text}}
    </div>
    @endif
 
@endif

            <div class="header-top">

                <div class="container">

                    <div class="col-md-11 col-sm-11 col-xs-11">

                        <p class="icon-menu-mobile"><i class="fa fa-bars"></i></p>

                        <div class="logo">

                            <a href="{{url('/')}}" title="Uno">

                                <img src="{{ asset('frontend/images/dlogo.png') }}" alt="images" style="width: 165px;">

                            </a>

                        </div>

                        <div class="logo-mobile"><a href="{{url('/')}}" title="Uno"><img src="{{ asset('frontend/images/dlogo.png') }}" style="width: 175px;"></a></div>

                        <nav class="mega-menu" style="margin-left: -54px !important;margin-top: 7px;">

                            <ul class="nav navbar-nav" id="navbar">
                                <li class="level1">
                                    <a href="{{url('/')}}">HOME</a>
                                </li>

                                @php
                              
                                $prodcuts=  DB::table('products')->join('productscategories', 'products.Id', '=', 'productscategories.productId')->where('products.product_status','enabled')->where('product_type','normal')->pluck('categoryId');  
                                
                                 $maincat = DB::table('category')->where('parentId','=',0)
                                 ->whereIn('id',$prodcuts)
                                           ->where('menu_order','!=','Null')
                                           ->orderBy('menu_order', 'ASC')->get();
                                @endphp
                                @foreach($maincat as $cat)
                                @php 
                                $parentid = $cat->Id; 
                                $categorytype = $cat->category_type;
                                
                                  $subprodcuts=  DB::table('products')->join('productscategories', 'products.Id', '=', 'productscategories.productId')->where('products.product_status','enabled')->where('product_type','normal')->pluck('subcategoryId');    
                                $subcategories = DB::table('category')->where('parentId','=',$parentid)
                                 ->whereIn('id',$subprodcuts)->get();
                                
                                
                                
                                $featuredmenu = DB::table('menufeatured')->where('catid','=',$parentid)->get();
                                @endphp
                                @if($categorytype == 'normal')
                             
                                @elseif($categorytype == 'category_withleftimage')
                                 <li class="level1 dropdown">
                                    <a href="{{ URL::to('childproducts/') }}">{{$cat->category}}</a>
                                    <div class="sub-menu dropdown-menu">
                                        <ul class="menu-level-1">
                                             <li class="level2">
                                               {{$cat->category}}
                                                 @foreach($subcategories as $subcat)
                                                @php $subcatid = $subcat->Id; 
                                                
                                           $subprodcuts=  DB::table('products')->join('productscategories', 'products.Id', '=', 'productscategories.productId')->where('products.product_status','enabled')->where('product_type','normal')->pluck('subcategoryId');       
                                                
                                                $subscategory = DB::table('category')
                                                                 ->where('parentId','=',$subcatid)
                                                                 ->where('menu_order','!=','Null')
                                                                 ->orderBy('menu_order', 'DESC')
                                         ->whereIn('id',$subprodcuts)
                                                                 ->get();
                                                @endphp
                                                 <ul class="menu-level-1">
                                                   
                                                    <li class="level3">
                                                        <a class="subcatchild" href="{{ URL::to('productlisting/'.Crypt::encrypt($subcatid)) }}" title="Shop_Catalog Standar" data-id="{{$subcatid}}">{{$subcat->category}}</a></li>
                                                    
                                                </ul>
                                                 @endforeach
                                            </li>
                                            <li class="level2">
                                                
                                                <img class="childimage"  style="margin-top: 15px;margin-left: 429px;height: 245px;width: 162px;display: none;" src="" alt="Sub-Menu" />
                                               
                                            </li>
                                            </li> 
                                        </ul>
                                    </div>
                                </li>
                                @endif
                                <!-- @if($cat->category == 'Kids')
                                <li class="level1 dropdown">
                                    <a href="{{ URL::to('childproducts/') }}">{{$cat->category}}</a>
                                    <div class="sub-menu dropdown-menu">
                                        <ul class="menu-level-1">
                                             <li class="level2">
                                                <a href="#">{{$cat->category}}</a>
                                                 @foreach($subcategories as $subcat)
                                                @php $subcatid = $subcat->Id; 
                                                $subscategory = DB::table('category')->where('parentId','=',$subcatid)->get();
                                                @endphp
                                                 <ul class="menu-level-2">
                                                   
                                                    <li class="level3"><a class="subcatchild" href="{{ URL::to('productlisting/'.Crypt::encrypt($subcatid)) }}" title="Shop_Catalog Standar" data-id="{{$subcatid}}">{{$subcat->category}}</a></li>
                                                    
                                                </ul>
                                                 @endforeach
                                            </li>
                                            <li class="level2">
                                                
                                                <img class="childimage"  style="margin-top: 15px;margin-left: 429px;height: 245px;width: 162px;display: none;" src="" alt="Sub-Menu" />
                                               
                                            </li>
                                            </li> 
                                        </ul>
                                    </div>
                                </li>
                                @else
                                <li class="level1 dropdown">
                                    <a href="{{ URL::to('womenproducts/') }}">{{$cat->category}}</a>
                                    <div class="sub-menu dropdown-menu">
                                        <ul class="menu-level-1">
                                            @foreach($subcategories as $subcat)
                                            @php $subcatid = $subcat->Id; 
                                            $subscategory = DB::table('category')->where('parentId','=',$subcatid)->get();
                                            @endphp
                                            <li class="level2">
                                                <a href="#">{{$subcat->category}}</a>
                                                <ul class="menu-level-2">
                                                    @foreach($subscategory as $submenu)
                                                    <li class="level3"><a class="subcat" href="{{ URL::to('productlisting/'.Crypt::encrypt($submenu->Id)) }}" title="Shop_Catalog Standar" data-id="{{$submenu->Id}}">{{ $submenu->category }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @endforeach
                                            <li class="level2">
                                               
                                                <img class="womenimage" style="margin-top: 18px;margin-left: 150px;height: 215px;width: 162px;display: none;" src="" />
                                               
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @endif -->

                                

                                @endforeach
                              
                                @php
                                $hide = DB::table('products')->where('product_type', 'luxury')->where('product_status','enabled')->count();
                             
                                @endphp
                                @if($hide>0 )
                                   
                                  
                                    <li class="level1 ">
                                    <a href="{{ URL::to('luxury') }}">Luxury </a>
                                    </li>
                                   
                                @else
                                <!--<li class="level1 ">-->
                                <!--    <a href="{{ URL::to('luxury') }}">Luxury </a>-->
                                <!--</li>-->
                                @endif
                                

                            
                                <li class="level1 ">
                                    <a href="{{ URL::to('customdesigning') }}">Custom Design</a>
                                </li>
                                <li class="level1 ">
                                    <a href="{{ URL::to('testimonial') }}">Testimonials</a>
                                </li>

                                <li class="level1 ">
                                    <a href="{{ URL::to('deals') }}">Deals</a>
                                </li>



                               <!--  <li class="level1 ">

                                    <a href="Contact us.html" title="collections">Contact us</a>

                                </li> -->







                            </ul>

                        </nav>

                    </div>

                    

                    <div class="col-md-1 col-sm-1 col-xs-1">

                        <div class="cart" style="margin-top: 18px;">

                            <p class="icon-cart">

                                <i class="icons icon-bag"></i>

                                <span class="cart-count">{{ count($carts)  }}</span>

                            </p>

                        </div>

                        <!-- End cart -->

                    </div>

                    

                </div>

                <!-- End container -->

            </div>

            <!-- End header-top -->

        </header><!-- /header -->

         @yield('content')

        <footer id="footer" class="footer-v1 footer-v3 space-50">

            <div class="container">

                <div class="footer-top">

                    <div class="col-md-6">

                        <div class="col-md-6 wrap-logo">

                            <div class="logo-footer"><a href="#" title="Logo">Dazzleknots</a></div>

                            <p>5373 Fraser Hwy</p>

                            <p>Suite 220, Surrey, BC V3R 3P3</p>

                            <p>Canada</p>

                        </div>

                        <div class="col-md-6">

                            <div class="footer-title">

                                <h3>SUBSCRIBE</h3>

                            </div>

                            <div class="newsletter-footer">

                                <form accept-charset="utf-8" method="post" action="{{ URL::to('subscription/') }}">
                                    {{ csrf_field() }}
                                    <input type="text" name="email" id="newsletter" title="Sign up for our newsletter" class="input-text required-entry validate-email" value="Enter adress..." onfocus="if(this.value != '') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Enter adress...';}">

                                    <button type="submit" title="Send" class="button button1 hover-white">Send<i class="link-icon-white"></i></button>
                                </form>

                            </div>

                            <!-- End newsletter -->

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="col-md-4">

                            <div class="footer-title">

                                <h3>INFORMATION</h3>

                            </div>

                           <ul>

                                <li><a href="{{ URL::to('help') }}" title="help">Help</a></li>

                                <li><a href="{{ URL::to('termsandconditions') }}" title="Jobs">Terms and Conditions</a></li>

                                <li><a href="{{ URL::to('privacypolicy') }}" title="about">Privacy Policy</a></li>

                                <li><a href="{{ URL::to('returnpolicy') }}" title="about">Return Policy</a></li>

                                <li><a href="{{ URL::to('deliverypolicy') }}" title="about">Delivery Policy</a></li>

                            </ul>

                        </div>

                        <div class="col-md-4">

                            <div class="footer-title">

                                <h3>INFORMATION</h3>

                            </div>

                            <ul>

                                <li><a href="{{ URL::to('aboutus') }}" title="help">About</a></li>

                                <li><a href="{{ URL::to('loginregister') }}" title="">Signup / Sign in</a></li>

                               <!--  <li><a href="#" title="help">Sign in</a></li> -->

                                <li><a href="{{ URL::to('customdesigning') }}" title="help">Customize your dress</a></li>

                                <li><a href="{{ URL::to('contactus') }}" title="help">Contact</a></li>

                            </ul>

                        </div>

                        <div class="col-md-4">

                            <div class="footer-title">

                                <h3>FOLLOW</h3>

                            </div>

                            <ul class="follow">

                                <li class="twitter"><i class="fa fa-twitter"></i><a href="#" title="twitter">Twitter</a></li>

                                <li class="facebook"><i class="fa fa-facebook"></i><a href="#" title="twitter">Facebook</a></li>

                                <li class="instagram"><i class="fa fa-instagram"></i><a href="#" title="twitter">Instagram</a></li>

                                <li class="pinterest"><i class="fa fa-pinterest"></i><a href="#" title="twitter">Pinterest</a></li>

                            </ul>

                        </div>

                    </div>

                </div>

                <!-- End footer-top -->

                <div class="footer-bottom">

                    <p>&copy; 2020 Dazzleknots. Powered by <a href="#" title="Daddycool">DaddyCool</a></p>

                </div>

                <!-- End footer-bottom -->

            </div>

            <!-- End container -->

        </footer>



    </div>

    <!-- End wrappage -->

    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('frontend/js/jquery.themepunch.revolution.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('frontend/js/jquery.themepunch.plugins.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('frontend/js/engo-plugins.js') }}"></script>

    <!-- <script type="text/javascript" src="{{ asset('frontend/js/jquery.elevatezoom.js') }}"></script> -->

    <script type="text/javascript" src="{{ asset('frontend/js/store.js') }}"></script>


    <script type="text/javascript">
    $(document).ready(function(){
        $('.button_search').click(function(){
            $('.search_form').submit();
        });
        $('.close').click(function(){
             var id = $('#notificationid').val();
            $.ajax({
                url: "{{ URL::to('disablenotification') }}",
                type:'get',
                 data: {id:id},
                success : function(response){
                   
                    console.log(id);
                }
            })
        });
        $('.subcat').hover(function(){
            var catid = $(this).attr("data-id"); 
            console.log(catid.length)
            $.ajax({
                url: "{{ URL::to('catimages') }}",
                type:'get',
                data: {id:catid},
                success : function(response){
                    $(".womenimage").attr("src",'');
                    if (response) {
                        var image = response.image_url; 
                        if (image != undefined) {
                            var img_url ="{{ asset(env('PRODUCT_IMAGE'))}}" +'/'+image; 
                            $('.womenimage').show();
                            $(".womenimage").attr("src",img_url);
                        }
                        
                    }
                    
                }
            })
        });  
        $('.subcatchild').hover(function(){
            var catid = $(this).attr("data-id"); 
            $.ajax({
                url: "{{ URL::to('catimages') }}",
                type:'get',
                data: {id:catid},
                success : function(response){
                    $(".womenimage").attr("src",'');
                    if (response) {
                        var image = response.image_url;
                        if (image != undefined) {
                            var img_url ="{{ asset(env('PRODUCT_IMAGE'))}}" +'/'+image; 
                            $(".childimage").attr("src",img_url);
                            $('.childimage').show();
                        }
                        
                    }
                    
                }
            })
        });


        $('#currencyid').change(function(){
        	var code = $(this).val(); 
        	$.ajax({
        		url: "{{ URL::to('currencyswitch') }}",
                type:'get',
                data: {currency:code},
                success : function(response){
                	console.log(response);
                	location.reload();
                }
        	})
        })
    })
    </script>



    </body>



</html>



