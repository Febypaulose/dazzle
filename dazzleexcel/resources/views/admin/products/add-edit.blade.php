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
                       
                        @if($edit == 1)
                        <h4 class="page-title">Edit Normal Products</h4>
                        @else
                        <h4 class="page-title">Add Normal Products</h4>
                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalnormal">
          Upload Products
                        @endif
                        
                    </div>
                </div>
                <!-- end row -->
<div class="modal fade" id="exampleModalnormal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a href="{{url('public/files/normalproducts.csv')}}"
                    class="btn btn-warning btn-icon-sm"><i
                    class="la la-download"></i>Please Download normal prodcuts Sample File</a>&nbsp;
                </div>
            </div>
        </div>
        <form method="POST" enctype="multipart/form-data" class="kt-form kt-form--label-right"
        id="create_bulk_products_form"
        action="{{url('manage/uploadsnormal')}}"  enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="kt-portlet__body">
            <div class="form-group row">
                <div class="col-md-12 col-sm-12">

                    <div></div>
                    <div class="custom-file">
                        <br>
                        <input class="form-control form-control-sm" id="formFileSm" type="file" name="normalprodcuts_file"/>
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

                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12">
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
                                    <div class="p-20">
                                        
                                        
                                        @if($edit == 1)
                                         <form  method="post" action="{{ URL::to('manage/normalproducts/'.Crypt::encrypt($products->Id)) }}" data-parsley-validate novalidate>

                                        <input type="hidden" name="_method" value="put">

                                        @else
                                        <form method="post" action="{{ URL::to('manage/normalproducts/') }}" data-parsley-validate novalidate>
                                        @endif
                                        
                                        {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="userName">Enable<span class="text-danger">*</span></label>
                                                @if($edit == 1)
                                                <input type="checkbox" data-plugin="switchery" name="enabledisable" value="enabled" data-color="#039cfd"  @if($products->product_status == 'enabled') checked @endif />
                                                @else
                                                <input type="checkbox" data-plugin="switchery" name="enabledisable" value="enabled" data-color="#039cfd" checked />
                                                @endif
                                                 
                                            </div>
                                        </div>
                                    </div>

                                    @if($edit == 1)
                                    @php
                                    $categories = DB::table('productscategories')->where('productId', '=',$products->Id)->first();
                                    $productimg = DB::table('productsimages')->where('productId', '=',$products->Id)->get();
                                    @endphp
                                    @endif


                                
                                    <div class="normal">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="userName">Product Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="productnameo" placeholder="Enter Product name" class="form-control" @if($edit == 1) value="{{ $products->product_name  }}" @endif>
                                                    <input type="hidden"  name="typeId" id="typeId" value="normal">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Product Price</label>
                                                    <!-- <input type="text" placeholder="Enter Product Price" name="productpriceo" data-a-sign="{{ $currency->symbol}}" class="form-control autonumber"> -->
                                                    @if($edit == 1)
                                                    @php
                                                    $fullprice = $products->product_price;
                                                   
                                                    @endphp
                                                    <input type="text" placeholder="Enter Product Price" name="productpriceo"  value="{{ $fullprice }}" class="form-control autonumber" >
                                                    @else
                                                    <input type="text" placeholder="Enter Product Price" name="productpriceo"  class="form-control autonumber" >
                                                    @endif
                                                    </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="userName">Product Tags<span class="text-danger">*</span></label>
                                                    <input type="text" name="oproducttags" placeholder="Enter Product Tags" class="form-control" @if($edit == 1) value="{{ $products->product_tags  }}" @endif>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                     <label>Color</label>
                                                     <select id="e1" name="ncolor[]" multiple>
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
                                                     <select id="e2" name="nsizes[]" multiple>
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
                                                    <label for="sel1">Select Parent Category:</label>
                                                    <select class="form-control" id="pcategoryId" name="pcategoryId">
                                                        <option value="">Select Parent Category</option>
                                                            @if($edit == 1)
                                                             @foreach($category as $cat)
                                                              @if(!empty($categories))
                                                            <option value="{{ $cat->Id }}" @if($categories->categoryId == $cat->Id ) selected  @endif>{{ $cat->category }}</option>
                                                            @else
                                                             <option value="{{ $cat->Id }}">{{ $cat->category }}</option>
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
                                                    <label for="sel1">Select category:</label>
                                                    <select class="form-control" id="categoryId" name="categoryId">  
                                                        <option value="">Select category</option> 
                                                        @if($edit == 1)
                                                        @foreach($subcategory as $subcat)
                                                            @if(!empty($categories))
                                                        <option value="{{ $subcat->Id }}" @if($categories->subcategoryId == $subcat->Id ) selected  @endif>{{ $subcat->category }}</option>
                                                        @else
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
                                                <select class="form-control" id="stockstatus" name="ostockstatus">
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
                                                <input type="number" placeholder="Enter Product Stock" name="ostockcount" class="form-control"
                                                @if($edit == 1) value="{{ $products->product_quantity  }}" @endif>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <label for="userName">Summary<span class="text-danger">*</span></label>
                                         @if($edit == 1)
                                        <textarea class="ckeditor" cols="80" id="editor1" name="opsummary" rows="10">
                                        {{ html_entity_decode($products->summary)  }}
                                        </textarea>
                                         @else
                                         <textarea class="ckeditor" cols="80" id="editor1" name="opsummary" rows="10"></textarea>
                                         @endif
                                         
                                    </div>


                                    <div class="form-group">
                                        <label for="userName">Description<span class="text-danger">*</span></label>
                                        @if($edit == 1)
                                        <textarea class="ckeditor" cols="80" id="editor1" name="opdescr" rows="10">
                                        {{ html_entity_decode($products->description)  }}
                                        </textarea>
                                        @else
                                        <textarea class="ckeditor" cols="80" id="editor1" name="opdescr" rows="10"></textarea>
                                        @endif
                                         
                                    </div>

                                    <h3><b>Product Images</b></h3>
                                    <hr/>
                                    @if($edit == 1)
                                    <div class="dropzone" id="nproductimage"name="File">
                                        <div class="dz-default dz-message">
                                            <span>Drop files here to upload (Choose image one by one)</span>
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
                                            <a class="dz-remove" href="{{ url('/manage/removenormalproductimage')}}/{{ $img->id }}" data-dz-remove="">Remove file</a>
                                        </div>
                                        @endforeach
                                    </div>
                                    @else
                                    <div class="dropzone" id="nproductimage" name="File">
                                        <div class="dz-default dz-message">
                                            <span>Drop files here to upload</span>
                                        </div>
                                    </div>
                                    @endif
                                    

                                    <!--<input type="hidden"  name="oproductresult" id="productresult">-->



                                    </div>
<div id="text-container"></div>
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
    $('#pcategoryId').change(function(){
        var CategoryID = $('#pcategoryId').val();
        $.ajax({
            type:"GET",
             url:"{{url('api/getsubcategory')}}?category_id="+CategoryID,
            success : function(response){
                if (response) {
                    $('#categoryId').empty();
                    $("#categoryId").append('<option value="">Select Subcategory</option>');
                    $.each(response,function(index){
                         $("#categoryId").append('<option value="'+response[index].Id+'">'+response[index].category+'</option>');
                    });
                }
            }
        })
    });
     $('#categoryId').change(function(){
        var CategoryID = $('#categoryId').val();
        $.ajax({
            type:"GET",
             url:"{{url('api/getsubcategory')}}?category_id="+CategoryID,
            success : function(response){
                if (response) {
                    $('#subcategoryId').empty();
                    $("#subcategoryId").append('<option value="">Select Subcategory</option>');
                    $.each(response,function(index){
                         $("#subcategoryId").append('<option value="'+response[index].Id+'">'+response[index].category+'</option>');
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

$('#nproductimage').dropzone({
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
        //send all the form data along with the files:
        this.on("sendingmultiple", function(data, xhr, formData) {
            formData.append("producttitle", jQuery("#producttitle").val());
            formData.append("producttitle", jQuery("#producttitle").val());
        });
    },

    success: function(file, responseText){
     var result="";
  
    //   $.each(responseText,function(i,value){
          console.log(responseText)
        // $('div#text-container').append('<input type="text" name="document[]" value="' + value + '">')
          result +='<input type="hidden" value="'+responseText.success+'" name="oproductresult[]"  > <br/>'
    //   });
     $('div#text-container').append(result);
    //   $('#sel-product').val(arrp);
        // $('#productresult').val(responseText.success);
    }
})

// Dropzone.options.myDropzone= {
//     url: "{{ URL::to('manage/productimages') }}",
//      data: {type: 1},
//     headers: {
//          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     },

//     autoProcessQueue: false,
//     addRemoveLinks: true,
//     uploadMultiple: true,
//     parallelUploads: 5,
//     maxFiles: 5,
//     maxFilesize: 1,
//     acceptedFiles: 'image/*',
//     addRemoveLinks: true,
//     init: function() {
      
//         let totalFiles = 0,
//             completeFiles = 0;
//         this.on("addedfile", function (file) {
//             totalFiles += 1;
//             localStorage.setItem('totalItem',totalFiles);
//             caption = file.caption == undefined ? "" : file.caption;
//             file._captionLabel = Dropzone.createElement("<input type='text' class='form-control' id='basic-url aria-describedby='basic-addon3'>")
//             file._captionBox = Dropzone.createElement("<textarea class='form-control descr' rows='4' cols='15' id='"+file.filename+"' name='caption' ></textarea>");
//             file.previewElement.appendChild(file._captionLabel);
//             file.previewElement.appendChild(file._captionBox);
//             // this.autoProcessQueue = true;
//         });
        
//         //send all the form data along with the files:
//         this.on("sendingmultiple", function(data, xhr, formData) {
//             formData.append("firstname", jQuery("#firstname").val());
//             formData.append("lastname", jQuery("#lastname").val());
//         });
//     },

//     success: function(file, responseText){
//                 console.log(responseText);
//                 $('#result').val(responseText.success);
//             }
// }
</script>







@endsection