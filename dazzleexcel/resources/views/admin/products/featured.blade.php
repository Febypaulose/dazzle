@extends('layouts.form')
@section('content')

<style type="text/css">
.descr
{
    margin-top: 12px;
}
</style>
<div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                        	<a href="{{ URL::to('manage/normalproducts') }}">
                            <button type="button" class="btn btn-custom">Back</button>
                        </a>

                        </div>
                        <h4 class="page-title">Add featured menu image</h4>
                    </div>
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">

                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12">
                                    <div class="p-20">
                                        <form method="post" action="{{ URL::to('manage/makemenufeatured/') }}" data-parsley-validate novalidate>  
                                        {{ csrf_field() }}
                                    <div class="normal">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="sel1">Select parent:</label>
                                                    <input type="hidden" name="productid" value="{{ $productid }}">
                                                    <input type="hidden" name="catid" id="catid" >
                                                    <select class="form-control" id="parentId" name="parentId">
                                                        <option value="0">Select Category</option>
                                                             @foreach($category as $cat)
                                                            <option value="{{ $cat->Id }}">{{ $cat->category }}</option>
                                                            @endforeach
                                                            
                                                         </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3 category" style="display:none" >
                                                <div class="form-group">
                                                    <label for="sel1">Select category:</label>
                                                    <select class="form-control" id="categoryId" name="categoryId">
                                                        <option value="0">Select Category</option>
                                                         </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3 subcategory" style="display:none" >
                                                <div class="form-group">
                                                    <label for="sel1">Select category:</label>
                                                    <select class="form-control" id="subcategoryId" name="subcategoryId">
                                                        <option value="0">Select sub Category</option>
                                                         </select>
                                                </div>
                                            </div>
                                            
                                    </div>


                                   

                                   


                                   

              



                                    </div>

                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Submit</button>
                                    <button type="reset" class="btn btn-secondary waves-effect m-l-5">Cancel</button>
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

<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>


<script type="text/javascript">
$(document).ready(function(){
    $('#parentId').change(function(){
        var parentID = $('#parentId').val();
        $.ajax({
            type:"GET",
             url:"{{url('api/getcategory')}}?parent_id="+parentID,
            success : function(response){
                if (response) {
                    $('.category').show();
                    $('#categoryId').empty();
                    $("#categoryId").append('<option>Select category</option>');
                    $.each(response,function(index){
                         $("#categoryId").append('<option value="'+response[index].Id+'">'+response[index].category+'</option>');
                    });
                }
            }
        })
    });
    
    $('#categoryId').change(function(){
        var categoryID = $('#categoryId').val();
        var parentID = $('#parentId').val();
        if(parentID == 26){
            $('#catid').val(categoryID);
        }
        $.ajax({
            type:"GET",
             url:"{{url('api/getsubcategory')}}?category_id="+categoryID,
            success : function(response){
                if (response) {
                    $('.subcategory').show();
                    $('#subcategoryId').empty();
                    $("#subcategoryId").append('<option>Select subcategory</option>');
                    $.each(response,function(index){
                         $("#subcategoryId").append('<option value="'+response[index].Id+'">'+response[index].category+'</option>');
                    });
                }
            }
        })
    });
    
    $('#subcategoryId').change(function(){
        var parentID = $('#parentId').val(); console.log(parentID);
        if(parentID == 27){
            $('#catid').val($('#subcategoryId').val());
        }
    });
 
})  











</script>







@endsection