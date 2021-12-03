 @extends('layouts.frontendinner')
@section('content')


<div class="container">
	<div class="row">
    <div class="col-md-12 order-md-2 mb-4">
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">Dress Type</h6>
            <small class="text-muted">{{$customdesign->dresstypeselect->dresstype}}</small>
          </div>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">Dress Material</h6>
            <small class="text-muted">{{$customdesign->dressmaterialselect->material}}</small>
          </div>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">Amount To Pay</h6>
            <span class="text-muted">${{$customdesign->amount}}</span>
          </div>
          
        </li>
        
      </ul>

    </div>

  </div>
</div>











@if($customdesign->paymenttype == 'paypal')
<div id="paypal-button" style="margin-left: 55px;"></div>
@else
<form method="POST" ACTION= https://esqa.moneris.com/HPPDP/index.php >
  <input TYPE="HIDDEN" NAME="ps_store_id" VALUE="28D54tore1">
  <input TYPE="HIDDEN" NAME="hpp_key" VALUE="hpV9DB4SPC9D">
  <input TYPE="HIDDEN" NAME="charge_total" VALUE="{{ $customdesign->amount }}.00">
  <input type="hidden" name="cust_id" VALUE="invoice: 123456-12-1">
  <input type="submit" class="btn link-button hover-white checkout color-red" id="pay" value="Pay with Credit/Debit card"  name="placeorder" style="margin-left: 50px;">
</form>
@endif
<input type="hidden" name="amount" id="amount" value="{{ $customdesign->amount }}">

<form method="post" id="payment" action="{{ URL::to('updatepayment') }}">
	{{ csrf_field() }}
	<input type="hidden" name="customdesignid" id="customdesignid" value="{{$customdesign->id }}">
	<input type="hidden" name="paymentid" id="paymentid">
</form>

  @endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
            <script>
            	$(document).ready(function(){
            		$()
            	});
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
                    total: $('#amount').val(),
                    currency: 'USD'
                  }
                }]
              });
            },
            // Execute the payment
            onAuthorize: function(data, actions) {
                console.log(data);
                $('#paymentid').val(data.paymentID);
                $('#payment').submit();
            }
          }, '#paypal-button'); 

        </script>



