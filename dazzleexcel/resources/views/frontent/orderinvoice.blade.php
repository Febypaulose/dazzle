@extends('layouts.frontendinner')

@section('content')

<style type="text/css">

.logo-footer {

    margin-bottom: 20px;

}

.logo-footer a {

    font-size: 80px;

    color: #000;

    font-family: "Blanch";

    line-height: 50px;

}

</style>



            

            <div class="container">

<div class="row">

                    <!-- BEGIN INVOICE -->

                    <div class="col-xs-12">

                        <div class="grid invoice">

                            <div class="grid-body">

                                <div class="invoice-title">

                                    <div class="row">

                                        <div class="col-xs-12">

                                            <div class="logo-footer"><a href="#" title="Logo">Dazzleknots</a></div>

                                        </div>

                                    </div>

                                    <br>

                                    <div class="row">

                                        <div class="col-xs-12">

                                            <h2>invoice<br>

                                            <span class="small">order #{{$invoice->orderno }}</span></h2>

                                        </div>

                                    </div>

                                </div>

                                <hr>

                                <div class="row">

                                    <div class="col-xs-6">

                                        <address>

                                            <strong>Billed To:</strong><br>

                                            {{$billing->first_name.' '.$billing->last_name}}<br>

                                            {{$billing->address1.','.$billing->address2}}<br>

                                            {{$billing->country_name}} {{$billing->pocode}}<br>

                                            <abbr title="Phone">P:</abbr> {{$billing->phone}}

                                        </address>

                                    </div>

                                    <div class="col-xs-6 text-right">

                                        <address>

                                            <strong>Shipped To:</strong><br>

                                            {{$shipping->first_name.' '.$shipping->last_name}}<br>

                                            {{$shipping->address1.','.$shipping->address2}}<br>

                                            {{$shipping->country_name}} {{$shipping->pocode}}<br>

                                            <abbr title="Phone">P:</abbr> {{$shipping->phone}}

                                        </address>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-xs-6">

                                        <address>

                                            <strong>Payment Method:</strong><br>

                                            {{$invoice->paymenttype}}<br>

                                            {{$billing->mail}}<br>

                                        </address>

                                    </div>

                                    <div class="col-xs-6 text-right">

                                        <address>

                                            <strong>Order Date:</strong><br>

                                            {{date('d/m/Y', strtotime($invoice->created_at))}}

                                        </address>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <h3>ORDER SUMMARY</h3>

                                        <table class="table table-striped">

                                            <thead>

                                                <tr class="line">

                                                    <td><strong>#</strong></td>

                                                    <td class="text-center"><strong>Item</strong></td>

                                                    <td class="text-center"><strong>Quantity</strong></td>

                                                    <td class="text-right"><strong>RATE</strong></td>

                                                    <td class="text-right"><strong>SUBTOTAL</strong></td>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                 @php $i = 1; @endphp

                                                @foreach($items as $item)

                                                @php

                                                $grandtotal = $item->price * $item->quantity;



                                                @endphp

                                                <tr>

                                                    <td>{{$i}}</td>

                                                    <td>{{$item->product_name}}</td>

                                                    <td class="text-center">{{$item->quantity}}</td>

                                                    <td class="text-right">{!! Helper::currency_conversion($item->price) !!}</td>

                                                    <td class="text-right">{!! Helper::currency_conversion($grandtotal) !!}</td>

                                                </tr>

                                                @php $i++;   @endphp

                                                @endforeach

                                                @php 

                                                

                                                @endphp

                                                <tr>

                                                    <td colspan="3"></td>

                                                    <td class="text-right"><strong>Shipping Amount</strong></td>

                                                    <td class="text-right"><strong>{!! Helper::currency_conversion($invoicelist->shipping_amt) !!}</strong></td>

                                                </tr>

                                                <tr>

                                                    <td colspan="3"></td>

                                                    <td class="text-right"><strong>GST(5%)</strong></td>

                                                    <td class="text-right"><strong>{!! Helper::currency_conversion($invoicelist->tax) !!}</strong></td>

                                                </tr>

                                                @if(!empty($coupondata))
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td class="text-right"><strong>Coupon Applied : ({{$coupondata->code}})</strong></td>
                                                    @if($coupondata->type == 'fixed')
                                                    <td class="text-right"><strong>{!! Helper::currency_conversion($coupondata->value) !!} Discount</strong></td>
                                                    @else
                                                    <td class="text-right"><strong>${{$coupondata->percent_off.'%'}} Discount</strong></td>
                                                    @endif
                                                </tr>
                                                @endif
                                                



                                                <tr>

                                                    <td colspan="3">

                                                    </td><td class="text-right"><strong>Total</strong></td>

                                                    <td class="text-right"><strong>{!! Helper::currency_conversion($invoicelist->price) !!}</strong></td>

                                                </tr>

                                            </tbody>

                                        </table>

                                    </div>                                  

                                </div>

                                <!-- <div class="row">

                                    <div class="col-md-12 text-right identity">

                                        <p>Designer identity<br><strong>Jeffrey Williams</strong></p>

                                    </div>

                                </div> -->

                            </div>

                        </div>

                    </div>

                    <!-- END INVOICE -->

                </div>

</div>



































 @endsection