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

                        <h4 class="page-title">Edit Category</h4>

                        @else

                        <h4 class="page-title">Add Category</h4>

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

                                        <form method="post" action="{{ URL::to('manage/categories/'.Crypt::encrypt($cate->Id)) }}" data-parsley-validate novalidate>

                                        <input type="hidden" name="_method" value="put">

                                        @else

                                        <form method="post" action="{{ URL::to('manage/categories/') }}" data-parsley-validate novalidate>

                                        @endif

                                        

                                        {{ csrf_field() }}

                                            <div class="form-group">

                                            <label for="sel1">Select list:</label>

                                            <select class="form-control" id="sel1" name="parentId">

                                                <option value="0">Select Category</option>

                                                @if($edit == 1)

                                                @foreach($categories as $cat)

                                                <option value="{{ $cat->Id }}" @if($cate->parentId == $cat->Id ) selected @endif>{{ $cat->category }}</option>

                                                @endforeach

                                                @else

                                                @foreach($categories as $cat)

                                                <option value="{{ $cat->Id }}">{{ $cat->category }}</option>

                                                @endforeach

                                                @endif

                                            </select>

                                            </div>

                                            <div class="form-group">
                                                <label for="userName">Category<span class="text-danger">*</span></label>
                                                <input type="text" name="category" parsley-trigger="change" required placeholder="Enter Category name" class="form-control" id="category" @if($edit == 1) value="{{ $cate->category  }}" @endif>

                                            </div>

                                            <div class="form-group">
                                                <label for="userName">Category Type<span class="text-danger">*</span></label>
                                                <select class="form-control" id="sel1" name="category_type">
                                                <option value="0">Select Category Type</option>
                                                @if($edit == 1)
                                                <option value="normal" @if($cate->category_type == 'normal') selected  @endif>Normal</option>
                                                <option value="category_withleftimage" @if($cate->category_type == 'category_withleftimage') selected  @endif>Category with Left Image</option>
                                                @else
                                                <option value="normal">Normal</option>
                                                <option value="category_withleftimage">Category with Left Image</option>
                                                @endif

                                            </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="userName">Menu Order<span class="text-danger">*</span></label>
                                                <input type="text" name="menu_order" parsley-trigger="change" required placeholder="Enter Menu Order" class="form-control" id="category" @if($edit == 1) value="{{ $cate->menu_order  }}" @endif>

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