@extends('layouts.form')
@section('content')


<div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                        	<a href="{{ URL::to('manage/categories') }}">
                            <button type="button" class="btn btn-custom">Back</button>
                        </a>

                        </div>
                        @if($edit == 1)
                        <h4 class="page-title">Edit Banner</h4>
                        @else
                        <h4 class="page-title">Add Banner</h4>
                        @endif
                    </div>
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">

                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12">
                                	
                                    <div class="p-20">
                                        @if($edit == 1)
                                        <form method="post" action="{{ URL::to('manage/banner/'.Crypt::encrypt($banner->id)) }}" data-parsley-validate novalidate>
                                        <input type="hidden" name="_method" value="put">
                                        @else
                                        <form method="post" action="{{ URL::to('manage/banner/') }}" data-parsley-validate novalidate>
                                        @endif
                                        
                                        {{ csrf_field() }}

                                            <div class="form-group">
                                                <label for="userName">Title</label>
                                                <input type="text" name="title" required placeholder="Enter Title" class="form-control" id="title" @if($edit == 1) value="{{ $banner->title  }}" @endif>
                                            </div>
                                            <div class="form-group">
                                                <label for="userName">Description</label>
                                                @if($edit == 1)
                                                <textarea class="form-control" rows="5" name="descr" id="descr">{{ html_entity_decode($banner->description)  }}</textarea>
                                                @else
                                                <textarea class="form-control" rows="5" name="descr" id="descr"></textarea>
                                                @endif
                                                
                                            </div>

                                            <h3><b>Banner Images</b></h3>
                                            <hr/>
                                            @if($edit == 1)
                                            <div class="dropzone" id="bannerimage"name="File">
                                            <div class="dz-default dz-message">
                                                <span>Drop files here to upload</span>
                                            </div>
                                            @if(!empty($banner->image))
                                            <div class="dz-preview dz-processing dz-image-preview dz-complete ">
                                                <div class="dz-image">
                                                    <img data-dz-thumbnail alt="{{ $banner->image }}" src="{{ asset(env('BANNER_IMAGE'))}}/{{ $banner->image}}/" style="width: 250px;height: 125px;">
                                                </div>
                                                <div class="dz-details">    
                                                <div class="dz-filename">
                                                </div>  
                                                </div>
                                                <div class="dz-progress"></div>
                                                <div class="dz-error-message"></div>
                                                <div class="dz-success-mark"></div>
                                                <div class="dz-error-mark"></div>
                                                <a class="dz-remove" href="{{ url('/manage/removebannerimage')}}/{{ $banner->id }}" data-dz-remove="">Remove file</a>
                                            </div>
                                            @endif
                                        </div>
                                            @else
                                            <div class="dropzone" id="bannerimage"name="File">
                                            <div class="dz-default dz-message">
                                                <span>Drop files here to upload</span>
                                            </div>
                                            </div>
                                            @endif
                                            
                                    <br/>
                                    <input type="hidden"  name="bannerresult" id="bannerresult">

                                            <div class="row">
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                        <label for="sel1">Position:</label>
                                                        <select class="form-control" id="position" name="position" required>
                                                            <option value="0">Select Position</option>
                                                             @if($edit == 1)
                                                             <option value="top" @if($banner->position == 'top') selected  @endif>top</option>
                                                            <option value="middle" @if($banner->position == 'middle') selected  @endif>middle</option>
                                                            <option value="bottom" @if($banner->position == 'bottom') selected  @endif>bottom</option>
                                                             @else
                                                             <option value="top">top</option>
                                                             <option value="middle">middle</option>
                                                             <option value="bottom">bottom</option>
                                                             @endif
                                                            

                                                             </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                        <label for="userName">Url</label>
                                                        <input type="text" name="url" placeholder="Enter Url" class="form-control" id="url" @if($edit == 1) value="{{ $banner->url  }}" @endif>
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

<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>

<script type="text/javascript">
$('#bannerimage').dropzone({
    url: "{{ URL::to('manage/bannerimages') }}",
    headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    autoProcessQueue: true,
    addRemoveLinks: true,
    uploadMultiple: true,
    parallelUploads: 5,
    maxFiles: 1,
    maxFilesize: 10,
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
        $('#bannerresult').val(responseText.success);
    }
})
</script>








@endsection