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
                       
                       
                      
                        <h4 class="page-title">Update Status</h4>
                       
                    </div>
                </div>
                <!-- end row -->

                @php $status = $order->status;   @endphp
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12">
                                    <div class="p-20">
                                        <form method="post" action="{{ URL::to('manage/updatestatus/') }}" data-parsley-validate novalidate>
                                        {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="userName">Order Status<span class="text-danger">*</span></label>
                                                        <input type="hidden" name="orderid" value="{{ $orderid }}">
                                                        <input type="hidden" name="shipmentId" id="shipmentId">
                                                         <input type="hidden" name="trackingId" id="trackingId">
                                                          <input type="hidden" name="shippingtype" id="shippingtype" value="{{ $order->shippingtype }}">
                                                        <select class="form-control" name="statusid" id="statusid">
                                                            <option value="">select</option>
                                                            <option value="Ordered" @if($order->status == 'Ordered') selected @endif>Ordered</option>
                                                            <option value="Confirmed" @if($order->status == 'Confirmed') selected @endif>Confirned</option>
                                                            <option value="Shipped" @if($order->status == 'Shipped') selected @endif>Shipped</option>
                                                            <option value="Delivered" @if($order->status == 'Delivered') selected @endif>Delivered</option>
                                                            <option value="Cancelled" @if($order->status == 'Cancelled') selected @endif>Cancelled</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="userName">Note<span class="text-danger">*</span></label>
                                                        <textarea class="form-control" name="ordernote" id="exampleFormControlTextarea1" rows="3"></textarea>
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


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- <script type="text/javascript">
$(document).ready(function(){
    $('#statusid').change(function(){
        var status = $(this).val();
        var shippingtype = $('#shippingtype').val();
        if (status == 'Shipped' && shippingtype == 'canadapost' ) {
            createshippingcapost();

        }
    })
});
</script> -->
<!-- <script type="text/javascript">
function createshippingcapost(){
    $base_url = "{{ URL::to('/') }}";
    $.ajax({
        type:"GET",
        url: $base_url+'/'+'storage/app/public/shipping/canadapost/ncshipping/CreateNCShipment/CreateNCShipment.php',
        success : function(response){
            //console.log(response);
             var splitcashipmentid = response.split('Shipment ID:');
             var splitsh = splitcashipmentid[1].split('self:');
            //console.log(splitsh[0]);
             $('#shipmentId').val(splitsh[0]);
             getshipmentdetailscapost();
        }
    })
}
function getshipmentdetailscapost(){
   $base_url = "{{ URL::to('/') }}";
   var shipmentid = $('#shipmentId').val();
   $.ajax({
    type:"GET",
    url: $base_url+'/'+'storage/app/public/shipping/canadapost/ncshipping/GetNCShipmentDetails/GetNCShipmentDetails.php?shipmentId='+shipmentid +'',
    success : function(response){
        //console.log(response);
        var splitpin = response.split('Tracking Pin:');
        var pinsplit = splitpin[1].split(' ');
        var trackingpin =pinsplit[1].split('Service');
        $('#trackingId').val(trackingpin[0]);

    }
   });
}
</script> -->











@endsection