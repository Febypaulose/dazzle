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

/*.products .product .product-images img {
    height: 219px !important;
}*/
.orderby{
    width: 116px;
}

.colpricecurrent{
    margin-top: -5px;
    margin-left: 64px;
}

.colpricediscount{
    margin-left: -81px;
    margin-top: -27px;
    text-decoration: line-through;
}
.listpricediscount{
    margin-left: -81px;
    margin-top: -13px;
    text-decoration: line-through;
    display:none;
}

.listpricecurrent{
    margin-top: 41px;
    margin-left: 207px;
    display:none;
}

.colprice{
    margin-top: -5px;
    margin-left: 14px;
}

.listprice{
    margin-top: 38px;
    margin-left: 208px;
    padding-bottom: 25px;
    display:none;
}

@media screen and (min-device-width: 1080px) and (max-device-width: 1920px){
  .listpricecurrent {
    margin-left: 305px;
    }

    .listprice {
    margin-left: 312px;
    }
}
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



                     <p class="result-count">Showing {{($products->currentPage()-1)* $products->perPage()+($products->total() ? 1:0)}}-{{($products->currentPage()-1)*$products->perPage()+count($products)}} of {{$products->total()}} Results</p>

                     @php

                    $segment = Request::segment(1); 

                    if($segment == 'childproducts'){

                    $type='Kids';

                    session()->put('category',$type);

                    }

                    @endphp

                    <form action="{{ URL::to('sortlist') }}" name="orderbyform" method="post" class="order-by">
                         {{ csrf_field() }}
                        <input type="hidden" name="type" value="{{ $type }}">
                        <select class="orderby" name="orderby">
                             <option value="newest">Sort by newest</option>
                            <option value="newest">Sort by newest</option>
                            <option value="discount">Sort by Discount</option>
                            <option value="lowhigh">Sort by price: low to high</option>
                            <option value="highlow">Sort by price: high to low</option>
                        </select>
                    </form>


                    <form action="{{ URL::to('pagination') }}" name="paginationform" method="post" class="order-by paginate">
                         {{ csrf_field() }}
                        <input type="hidden" name="type" value="{{ $type }}">
                        <select class="orderby" id="pagination" name="paginationcount" style="width: 74px;">
                             <option value="12" selected>12</option>
                            <option value="24">24</option>
                            <option value="36">36</option>
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

                    $category = DB::table('category')->where('parentId','=',$product->categoryId)->first();

                    @endphp

                    @if($product->categoryId == 26)

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

                                    <form method="post" action="{{ URL::to('customer/addtocart/'.Crypt::encrypt($product->Id )) }}" class="productlist-{{ $product->Id }}">

                                        {{ csrf_field() }}

                                    <input data-step="1" value="1" title="Qty" name="qty" class="qty" size="4" type="hidden">

                                    <input type="hidden" name="productId" value="{{ $product->Id }}">

                                    <input type="hidden" name="price" value="{{$product->product_price}}">

                                    </form>

                                    <a class="add-cart-productlist" href="#" title="Add to cart" data-id="{{ $product->Id }}"><i class="icon-bag"></i></a>

                                </div>

                            </div>

                            <a href="{{ URL::to('productdetail/'.Crypt::encrypt($product->Id)) }}" title="Bouble Fabric Blazer">

                                <p class="product-title productcolname">{{ Str::limit($product->product_name, 22) }}</p>

                                 <p class="product-title productlistname" style="display:none">{{ $product->product_name }}</p>

                            </a>

                            



                            @if(!empty($offers))

                            <p class="colpricecurrent">{!! Helper::getdiscountamt($product->Id,$product->product_price) !!}</p>

                            <p class="product-price colpricediscount">{!! Helper::currency_conversion($product->product_price) !!}</p>

                    

                            <p class="product-price listpricediscount">{!! Helper::currency_conversion($product->product_price) !!}</p>

                            <p class="listpricecurrent">{!! Helper::getdiscountamt($product->Id,$product->product_price) !!}</p>

                              @else

                              <p class="colprice">{!! Helper::currency_conversion($product->product_price) !!}</p>

                              <p class="listprice">{!! Helper::currency_conversion($product->product_price) !!}</p>

                             @endif

                        </div>

                        <!-- End product -->

                    </div>

                    @endif

                    @endforeach

                </div>

                <!-- End product-content products  -->

               

                <!-- End pagination-container -->

            </div>



            <!-- End Primary -->







            @include('layouts.searchfilter');



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

                        <img src="" class="img-responsive">

                    </div>

                    <div class="col-md-6 product_content">

                        <h1></h1>

                        

                        <div class="descr"></div>

                        <!-- <h3 class="cost"><span class="glyphicon glyphicon-usd"></span> 75.00 <small class="pre-cost"><span class="glyphicon glyphicon-usd"></span> 60.00</small></h3>  -->

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

           $('.add-cart-productlist').click(function(){

             var productid = $(this).attr("data-id"); 

             $('#productId').val(productid);

             var classname = '.productlist-'+productid;

            $(classname).submit();

            });

            $('.orderby').change(function(){

                $('.order-by').submit();   

            });

            $('#pagination').change(function(){
                ('.paginate').submit();
            });

            $('.list').click(function(){

                $('.productcolname').hide();

                $('.productlistname').show();

                

                $('.listprice').show();

                $('.colprice').hide();

            });

            $('.col').click(function(){

                $('.productcolname').show();

                $('.productlistname').hide();

                

                $('.colprice').show();

                $('.listprice').hide();

            });$('.list').click(function(){

                $('.productcolname').hide();

                $('.productlistname').show();

                

                $('.listprice').show();

                $('.colprice').hide();

                

                $('.colpricediscount').hide();

                $('.colpricecurrent').hide();

                

                $('.listpricediscount').show();

                $('.listpricecurrent').show();

            });

            $('.col').click(function(){

                $('.productcolname').show();

                $('.productlistname').hide();

                

                $('.colprice').show();

                $('.listprice').hide();

                

                $('.colpricediscount').show();

                $('.colpricecurrent').show();

                

                $('.listpricediscount').hide();

                $('.listpricecurrent').hide();

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

         });



         </script>





























































     @endsection



