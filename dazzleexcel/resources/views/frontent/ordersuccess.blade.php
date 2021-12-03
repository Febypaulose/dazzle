@extends('layouts.frontendinner')
@section('content')


            <div class="title-page space-padding-tb-50">
                <h3>Order Success</h3>
            </div>
            <div class="container container-ver2">
                <div class="row">
                    <div class="col-md-6 space-50">
                        <div class="title-box">
                            <p>Congratulations, your order has been placed.</p><br/>
                            <p><span>Transaction Id:</span>{{$invoice->payment_id}}</p><br/>
                            <p><span>Invoice Id:</span>{{$invoice->invoiceno}}</p><br/>
                           

                        </div>
                        <!-- End title -->
                        <!-- End content -->
                    </div>
                    
                </div>
                <!-- End row -->
            
            </div>

















 @endsection