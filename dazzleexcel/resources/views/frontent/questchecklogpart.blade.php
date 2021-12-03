 @extends('layouts.frontendinner')
@section('content')

<style type="text/css">
.or-seperator {
    margin-top: 20px;
    text-align: center;
    border-top: 1px solid #ccc;
}
.or-seperator i {
    padding: 0 10px;
    background: #f7f7f7;
    position: relative;
    top: -11px;
    z-index: 1;
}   
</style>
            <div class="main-content">
                <div class="title-page">
                    <h3>Login</h3>
                </div>
                <div class="login-box-container">
                    <div class="container">
                    	@if (Session::has('message'))
                    	<div class="alert alert-danger alert-dismissible">
 				 			<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  							<strong>Success!</strong> {{ Session::get('message') }}
						</div>
						@endif
                        <ul class="tabs">
                            <li class="item" rel="tab_1">Login</li>
                            <li class="item" rel="tab_2">Register</li>
                        </ul>
                        <div class="tab-container">
                            <div id="tab_1" class="tab-content">
                                <p>If you have an account with us, log in using your email address.</p>
                                <div class="contact-form">
                                   <!--  <a class="btn link-button link-button-fb" href="#" title="facebook">facebook</a>
                                    <a class="btn link-button link-button-gg" href="#" title="google">google</a> -->
                                    <form class="form-horizontal" name="customerlogin" method="post" action="{{ URL::to('customerlogin') }}" style="padding-left: 262px;padding-right: 188px;">

                                            {{ csrf_field() }}

                                        <div class="form-group col-md-6 col-sm-6 col-xs-6">

                                            <input type="text" class="form-control" id="inputemail" name="cemail" placeholder="Email adress*">

                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <input type="password" class="form-control" id="inputpass" name="cpassword" placeholder="Password*">
                                        </div>
                                        <div class="form-group">
                                            <!-- <a class="btn link-button lh-55 hover-white" href="#" title="Login">login<i class="link-icon-white"></i></a> -->
                                            <button class="btn link-button lh-55 hover-white" type="submit" >login<i class="link-icon-white"></i></button>
                                            <a href="{{ URL::to('questcheckout') }}">
                                                <button class="btn link-button lh-55 hover-white" type="button" >Guest Checkout<i class="link-icon-white"></i></button>
                                            </a>
                                            
                                            <div class="or-seperator"><i>or</i></div>

                                         <a class="btn link-button link-button-fb" href="{{ url('sociallogin/facebook') }}" title="facebook">facebook</a>
                                         <a class="btn link-button link-button-gg" href="{{ url('sociallogin/google') }}" title="google">google</a>
                                             
                                        </div>
                                    </form>
                                </div>
                                <!-- End contact form -->
                            </div>
                            <div id="tab_2" class="tab-content">
                                <p>Creating an account will save you time at checkout and allow you to access your order status and history.</p>
                                <div class="contact-form register">
                                   <form class="form-horizontal" method="post" name="register"  action="{{ URL::to('register') }}" style="padding-left: 262px;padding-right: 188px;">
                                   	{{ csrf_field() }}
                                        <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <input type="text" class="form-control" id="inputemail1" name="custname" placeholder="Name*">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <input type="email" class="form-control" id="inputpass2" name="custemail" placeholder="Email adress*">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <input type="password" class="form-control" id="custpass" name="custpass" placeholder="Password*">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <input type="password" class="form-control" id="inputpass3" name="custcpass" placeholder="Confirm password*">
                                        </div>
                                        <div class="form-group">
                                            <button class="btn link-button lh-55 hover-white" type="submit" >register<i class="link-icon-white"></i></button>
                                        </div>
                                        
                                        <div class="or-seperator"><i>or</i></div>

                                         <a class="btn link-button link-button-fb" href="{{ url('sociallogin/facebook') }}" title="facebook">facebook</a>
                                         <a class="btn link-button link-button-gg" href="{{ url('sociallogin/google') }}" title="google">google</a>
                                    </form>
                                </div>
                                <!-- End contact form -->
                            </div>
                        </div>
                    </div>
                    <!-- End container -->
                </div>
                <!-- End cat-box-container -->
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
            <script type="text/javascript" src="{{ asset('frontend/js/form-validation.js') }}"></script>
 @endsection