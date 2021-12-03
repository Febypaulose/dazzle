 @extends('layouts.frontendinner')



@section('content')

<style type="text/css">

.input-number

{

	width: 47px;

	height: 25px;

    margin-left: -74px;

}

</style>

            <div class="main-content">

                <div class="title-page">

                    <h3>Cart</h3>

                </div>

                <div class="cart-box-container">

                    <div class="container container-ver2">

                        <div class="col-md-8">

                            <table class="table cart-table space-80">

                                <thead>

                                    <tr>

                                        <th class="product-photo">Product</th>

                                        <th class="produc-name"></th>

                                        <th class="product-quantity">qty</th>

                                        <th class="total-price">Total</th>

                                        <th class="product-remove"></th>

                                    </tr>

                                </thead>

                                <tbody>

                                	@php  $grandtotal = [];   @endphp
                                	@foreach($carts as $cart)
                                	@php
                                    if(!empty(Auth::user())) {
                                    $image = DB::table('productsimages')
                                             ->select('image_url')
                                             ->where('productId',$cart->productId)
                                             ->first();
                                    } else {
                                    $image = DB::table('productsimages')
                                             ->select('image_url')
                                             ->where('productId',$cart->productid)
                                             ->first(); 
                                    }
					                $quantity = $cart->quantity;
					                $totalamt = $cart->product_price * $cart->quantity;
					                $grandtotal[] = $cart->product_price * $cart->quantity;
					                @endphp
                                    <tr class="item_cart">
                                        <td class="product-photo"><img src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image->image_url }}" alt="Futurelife" height="100" width="100"></td>
                                        <td class="produc-name"><a href="#" title="">{{$cart->product_name}}</a><p class="price">${{$cart->product_price}}</p></td>
                                        <td class="product-quantity">
                                            <form method="post" class="cartupdate-{{$cart->id}}" action="{{ URL::to('customer/carts/'.Crypt::encrypt($cart->id)) }}" enctype="multipart/form-data">
                                            	<input type="hidden" name="_method" value="put">
                                                <input type="hidden" name="cartupdclass" id="cartupdclass" value="cartupdate-{{$cart->id}}">
                                            	{{ csrf_field() }}
                                                @if(!empty(Auth::user()))
                                                <input type="hidden" value="{{$cart->productId}}" name="productid" class="productId">
                                                @else
                                                <input type="hidden" value="{{$cart->productid}}" name="productid" class="productId">
                                                @endif
                                                <input type="hidden" name="cartid" value="{{$cart->id }}">
                                                <div class="product-signle-options product_15 clearfix">
                                                    <div class="selector-wrapper size">
                                                       <div class="container " style="display: flex;">
                                                    	<button type="button" class="plus-sign" data-qty="{{$cart->quantity}}" data-id="{{$cart->id }}"><i class="fa fa-plus"></i></button>
														<input type="text" name="quant" class="form-control input-number" value="{{$cart->quantity}}" min="1" max="10">
														<button type="button" class="minus-sign" data-qty="{{$cart->quantity}}" data-id="{{$cart->id }}" style="margin-left: -73px;"><i class="fa fa-minus"></i></button>
													    </div>
                                                    </div>
                                                </div>
                                            </form>

                                        </td>

                                        <td class="total-price">${{ $totalamt  }}.00</td>

                                        <td class="product-remove"><a class="remove" href="#" title=""></a></td>

                                    </tr>

                                    @endforeach

                                    

                                </tbody>

                            </table>

                            

                        </div>

                        <!-- End contact-form -->

                        <div class="col-md-4">

                            <div class="text-price">

                                <h3>CART TOTALS</h3>

                                <ul>

                                    <li><span class="text">Subtotal</span><span class="number">${{ array_sum($grandtotal) }}.00</span></li>

                                    <!-- <li>

                                        <span class="text">Shipping</span>

                                        <div class="payment">

                                            <form action="#">

                                                <input type="radio" name="gender" value="Flat" id="radio1" checked="checked">

                                                <label for="radio1">Flat Rate: $100.00</label>

                                                <input type="radio" name="gender" value="Free" id="radio2">

                                                <label for="radio2">Free Shipping</label>

                                                <input type="radio" name="gender" value="Delivery" id="radio3">

                                                <label for="radio3">International Delivery: $170.00</label>

                                                <input type="radio" name="gender" value="Local-Delivery" id="radio4">

                                                <label for="radio4">Local Delivery: $60.00</label>

                                                <input type="radio" name="gender" value="Pickup" id="radio5">

                                                <label for="radio5">Local Pickup (Free)</label>

                                            </form>

                                        </div>

                                    </li>

                                    <li>

                                        <span class="text calculate">Calculate shipping</span>

                                        <form class="zipcode" action="#">

                                            <input type="text" class="form-control" placeholder="Zipcode">

                                        </form>

                                    </li> -->

                                    <li><span class="text">Totals</span><span class="number">${{ array_sum($grandtotal) }}.00</span></li>

                                </ul>

                               <!--  <a class="btn link-button hover-white update" href="#" title="UpDATE CART">UpDATE CART</a> -->

                                <a class="btn link-button hover-white checkout" href="{{ URL::to('customer/checkout') }}" title="Proceed to checkout">Proceed to checkout</a>

                            </div>

                        </div>

                    </div>

                    <!-- End container -->

                </div>

                <!-- End cat-box-container -->

            </div>

            

            <script type="text/javascript">

            $(document).ready(function(){

            	$('.plus-sign').click(function(){

            		//var quantity = $('.input-number').val(); 
                    var quantity = $(this).attr("data-qty");
                    var dataId = $(this).attr("data-id");

            		if (quantity ==1 || quantity > 1) {

            		    var newquatity = parseInt(quantity) + 1;

            		    $('.input-number').val(newquatity);

            		   $('.cartupdate-'+dataId).submit();

            		}

            	});

            	$('.minus-sign').click(function(){
            		//var quantity = $('.input-number').val();
                    var dataId = $(this).attr("data-id");
                    var quantity = $(this).attr("data-qty");

            		if (quantity > 1) {

            			var newquatity = parseInt(quantity) - 1;

            		$('.input-number').val(newquatity);

                    $('.cartupdate-'+dataId).submit();

            		}

            	});

            });

            </script>













































 @endsection