@extends('layouts.frontendinner')

@section('content')
<style>
.checked {
  color: #a57f20 !important;
}
</style>
@php
$summarydecode = json_decode($products->summary, true);
$descrdecode = json_decode($products->description, true); 
$designdecode = json_decode($products->productdesigner, true);  
@endphp
            <div class="container">
                    <div class="product-details-content product-details-content-v2">
                        <div class="images">
                            @if($summarydecode['image'] !='')
                            <img src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $summarydecode['image']}}" alt="bg">
                            @else
                              <img src="https://blogrooster.com/wp-content/plugins/accelerated-mobile-pages/images/SD-default-image.png" style="width:1249px;height:768px" >
                            @endif
                        </div>
                        <div class="col-md-5 col-sm-5 box-detalis-v2">
                            <div class="box-details-info">
                                <div class="breadcrumb">
                                    <ul>
                                        <li><a href="#">Home</a></li>
                                        <li class="active">Product Details</li>
                                    </ul>
                                </div>
                                @if (Session::has('message'))
                                <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> {{ Session::get('message') }}
                              </div>
                               @endif
                                @if (Session::has('error'))
                                <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                 {{ Session::get('error') }}
                              </div>
                               @endif
                                <div class="product-name">
                                    <h1>{{$products->product_name}}</h1>
                                </div>
                                <!-- End product-name -->
                                @php
                                 $reviewcount = DB::table('reviews')->where('productid','=',$products->Id)->count();
                                 $review =  DB::table('reviews')->where('productid','=',$products->Id)->latest()->first(); 
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
                                        <span>{{ $reviewcount }} Rating(s)</span>
                                    </div>
                                </div>
                                <!-- End Rating -->
                                <div class="wrap-price">
                                    @php 
                    
                     $offerswhole = DB::table('offers')->where('type','=','wholewebsite')->first(); 
                         $offers = DB::table('offers')->where('productid','=',$products->Id)->first();
                    @endphp
                     @if(!empty($offers))
                     
                              @php
                              $offerproduct= $offers->percentage;
                               $disc=$products->product_price - ($products->product_price * ( $offerproduct/100));
                              @endphp

                            <p class="colpricecurrent">{!! Helper::currency_conversion($disc) !!}</p>

                 @else
                
                     @if(!empty($offerswhole))
                              @php
                              $offeramt = $offerswhole->percentage;
                               $disc=$products->product_price - ($products->product_price * ($offeramt/100));
                              @endphp

                            <p class="colpricecurrent">{!! Helper::currency_conversion($disc) !!}</p>

                 @else
                 
                  <p class="price">{!! Helper::currency_conversion($products->product_price) !!}</p>
                 @endif
                       @endif
                 
                                </div>
                                <!-- End Price -->
                            </div>
                            <!-- End box details info -->
                            <div class="options">
                                <p>
                                    {!! html_entity_decode($summarydecode['summary'] )!!}
                                </p>
                                <div class="action">
                                    <form method="post" action="{{ URL::to('customer/addtocart/'.Crypt::encrypt($products->Id )) }}" class="addcart">
                                        {{ csrf_field() }}
                                        <div class="product-signle-options product_15 clearfix">
                                            <div class="selector-wrapper size">
                                                <div class="quantity">
                                                    <input data-step="1" value="1" title="Qty" name="qty" class="qty" size="4" type="text">
                                                    <input type="hidden" name="productId" value="{{ $products->Id }}">
                                                    <input type="hidden" name="price" value="{{$products->product_price}}">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <a class="link-ver1 add-cart" title="Add to cart" href="#"><i class="icon-bag"></i><span>Add to cart</span></a>
                                    <a class="link-ver1 wish" title="Wishlist" href="{{ URL::to('customer/wishlist/'.Crypt::encrypt($products->Id)) }}"><i class="icon icon-heart"></i></a>
                                   <!--  <a class="link-ver1 chart" title="Compare" href="#"><i class="icon icon-bar-chart"></i></a> -->
                                </div>
                                <!-- End action -->
                                @php
                                $colours = DB::table('productscolor')
                                            ->select('colours.color_name')
                                            ->join('colours', 'productscolor.colorId', '=', 'colours.id')
                                            ->where('productscolor.productId','=',$products->Id)
                                            ->get();
                                $sizes = DB::table('productsize')
                                            ->select('sizes.size')
                                            ->join('sizes', 'productsize.sizeId', '=', 'sizes.id')
                                            ->where('productsize.productId','=',$products->Id)
                                            ->get();
                                @endphp
                                    <div class="infomation">
                                   <!--  <p class="sku"><span>SKU: </span>671272</p> -->
                                    <p class="category"><span>Category: </span> {{$products->category}}</p>
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
                        <!-- End col-md-5 -->
                    </div>
                    <!-- End product-details-content -->
                    <div class="hoz-tab-container space-padding-tb-40 slider-product tabs-title-v2">
                        <ul class="tabs">
                            <li class="item" rel="description">Description</li>
                            <!-- <li class="item" rel="product-tags">ADDITIONAL INFORMATION</li> -->
                            <li class="item" rel="customer">REVIEWS (5)</li>
                        </ul>
                        <div class="tab-container">
                            <div id="description" class="tab-content mockup-v2">
                                @if( $descrdecode['image'] !="")
                                <div class="row">
                                    <div class="mockup-images hover-images col-md-6">
                                        <img src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $descrdecode['image'] }}" alt="details">
                                    </div>
                                    <div class="mockup-text col-md-6">
                                        <div class="wrap-text">
                                            <div class="text">
                                                <h4>DETAILS</h4>
                                                <h3>{{$descrdecode['title']}}</h3>
                                                {!! html_entity_decode($descrdecode['description']) !!}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="container container-ver2">
                                        <div class="mockup-center space-padding-tb-50">
                                            @foreach($productimages as $images)
                                            @if( $images->image_url !='')
                                            <div class="col-md-4 col-sm-4">
                                                <div class="items">
                                                    <a href="#" class="images hover-images">
                                                        <img src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $images->image_url }}" alt="Banner">
                                                    </a>
                                                    <div class="text">
                                                        <h3>{{ $images->title }}</h3>
                                                        <p>{{ $images->description }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                            <!-- End col-md-4 -->
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- End row -->
                                <div class="row">
                                    <div class="by-tags"> 
                                    @if( $designdecode['image']!="")
                                        <img src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $designdecode['image'] }}" alt="user">
                                        @endif
                                        <h3>Designed by {{$designdecode['name']}}</h3>
                                        <a href="#" title="robertsmith.com">{{$designdecode['website']}}</a>
                                    </div>
                                </div>
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
                                             <input type="hidden" name="productid" value="{{ $products->Id }}">
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

                </div>
 <script type="text/javascript">
         $(document).ready(function(){
            $('.add-cart').click(function(){
                $('.addcart').submit();
            });
         });

         </script>
  @endsection