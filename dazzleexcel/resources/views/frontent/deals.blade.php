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

.products .product p.product-title {

    /*font-size: 8px !important;*/

}

/*.products .product .product-images img {

    height: 219px !important;

}
*/
</style>







        <div class="container">



            <div class="banner-header banner-lbook3">



                <img src="{{ asset('frontend/images/banner-catalog1.jpg') }}" alt="Banner-header">



                <div class="text">



                    <h3>shop</h3>



                    <img class="border" src="{{ asset('frontend/images/Uno-slideshow-border-home1.png') }}" alt="border">



                    <p>Your search for the best attire ends here!</p>



                </div>



            </div>



        </div>



        <!-- End Banner Grid -->



        <div class="container">



            <div class="wrap-breadcrumb">



                <ul class="breadcrumb">



                    <li><a href="#">Home</a></li>



                    <li class="active">Shopping all products</li>



                </ul>



                <div class="ordering">



                    <span class="list"></span>



                    <span class="col active"></span>



                    <p class="result-count">Showing 1-12 of 30 relults</p>



                    <form action="#" method="get" class="order-by">



                        <select class="orderby" name="orderby">



                            <option>Sort by popularity</option>



                            <option selected="selected">Sort by average rating</option>



                            <option>Sort by newness</option>



                            <option>Sort by price: low to high</option>



                            <option>Sort by price: high to low</option>



                        </select>



                    </form>



                </div>



            </div>



        </div>



        <!-- End ordering -->



        <div class="container">



            <div id="primary" class="col-xs-12 col-md-9">

                <div class="products grid_full grid_sidebar">

                    @foreach($products as $product)

                    @php

                    $image = DB::table('productsimages')->where('productId','=',$product->Id)->first();

                     $offers = DB::table('offers')->where('productid','=',$product->Id)->first();

                     $offerswhole = DB::table('offers')->where('type','=','wholewebsite')->first(); 
                     $producttype = $product->product_type;
                     $hide = DB::table('pagehide')->where('pagename', 'luxury')->first();
                     $hidestatus = $hide->status;
                    @endphp

                    @if($producttype== 'luxury' && $hidestatus !='1' || empty($hide) || $producttype != 'luxury' )
                    <div class="item-inner">
                        <div class="product">
                            <div class="product-images">
                                <a href="{{ URL::to('productdetail/'.Crypt::encrypt($product->Id)) }}" title="product-images">
                                    <img class="primary_image" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image->image_url }}" alt="" />
                                    <img class="secondary_image" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image->image_url }}" alt="" />
                                </a>

                                <div class="action">
                                    <a class="zoom quickview"  data-toggle="modal" data-target="#product_view" title="Quick view" data-id="{{$product->Id }}"><i class="icon icon-magnifier-add "></i></a>
                                    <a class="wish" href="{{ URL::to('customer/wishlist/'.Crypt::encrypt($product->Id)) }}" title="Wishlist"><i class="icon icon-heart"></i></a>
                                    <form method="post" action="{{ URL::to('customer/addtocart/'.Crypt::encrypt($product->Id )) }}" class="addcart">
                                        {{ csrf_field() }}
                                    <input data-step="1" value="1" title="Qty" name="qty" class="qty" size="4" type="hidden">
                                    <input type="hidden" name="productId" value="{{ $product->Id }}">
                                    <input type="hidden" name="price" value="{{$product->product_price}}">
                                    </form>
                                    <a class="add-cart" href="#" title="Add to cart"><i class="icon-bag"></i></a>
                                </div>
                            </div>
                            <a href="Product Details.html" title="Bouble Fabric Blazer"><p class="product-title">{{ Str::limit($product->product_name, 27) }}</p></a>
                            @if(!empty($offers))
                             <p class="product-price" style="margin-left: -81px;margin-top: -12px;">{!! Helper::getdiscountamt($product->Id,$product->product_price) !!}</p>
                             <p style="margin-top: -37px;margin-left: 64px;text-decoration: line-through;">{!! Helper::currency_conversion($product->product_price) !!}</p>
                              @else
                              @if(!empty($offerswhole))
                              @php
                              $offeramt = $offerswhole->percentage;
                              $disc = $product->product_price * $offeramt/100;
                              @endphp
                              <p class="product-price" style="margin-left: -81px;margin-top: -12px;">{!! Helper::currency_conversion($product->Id,$disc) !!}</p>
                             <p style="margin-top: -37px;margin-left: 64px;text-decoration: line-through;">{!! Helper::currency_conversion($product->product_price) !!}</p>
                              @else
                            <p style="margin-top: -5px;margin-left: 14px;">{!! Helper::currency_conversion($product->product_price) !!}</p>
                              @endif
                             @endif
                        </div>
                        <!-- End product -->
                    </div>
                    @endif
                    @endforeach

                </div>

                <!-- End product-content products  -->

                <div class="pagination-container">

                    {{ $products->links() }}

                </div>

                <!-- End pagination-container -->

            </div>



            <!-- End Primary -->







            @include('layouts.searchfilterdeals');



            <!-- End Secondary -->



        </div>



        <!-- end product sidebar -->



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

                        <img src="http://img.bbystatic.com/BestBuy_US/images/products/5613/5613060_sd.jpg" class="img-responsive">

                    </div>

                    <div class="col-md-6 product_content">

                        <h1>DESIGNER BLUE & PINK ANARKALI</h1>

                        

                        <div class="descr"></div>

            

                        <h3 class="cost">   

                         <div class="price">$75.00</div>

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

                            <!-- <form method="post" action="" class="addcart">

                                {{ csrf_field() }}

                                <input data-step="1" value="1" title="Qty" name="qty" class="qty" size="4" type="text">

                                <input type="hidden" name="productId" id="productId" value="">

                                <input type="hidden" name="price" id="product_price" value="">

                            </form> -->



                        </div>

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

            $('.add-cart').click(function(){

                $('.addcart').submit();

            });

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

                $('.product_content .price').html(price);

                

                $('#product_price').val(response.detail.product_price);

                var img_url ="{{ asset(env('PRODUCT_IMAGE'))}}" +'/'+image; 

                var wishlist_url ="{{ URL::to('customer/wishlist/') }}" + '/'+ productid ; 

                var carturl = "{{ URL::to('customer/addtocart/') }}"  + '/'+ productid ;

                $(".product_img img").attr("src",img_url);

                $(".wish").attr("href",wishlist_url);

                $(".addcart").attr("action",carturl);





             }

        })

    })

         });



         </script>





























































     @endsection



