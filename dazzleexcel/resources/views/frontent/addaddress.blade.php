 @extends('layouts.frontendinner')



@section('content')



<div class="main-content">

	<div class="page-title-overlap bg-dark pt-4 container">

		<div class="col-md-3 pull-left">

			<h1 class="h3 text-light mb-0">Profile info</h1>

	    </div>

	    <div class="col-md-3 pull-right">

			<nav aria-label="breadcrumb">

				<ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">

              		<li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="czi-home"></i>Home</a></li>

              		<li class="breadcrumb-item text-nowrap"><a href="#">Account</a></li>

              		<li class="breadcrumb-item text-nowrap active" aria-current="page">Profile info</li>

            	</ol>

			</nav>

	    </div>

	</div>



      <!-- Page Content -->

  <div class="container">



    <div class="row">



      <div class="col-lg-4">



        @include('layouts.accountmenu');



      </div>

      <!-- /.col-lg-3 -->

      @php

      $fullname = Auth::user()->name;

      $splitname = explode(' ',$fullname);

      $wcount = str_word_count( $fullname); 



      $profileimage = Auth::user()->profileimage;

     

      @endphp

      <div class="col-lg-5">

      	@if (Session::has('message'))

            <div class="alert alert-success alert-dismissible">

 				<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>

  				<strong>Success!</strong> {{ Session::get('message') }}

			</div>

		@endif

		@if ($errors->any())

     @foreach ($errors->all() as $error)

         <div>{{$error}}</div>

     @endforeach

 @endif
        <div class="row">
           <div class="title-page space-padding-tb-50">

                @if($edit == 1)
                <h3 style="font-size: 55px;">Edit Addresses</h3>
                @else
                <h3 style="font-size: 55px;">Create Addresses</h3>
                @endif
                



            </div>
            @if($edit == 1)
            <form method="post" name="addeditaddress" action="{{ URL::to('customer/addresses/'.Crypt::encrypt($address->id)) }}">
              <input type="hidden" name="_method" value="put">
            @else
            <form method="post" name="addeditaddress" action="{{ URL::to('customer/addresses') }}">
            @endif
        	  

        	  	{{ csrf_field() }}
              <div class="form-check">
                @if($edit == 1)
                <input type="checkbox" name="def_addr" value="1" @if($address->default_address == '1') checked  @endif>
                @else
                <input type="checkbox" name="def_addr" value="1">
                @endif
                <label class="form-check-label" for="exampleCheck1">default</label>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="account-fn">Title</label>
                 <input class="form-control" type="text" name="titleaddr" @if($edit == 1) value="{{$address->title}}" @endif>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn">Address1</label>
                  <textarea class="form-control" name="address1" rows="3">@if($edit == 1) {{$address->address1}}  @endif</textarea>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-ln">Address2</label>
                  <textarea class="form-control" name="address2" rows="3">@if($edit == 1) {{$address->address2}}  @endif</textarea>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email">Town/city</label>
                  <input class="form-control" type="text" name="towncity" @if($edit == 1) value="{{$address->towncity}}" @endif>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="account-phone">Country</label>
                  <select name="countryid" id="countryid" class="country form-control">
                    <option selected="selected">Select Country</option>
                    @foreach($country as $count)
                    @if($edit == 1)
                    <option value="{{$count->id }}" @if($address->countryid == $count->id ) selected   @endif >{{$count->country_name}}</option>
                    @else
                    <option value="{{$count->id }}" >{{$count->country_name}}</option>
                    @endif
                    
                    @endforeach

                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="account-pass">Zipcode</label>
                  <div class="password-toggle">
                    <input class="form-control" type="text" name="zipcode" @if($edit == 1) value="{{$address->zipcode}}" @endif>
                  </div>
                </div>
              </div>
              
              <button class="btn btn-primary mt-3 mt-sm-0" type="Submit">Submit</button><br/>
          </form>
            </div>
        <!-- /.row -->
      </div>
      <!-- /.col-lg-9 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
 </div>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/shop.css') }}"/>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

  <script type="text/javascript" src="{{ asset('frontend/js/form-validation.js') }}"></script>



  <script src="{{ asset('frontend/js/bootstrap-imageupload.js') }}"></script>

   <script>

            var $imageupload = $('.imageupload');

            $imageupload.imageupload();



            $('#imageupload-disable').on('click', function() {

                $imageupload.imageupload('disable');

                $(this).blur();

            })



            $('#imageupload-enable').on('click', function() {

                $imageupload.imageupload('enable');

                $(this).blur();

            })



            $('#imageupload-reset').on('click', function() {

                $imageupload.imageupload('reset');

                $(this).blur();

            });

   </script>















 @endsection