@extends('layouts.master')
@section('content')
<div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>


                <div class="row">
                    

                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card-box tilebox-one">
                            <i class="icon-paypal float-right text-muted"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Revenue</h6>
                            <h2 class="m-b-20">$<span data-plugin="counterup">{{round($revenue->revenue,2)}}</span></h2>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card-box tilebox-one">
                            <i class="icon-paypal float-right text-muted"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Shipping</h6>
                            <h2 class="m-b-20">$<span data-plugin="counterup">{{$shipping->shipping}}</span></h2>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card-box tilebox-one">
                            <i class="icon-layers float-right text-muted"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Orders</h6>
                            <h2 class="m-b-20" data-plugin="counterup">{{$orders}}</h2>
                        </div>
                    </div>

                    <!-- <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card-box tilebox-one">
                            <i class="icon-chart float-right text-muted"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Average Price</h6>
                            <h2 class="m-b-20">$<span data-plugin="counterup">{!! Helper::getaverage($revenue->revenue) !!}</span></h2>
                            <span class="label label-pink"> 0% </span> <span class="text-muted">From previous period</span>
                        </div>
                    </div> -->

                    
                </div>
                <!-- end row -->







            </div> <!-- container -->
@endsection