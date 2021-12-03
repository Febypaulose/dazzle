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
 <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
  <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
 
<div class="main-content">

                <div class="title-page">

                    <h3>Card Details</h3>

                </div>

                
                <div class="cart-box-container check-out">
                    <div class="container container-ver2">
                        <div class="col-md-12">
                            <div class="checkout-heading2 space-50"><i class="icon-present icons"></i><p>Have a coupon?</p></div>
                            @if($errors->any())
                                    <div class="alert alert-danger">
                                        <p><strong>Opps Something went wrong</strong></p>
                                        <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (Session::has('message'))
                                <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                 {{ Session::get('message') }}
                              </div>
                              @endif
                              @if (Session::has('error'))
                                <div class="alert alert-danger alert-dismissible error">
                                <a href="#" class="close errorclose" data-dismiss="alert" aria-label="close">&times;</a>
                                 {{ Session::get('error') }}
                              </div>
                              @endif
                            <div class="contact-form coupon">
                                 
                                
                            </div>
                        </div>
                    </div>
                </div>
               

                     @if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif

                <div class="cart-box-container check-out">

                    <div class="container container-ver2">

                        <div class="col-md-12">

                           <!--  <div class="checkout-heading1"><i class="icon-user icons"></i><p>Returning customer?</p><a href="#" title="Click here to login">Click here to login</a></div> -->

                            

                            <h3 class="title-v3">Card Details</h3>

                            <form class="form-horizontal" method="post" action="{{ URL::to('customer/cardpayment') }}">
                                {{ csrf_field() }}
                                <div class="form-group col-md-6">
                                    <label for="inputfname" class=" control-label">Card No*</label>
                                    <input type="text" placeholder="Enter your Card No..." name="cardno" id="cardno"  class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputlname" class=" control-label">Expiry Date*</label>
                                    <input  type="month" data-date-format="mm-dd" id ="datepicker-13" placeholder="Enter your last name..." name="expdate"  value="" class="form-control">
                                    <input type="hidden" name="orderno" value="{{ $orders->orderno }}">
                                    <input type="hidden" name="orderid" value="{{ $orders->id }}">
                                    <input type="hidden" name="price" value="{{ $orders->price }}">
                                    <input type="hidden" name="invoiceid" value="{{ $orders->Invoiceid }}">
                                </div>

                              <input type="submit" class="btn link-button hover-white checkout color-red" id="pay" value="Pay Now" name="placeorder">
                            </form>
                                
                     
                            


                            


                                
                        </div>

                        <!-- End col-md-8 -->

                        
                    </div>
                    <!-- End container -->
                </div>
                <!-- End cat-box-container -->
            </div>
          
           
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

            <script type="text/javascript" src="{{ asset('frontend/js/form-validation.js') }}"></script>









 @endsection