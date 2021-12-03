   <div id="primary" class="col-xs-12 col-md-9">

                <div class="products grid_full grid_sidebar">

                    @foreach($products as $product)

                    @php 

                    $image = DB::table('productsimages')->where('productId','=',$product->Id)->first();

                     $offers = DB::table('offers')->where('productid','=',$product->Id)->first();

                     $offerswhole = DB::table('offers')->where('type','=','wholewebsite')->first(); 

                    @endphp

                    <div class="item-inner">

                        <div class="product">

                            <div class="product-images">

                                <a href="{{ URL::to('productdetail/'.Crypt::encrypt($product->Id)) }}" title="product-images">
                                @if( $image->image_url !='')
                                    <img class="primary_image" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image->image_url }}" alt="" style="width:80%;height:100%" />

                                    <img class="secondary_image" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image->image_url }}" alt="" style="width:80%;height:100%"/>
                                    @else
                                    
                                     <img class="primary_image" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image->image_url }}" alt="" style="width:168px;height:210px" />

                                    <img class="secondary_image" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image->image_url }}" alt="" style="width:168px;height:210px"/>
                                    @endif
                                
                                 
                                 
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

                            <a href="{{ URL::to('customer/wishlist/'.Crypt::encrypt($product->Id)) }}" title="Bouble Fabric Blazer">

                                <p class="product-title productcolname">{{ Str::limit($product->product_name, 22) }}</p>

                                 <p class="product-title productlistname" style="display:none">{{ $product->product_name }}</p>

                                </a>

                            



                          

                            @if(!empty($offers))

                             <!--<p class="product-price" style="margin-left: -81px;margin-top: -12px;">{!! Helper::getdiscountamt($product->Id,$product->product_price) !!}</p>-->

                             <!--<p style="margin-top: -37px;margin-left: 64px;text-decoration: line-through;">{!! Helper::currency_conversion($product->product_price) !!}</p>-->

                             

                             <p class="colpricecurrent">{!! Helper::getdiscountamt($product->Id,$product->product_price) !!}</p>

                             <p class="product-price colpricediscount">{!! Helper::currency_conversion($product->product_price) !!}</p>

                    

                             <p class="product-price listpricediscount">{!! Helper::currency_conversion($product->product_price) !!}</p>

                             <p class="listpricecurrent">{!! Helper::getdiscountamt($product->Id,$product->product_price) !!}</p>

                              @else

                              @if(!empty($offerswhole))

                              @php

                              $offeramt = $offerswhole->percentage;

                              
                             $disc=$product->product_price - ($product->product_price * ($offeramt/100));
                              @endphp
                            
                             

                             <p class="colpricecurrent">{!! Helper::currency_conversion($disc) !!}</p>

                            <p class="product-price colpricediscount">{!! Helper::currency_conversion($product->product_price) !!}</p>

                             </p>

                    

                            <p class="product-price listpricediscount">{!! Helper::currency_conversion($product->product_price) !!}</p>

                             </p>

                            <p class="listpricecurrent">{!! Helper::currency_conversion($product->Id,$disc) !!}</p>

                              @else

                              <p class="colprice">{!! Helper::currency_conversion($product->product_price) !!}</p>

                              <p class="listprice">{!! Helper::currency_conversion($product->product_price) !!}</p>

                              @endif

                              

                             @endif

                        </div>

                        <!-- End product -->

                    </div>

                    @endforeach

                </div>

                <!-- End product-content products  -->

                <div class="pagination-container">

                    {{ $products->links() }}

                </div>

                <!-- End pagination-container -->

            </div>