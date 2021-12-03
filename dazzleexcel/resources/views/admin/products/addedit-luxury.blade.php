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
             <a href="{{ URL::to('manage/products') }}">
                <button type="button" class="btn btn-custom">Back</button>
            </a>

        </div>

        @if($edit == 1)
        <h4 class="page-title">Edit Luxury Products</h4>
        @else
        <h4 class="page-title">Add Luxury Products</h4>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
          Upload Products
      </button>
      @endif

  </div>
</div>
<!-- end row -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Uploads Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
   <div class="col-lg-6">
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">

            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <a href="{{url('public/files/promocodes-sample.csv')}}"
                    class="btn btn-warning btn-icon-sm"><i
                    class="la la-download"></i>Sample File</a>&nbsp;
                </div>
            </div>
        </div>
        <form method="POST" enctype="multipart/form-data" class="kt-form kt-form--label-right"
        id="create_bulk_products_form"
        action="{{url('manage/uploads')}}">
        {{csrf_field()}}
        <div class="kt-portlet__body">
            <div class="form-group row">
                <div class="col-md-12 col-sm-12">

                    <div></div>
                    <div class="custom-file">
                        <br>
                        <input class="form-control form-control-sm" id="formFileSm" type="file" name="prodcuts_file"/>
                        <label for="formFileSm" class="form-label">Choose file</label>
                                        <!-- <input type="file"
                                               class="custom-file-input  {{ $errors->has('voucher_code') ? ' is-invalid' : '' }} "
                                               id="customFile" placeholder="Choose file" name="voucher_code"> -->
                                               <!--    <label class="custom-file-label" for="customFile">Choose file</label> -->
                                               @if ($errors->has('prodcuts_file'))
                                               <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('prodcuts_file') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg">
                                       <button type="submit"class="btn btn-primary">Upload</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
             
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <!--   <button type="button" class="btn btn-primary">Save changes</button> -->

           </div>
       </div>
   </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card-box">
@if (Session::has('message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Well done!</strong>{{ Session::get('message') }}
                                </div>
                            @endif
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
                <div class="col-sm-12 col-xs-12 col-md-12">

                    <div class="p-20">
                        @if($edit == 1)
                        <form  method="post" action="{{ URL::to('manage/products/'.Crypt::encrypt($products->Id)) }}" data-parsley-validate novalidate>

                            <input type="hidden" name="_method" value="put">

                            @else
                            <form method="post" action="{{ URL::to('manage/products/') }}" data-parsley-validate novalidate>
                                @endif



                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="userName">Enable<span class="text-danger">*</span></label>
                                            @if($edit == 1)
                                            <input type="checkbox" data-plugin="switchery" name="enabledisable" value="enable" data-color="#039cfd"  @if($products->product_status == 'enabled') checked @endif  />
                                            @else

                                            @endif

                                        </div>
                                    </div>
                                </div>


                                @if($edit == 1)
                                @php
                                $categories = DB::table('productscategories')->where('productId', '=',$products->Id)->first();
                                $productimg = DB::table('productsimages')->where('productId', '=',$products->Id)->get();
                                $productcolor = DB::table('productscolor')->where('productId', '=',$products->Id)->get();
                                @endphp
                                @endif


                                <div class="luxury">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userName">Product Name<span class="text-danger">*</span></label>
                                                <input type="text" name="productname" placeholder="Enter Product name" class="form-control" @if($edit == 1) value="{{ $products->product_name  }}" @endif>
                                                <input type="hidden"  name="typeId" id="typeId" value="luxury">
                                                @if($edit == 1)
                                                <input type="hidden" name="productid" id="productid" value="{{  $products->Id }}">
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Product Price</label>
                                                @if($edit == 1)
                                                @php
                                                $fullprice = $products->product_price;

                                                @endphp
                                                <input type="text" placeholder="Enter Product Price" name="productprice"  value="{{ $fullprice }}" class="form-control autonumber" >
                                                @else
                                                <input type="text" placeholder="Enter Product Price" name="productprice"  class="form-control autonumber" >
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="userName">Product Tags<span class="text-danger">*</span></label>
                                                <input type="text" name="producttags" placeholder="Enter Product Tags" class="form-control" @if($edit == 1) value="{{ $products->product_tags  }}" @endif>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Color</label>
                                                <select id="e3" name="lcolor[]" multiple>
                                                    @if($edit == 1)
                                                     @php
                                                    
                                                     $pcolors =DB::table('productscolor')->where('productId', '=',$products->Id)->get();
                                                      @endphp
                                                  @foreach($pcolors as $color)
                                                   @php
         $productcolors =DB::table('colours')->where('id', '=', $color->colorId)->get();
                                                     @endphp
                @if($productcolors!='')    
   @foreach($productcolors as $color)
      <option value="{{$color->id}}" selected>{{$color->color_name}}</option> 
   @endforeach
   @endif
  @foreach($colours as $color)
                                                    <option value="{{$color->id}}">{{$color->color_name}}</option>
                                                    @endforeach
                                          
                                                   @endforeach
                                                   @else
                                                    @foreach($colours as $color)
                                                    <option value="{{$color->id}}">{{$color->color_name}}</option>
                                                    @endforeach
                                                    @endif
                                                    
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>sizes</label>
                                                <select id="e4" name="lsizes[]" multiple>
                                                    @if($edit == 1)
                                                         @php
                                                    
                                                     $psize =DB::table('productsize')->where('productId', '=',$products->Id)->get();
                                                      @endphp
                                                  @foreach($psize as $size)
                                                   @php
         $productsize =DB::table('sizes')->where('id', '=', $size->sizeId)->get();
                                                     @endphp
                @if($productsize!='')    
   @foreach($productsize as $size)
      <option value="{{$size->id}}" selected>{{$size->size}}</option> 
   @endforeach
   @endif
@foreach($sizes as $sizeval)
                                                    <option value="{{$sizeval->id}}">{{$sizeval->size}}</option>
                                                    @endforeach
                                          
                                                   @endforeach
                                                   @else
                                                    @foreach($sizes as $sizeval)
                                                    <option value="{{$sizeval->id}}">{{$sizeval->size}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sel1">Select Category:</label>
                                                <select class="form-control" id="lcategoryId" name="lcategoryId">
                                                    <option value="0">Select Category</option>
                                                    @if($edit == 1)

                                                    @foreach($category as $cat)
                                                    @if(!empty($categories))
                                                    <option value="{{ $cat->Id }}" @if($categories->categoryId == $cat->Id ) selected  @endif>{{ $cat->category }}</option>
                                                    @else
                                                    <option value="{{ $cat->Id }}" >{{ $cat->category }}</option>
                                                    @endif
                                                    
                                                    @endforeach
                                                    @else
                                                    @foreach($category as $cat)
                                                    <option value="{{ $cat->Id }}">{{ $cat->category }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sel1">Select Subcategory:</label>
                                                <select class="form-control" id="lsubcategoryId" name="lsubcategoryId">  
                                                    <option value="0">Select Sub Category</option>     
                                                    @if($edit == 1)
                                                    @foreach($subcategory as $subcat)
                                                    @if(!empty($categories))
                                                    <option value="{{ $subcat->Id }}" @if($categories->subcategoryId == $subcat->Id ) selected  @endif>{{ $subcat->category }}</option>
                                                    else
                                                    <option value="{{ $subcat->Id }}" >{{ $subcat->category }}</option>
                                                    @endif
                                                    
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sel1">Product status:</label>
                                                <select class="form-control" id="stockstatus" name="stockstatus">
                                                    <option value="0">Select Status</option>
                                                    @if($edit == 1)
                                                    <option value="in stock" @if($products->stock_status == 'in stock') selected  @endif>In stock</option>
                                                    <option value="Out of stock" @if($products->stock_status == 'Out of stock') selected  @endif>Out of stock</option>
                                                    @else
                                                    <option value="in stock">In stock</option>
                                                    <option value="Out of stock">Out of stock</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Stock Count</label>
                                                <input type="text" placeholder="Enter Product Stock" name="stockcount" class="form-control" @if($edit == 1) value="{{ $products->product_quantity  }}" @endif>
                                            </div>
                                        </div>

                                    </div>

                                    <h3><b>Prouct Summary</b></h3>
                                    <hr>
                                    @if($edit == 1)
                                    @php
                                    $summarydecode = json_decode($products->summary, true);  
                                    @endphp
                                    @endif

                                    <div class="form-group">
                                      <label for="comment">Summary:</label>
                                      @if($edit == 1)
                                      <textarea class="form-control" rows="5" name="psummary" id="psummary">{!! html_entity_decode($summarydecode['summary']) !!}</textarea>
                                      @else
                                      <textarea class="form-control" rows="5" name="psummary" id="psummary"></textarea>
                                      @endif


                                      
                                  </div>

                                  <p><b>Image</b></p>
                                  @if($edit == 1)
                                  <div class="dropzone" id="summaryimage"name="File">
                                    <div class="dz-default dz-message">
                                        <span>Drop files here to upload</span>
                                    </div>
                                    @if(!empty($summarydecode['image']))
                                    <div class="dz-preview dz-processing dz-image-preview dz-complete ">
                                        <div class="dz-image">
                                            <img data-dz-thumbnail alt="{{ $summarydecode['image'] }}" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $summarydecode['image']}}/" style="width: 250px;height: 125px;">
                                        </div>
                                        <div class="dz-details">    
                                            <div class="dz-filename">
                                            </div>  
                                        </div>
                                        <div class="dz-progress"></div>
                                        <div class="dz-error-message"></div>
                                        <div class="dz-success-mark"></div>
                                        <div class="dz-error-mark"></div>
                                        <a class="dz-remove" href="{{ url('/manage/removesummaryimage')}}/{{ $products->Id }}" data-dz-remove="">Remove file</a>
                                    </div>
                                    @endif
                                </div>
                                @else
                                <div class="dropzone" id="summaryimage" name="File">
                                    <div class="dz-default dz-message">
                                        <span>Drop files here to upload</span>
                                    </div>
                                </div>
                                @endif
                                <input type="hidden"  name="summaryresult" id="summaryresult">
                                <br/>
                                @if($edit == 1)
                                @php
                                $descriptiondecode = json_decode($products->description, true);  
                                @endphp
                                @endif
                                <h3><b>Product Description</b></h3>
                                <hr/>
                                <div class="form-group">
                                    <label for="userName">Title<span class="text-danger">*</span></label>
                                    <input type="text" name="descrtitle" placeholder="Enter Description Title" class="form-control"
                                    @if($edit == 1) value="{{ $descriptiondecode['title'] }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="userName">Description<span class="text-danger">*</span></label>
                                    @if($edit == 1)
                                    <textarea class="ckeditor" cols="80" id="editor1" name="pdescr" rows="10">{!! html_entity_decode($descriptiondecode['description']) !!}</textarea>
                                    @else
                                    <textarea class="ckeditor" cols="80" id="editor1" name="pdescr" rows="10"></textarea>
                                    @endif

                                </div>
                                <p><b>Description Images</b></p>
                                @if($edit == 1)
                                <div class="dropzone" id="descriptionimage"name="File">
                                    <div class="dz-default dz-message">
                                        <span>Drop files here to upload</span>
                                    </div>
                                    @if(!empty($descriptiondecode['image']))
                                    <div class="dz-preview dz-processing dz-image-preview dz-complete ">
                                        <div class="dz-image">
                                            <img data-dz-thumbnail alt="{{ $descriptiondecode['image'] }}" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $descriptiondecode['image']}}/" style="width: 250px;height: 125px;">
                                        </div>
                                        <div class="dz-details">    
                                            <div class="dz-filename">
                                            </div>  
                                        </div>
                                        <div class="dz-progress"></div>
                                        <div class="dz-error-message"></div>
                                        <div class="dz-success-mark"></div>
                                        <div class="dz-error-mark"></div>
                                        <a class="dz-remove" href="{{ url('/manage/removedescrimage')}}/{{ $products->Id }}" data-dz-remove="">Remove file</a>
                                    </div>
                                    @endif
                                </div>
                                @else
                                <div class="dropzone" id="descriptionimage" name="File">
                                    <div class="dz-default dz-message">
                                        <span>Drop files here to upload</span>
                                    </div>
                                </div>
                                @endif

                                <br/>
                                <h3><b>Product Images</b></h3>
                                <hr/>
                                @if($edit == 1)
                                <div class="dropzone" id="lproductimage"name="File">
                                    <div class="dz-default dz-message">
                                        <span>Drop files here to upload</span>
                                    </div>
                                    @foreach($productimg as $img)
                                    <div class="dz-preview dz-processing dz-image-preview dz-complete ">
                                        <div class="dz-image">
                                            <img data-dz-thumbnail alt="{{ $img->image_url }}" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $img->image_url}}/" style="width: 250px;height: 125px;">
                                        </div>
                                        <div class="dz-details">    
                                            <div class="dz-filename">
                                            </div>  
                                        </div>
                                        <div class="dz-progress"></div>
                                        <div class="dz-error-message"></div>
                                        <div class="dz-success-mark"></div>
                                        <div class="dz-error-mark"></div>
                                        <a class="dz-remove" href="{{ url('/manage/removeproductimage')}}/{{ $img->id }}" data-dz-remove="">Remove file</a>
                                        <input type='text' class='form-control' id='producttitle' name='producttitle[]' value="{{ $img->title }}">
                                        <textarea class='form-control descr' id='productdescription' name='productdescription[]' rows='4' cols='15' >{{ $img->description }}</textarea>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <div class="dropzone" id="lproductimage" name="File">
                                    <div class="dz-default dz-message">
                                        <span>Drop files here to upload</span>
                                    </div>
                                </div>
                                @endif

                                <input type="hidden"  name="descriptionresult" id="descriptionresult">
                                <input type="hidden"  name="lproductresult" id="lproductresult">

                                <br/>
                                <h3><b>Designer Data</b></h3>
                                <hr/>
                                @if($edit == 1)
                                @php
                                $designerdecode = json_decode($products->productdesigner, true);  
                                @endphp
                                @endif
                                <p><b>Designer Images</b></p>
                                @if($edit == 1)
                                <div class="dropzone" id="designerimage"name="File">
                                    <div class="dz-default dz-message">
                                        <span>Drop files here to upload</span>
                                    </div>
                                    @if(!empty($designerdecode['image']))
                                    <div class="dz-preview dz-processing dz-image-preview dz-complete ">
                                        <div class="dz-image">
                                            <img data-dz-thumbnail alt="{{ $designerdecode['image'] }}" src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $designerdecode['image']}}/" style="width: 250px;height: 125px;">
                                        </div>
                                        <div class="dz-details">    
                                            <div class="dz-filename">
                                            </div>  
                                        </div>
                                        <div class="dz-progress"></div>
                                        <div class="dz-error-message"></div>
                                        <div class="dz-success-mark"></div>
                                        <div class="dz-error-mark"></div>
                                        <a class="dz-remove" href="{{ url('/manage/removedesignerimage')}}/{{ $products->Id }}" data-dz-remove="">Remove file</a>
                                    </div>
                                    @endif
                                </div>
                                @else
                                <div class="dropzone" id="designerimage" name="File">
                                    <div class="dz-default dz-message">
                                        <span>Drop files here to upload</span>
                                    </div>
                                </div>
                                @endif

                                <br/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="userName">Name<span class="text-danger">*</span></label>
                                            <input type="text" name="dtitle" placeholder="Enter Name" class="form-control" @if($edit == 1) value="{{ $designerdecode['name']  }}" @endif>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="userName">Website<span class="text-danger">*</span></label>
                                            <input type="text" name="dwebsite"  placeholder="Enter Website" class="form-control" @if($edit == 1) value="{{ strip_tags($designerdecode['website'])  }}" @endif>
                                            <input type="hidden"  name="designerresult" id="designerresult" >
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
        $('#categoryId').change(function(){
            var CategoryID = $('#categoryId').val();
            $.ajax({
                type:"GET",
                url:"{{url('api/getsubcategory')}}?category_id="+CategoryID,
                success : function(response){
                    if (response) {
                        $('#subcategoryId').empty();
                        $("#subcategoryId").append('<option>Select Subcategory</option>');
                        $.each(response,function(index){
                         $("#subcategoryId").append('<option value="'+response[index].Id+'">'+response[index].category+'</option>');
                     });
                    }
                }
            })
        });
        $('#lcategoryId').change(function(){
            var CategoryID = $('#lcategoryId').val();
            $.ajax({
                type:"GET",
                url:"{{url('api/getsubcategory')}}?category_id="+CategoryID,
                success : function(response){
                    if (response) {
                        $('#lsubcategoryId').empty();
                        $("#lsubcategoryId").append('<option>Select Subcategory</option>');
                        $.each(response,function(index){
                         $("#lsubcategoryId").append('<option value="'+response[index].Id+'">'+response[index].category+'</option>');
                     });
                    }
                }
            })
        });
        $('#typeId').change(function(){
            var type = $('#typeId').val(); 
            if (type == 'luxury') {
                $(".normal").css("display", "none");
                $(".luxury").css("display", "block");
            } else if(type == 'normal') {
                $(".luxury").css("display", "none");
                $(".normal").css("display", "block");
            }
        })
    })  
    $('#summaryimage').dropzone({
        url: "{{ URL::to('manage/productimages') }}",
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
     autoProcessQueue: true,
     addRemoveLinks: true,
     uploadMultiple: true,
     parallelUploads: 1,
     maxFiles: 1,
     maxFilesize: 10,
     acceptedFiles: 'image/*',
     addRemoveLinks: true,
     init: function() {



        //send all the form data along with the files:
        this.on("sendingmultiple", function(data, xhr, formData) {
            formData.append("firstname", jQuery("#firstname").val());
            formData.append("lastname", jQuery("#lastname").val());
        });
    },

    success: function(file, responseText){
        $('#summaryresult').val(responseText.success);
    }
});
    $('#descriptionimage').dropzone({
        url: "{{ URL::to('manage/productimages') }}",
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
     autoProcessQueue: true,
     addRemoveLinks: true,
     uploadMultiple: true,
     parallelUploads: 5,
     maxFiles: 1,
     maxFilesize: 1,
     acceptedFiles: 'image/*',
     addRemoveLinks: true,
     init: function() {



        //send all the form data along with the files:
        this.on("sendingmultiple", function(data, xhr, formData) {
            formData.append("firstname", jQuery("#firstname").val());
            formData.append("lastname", jQuery("#lastname").val());
        });
    },

    success: function(file, responseText){
        $('#descriptionresult').val(responseText.success);
    }
});

    $('#designerimage').dropzone({
        url: "{{ URL::to('manage/productimages') }}",
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
     autoProcessQueue: true,
     addRemoveLinks: true,
     uploadMultiple: true,
     parallelUploads: 5,
     maxFiles: 1,
     maxFilesize: 1,
     acceptedFiles: 'image/*',
     addRemoveLinks: true,
     init: function() {



        //send all the form data along with the files:
        this.on("sendingmultiple", function(data, xhr, formData) {
            formData.append("firstname", jQuery("#firstname").val());
            formData.append("lastname", jQuery("#lastname").val());
        });
    },

    success: function(file, responseText){
        $('#designerresult').val(responseText.success);
    }
});


    $('#lproductimage').dropzone({
        url: "{{ URL::to('manage/productimages') }}",
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
     autoProcessQueue: true,
     addRemoveLinks: true,
     uploadMultiple: true,
     parallelUploads: 5,
     maxFiles: 5,
     maxFilesize: 1,
     acceptedFiles: 'image/*',
     addRemoveLinks: true,
     init: function() {
      let totalFiles = 0,
      completeFiles = 0;
      this.on("addedfile", function (file) {
        totalFiles += 1;
        localStorage.setItem('totalItem',totalFiles);
        caption = file.caption == undefined ? "" : file.caption;
        file._captionLabel = Dropzone.createElement("<input type='text' class='form-control' id='producttitle' name='producttitle[]'>")
        file._captionBox = Dropzone.createElement("<textarea class='form-control descr' id='productdescription' name='productdescription[]' rows='4' cols='15' ></textarea>");
        file.previewElement.appendChild(file._captionLabel);
        file.previewElement.appendChild(file._captionBox);
        setTimeout(function(){
        }, 10);
    });




        //send all the form data along with the files:
        this.on("sendingmultiple", function(data, xhr, formData) {
            formData.append("producttitle", jQuery("#producttitle").val());
            formData.append("producttitle", jQuery("#producttitle").val());
        });
    },

    success: function(file, responseText){
        $('#lproductresult').val(responseText.success);
    }
});


</script>







@endsection