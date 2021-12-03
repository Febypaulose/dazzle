 @extends('layouts.frontendinner')



@section('content')



<div class="main-content">

	<div class="page-title-overlap bg-dark pt-4 container">

		<div class="col-md-3 pull-left">

			<h1 class="h3 text-light mb-0">Testimonials</h1>

	    </div>

	    <div class="col-md-3 pull-right">

			<nav aria-label="breadcrumb">

				<ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">

              		<li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="czi-home"></i>Home</a></li>

              		<li class="breadcrumb-item text-nowrap"><a href="#">Account</a></li>

              		<li class="breadcrumb-item text-nowrap active" aria-current="page">Testimonials</li>

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

      	<div class="bg-secondary rounded-lg p-4 mb-4">

            

        </div>

        <div class="row">

        	  <form method="post" name="profileedit" action="{{ URL::to('customer/testimonials') }}" enctype='multipart/form-data'>

        	  	{{ csrf_field() }}

              <div class="col-sm-12">

                <div class="form-group">

                  <label for="account-fn">Message</label>

                  <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3"></textarea>

                </div>

              </div>



               <div class="col-sm-12">

                <div class="form-group">

                  <label for="account-fn">Image</label>

                  <input class="form-control" type="file"  name="image">

                </div>

              </div>

              

              

              

              

             

              

              <button class="btn btn-primary mt-3 mt-sm-0" type="Submit">Add</button>

          </form>

            </div>



        <div class="row">



         



        </div>

        <!-- /.row -->



      </div>

      <!-- /.col-lg-9 -->



    </div>

    <!-- /.row -->



  </div>

  <!-- /.container -->







 </div>





  <!-- Modal -->

  <div class="modal fade" id="myModal" role="dialog">

    <div class="modal-dialog">

    

      <!-- Modal content-->

      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Modal Header</h4>

        </div>

        <form method="post" method="post" action="{{ URL::to('customer/updateprofilepic') }}" enctype="multipart/form-data">

        	{{ csrf_field() }}

        <div class="modal-body">

          <div class="imageupload panel panel-default">

                <div class="panel-heading clearfix">

                    <h3 class="panel-title pull-left">Upload Image</h3>

                    

                </div>

                <div class="file-tab panel-body">

                    <label class="btn btn-default btn-file">

                        <span>Browse</span>

                        <!-- The file is stored here. -->

                        <input type="file" name="profileimage">

                    </label>

                    <button type="button" class="btn btn-default">Remove</button>

                </div>

                <div class="url-tab panel-body">

                    <div class="input-group">

                        <input type="text" class="form-control hasclear" placeholder="Image URL">

                        <div class="input-group-btn">

                            <button type="button" class="btn btn-default">Submit</button>

                        </div>

                    </div>

                    <button type="button" class="btn btn-default">Remove</button>

                    <!-- The URL is stored here. -->

                    <input type="hidden" name="image-url">



                     

                </div>

            </div>

        </div>

        <div class="modal-footer">

          <button type="Submit" class="btn btn-default">Submit</button>

          <button type="Submit" class="btn btn-default" data-dismiss="modal">Close</button>

        </div>

    </form>

      </div>

      

    </div>

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