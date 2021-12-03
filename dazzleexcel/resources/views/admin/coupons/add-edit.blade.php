@extends('layouts.form')
@section('content')

<div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                        	<a href="{{ URL::to('manage/coupons') }}">
                            <button type="button" class="btn btn-custom">Back</button>
                        </a>

                        </div>
                        @if($edit == 1)
                        <h4 class="page-title">Edit Coupons</h4>
                        @else
                        <h4 class="page-title">Add Coupons</h4>
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
                                        <form method="post" action="{{ URL::to('manage/coupons/'.Crypt::encrypt($coupons->id)) }}" data-parsley-validate novalidate>
                                        <input type="hidden" name="_method" value="put">
                                        @else
                                        <form method="post" action="{{ URL::to('manage/coupons/') }}" data-parsley-validate novalidate>
                                        @endif
                                        
                                        {{ csrf_field() }}

                                            <div class="form-group">
                                                <label for="userName">Type</label>
                                                <select class="form-control" id="type" name="type" required>
                                                    <option value="">Select</option>
                                                    @if($edit == 1)
                                                    <option value="fixed" @if($coupons->type == 'fixed') selected  @endif>Fixed</option>
                                                    <option value="percent"  @if($coupons->type == 'percent') selected  @endif>Percent</option>
                                                    @else
                                                    <option value="fixed">Fixed</option>
                                                    <option value="percent">Percent</option>
                                                    @endif
                                                </select>
                                            </div>

                                            <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="userName">Coupon Code</label>
                                                         @if($edit == 1)
                                                         <input type="text" required placeholder="Enter Coupon Code" class="form-control" name="couponcode" value="{{ $coupons->code }}">
                                                         @else
                                                         <input type="text" required placeholder="Enter Coupon Code" class="form-control" name="couponcode">
                                                         @endif
                                                    </div>
                                                </div>

                                            
                                            @if($edit == 1)
                                            @if($coupons->type == 'percent')
                                            <div class="row percentamt" style="display: block;">
                                            @else
                                            <div class="row percentamt" style="display: none;">
                                            @endif
                                            @else
                                            <div class="row percentamt" style="display: none;">
                                            @endif
                                            
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="userName">Percentage</label>
                                                         @if($edit == 1)
                                                         <input type="text" placeholder="Enter Percentage" class="form-control" name="percentage" value="{{ $coupons->percent_off }}">
                                                         @else
                                                         <input type="text" placeholder="Enter Percentage" class="form-control" name="percentage">
                                                         @endif
                                                    </div>
                                                </div>
                                            </div>

                                            @if($edit == 1)
                                            @if($coupons->type == 'fixed')
                                            <div class="row fixedamt" style="display: block;">
                                            @else
                                            <div class="row fixedamt" style="display: none;">
                                            @endif
                                            @else
                                            <div class="row fixedamt" style="display: none;">
                                            @endif
                                            
                                                <div class="col-md-12">
                                                <div class="form-group">
                                                <label for="userName">Amount</label>
                                                 @if($edit == 1)
                                                 <input type="text" placeholder="Enter Amount" class="form-control" name="fixedvalue" value="{{ $coupons->value }}">
                                                 @else
                                                 <input type="text" placeholder="Enter Amount" class="form-control" name="fixedvalue">
                                                 @endif
            
                                                </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                <div class="form-group">
                                                <label for="userName">Expiry Date</label>
                                                 @if($edit == 1)
                                                 <input type="text" required placeholder="Enter Date" class="form-control" name="exdate" value="{{ $coupons->to }}">
                                                 @else
                                                 <input type="date" required placeholder="Enter Date" class="form-control" name="exdate">
                                                 @endif
            
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
        if (type == 'fixed') {
            $('.percentamt').hide();
            $('.fixedamt').show();
        } else if(type == 'percent'){
             $('.fixedamt').hide();
            $('.percentamt').show();
        }
    });

    





})
</script>








@endsection