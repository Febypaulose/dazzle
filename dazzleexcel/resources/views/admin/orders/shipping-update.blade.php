@extends('layouts.form')
@section('content')


<div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            <a href="{{ URL::to('manage/colours') }}">
                            <button type="button" class="btn btn-custom">Back</button>
                        </a>

                        </div>
                       
                       
                      
                        <h4 class="page-title">Update Shipping</h4>
                       
                    </div>
                </div>
                <!-- end row -->

               @php
                $orders = DB::table('orders')->where('id', '=',$orderid)->first();

               @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12">
                                    <div class="p-20">
                                        <form method="post" action="{{ URL::to('manage/updateshippingmethod/') }}" data-parsley-validate novalidate>
                                        {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="userName">Shipping Type<span class="text-danger">*</span></label>
                                                        <input type="hidden" name="orderid" value="{{ $orderid }}">
                                                        <select class="form-control" name="shipping" id="shipping">
                                                            <option value="">select</option>
                                                            @if($orders->shippingtype != null)
                                                            <option value="canadapost" @if($orders->shippingtype == 'canadapost') selected  @endif>Canada Post</option>
                                                            <option value="fedex" @if($orders->shippingtype == 'fedex') selected  @endif>Fedex</option>
                                                            <option value="usps" @if($orders->shippingtype == 'usps') selected  @endif>USPS</option>
                                                            <option value="dhl" @if($orders->shippingtype == 'dhl') selected  @endif>DHL</option>
                                                            @else
                                                            <option value="canadapost">Canada Post</option>
                                                            <option value="fedex">Fedex</option>
                                                            <option value="usps">USPS</option>
                                                            <option value="dhl">DHL</option>
                                                            @endif
                                                            
                                                        </select>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                             <div class="row">
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="userName">Trackingcode</label>
                                                         <input type="text" required placeholder="Enter Tracking code" class="form-control" name="trackingcode">
                                                    </div>
                                                 </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="userName">Tracking Url</label>
                                                         <input type="text" required placeholder="Enter Tracking Url" class="form-control" name="trackingurl">
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