@extends('layouts.frontend')



@section('content')



<style>

.checked {

  color: #a57f20 !important;

}

</style>

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

</style>







         <div class="container">



            



             <div class="banner-product-details3">



                 <img src="{{ asset('frontend/images/banner-catalog1.jpg') }}" alt="Banner">



                 <h3>SHORT-SLEEVED JERSEY SHIRT</h3>



             </div>



         </div>



         <!-- End product details -->







         <div class="container container-ver2">



             <div class="product-details-content">



                 <div class="col-md-6">



                     <div class="product-img-box product-img-box-v2">



                         <a id="image-view" title="Product Image">

                          <div id="results">
                                 
                                 @include('pagination')
                                 </div>

                         </a>

                         <div class="product-thumb">

                             <ul class="thumb-content">

                             	 @foreach($productimages as $img)
                                  @if($img->image_url !='')
                                 <li class="thumb"><a href="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $img->image_url }}" title="thumb product view1" onclick="swap(this);return false;"><img src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $img->image_url }}" alt="thumb product1" /></a></li>
                                @endif
                                 @endforeach
  
                             </ul>

                         </div>

                     </div>



                     <!-- End product-img-box -->



                 </div>



                 <div class="col-md-6 box-detalis-v2">



                     <div class="box-details-info">



                         <div class="breadcrumb">



                             <ul>



                                 <li><a href="#">Home</a></li>



                                 <li class="active">Product Details</li>



                             </ul>



                         </div>



                           </div>



                         @if (Session::has('message'))



                        <div class="alert alert-success alert-dismissible">



                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>



                         {{ Session::get('message') }}



                      </div>



                       @endif



                       @if (Session::has('error'))



                        <div class="alert alert-danger alert-dismissible">



                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>



                         {{ Session::get('error') }}



                      </div>



                       @endif



                         <div class="product-name">



                             <h1>{{$product->product_name}}</h1>

                         <!-- End product-name -->

                         @php

                         $reviewcount = DB::table('reviews')->where('productid','=',$product->Id)->count();

                         $review =  DB::table('reviews')->where('productid','=',$product->Id)->latest()->first();

                         

                         @endphp

                         <div class="rating">

                             <div class="overflow-h">

                                 <div class="icon-rating">

                                  @if(!empty($review))

                                  @if($review->rating == 1)

                                  <span class="fa fa-star checked"></span>

                                  <span class="fa fa-star"></span>

                                  <span class="fa fa-star"></span>

                                  <span class="fa fa-star"></span>

                                  <span class="fa fa-star"></span>

                                 @elseif($review->rating == 2)

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star"></span>

                                 <span class="fa fa-star"></span>

                                 <span class="fa fa-star"></span>

                                 @elseif($review->rating == 3)

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star"></span>

                                 <span class="fa fa-star"></span>

                                 @elseif($review->rating == 4)

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star"></span>

                                 @elseif($review->rating == 5)

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star checked"></span>

                                 @endif

                                  @else 

                                   <span class="fa fa-star"></span>

                                   <span class="fa fa-star"></span>

                                   <span class="fa fa-star"></span>

                                   <span class="fa fa-star"></span>

                                   <span class="fa fa-star"></span>

                                  @endif

                                  

                                     <!--<input type="radio" id="star-horizontal-rating-1" name="star-horizontal-rating" checked="">-->

                                     <!--<label for="star-horizontal-rating-1"><i class="fa fa-star"></i></label>-->

                                     <!--<input type="radio" id="star-horizontal-rating-2" name="star-horizontal-rating" checked="">-->

                                     <!--<label for="star-horizontal-rating-2"><i class="fa fa-star"></i></label>-->

                                     <!--<input type="radio" id="star-horizontal-rating-3" name="star-horizontal-rating" checked="">-->

                                     <!--<label for="star-horizontal-rating-3"><i class="fa fa-star"></i></label>-->

                                     <!--<input type="radio" id="star-horizontal-rating-4" name="star-horizontal-rating">-->

                                     <!--<label for="star-horizontal-rating-4"><i class="fa fa-star"></i></label>-->

                                     <!--<input type="radio" id="star-horizontal-rating-5" name="star-horizontal-rating">-->

                                     <!--<label for="star-horizontal-rating-5"><i class="fa fa-star"></i></label>-->

                                 </div>

                                 <span>{{$reviewcount}} Rating(s)</span>

                             </div>

                         </div>

                         <!-- End Rating -->



                         <div class="wrap-price">

 @php 
                    
                     $offerswhole = DB::table('offers')->where('type','=','wholewebsite')->first(); 
                         $offers = DB::table('offers')->where('productid','=',$product->Id)->first();
                    @endphp
                     @if(!empty($offers))
                     
                              @php
                              $offerproduct= $offers->percentage;
                               $disc=$product->product_price - ($product->product_price * ( $offerproduct/100));
                              @endphp

                            <p class="colpricecurrent">{!! Helper::currency_conversion($disc) !!}</p>

                 @else
                
                     @if(!empty($offerswhole))
                              @php
                              $offeramt = $offerswhole->percentage;
                               $disc=$product->product_price - ($product->product_price * ($offeramt/100));
                              @endphp

                            <p class="colpricecurrent">{!! Helper::currency_conversion($disc) !!}</p>

                 @else
                 
                  <p class="price">{!! Helper::currency_conversion($product->product_price) !!}</p>
                 @endif
                       @endif
                 

                             <!--<p class="price">{!! Helper::currency_conversion($product->product_price) !!}</p>-->



                         </div>



                         <!-- End Price -->



                     </div>



                     <!-- End box details info -->



                     <div class="options">



                     	

  @if($product->product_type == "normal")

                     	 {!! $product->summary !!}

@endif

     @if($product->product_type =="luxury")
     
     

                     	 

@endif
                    



                         <div class="action">



                            <!--  <form method="post" action="{{ URL::to('customer/addtocart/'.Crypt::encrypt($product->Id )) }}" class="addcart">

                                 <input type="hidden" name="_method" value="put"> -->

                                  <form method="post" action="{{ URL::to('customer/addtocart/'.Crypt::encrypt($product->Id )) }}" class="productcart-{{ $product->Id }}">

                                {{ csrf_field() }}



                                 <div class="product-signle-options product_15 clearfix">



                                     <div class="selector-wrapper size">



                                         <div class="quantity">



                                             <input data-step="1" value="1" title="Qty" name="qty" class="qty" size="4" type="text">



                                             <input type="hidden" name="productId" value="{{ $product->Id }}" id="productId">



                                             <input type="hidden" name="price" value="{{$product->product_price}}">



                                         </div>



                                     </div>



                                 </div>



                             </form>



                             <a class="link-ver1 add-cart" title="Add to cart" href="#"  data-id="{{ $product->Id }}"><i class="icon-bag"></i><span>Add to cart</span></a>



                             <a class="link-ver1 wish" title="Wishlist" href="{{ URL::to('customer/wishlist/'.Crypt::encrypt($product->Id)) }}"><i class="icon icon-heart"></i></a>



                             <!--<a class="link-ver1 chart" title="Compare" href="#"><i class="icon icon-bar-chart"></i></a>-->



                         </div>



                         <!-- End action -->



                         <div class="infomation">

                            @php

                            $colours = DB::table('productscolor')

                                        ->select('colours.color_name')

                                        ->join('colours', 'productscolor.colorId', '=', 'colours.id')

                                        ->where('productscolor.productId','=',$product->Id)

                                        ->get();

                            $sizes = DB::table('productsize')

                                        ->select('sizes.size')

                                        ->join('sizes', 'productsize.sizeId', '=', 'sizes.id')

                                        ->where('productsize.productId','=',$product->Id)

                                        ->get();

                            @endphp

                            <!--  <p class="sku"><span>SKU: </span>671272</p> -->



                             <p class="category"><span>Category: </span> {{$product->category}}</p>

                             

                             <p class="category"><span>color: </span> 

                             @foreach($colours as $color)

                             

                             {{ $color->color_name }}

                             @if( !$loop->last)

                             ,

                             @endif

                             @endforeach

                             </p>

                             <p class="category"><span>Sizes: </span> 

                             @foreach($sizes as $size)

                             

                             {{ $size->size }}

                             @if( !$loop->last)

                             ,

                             @endif

                             @endforeach

                             </p>



                             <!-- <p class="tags"><span>Tags: </span>Sweaters, Turtleneck, Wool</p> -->



                         </div>



                         <!-- Infomation -->



                         <div class="social">



                             <a title="twitter" href="#"><i class="fa fa-twitter"></i></a>



                             <a title="facebook" href="#"><i class="fa fa-facebook"></i></a>



                             <a title="google plus" href="#"><i class="fa fa-google-plus"></i></a>



                             <a title="pinter" href="#"><i class="fa fa-pinterest-p"></i></a>



                         </div>



                         <!-- End share -->



                     </div>



                     <!-- End Options -->



                 </div>



             </div>



             <!-- End product-details-content -->



         </div>



         <div class="container">



             <div class="hoz-tab-container space-padding-tb-40 slider-product tabs-title-v2">



                 <ul class="tabs">



                     <li class="item" rel="description">Description</li>



                     <!--<li class="item" rel="product-tags">ADDITIONAL INFORMATION</li>-->



                     <li class="item" rel="customer">REVIEWS ({{ $reviewcount }})</li>



                 </ul>



                 <div class="tab-container">



                     <div id="description" class="tab-content mockup mockup-v3">


@php
$summarydecode = json_decode($product->summary, true);
$descrdecode = json_decode($product->description, true); 
$designdecode = json_decode($product->productdesigner, true);  
@endphp
        


  @if($product->product_type == "normal")

                       <p class="center">{!! strip_tags($product->description) !!}

@endif
 @if($product->product_type == "luxury")
    <p class="center"> {!! html_entity_decode($descrdecode['title']) !!}
     
     

                     	 

@endif

                       







                         </p>



                     </div>



                     <!-- End description -->



                     <div id="product-tags" class="tab-content">



                         <h3 class="space-20">Product tags</h3>



                         <p>Other  people marked this product with these tags</p>



                         <p>Sumer collection (2) </p>



                         <p>Fashion accessories (2)</p>



                         <a class="button-v2 hover-black color-black" href="#" title="add tags">add tags <i class="link-icon-black"></i></a>



                     </div>



                     <div id="customer" class="tab-content">



                         <div class="col-md-6">



                             <h3 class="space-10">Customer Review</h3>

                             @foreach($reviews as $review)

                             @php

                             $created_timestamp = $review->created_at;

                             $split_timestamp = explode(" ",$created_timestamp); 

                             $created_date = $split_timestamp[0];

                             $splitdate = explode("-",$created_date); 

                             @endphp

                             <div class="space-10">

                                 <p><strong>Review by {{$review->name}}</strong></p>

                                 <p>(Posted on {{$splitdate[2]}}/{{$splitdate[1]}}/{{$splitdate[0]}})</p>

                             </div>

                             <div class="space-padding-tb-40" style="margin-top: -47px !important;">

                                 <h4>Customer Review</h4>

                                 <p>{{$review->summary}}</p>

                                 @if($review->rating == 1)

                                  <span class="fa fa-star checked"></span>

                                  <span class="fa fa-star"></span>

                                  <span class="fa fa-star"></span>

                                  <span class="fa fa-star"></span>

                                  <span class="fa fa-star"></span>

                                 @elseif($review->rating == 2)

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star"></span>

                                 <span class="fa fa-star"></span>

                                 <span class="fa fa-star"></span>

                                 @elseif($review->rating == 3)

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star"></span>

                                 <span class="fa fa-star"></span>

                                 @elseif($review->rating == 4)

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star"></span>

                                 @elseif($review->rating == 5)

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star checked"></span>

                                 <span class="fa fa-star checked"></span>

                                 @endif

                                

                             </div>

                             <hr/>

                             @endforeach



                             <div class="space-10">

                             </div>

                         </div>

                         <div class="col-md-6">

                             <form class="form-horizontal" method="post" action="{{ URL::to('customer/reviews/') }}">

                                {{ csrf_field() }}

                                 <div class="form-group">

                                     <label class=" control-label" for="inputName">Nick Name*</label>

                                      @if(!empty(Auth::user()))

                                      <input type="text" class="form-control" id="inputName" name="fullname" placeholder="Nick Name" value="{{ Auth::user()->name}}">

                                      @else

                                      <input type="text" class="form-control" id="inputName" name="fullname" placeholder="Nick Name">

                                      @endif

                                     

                                 </div>

                                 <div class="form-group">

                                     <label class=" control-label" for="inputsumary">Summary of Your Review *</label>

                                     <input type="text" class="form-control" name="summary" id="inputsumary" placeholder="Summary">

                                     <input type="hidden" name="productid" value="{{ $product->Id }}">

                                 </div>

                                 <h4>Customer Review</h4>

                                 <div class="radio customer-radio">

                                    <input type="radio" id="star-1" value="1" name="star" />

                                     <label for="star-1">01 star</label>

                                     <input type="radio" id="star-2" value="2" name="star" />

                                     <label for="star-2">02 star</label>

                                     <input type="radio" id="star-3" value="3" name="star" />

                                     <label for="star-3">03 star</label>

                                     <input type="radio" id="star-4" value="4" name="star" />

                                     <label for="star-4">04 star</label>

                                     <input type="radio" id="star-5" value="5" name="star" />

                                     <label for="star-5">05 star</label>



                                 </div>

                                 <button type="submit" class="button-v2 hover-black color-black">Submit review<i class="link-icon-black"></i></button>



                             </form>



                         </div>



                     </div>



                 </div>



             </div>



             <!-- tab-container -->



             <div class="title-product">



                 <h3>Related products</h3>



             </div>



             <!-- End title -->



             <div class="upsell-product products owl-nav-hidden">

                 @foreach($relatedpro as $prorel)

                 @php

                 $image = DB::table('productsimages')->where('productId','=',$prorel->Id)->first();

                 @endphp

                 <div class="item-inner">

                     <div class="product">

                         <div class="product-images">

                             <a href="{{ URL::to('productdetail/'.Crypt::encrypt($prorel->Id)) }}" title="product-images">

                                 <img class="primary_image" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image->image_url }}" alt="" />

                                 <img class="secondary_image" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image->image_url }}" alt="" />

                             </a>

                             <div class="action">

                                 <a class="zoom quickview"  data-toggle="modal" data-target="#product_view" title="Quick view" data-id="{{$prorel->Id }}"><i class="icon icon-magnifier-add "></i></a>

                                 <a class="wish" href="{{ URL::to('customer/wishlist/'.Crypt::encrypt($prorel->Id)) }}" title="Wishlist"><i class="icon icon-heart"></i></a>

                                 <form method="post" action="{{ URL::to('customer/addtocart/'.Crypt::encrypt($prorel->Id )) }}" class="relatedpro-{{ $prorel->Id }}">

                                 {{ csrf_field() }}

                                    <input data-step="1" value="1" title="Qty" name="qty" class="qty" size="4" type="hidden">



                                    <input type="hidden" name="productId" value="{{ $prorel->Id }}">



                                    <input type="hidden" name="price" value="{{$prorel->product_price}}">



                                    </form>

                                 <a class="related-cart" href="#" title="Add to cart" data-id="{{ $prorel->Id }}"><i class="icon-bag"></i></a>

                             </div>

                         </div>



                         <a href="#" title="Bouble Fabric Blazer"><p class="product-title">{{$prorel->product_name}}</p></a>

                         <p class="product-price">{!! Helper::currency_conversion($prorel->product_price) !!}</p>

                     </div>

                     <!-- End product -->

                 </div>

                 @endforeach



                



                 



                 



             </div>



         </div>





                 <div class="modal fade product_view" id="product_view">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header"> 

                <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-times"></span></a>

               

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


<script>
    $(document).ready(function() {

        $(document).on('click','.pagination a', function(event) {
            
            event.preventDefault();
            //  alert('x');
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

       function fetch_data(page) {

    var l = window.location;

                 var productid = $('#productId').val()
                //  $(this).attr("data-id");

                //  $('#productId').val(productid);
    // the request path should be 
    // domain.com/welcome/pagination

    $.ajax({
        url:"welcome/pagination/"+productid+"?page=" + page,
        success: function(productimagess) {
            $('#results').html(productimagess);
        }
    });
}

    });
    
</script>




         







        <script type="text/javascript">
  

         $(document).ready(function(){

            $('.add-cart').click(function(){

                //$('.addcart').submit();

                 var productid = $(this).attr("data-id");

                 $('#productId').val(productid);

                 var classname = '.productcart-'+productid;

                 $(classname).submit();

            });

            $('.related-cart').click(function(){

                var productid = $(this).attr("data-id"); 

                $('#productId').val(productid);

                var classname = '.relatedpro-'+productid;

                $(classname).submit();



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
   <!--                           <div id="myCarousel" class="carousel slide" data-ride="carousel">-->
 <!--  <ol class="carousel-indicators">-->
 <!--       <li data-target="#myCarousel" data-slide-to="0" class="active"></li>-->
 <!--   </ol>-->
 <!--   <div class="carousel-inner">-->

    <!-- Wrapper for slides -->
    
 <!--@foreach($productimages as $key => $fimg)-->
 <!--<div class="item{{ $key == 0 ? ' active' : '' }}">-->
               
 <!--       <img id="image" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $fimg->image_url }}" alt="Product" />-->
       
 <!--       </div>-->
 <!--       @endforeach-->
 <!--   </div>-->

    <!-- Left and right controls -->
 <!--   <a class="left carousel-control" href="#myCarousel" data-slide="prev">-->
 <!--     <span class="glyphicon glyphicon-chevron-left"></span>-->
 <!--     <span class="sr-only">Previous</span>-->
 <!--   </a>-->
 <!--   <a class="right carousel-control" href="#myCarousel" data-slide="next">-->
 <!--     <span class="glyphicon glyphicon-chevron-right"></span>-->
 <!--     <span class="sr-only">Next</span>-->
 <!--   </a>-->
 <!-- </div>-->