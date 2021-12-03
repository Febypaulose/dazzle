@extends('layouts.form')
@section('content')


<style type="text/css">
/*.float-left .logo {
	font-size: 80px;
    color: #000;
    font-family: "Blanch";
    line-height: 50px;
}*/
</style>
<div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            <a href="{{ URL::to('manage/orders') }}">
                            <button type="button" class="btn btn-custom">Back</button>
                        </a>

                        </div>
                       
                       
                      <h4 class="page-title">Invoice</h4>
                    </div>
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <!-- <div class="panel-heading">
                                <h4>Invoice</h4>
                            </div> -->
                            <div class="panel-body">
                                <div class="clearfix">
                                    <div class="float-left">
                                        <h3 class="logo" style="color: #090909 !important;">Dazzleknots</h3>
                                    </div>
                                    <div class="float-right">
                                        <h5>Invoice # <br>
                                            <small>{{$order->invoice_id}}</small>
                                        </h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">

                                        <div class="float-left m-t-30">
                                            <address>
                                                <strong>{{$billing->first_name.' '.$billing->first_name}}</strong><br>
                                                {{$billing->address1}}<br>
                                                {{$billing->address2}}<br>
                                                {{$billing->city}}, {{$billing->country_name}} {{$billing->pocode}}<br>
                                                <abbr title="Phone">P:</abbr> {{$billing->phone}}
                                            </address>
                                        </div>
                                        @php
                                        $created_timestamp = $order->created_at;
                                        $split_timestamp = explode(" ",$created_timestamp);
										$created_date = $split_timestamp[0];
										$date = strtotime($created_date);
										$Monthname = date('M ', $date);
										$day = date('d ', $date);
										$year = date('Y ', $date);
                                        @endphp
                                        <div class="float-right m-t-30">
                                            <p><strong>Order Date: </strong> {{$Monthname}} {{$day}}, {{$year}}</p>
                                            <p class="m-t-10"><strong>Order Status: </strong> <span class="label label-danger">{{$order->status}}</span></p>
                                            <p class="m-t-10"><strong>Order ID: </strong> #{{$order->orderno}}</p>
                                        </div>
                                    </div><!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="m-h-50"></div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table m-t-30">
                                                <thead class="bg-faded">
                                                <tr><th>#</th>
                                                    <th>Item</th>
                                                    <th>Quantity</th>
                                                    <th>Unit Cost</th>
                                                    <th>Total</th>
                                                </tr></thead>
                                                <tbody>
                                                @php $i=1;  @endphp
                                                @foreach($suborders as $item)
                                                @php  
                                                $total = $item->price * $item->quantity;

                                                @endphp
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{$item->product_name}}</td>
                                                    <td>{{$item->quantity}}</td>
                                                    <td>${{$item->price}}</td>
                                                    <td>${{$total}}</td>
                                                </tr>
                                                @php $i++;  @endphp
                                                @endforeach
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                @php

                                $shipping = $invoice->shipping_amt;
                                $price = $invoice->price;

                                $totalamt = $price - $shipping;

                                @endphp
                                <div class="row">
                                    <div class="col-6">
                                        <div class="clearfix m-t-30">
                                            <h5 class="small text-inverse font-600"><b>PAYMENT TERMS AND POLICIES</b></h5>

                                            <small>
                                                All accounts are to be paid within 7 days from receipt of
                                                invoice. To be paid by cheque or credit card or direct payment
                                                online. If account is not paid within 7 days the credits details
                                                supplied as confirmation of work undertaken will be charged the
                                                agreed quoted fee noted above.
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-6 ">
                                        <p class="text-right"><b>Sub-total:</b> ${{$totalamt}}</p>
                                        <p class="text-right">Shipping cost: ${{$shipping}}</p>
                                        
                                        <hr>
                                        <h3 class="text-right">USD {{$price}}</h3>
                                    </div>
                                </div>
                                <hr>
                                <div class="hidden-print">
                                    <div class="float-right">
                                        <a href="" class="btn btn-dark waves-effect waves-light print"><i class="fa fa-print"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- end row -->


            </div> <!-- container -->

             <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
             <script type="text/javascript">
             $(document).ready(function(){
             	$('.print').click(function(){
             		$('.topbar-main').hide();
             		window.print()
             	});
             })
             </script>




















@endsection