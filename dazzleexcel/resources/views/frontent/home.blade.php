 @extends('layouts.frontend')



@section('content')



<style type="text/css">

.product_view .modal-dialog{max-width: 800px; width: 100%;}

        .pre-cost{text-decoration: line-through; color: #a5a5a5;}

        .space-ten{padding: 10px 0;}

.btn {

    width: 149px !important;

}

.link-ver1 i {

    color: #000000 !important;

}

.banner-private a:hover {

    /*color: #b5b4b4;*/

    color: #D4AF37;

}

</style>



@foreach($bannertop as $banner1)

@if(!empty($banner1->title) && empty($banner1->description))

<div class="container space-30">

            <div class="banner-home3-colection-top">

                <img src="{{ asset(env('BANNER_IMAGE'))}}/{{ $banner1->image}}" alt="Banner">

                <a class="button button1 hover-white" href="{{$banner1->url}}" title="Shop collection">{{$banner1->title}}<i class="link-icon-white"></i></a>

            </div>

        </div>

@endif

@if(!empty($banner1->title) && !empty($banner1->description))

@php

$url = $banner1->url;

if(!empty($url)){

$link = $url;

} else {

$link = '#';

}

@endphp

        <div class="container">

            <div class="banner-home3-lookbook1 banner-private">

                <img src="{{ asset(env('BANNER_IMAGE'))}}/{{ $banner1->image}}" alt="Banner">

                <div class="text">

                    <h3>

                        <a href="{{ $link }}">

                            {{$banner1->title}}

                        </a>

                    </h3>

                    <p>

                        <a href="{{ $link }}">

                            {{$banner1->description}}

                        </a>

                    </p>

                </div>

            </div>

        </div>

@endif

@endforeach

        <!-- End banner-home3-loobook1 -->

        <div class="title-text">

            <h3>Shop These Looks</h3>

        </div>

        <div class="container">

            <div class="slider-product our-new-product owl-nav-hidden space-30">

                <div class="product-tab-content products">

                    @foreach($segment1 as $proseg1)

                    @php

                    $image = DB::table('productsimages')->where('productId','=',$proseg1->Id)->first();

                    $offers = DB::table('offers')->where('productid','=',$proseg1->Id)->first();

                    @endphp

                    <div class="item-inner">

                        <div class="product">

                            <div class="product-images">

                                <a href="{{ URL::to('productdetail/'.Crypt::encrypt($proseg1->Id)) }}" title="product-images">

                                    <img class="primary_image" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image->image_url }}" alt="" />

                                    <img class="secondary_image" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image->image_url }}" alt="" />

                                </a>

                                <div class="action">

                                    <a class="zoom quickview"  data-toggle="modal" data-target="#product_view" title="Quick view" data-id="{{$proseg1->Id }}"><i class="icon icon-magnifier-add "></i></a>



                                    <a class="wish" href="{{ URL::to('customer/wishlist/'.Crypt::encrypt($proseg1->Id)) }}" title="Wishlist"><i class="icon icon-heart"></i></a>

                                    <form method="post" action="{{ URL::to('customer/addtocart/'.Crypt::encrypt($proseg1->Id )) }}" class="addcartshoplooks-{{ $proseg1->Id }}">

                                        {{ csrf_field() }}

                                    <input data-step="1" value="1" title="Qty" name="qty" class="qty" size="4" type="hidden">

                                    <input type="hidden" name="productId" id="productId" value="{{ $proseg1->Id }}">

                                     @if(!empty($offers))

                                     @php

                                      $helpers = new Helper();

                                      $discount = $helpers->getdiscountamt($proseg1->Id,$proseg1->product_price); 

                                      $split = explode(' ',$discount);

                                     @endphp

                                     <input type="hidden" name="price" value="{{$split [1]}}">

                                     @else

                                     @php

                                      $helpers = new Helper();

                                      $price = $helpers->currency_conversion($proseg1->product_price); 

                                      $split = explode(' ',$price);

                                     @endphp

                                     <input type="hidden" name="price" value="{{$split [1]}}">

                                     @endif

                                    

                                    </form>

                                    <a class="add-cart-slooks" id="add-cart-slooks" href="#" data-id="{{ $proseg1->Id }}" title="Add to cart"><i class="icon-bag"></i></a>

                                </div>

                            </div>

                            <a href="{{ URL::to('productdetail/'.Crypt::encrypt($proseg1->Id)) }}" title="Bouble Fabric Blazer"><p class="product-title">{{$proseg1->product_name}}</p></a>

                             @if(!empty($offers))

                             <p class="product-price" style="margin-left: -81px;">{!! Helper::getdiscountamt($proseg1->Id,$proseg1->product_price) !!}</p>

                             <p style="margin-top: -37px;margin-left: 64px;text-decoration: line-through;">{!! Helper::currency_conversion($proseg1->product_price) !!}</p>

                              @else

                              <p style="margin-top: 10px;margin-left: 14px;">{!! Helper::currency_conversion($proseg1->product_price) !!}</p>

                             @endif

                            <!--begin modal window-->

                        </div>

                    </div>

                    @endforeach

                    <!-- End item -->

                </div>

                <!-- End product-tab-content products -->

            </div>

            <!-- End OurNewProduct -->

        </div>

        <!-- End container -->

        <div class="girllook">

            <div class="container">

                @foreach($bannermiddle as $banner2)

                @php

                $url = $banner2->url;

                if(!empty($url)){

                $link = $url;

                } else {

                $link = '#';

                }

                @endphp

                <div class="col-md-6">

                    <div class="items banner-private banner-home3-lookbook1 banner-home3-top-50">

                        <img src="{{ asset(env('BANNER_IMAGE'))}}/{{ $banner2->image}}" alt="Banner">

                        <div class="text">

                            <h3>

                                <a href="{{ $link }}">

                                    {{$banner2->title}}

                                </a>

                                

                            </h3>

                            <p>

                                <a href="{{ $link }}">

                                    {{$banner2->description}}

                                </a>

                            </p>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        </div>



        <!-- End frid look -->

        <div class="title-text">

            <h3>GET THIS LOOK</h3>

        </div>

        <div class="container">

            <div class="slider-product our-new-product owl-nav-hidden space-30">

                <div class="product-tab-content products">

                    @foreach($segment2 as $proseg2)

                    @php

                    $image2 = DB::table('productsimages')->where('productId','=',$proseg2->Id)->first();

                    $offers = DB::table('offers')->where('productid','=',$proseg2->Id)->first();

                    @endphp

                    <div class="item-inner">

                        <div class="product">

                            <div class="product-images">

                                <a href="{{ URL::to('productdetail/'.Crypt::encrypt($proseg2->Id)) }}" title="product-images">

                                    <img class="primary_image" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image2->image_url }}" alt="" />

                                    <img class="secondary_image" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image2->image_url }}" alt="" />

                                </a>

                                <div class="action">

                                    <a class="zoom quickview"  data-toggle="modal" data-target="#product_view" title="Quick view" data-id="{{$proseg2->Id }}"><i class="icon icon-magnifier-add "></i></a>

                                    <a class="wish" href="{{ URL::to('customer/wishlist/'.Crypt::encrypt($proseg2->Id)) }}" title="Wishlist"><i class="icon icon-heart"></i></a>

                                    <form method="post" action="{{ URL::to('customer/addtocart/'.Crypt::encrypt($proseg2->Id )) }}" class="addcartshoplooks1-{{ $proseg2->Id }}">

                                        {{ csrf_field() }}

                                    <input data-step="1" value="1" title="Qty" name="qty" class="qty" size="4" type="hidden">

                                    <input type="hidden" name="productId" value="{{ $proseg2->Id }}">

                                    <input type="hidden" name="price" value="{{$proseg2->product_price}}">

                                    </form>

                                    <a class="add-cart-slooks1" href="#" title="Add to cart" data-id="{{ $proseg2->Id }}"><i class="icon-bag"></i></a>

                                </div>

                            </div>

                            <a href="{{ URL::to('productdetail/'.Crypt::encrypt($proseg1->Id)) }}" title="Bouble Fabric Blazer"><p class="product-title">{{$proseg2->product_name}}</p></a>

                             @if(!empty($offers))

                             <p class="product-price" style="margin-left: -81px;">{!! Helper::getdiscountamt($proseg2->Id,$proseg2->product_price) !!}</p>

                             <p style="margin-top: -37px;margin-left: 64px;text-decoration: line-through;">{!! Helper::currency_conversion($proseg2->product_price) !!}</p>

                              @else

                              <p style="margin-top: 10px;margin-left: 14px;">{!! Helper::currency_conversion($proseg2->product_price) !!}</p>

                             @endif



                        </div>

                    </div>

                    @endforeach

                    <!-- End item -->

                </div>

                <!-- End product-tab-content products -->

            </div>

            <!-- End OurNewProduct -->

        </div>

        <!-- End container -->



        @foreach($bannerbottom as $banner3)

        @if(!empty($banner3->title) && !empty($banner3->description) && !empty($banner3->url)  )

        @php

        $url = $banner3->url;

        if(!empty($url)){

        $link = $url;

        } else {

        $link = '#';

        }

        @endphp

        <div class="container">

            <div class="banner-home3-lookbook2 banner-private space-30">

                <img src="{{ asset(env('BANNER_IMAGE'))}}/{{ $banner3->image}}" alt="Banner">

                <div class="text">

                    <!--<span class="icon-plane icons"></span>-->

                    <h3>{{$banner3->title}}</h3>

                    <a class="button button1 hover-white" href="{{ $link }}" title="CUSTOM DESIGN YOUR DRESS">{{ $banner3->description }}<i class="link-icon-white"></i></a>

                </div>

            </div>

        </div>

        @endif

        @if(!empty($banner3->title) && !empty($banner3->description) && empty($banner3->url))

        @php

        $url = $banner3->url;

        if(!empty($url)){

        $link = $url;

        } else {

        $link = '#';

        }

        @endphp

        <div class="container">

            <div class="banner-home3-lookbook1 banner-private">

                <img src="{{ asset(env('BANNER_IMAGE'))}}/{{ $banner3->image}}" alt="Banner">

                <div class="text">

                    <h3>

                        <a href="{{ $link }}">

                            {{$banner3->title}}

                        </a>

                        

                    </h3>

                    <p>

                        <a href="{{ $link }}">

                        {{$banner3->description}}

                        </a>

                    </p>

                </div>

            </div>

        </div>

        @endif

        @endforeach



        <!-- End banner-home3-loobook1 -->



        <div class="title-text">



            <h3>Shop These Looks</h3>



        </div>



        <div class="container">



            <div class="slider-product our-new-product owl-nav-hidden space-30">



                <div class="product-tab-content products">



                    @foreach($segment3 as $proseg3)



                    @php



                    $image3 = DB::table('productsimages')->where('productId','=',$proseg3->Id)->first();

                     $offers = DB::table('offers')->where('productid','=',$proseg3->Id)->first();



                    @endphp



                    <div class="item-inner">



                        <div class="product">



                            <div class="product-images">



                                <a href="{{ URL::to('productdetail/'.Crypt::encrypt($proseg3->Id)) }}" title="product-images">



                                    <img class="primary_image" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image3->image_url }}" alt="" />



                                    <img class="secondary_image" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image3->image_url }}" alt="" />



                                </a>



                                <div class="action">



                                    

                                    <a class="zoom quickview"  data-toggle="modal" data-target="#product_view" title="Quick view" data-id="{{$proseg3->Id }}"><i class="icon icon-magnifier-add "></i></a>



                                    <a class="wish" href="{{ URL::to('customer/wishlist/'.Crypt::encrypt($proseg3->Id)) }}" title="Wishlist"><i class="icon icon-heart"></i></a>

                                    <form method="post" action="{{ URL::to('customer/addtocart/'.Crypt::encrypt($proseg3->Id )) }}" class="addcartshoplooks2-{{ $proseg3->Id }}">

                                        {{ csrf_field() }}

                                    <input data-step="1" value="1" title="Qty" name="qty" class="qty" size="4" type="hidden">

                                    <input type="hidden" name="productId" value="{{ $proseg3->Id }}">

                                    <input type="hidden" name="price" value="{{$proseg3->product_price}}">

                                    </form>

                                    <a class="add-cart-slooks2" href="#" title="Add to cart"  data-id="{{ $proseg3->Id }}"><i class="icon-bag"></i></a>



                                </div>



                            </div>



                            <a href="{{ URL::to('productdetail/'.Crypt::encrypt($proseg3->Id)) }}" title="Bouble Fabric Blazer"><p class="product-title">{{$proseg3->product_name}}</p></a>

                              @if(!empty($offers))

                             <p class="product-price" style="margin-left: -81px;">{!! Helper::getdiscountamt($proseg3->Id,$proseg3->product_price) !!}</p>

                             <p style="margin-top: -37px;margin-left: 64px;text-decoration: line-through;">{!! Helper::currency_conversion($proseg3->product_price) !!}</p>

                              @else

                              <p style="margin-top: 10px;margin-left: 14px;">{!! Helper::currency_conversion($proseg3->product_price) !!}</p>

                             @endif







                        </div>



                    </div>



                    @endforeach



                    <!-- End item -->



                </div>



                <!-- End product-tab-content products -->



            </div>



            <!-- End OurNewProduct -->



        </div>



        <!-- End container -->



        <div id="back-to-top">



            <i class="fa fa-long-arrow-up"></i>



        </div>



<div class="modal fade product_view" id="product_view">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header"> 

                <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-times"></span></a>

                <!-- <h3 class="modal-title">HTML5 is a markup language</h3> -->

            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 product_img">
                        <img src="" class="img-responsive">
                    </div>
                    <div class="col-md-6 product_content">
                        <h1></h1><br/>
                        <div class="descr"></div><br/>
                        <h3 class="cost">   
                         <div class="price"></div>
                        </h3>
                        <div class="space-ten"></div>
                        <div class="btn-ground">
                        <div class="action">
                            <form method="post" action="" class="addcart">
                            <div class="product-details-content">
                                {{ csrf_field() }}
                                 <div class="product-signle-options product_15 clearfix">
                                     <div class="selector-wrapper size">
                                         <div class="quantity">
                                             <input data-step="1" value="1" title="Qty" name="qty" class="qty" size="4" type="text">
                                             <input type="hidden" name="productId" id="productId" value="">
                                             <input type="hidden" name="price" id="product_price" value="">
                                         </div>
                                     </div>
                                 </div>
                         </div>
                        </div><br/>
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>
                            </form>
                            <a class="link-ver1 wish" title="Wishlist" href=""><i class="icon icon-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<script type="text/javascript">

$(document).ready(function(){

    $('.add-cart-slooks').click(function(){

         var productid = $(this).attr("data-id"); 

         $('#productId').val(productid);

         var classname = '.addcartshoplooks-'+productid;

        $(classname).submit();

    });

    $('.add-cart-slooks1').click(function(){

        var productid = $(this).attr("data-id"); 

        $('#productId').val(productid);

        var classname = '.addcartshoplooks1-'+productid;

        $(classname).submit();

    })

    $('.add-cart-slooks2').click(function(){

        var productid = $(this).attr("data-id"); 

        $('#productId').val(productid);

        var classname = '.addcartshoplooks2-'+productid;

        $(classname).submit();

    })

    $('.quickview').click(function(){

        var productid = $(this).attr("data-id");

        $('#productId').val(productid);

        $.ajax({

             url: "{{ URL::to('quickview') }}",

             type:'get',

             data: {id:productid},

             success : function(response){



                var productname = response.detail.product_name;

                var descr = response.detail.summary;

                var price = '$'+ response.detail.product_price;

                var image = response.productimages.image_url;

                var productid = response.crypt;

                $('.product_content h1').html(productname);

                $('.product_content .descr').html(descr);

                $('.product_content .price').html(response.productprice);

                

                $('#product_price').val(response.productpriceval);

                var img_url ="{{ asset(env('PRODUCT_IMAGE'))}}" +'/'+image; 

                var wishlist_url ="{{ URL::to('customer/wishlist/') }}" + '/'+ productid ; 

                var carturl = "{{ URL::to('customer/addtocart/') }}"  + '/'+ productid ;

                $(".product_img img").attr("src",img_url);

                $(".wish").attr("href",wishlist_url);

                $(".addcart").attr("action",carturl);





             }

        })

    })

})

</script>

     @endsection