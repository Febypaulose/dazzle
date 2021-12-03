 @extends('layouts.datatable')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
.colour-colorDisplay {
    width: 15px;
    height: 15px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 8px;
    margin-left: 27px;
}
</style>
 <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            
                            

                        </div>
                        <h4 class="page-title">Orders</h4>
                    </div>
                </div>
                <!-- end row -->



                <div class="row">
                    <div class="col-12">
                        <div class="card-box table-responsive">
                            @if (Session::has('message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Well done!</strong>{{ Session::get('message') }}
                                </div>
                            @endif
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Order No</th>
                                    <th>Client Name</th>
                                    <th>Total Amount</th>
                                    <th>Current Status</th>
                                    <th>Status Update</th>
                                    <th>Shipping update</th>
                                    <th>View and print</th>
                                </tr>
                                </thead>


                                <tbody>
                                
                               @php  $i = 1; @endphp
                               @foreach($orders as $order)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{ $order->orderno }}</td>
                                    <td>{{ $order->userselect->name }}</td>
                                    <td>{{ '$'.$order->invoiceselect->price }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>
                                         <a href="{{ URL::to('manage/updateordersstatus/'.Crypt::encrypt($order->id)) }}">
                                            <button type="button" class="btn btn-success"><i class="fa fa-eye"></i></button>
                                        </a>
                                    </td>
                                    <td>
                                         <a href="{{ URL::to('manage/updateshippings/'.Crypt::encrypt($order->id)) }}">
                                            <button type="button" class="btn btn-success"><i class="fa fa-eye"></i></button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ URL::to('manage/orders/'.Crypt::encrypt($order->id)) }}">
                                            <button type="button" class="btn btn-success"><i class="fa fa-eye"></i></button>
                                        </a>
                                    </td>
                                </tr>
                                @php  $i++; @endphp
                                @endforeach
                                
                               
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end row -->


                


            </div> <!-- container -->

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#statusid').change(function(){
            var status = $(this).val();
            var dataid = $(this).attr("data-id")
            $.ajax({
                 type:"GET",
                 url:"{{url('manage/updatestatus')}}?orderid="+dataid+"&status="+status,
                 success : function(response){
                     location.reload();
                 }
            })
        })
    })
    </script>

            @endsection