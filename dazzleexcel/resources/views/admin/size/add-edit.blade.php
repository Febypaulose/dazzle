@extends('layouts.form')
@section('content')


<div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            <a href="{{ URL::to('manage/size') }}">
                            <button type="button" class="btn btn-custom">Back</button>
                        </a>

                        </div>
                       
                       
                       @if($edit == 1)
                        <h4 class="page-title">Edit Size</h4>
                        @else
                        <h4 class="page-title">Add Size</h4>
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
                                        <form method="post" action="{{ URL::to('manage/size/'.Crypt::encrypt($sizes->id)) }}" data-parsley-validate novalidate>
                                        <input type="hidden" name="_method" value="put">
                                        @else
                                        <form method="post" action="{{ URL::to('manage/size/') }}" data-parsley-validate novalidate>
                                        @endif
                                       <!--  <form method="post" action="{{ URL::to('manage/colours/') }}" data-parsley-validate novalidate> -->
                                       
                                        
                                        {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="userName">size<span class="text-danger">*</span></label>
                                                        <input type="text" name="sizename" parsley-trigger="change" required placeholder="Enter Color Name" class="form-control" id="sizename"@if($edit == 1) value="{{ $sizes->size  }}" @endif>
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














@endsection