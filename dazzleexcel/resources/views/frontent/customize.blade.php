 @extends('layouts.frontendinner')







@section('content')



<style type="text/css">



label {



    vertical-align:middle;



}



</style>



            <div class="container">



                <div class="banner-product-details3">



                    <!-- <img src="assets/images/banner-catalog1.jpg" alt="Banner"> -->



                    <h3>SHORT-SLEEVED JERSEY SHIRT</h3>



                </div>



            </div>



            <!-- End product details -->







            <div class="container container-ver2">



                <div class="product-details-content">



                    <div class="col-md-6">



                        <div class="product-img-box product-img-box-v2">



                            <a id="image-view" title="Product Image">



                                <img id="image" src="{{ asset('frontend/images/products/1a.jpg') }}" alt="Product" />



                            </a>



                        </div>



                        <!-- End product-img-box -->



                    </div>



                    <div class="col-md-6 box-detalis-v2">











                        <div class="box-details-info">



                            <div class="breadcrumb">



                                <ul>



                                    <li><a href="#">Home</a></li>



                                    <li class="active">Product Details</li>



                                </ul>



                            </div>



                            <div class="product-name">



                                <h1>Customize Designar Salwar</h1><br/>



                            </div>







                            <!-- End Price -->



                        </div>



                        <!-- End box details info -->







                        <div class="options">



                            <p>



                                It is a long established fact that a reader will be distracted by the readable



                                content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using



                                'Content here, content here', making it look like readable English..



                            </p>



                            <div>







                            </div>



                        </div>



                        <!-- End Options -->



                         @if (Session::has('success'))



                        <div class="alert alert-success alert-dismissible">



                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>



                          <strong>Success!</strong>{{ Session::get('success') }}



                        </div>



                        @endif



                        @if ($errors->any())



                             @foreach ($errors->all() as $error)



                                 <div>{{$error}}</div>



                             @endforeach



                         @endif



                        <div class="col-md-12">



                            <form method="post" action="{{ URL::to('customdesigning') }}"  class="form-horizontal space-50" enctype='multipart/form-data'>

                                {{ csrf_field() }}

                                <div class="form-group">

                                    <label>Name</label>

                                    @if(!empty(Auth::user()))

                                    <input type="text" class="form-control" name="fullname" placeholder="" value="{{ Auth::user()->name}}">

                                    <input type="hidden" name="userid" value="{{ Auth::user()->id }}">

                                    @else

                                    <input type="text" class="form-control" name="fullname" placeholder="" >

                                    @endif

                                </div>

                                <div class="form-group">

                                    <label>Email</label>

                                    @if(!empty(Auth::user()))

                                    <input type="text" class="form-control" name="mail" value="{{ Auth::user()->email}}" placeholder="">

                                    @else

                                    <input type="text" class="form-control" name="mail" placeholder="">

                                    @endif

                                </div>

                                <div class="form-group">

                                    <label>Phone</label>

                                    @if(!empty(Auth::user()))

                                    <input type="text" class="form-control" name="phone" id="inputsumary3" value="{{ Auth::user()->phone}}" placeholder="">

                                    @else

                                    <input type="text" class="form-control" name="phone" id="inputsumary3"  placeholder="">

                                    @endif

                                    

                                </div>



                                 <div class="form-group">

                                    <label>Payment Type</label><br/>

                                    <select id="myList" name="paytype">

                                        <option value="1">Select</option>

                                        <option value="card">Credit card / Debit Card</option>

                                        <option value="paypal">Paypal</option>

                                    </select>



                                </div>



                                <div class="form-group">



                                    <label>Type Of Dress</label><br/>



                                    <select id="myList" name="typeId">



                                        <option value="1">Select</option>



                                        @foreach($dresstype as $type)



                                        <option value="{{$type->id }}">{{$type->dresstype}}</option>



                                        @endforeach



                                        



                                    </select>



                                </div>



                                <div class="form-group">



                                    <label>Color</label><br/>



                                   <select id="example-getting-started" name="color[]" multiple="multiple">



                                        @foreach($colours as $color)



                                        <option value="{{$color->id }}">{{$color->color_name}}</option>



                                        @endforeach



                                    </select>







                                </div>



                                 <div class="form-group">



                                    <label>Type Of Material</label><br/>



                                    <select id="myList" name="materialid">



                                        <option value="1">Select</option>



                                        @foreach($materials as $mat)



                                        <option value="{{$mat->id }}">{{$mat->material}}</option>



                                        @endforeach



                                        



                                    </select>



                                </div>



                                  <div class="form-group" style="margin-left: -140px;">



                        <div class="col-sm-6 col-sm-offset-3 handwork">



                            <label>Hand-work required</label><br/>



                            



                            <label class="radio-inline">



                                <input type="radio" name="handwork" value="yes" /> Yes



                            </label>



                            



                            <label class="radio-inline">



                                <input type="radio" name="handwork" value="no" /> No



                            </label>



                        </div>



                    </div>



                    <div class="form-group">
                            <label>Upload any custom design</label>
                            <input type="file" class="form-control" name="design" placeholder="">
                    </div>

                    <div class="form-group">
                        <label>Additional Requirement</label>
                        <input type="text" class="form-control" name="additionreq" id="additionreq"  placeholder="Additional Requirement">
                     </div>

                    <div class="form-group">
                            <label>Preferred time slot for designer to contact</label>
                            <input type="time" class="form-control" name="ptime" placeholder="">
                    </div>







                    <div class="form-group">



                            <label>When is the product required(Date)</label>



                            <input type="date" class="form-control" name="pdate" id="pdate" placeholder="">



                    </div>



                                <button type="submit" class="button-v2 hover-black color-black">Proceed with this design<i class="link-icon-black"></i></button>



                                <!-- <a class="button-v2 hover-black color-black" href="#" title="add tags">Proceed with this design<i class="link-icon-black"></i></a> -->



                            </form>



                        </div>







                        <br/>



                



                        </div>



                    </div>



                <!-- End product-details-content -->



            </div>




<script type="text/javascript">
$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
   
    $('#pdate').attr('min', maxDate);
});
</script>










 @endsection



