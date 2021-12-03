@extends('layouts.form')
@section('content')

<div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                        	<a href="{{ URL::to('manage/offers') }}">
                            <button type="button" class="btn btn-custom">Back</button>
                        </a>

                        </div>
                        @if($edit == 1)
                        <h4 class="page-title">Edit Offers</h4>
                        @else
                        <h4 class="page-title">Add Offers</h4>
                        @endif
                    </div>
                </div>
                <!-- end row -->

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


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">

                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12">
                                	
                                    <div class="p-20">
                                        @if($edit == 1)
                                        <form method="post" action="{{ URL::to('manage/offers/'.Crypt::encrypt($offer->id)) }}" data-parsley-validate novalidate>
                                        <input type="hidden" name="_method" value="put">
                                        @else
                                        <form method="post" action="{{ URL::to('manage/offers/') }}" data-parsley-validate novalidate>
                                        @endif
                                        
                                        {{ csrf_field() }}

                                            <div class="form-group">
                                                <label for="userName">Type</label>
                                                <select class="form-control" id="type" name="type" required>
                                                    <option value="">Select</option>
                                                    @if($edit == 1)
                                                    <option value="wholewebsite" @if($offer->type == 'wholewebsite') selected  @endif>Whole Website</option>
                                                    <option value="individualproduct" @if($offer->type == 'individualproduct') selected  @endif>individual Product</option>
                                                    @else
                                                    <option value="wholewebsite">Whole Website</option>
                                                    <option value="individualproduct">individual Product</option>
                                                    @endif
                                                    
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="userName">Percentage</label>
                                                 @if($edit == 1)
                                                 <input type="text" required placeholder="Enter Percentage" class="form-control" name="percentage" value="{{ $offer->percentage }}">
                                                 @else
                                                 <input type="text" required placeholder="Enter Percentage" class="form-control" name="percentage">
                                                 @endif
                                                 
                                            </div>

                                            @if($edit == 1)
                                            @if($offer->type == 'individualproduct')

                                            <div class="row category"  style="display: flex;">
                                            @else
                                            <div class="row category"  style="display: none;">
                                            @endif
                                            
                                            @else
                                            <div class="row category"  style="display: none;">
                                            @endif
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="userName">parent Category</label>
                                                        <select class="form-control" id="pcatid" name="pcatid">
                                                            <option value="">Select</option>
                                                            @foreach($category as $cat)
                                                            @if($edit == 1)
                                                            <option value="{{$cat->Id }}" @if($offer->parentid == $cat->Id) selected   @endif>{{$cat->category}}</option>
                                                            @else
                                                            <option value="{{$cat->Id }}">{{$cat->category}}</option>
                                                            @endif
                                                            
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="userName">Category</label>
                                                        <select class="form-control" id="catid" name="catid">
                                                            <option value="">Select</option>
                                                            @if($edit == 1)
                                                                @foreach($maincategory as $cat1)
                                                                <option value="{{$cat1->Id }}" @if($offer->categoryid == $cat1->Id) selected   @endif>{{$cat1->category}}</option>
                                                                @endforeach
                                                            
                                                            @endif
                                                           
                                                        </select>
                                                    </div>
                                                </div>

                                                <!--<div class="col-md-3">-->
                                                <!--    <div class="form-group">-->
                                                <!--        <label for="userName">sub Category</label>-->
                                                <!--        <select class="form-control" id="subcatid" name="subcatid">-->
                                                <!--            <option value="">Select</option>-->
                                                <!--            @if($edit == 1)-->
                                                <!--                @foreach($subcategory as $subcat)-->
                                                <!--                <option value="{{$subcat->Id }}" @if($offer->subcategoryid == $subcat->Id) selected   @endif>{{$subcat->category}}</option>-->
                                                <!--                @endforeach-->
                                                            
                                                <!--            @endif-->
                                                            
                                                <!--        </select>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="userName">product</label>
                                                        <select class="form-control" id="productid" name="productid">
                                                            <option value="">Select</option>
                                                            @if($edit == 1)
                                                                @foreach($products as $product)
                                                                <option value="{{$product->Id }}" @if($offer->productid == $product->Id) selected   @endif>{{$product->product_name}}</option>
                                                                @endforeach
                                                            
                                                            @endif
                                                            
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>



                                            <div class="form-group text-right m-b-0">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit">
                                                    Submit
                                                </button>
                                                <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                                    Cancel
                                                </button>
                                            </div>

                                        </form>
                                    </div>

                                </div>

                            </div>
                            <!-- end row -->

                            

                        </div>
                    </div><!-- end col-->

                </div>
                <!-- end row -->


            </div> <!-- container -->



<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  


<script type="text/javascript">
$(document).ready(function(){
    //$('.category').hide();
    $('#type').change(function(){
        var type = $(this).val();
        if (type == 'individualproduct') {
            $('.category').show();
        }
    });

    $('#pcatid').change(function(){
        var pcatid = $(this).val();
        $.ajax({
            type:"GET",
             url:"{{url('api/getsubcategory')}}?category_id="+pcatid,
            success : function(response){
                if (response) {
                    $('#catid').empty();
                    $("#catid").append('<option>Select Subcategory</option>');
                    $.each(response,function(index){
                         $("#catid").append('<option value="'+response[index].Id+'">'+response[index].category+'</option>');
                    });
                }
            }
        })
    });

    $('#catid').change(function(){
        var subcatid = $(this).val();
        $.ajax({
            type:"GET",
             url:"{{url('api/getproducts')}}?category_id="+subcatid, 
             success : function(response){
                if (response) {
                    $('#productid').empty();
                    $("#productid").append('<option>Select Product</option>');
                    $.each(response,function(index){
                         $("#productid").append('<option value="'+response[index].Id+'">'+response[index].product_name+'</option>');
                    });
                }
             }
        })
    });


    $('#subcatid').change(function(){
        var subcatid = $(this).val();
        $.ajax({
            type:"GET",
             url:"{{url('api/getproducts')}}?category_id="+subcatid, 
             success : function(response){
                if (response) {
                    $('#productid').empty();
                    $("#productid").append('<option>Select Product</option>');
                    $.each(response,function(index){
                         $("#productid").append('<option value="'+response[index].Id+'">'+response[index].product_name+'</option>');
                    });
                }
             }
        })
    });

})
</script>








@endsection