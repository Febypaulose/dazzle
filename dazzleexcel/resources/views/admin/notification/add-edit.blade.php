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
                        <h4 class="page-title">Edit Notification</h4>
                        @else
                        <h4 class="page-title">Add Notification</h4>
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
                                        <form method="post" action="{{ URL::to('manage/notification/'.Crypt::encrypt($notification->id)) }}" data-parsley-validate novalidate>
                                        <input type="hidden" name="_method" value="put">
                                        @else
                                        <form method="post" action="{{ URL::to('manage/notification/') }}" data-parsley-validate novalidate>
                                        @endif
                                        
                                        {{ csrf_field() }}

                                            

                                            <div class="form-group">
                                                <label for="userName">notification text</label>
                                                 @if($edit == 1)
                                                 <input type="text" required placeholder="Enter Notification" class="form-control" name="notification" value="{{ $notification->notification_text }}">
                                                 @else
                                                 <input type="text" required placeholder="Enter notification" class="form-control" name="notification">
                                                 @endif
                                                 
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
             url:"{{url('api/getsubcategory')}}?category_id="+subcatid,
            success : function(response){
                if (response) {
                    $('#subcatid').empty();
                    $("#subcatid").append('<option>Select Subcategory</option>');
                    $.each(response,function(index){
                         $("#subcatid").append('<option value="'+response[index].Id+'">'+response[index].category+'</option>');
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