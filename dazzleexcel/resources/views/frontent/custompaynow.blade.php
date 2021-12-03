 @extends('layouts.frontendinner')



@section('content')

 <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
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

                <h3 style="font-size: 64px;">Custom Designing</h3>



            </div>

            <div class="container container-ver2">
                              <table class="table wishlist">

                    <thead>

                      <tr>

                        <th>Sl. No</th>

                        <th>Dress Type</th>

                        <th>Time Slot</th>

                        <th>Date</th>

                        <th>Actions</th>

                      </tr>

                    </thead>

                    <tbody>
                        @if(count($customdesigns) == 0)
                        <tr class="item_cart">
                          <td>no custom products ordered</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        @else
                         @php $i = 1;  @endphp

                        @foreach($customdesigns as $design)

                        <tr class="item_cart">

                            <td>{{$i}}</td>

                            <td>{{$design->dresstypeselect->dresstype}}</td>

                            <td>{{$design->preftime }}</td>
                          
                            <td>{{$design->prefdate}}</td>

                            <td class="add-cart"><a class="btn link-button hover-white color-red" href="{{ URL::to('custompayment/'.Crypt::encrypt($design->id)) }}" title="Pay">Pay</a></td>

                        </tr>

                        @php $i++;   @endphp

                        @endforeach
                        @endif
                       

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




 
  <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
  <script>
  $(function(){
    $("#example").dataTable();
  })
  </script>

   











 @endsection