@extends('layouts.form')
@section('content')
<div class="container">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            <a href="{{ URL::to('manage/dressmaterial') }}">
                            <button type="button" class="btn btn-custom">Back</button>
                        </a>
                        </div>
                       @if($edit == 1)
                        <h4 class="page-title">Edit Dress Material</h4>
                        @else
                        <h4 class="page-title">Add Dress Material</h4>
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
                                        <form method="post" action="{{ URL::to('manage/dressmaterial/'.Crypt::encrypt($materials->id)) }}" data-parsley-validate novalidate>
                                        <input type="hidden" name="_method" value="put">
                                        @else
                                        <form method="post" action="{{ URL::to('manage/dressmaterial/') }}" data-parsley-validate novalidate>
                                        @endif
                                        {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="userName">Dress Material Name<span class="text-danger">*</span></label>
                                                        <input type="text" name="dressmaterial" parsley-trigger="change" required placeholder="Enter dressmaterial Name" class="form-control" id="dressmaterial" @if($edit == 1) value="{{ $materials->material  }}" @endif>
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