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
                       
                       
                      
                        <h4 class="page-title">Add Status/Shipping</h4>
                       
                    </div>
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12">
                                    <div class="p-20">
                                        <form method="post" action="{{ URL::to('manage/orders/') }}" data-parsley-validate novalidate>
                                        {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="userName">Order Status<span class="text-danger">*</span></label>
                                                        <select class="form-control" id="statusid">
                                                            <option value="">select</option>
                                                            <option value="Ordered">Ordered</option>
                                                            <option value="Confirned">Confirned</option>
                                                            <option value="Shipped">Shipped</option>
                                                            <option value="Delivered">Delivered</option>
                                                            <option value="Cancelled">Cancelled</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="userName">Shipping Methods<span class="text-danger">*</span></label>
                                                        <select class="form-control" id="shipping">
                                                            <option value="">select</option>
                                                            <option value="canadapost">Canada Post</option>
                                                            <option value="fedex">Fedex</option>
                                                            <option value="usps">USPS</option>
                                                            <option value="dhl">DHL</option>
                                                        </select>
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