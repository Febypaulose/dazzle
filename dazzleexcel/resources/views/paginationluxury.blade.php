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
                                
                                <a href="{{ URL::to('luxury/'.Crypt::encrypt($product->Id)) }}" title="product-images">
                                    @if($image->image_url !='')
                                    <img class="primary_image" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image->image_url }}" alt="" style="width:80%height:100%" />
                                    <img class="secondary_image" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image->image_url }}" alt=""  style="width:80%height:100%" />
                                     @else
                                    <img class="primary_image" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image->image_url }}" alt="" style="width:210px;height:263px" />
                                    <img class="secondary_image" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image->image_url }}" alt=""  style="width:210px;height:263px" />
                                    @endif
                                </a>

                                <div class="action">
                                    <!--<a class="zoom" href="{{ URL::to('luxury/'.Crypt::encrypt($product->Id)) }}" title="Quick view"><i class="icon icon-magnifier-add "></i></a>-->
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
                            <a href="Product Details.html" title="Bouble Fabric Blazer"><p class="product-title">{{$product->product_name}}</p></a>
                            @if(!empty($offers))
                             <p class="product-price" style="margin-left: -81px;margin-top: -12px;">{!! Helper::getdiscountamt($product->Id,$product->product_price) !!}</p>
                             <p style="margin-top: -37px;margin-left: 64px;text-decoration: line-through;">{!! Helper::currency_conversion($product->product_price) !!}</p>
                              @else
                              @if(!empty($offerswhole))
                              @php
                              $offeramt = $offerswhole->percentage;
                              $disc = $product->product_price * $offeramt/100;
                              
                                    $offeramt = $offerswhole->percentage;

                              
                             $disc=$product->product_price - ($product->product_price * ($offeramt/100));
                              
                              @endphp
                              <p class="product-price" style="margin-left: -81px;margin-top: -12px;">{!! Helper::currency_conversion($disc) !!}</p>
                             <p style="margin-top: -37px;margin-left: 64px;text-decoration: line-through;">{!! Helper::currency_conversion($product->product_price) !!}</p>
                              @else
                            <p style="margin-top: -5px;margin-left: 14px;">{!! Helper::currency_conversion($product->product_price) !!}</p>
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
            
         <script type="text/javascript">

         $(document).ready(function(){

            // $('.add-cart').click(function(){

            //     $('.addcart').submit();

            // });

             $('.add-cart-productlist').click(function(){

             var productid = $(this).attr("data-id"); 

             $('#productId').val(productid);

             var classname = '.productlist-'+productid;

            $(classname).submit();

            });

            // $('.orderby').change(function(){

            //     $('.order-by').submit();

            // });

            $('#pagination').change(function(){
                ('.paginate').submit();
            });

           $('.list').click(function(){

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

             url: "{{ URL::to('quickviewluxury') }}",

             type:'get',

             data: {id:productid},

             success : function(response){



                var productname = response.detail.product_name;

                var descr = response.detail.product_name;

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