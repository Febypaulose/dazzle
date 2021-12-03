@extends('layouts.frontendinner')

@section('content')
<style type="text/css">

.form-control {

    border: 1px solid #f1ebeb !important;

}

label + input[type=checkbox]  {

  color: #ccc;

  font-style: italic;

} 

label + input[type=checkbox]:checked {

  color: #f00;

  font-style: normal;

} 

h4 {

    margin-left: 23px;

    margin-top: -16px;

}

hr {

    border: 1px solid #e7dcdc !important;

}

.promo {
  background: #ccc;
  padding: 3px;
}

.check-out .form-horizontal label.control-label {
    padding-top: 22px;
}

</style>
<div class="main-content">
                <div class="title-page">
                    <h3>Checkout</h3>
                </div>
                <form method="post" id="checkout" name="checkout" action="{{ URL::to('questcheckout') }}">
                     {{ csrf_field() }}
                <div class="cart-box-container check-out">
                    <div class="container container-ver2">
                        <div class="col-md-8">
                           
                             <div class="checkout-heading2 space-50"><i class="icon-present icons"></i><p>Have a coupon?</p></div>
                             <div class="contact-form coupon"> 

	                             <form class="form-horizontal" method="post" action="{{ URL::to('customer/validatecoupons') }}">
	                                {{ csrf_field() }}
	                                    <div class="form-group">
	                                        <label class=" control-label" for="inputfname">Coupon</label>
	                                        <input type="text" name="couponcode" class="form-control" placeholder="Enter your Coupon code...">
	                                        <button id="applycoupon"  value="Submit" class="btn link-button link-button-v2 hover-white color-red" type="submit">APPLY COUPON</button>
	                                    </div>
	                            </form>
                            </div>
                            <h3 class="title-v3">BILLING ADDRESS</h3>
                                <div class="form-group col-md-6">
                                    <label for="inputfname" class=" control-label">First Name*</label>
                                    <input type="text" placeholder="Enter your first name..." name="fname" id="fname" value=""  class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputlname" class=" control-label">Last Name*</label>
                                    <input type="text" placeholder="Enter your last name..." name="lname" id="lname" value="" class="form-control">
                                </div>
                                <div>
                                    <div class="form-group col-md-6">
                                        <label for="inputemail" class=" control-label">Email*</label>
                                        <input type="text" placeholder="Enter your email..." name="mail" id="mail" value="" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputphone" class=" control-label">Phone*</label>
                                        <input type="text" placeholder="Enter your phone..." name="phone" id="phone" value="" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                        <label for="inputphone" class=" control-label">Password*</label>
                                        <input type="password" placeholder="Enter your Password..." name="pass" id="pass" value="" class="form-control">
                               </div>

                                <div class="form-group">
                                    <label for="inputstreet" class=" control-label">Adsdress*</label>
                                    <input type="text" placeholder="Enter your street address..." name="address1" id="address1" class="form-control space-20">
                                    <input type="text" placeholder="Enter the apartment, floor, suite, etc..." name="address2" id="address2" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputcountry" class="country_name control-label">Town/City*</label>
                                    <input type="text" placeholder="Enter your Town..." name="city" id="city" class="form-control space-20">
                                </div>
                                <div>
                                    <div class="form-group col-md-6">
                                    <label for="inputcountry1" class=" control-label">COUNTRY*</label>
                                    <select name="countryid" id="countryid" class="country form-control">
                                        <option selected="selected">Select Country</option>
                                        @foreach($country as $count)
                                        <option value="{{$count->id }}">{{$count->country_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputpostcode" class=" control-label">POSTCODE *</label>
                                        <input type="text" placeholder="Enter your postcode..." name="pocode" id="pocode" class="form-control">
                                    </div>
                                </div>
                                <div class="form-check1">
                                    <input type="checkbox" name="addr_save" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Save in my Address</label>
                                 </div>
                            </form>
                            <h3 class="title-v3">SHIPPING ADDRESS</h3>
                            <div class="form-check1">
                                    <input type="checkbox" name="shipping_save" id="shipping_save" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Same as Billing Address</label>
                            </div>
                            <div class="shipping">
                                <div class="form-group col-md-6">
                                    <label for="inputfname" class=" control-label">First Name*</label>
                                    <input type="text" placeholder="Enter your first name..." name="shipfname" id="shipfname" value=""  class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputlname" class=" control-label">Last Name*</label>
                                    <input type="text" placeholder="Enter your last name..." name="shiplname" id="shiplname" value="" class="form-control">
                                </div>
                                <div>
                                    <div class="form-group col-md-6">
                                        <label for="inputemail" class=" control-label">Email*</label>
                                        <input type="text" placeholder="Enter your email..." name="shipmail" id="shipmail" value="" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputphone" class=" control-label">Phone*</label>
                                        <input type="text" placeholder="Enter your phone..." name="shipphone" id="shipphone" value="" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputstreet" class=" control-label">Adress*</label>
                                    <input type="text" placeholder="Enter your street address..." name="shipaddress1" id="shipaddress1" class="form-control space-20">
                                    <input type="text" placeholder="Enter the apartment, floor, suite, etc..." name="shipaddress2" id="shipaddress2" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputcountry" class="country_name control-label">Town/City*</label>
                                    <input type="text" placeholder="Enter your Town..." name="shipcity" id="shipcity" class="form-control space-20">
                                </div>
                                <div>
                                    <div class="form-group col-md-6">
                                    <label for="inputcountry1" class=" control-label">COUNTRY*</label>
                                    <select name="scountryid" id="scountryid" class="country form-control">
                                        <option selected="selected">Select Country</option>
                                        @foreach($country as $count)
                                        <option value="{{$count->id }}">{{$count->country_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputpostcode" class=" control-label">POSTCODE *</label>
                                        <input type="text" placeholder="Enter your postcode..." name="shippocode" id="shippocode" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-horizontal form-group">
                                    <label for="inputmail" class=" control-label">Additional Notes</label>
                                    <textarea name="note" id="note" class="form-control"></textarea>
                                </div>
                            
                        </div>
                        <!-- End col-md-8 -->
                        <div class="col-md-4">
                            <div class="text-price">
                                <h3>YOUR ORDER</h3>
                                @php  $grandtotal = [];  @endphp
                                @php   
                                $cartcount = count($carts);
                                if($cartcount == 1){
                                 $flatrate = 18;
                                 } else if($cartcount == 2){
                                 $flatrate = 23;
                                 } else if($cartcount > 2){
                                 $flatrate = 26;
                                }
                                $appliedcoupon = Session::get('couponcode'); 
                                if(!empty($appliedcoupon)){
                                    $coupondata = DB::table('coupons')->where('code','=',$appliedcoupon)->first();
                                    $type = $coupondata->type;
                                    if($type == 'fixed'){
                                    $amount = $coupondata->value;
                                    } else if($type == 'percent'){
                                    $amount = $coupondata->percent_off;
                                    }
                                } 
                                @endphp
                                <ul>
                                    <li><span class="text bold">Product</span><span class="number bold">Total</span></li>
                                     @foreach($carts as $cart)
                                    @php
                                    $quantity = $cart->quantity;
                                    $totalamt = $cart->product_price * $cart->quantity;
                                    $grandtotal[] = $cart->product_price * $cart->quantity;
                                    @endphp
                                    <li><span class="text bold text-cap">{{$cart->product_name}}<br>QTy : {{$cart->quantity}}</span></span><span class="number">{!! Helper::currency_conversion($cart->product_price) !!} </span></li>
                                    @endforeach
                                    <li><span class="text">Subtotal</span><span class="number" >{!! \Helper::currency_conversion(array_sum($grandtotal)); !!}</span></li>
                                     
                                        <!--<span class="text">Flat Rate</span><br/>-->
                                    @if(!empty($appliedcoupon))
                                    @if($type == 'fixed')
                                    @php  
                                    $total = array_sum($grandtotal) + $flatrate - $amount; 
                                    $gst = $total * 5/100;
                                    $finaltotal = $total + $gst;
                                    @endphp
                                    @endif
                                    @else
                                    @php 
                                    $total = array_sum($grandtotal) + $flatrate; 
                                    $gst = $total * 5/100;
                                    $finaltotal = $total + $gst;
                                    @endphp
                                    @endif
                                    @php
                                    @endphp
                                     <li><span class="text">Shipping Rate</span><span class="number" >{!! Helper::currency_conversion($flatrate) !!}</span></li>
                                     <li><span class="text">GST(5%)</span><span class="number" >{!! Helper::currency_conversion($gst) !!}</span></li>
                                     
                                        <!--<label>Shipping Rate: {!! Helper::currency_conversion($flatrate) !!}</label><br/>-->
                                        <!--<label>GST(5%): {!! Helper::currency_conversion($gst) !!}</label><br/>-->
                                        @if(!empty($appliedcoupon))
                                        <!--<p>Coupon Applied: <span class="promo">{{$appliedcoupon}}</span> ({!! Helper::currency_conversion($amount) !!} Discount)</p>-->
                                        <li><span class="text">Coupon Applied</span><span class="promo">{{$appliedcoupon}}</span> ({!! Helper::currency_conversion($amount) !!} Discount)</li>
                                        @endif
                                    
                                    <input type="hidden" name="" value="{!! \Helper::currency_payment(array_sum($grandtotal)); !!}" id="gtotal" name="gtotal" >
                                    <input type="hidden" name="finalamt" id="finalamt" value="{!! Helper::currency_payment($finaltotal) !!}" name="finalamt">
                                    <input type="hidden" name="cartid" value="{{$cart->id}}">
                                    <input type="hidden" name="paymenttype" id="paymenttype" value="creditcard">
                                    <input type="hidden" name="shippingamt" id="shippingamt" value="{!! Helper::currency_payment($flatrate) !!}">
                                    <input type="hidden" name="paymentId" id="paymentId">
                                    <input type="hidden" name="taxamt" value="{!! Helper::currency_payment($gst) !!}">
                                   
                                    <li><span class="text">Totals</span><span class="number" id="grandtotal">{!! Helper::currency_conversion($finaltotal) !!}</span></li>
                                 
                                    <hr/>
                                </ul>
                                    
                                </ul>
                                
                                <input type="submit" class="btn link-button hover-white checkout color-red" id="pay" value="Pay with Credit/Debit card"  name="placeorder">
                                <br/>
                                <div style="margin-left: 78px;margin-top: 14px;">Or</div><br>
                                <div id="paypal-button"></div>
                            </div>
                        </div>
                    </div>
                    </form>
                    <!-- End container -->
                </div>
                <!-- End cat-box-container -->
            </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('input[type="radio"]').on('change', function() {
                    $('input[name="' + this.name + '"]').not(this).prop('checked', false);
                });

                $('.shipping').click(function(){
                    var gtotal = $('#gtotal').val();
                    var method = $(this).val();
                    if (method == 'Flatrate') {
                        var total = parseInt(gtotal) + parseInt(100);
                        var grandtotal = '$'+ total + '.00';
                        $('#grandtotal').html(grandtotal);
                         $('#finalamt').val(total);
                         $('#shippingamt').val(100);
                    } else if(method == 'Freeshipping') {
                        var total = parseInt(gtotal) + parseInt(0);
                        var grandtotal = '$'+ total + '.00';
                        $('#grandtotal').html(grandtotal);
                        $('#finalamt').val(total);
                        $('#shippingamt').val(0);
                    } else if(method == 'internationalDelivery') {
                        var total = parseInt(gtotal) + parseInt(170);
                        var grandtotal = '$'+ total + '.00';
                        $('#grandtotal').html(grandtotal);
                        $('#finalamt').val(total);
                        $('#shippingamt').val(170);
                    } else if(method == 'LocalDelivery') {
                        var total = parseInt(gtotal) + parseInt(60);
                        var grandtotal = '$'+ total + '.00';
                        $('#grandtotal').html(grandtotal);
                        $('#finalamt').val(total);
                        $('#shippingamt').val(60);
                    } else if(method == 'Pickup') {
                        var total = parseInt(gtotal) + parseInt(0);
                        var grandtotal = '$'+ total + '.00';
                        $('#grandtotal').html(grandtotal);
                        $('#finalamt').val(total);
                        $('#shippingamt').val(0);
                    }
                });

                $('#shipping_save').change(function(){
                    var fname = $('#fname').val();
                    var lname = $('#lname').val();
                    var mail = $('#mail').val();
                    var phone = $('#phone').val();
                    var addr1 = $('#address1').val();
                    var addr2 = $('#address2').val();
                    var city = $('#city').val();
                    var countryid = $('#countryid').val();
                    var pocode = $('#pocode').val(); 

                    $('#shipfname').val(fname);
                    $('#shiplname').val(lname);
                    $('#shipmail').val(mail);
                    $('#shipphone').val(phone);
                    $('#shipaddress1').val(addr1);
                    $('#shipaddress2').val(addr2);
                    $('#shipcity').val(city);
                    $('#scountryid').val(countryid);
                    $('#shippocode').val(pocode);


                    $('.shipping').hide();
                });

                $('.errorclose').click(function(){
                    $('.error').hide();
                })


                $('#applycoupon').click(function(){
                    $('#couponadd').submit();
                })

                $('#addressid').change(function(){
                    var id = $(this).val();
                    $.ajax({
                        type:"GET",
                        url: "{{ URL::to('customer/getsavedaddress') }}",
                        data: {id:id},
                        success : function(response){
                            console.log(response.address1);
                            $('#address1').val(response.address1);
                            $('#address2').val(response.address2);
                            $('#city').val(response.towncity);
                            $('#countryid').val(response.countryid);
                            $('#pocode').val(response.zipcode);
                        }
                    })
                });
})
</script>
<script>
            paypal.Button.render({
            // Configure environment
            env: 'sandbox',
            client: {
              sandbox: 'AYDpNuKHFtxXVK4CQdkXv-4rPkD-_-vYlSJEPcRRIjsfNUhckBiN-I1tsTVIhmeVMMW2xq8J1Xtc8XDw'
            },
            // Set up a payment
            payment: function(data, actions) {
              return actions.payment.create({
                transactions: [{
                  amount: {
                    total: $('#finalamt').val(),
                    currency: 'CAD'
                  }
                }]
              });
            },
            // Execute the payment
            onAuthorize: function(data, actions) {
                console.log(data);
                $('#paymenttype').val('paypal');
                $('#paymentId').val(data.paymentID);
                $('#checkout').submit();
            }

          }, '#paypal-button'); 
        </script>

























 @endsection