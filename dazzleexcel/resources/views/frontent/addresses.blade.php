 @extends('layouts.frontendinner')



@section('content')


<style type="text/css">
  table {
    width: auto !important;
  }
</style>
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

     

      <div class="col-lg-5">
      	

		

      	

        <div class="row">

            <div class="title-page space-padding-tb-50">

                <h3>Addresses</h3>

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



            </div>

            <div class="container container-ver2">
              <a class="btn link-button hover-white color-red" href="{{ URL::to('customer/addresses/create') }}" title="Add to cart" style="width: 0px;height: 27px;padding-left: 11px;">Add</a>
                <table class="table wishlist">
                    <thead>
                      <tr>
                        <th>Sl. No</th>
                        <th>Title</th>
                         <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($addresses as $addr)
                        <tr class="item_cart">
                            <td>{{$i}}</td>
                            <td>{{$addr->title}}</td>
                            <td>
                              @if($addr->default_address == '1')
                              <span class="label label-success">Default</span>
                              @else
                              <span class="label label-default">Not set</span>
                              @endif
                            </td>
                            <td class="add-cart"><a class="btn link-button hover-white color-red" href="{{ URL::to('customer/addresses/'.Crypt::encrypt($addr->id).'/edit') }}" title="Add to cart">Edit</a></td>
                        </tr>
                        @php $i++;   @endphp
                        @endforeach

                    </tbody>


                </table>

            </div>

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











  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/shop.css') }}"/>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

  <script type="text/javascript" src="{{ asset('frontend/js/form-validation.js') }}"></script>



  <script src="{{ asset('frontend/js/bootstrap-imageupload.js') }}"></script>

   











 @endsection