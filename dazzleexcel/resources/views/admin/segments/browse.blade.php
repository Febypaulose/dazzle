 @extends('layouts.datatable')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
.segmentremove {
    margin-left: 14px;
}
</style>
 <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                           <!--  <a href="{{ URL::to('manage/products/create') }}">
                                <button type="button" class="btn btn-custom">Add</button>
                            </a> -->
                            

                        </div>
                        <h4 class="page-title">Segment</h4>
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
                            <div class="messages"></div>
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Thumbnail</th>
                                    <th>Products Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                   
                                    <th>Segment Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                

                                @foreach($products as $product)
                                @php
                                $id = $product->Id;
                                $images = DB::table('productsimages')->where('productId', '=',$id)->first();
                                $productcategory = DB::table('productscategories')
                                 ->join('category', 'productscategories.categoryId', '=', 'category.Id')
                                ->where('productId', '=',$id)
                                ->first();

                                $segments = DB::table('segments')->where('productId', '=',$id)->first();
                               

                                @endphp
                                 
                                <tr>
                                    <td>
                                          @if($images !='')
                                        <img src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $images->image_url}}/" height="100" width="100">
                                        @else
                                        <td></td>
                                        @endif
                                    </td>
                                    <td>{{ $product->product_name}}</td>
                                    @if( $productcategory!="")
                                    <td>{{ $productcategory->category}}</td>
                                    @else
                                    <td></td>
                                    @endif
                                    <td>{{ '$'.''.$product->product_price}}</td>
                                    <td>
                                        <div class="col-md-6">
                                        <form method="post" class="changesegment" id="changesegment" action="{{ URL::to('manage/segments/') }}" >
                                         {{ csrf_field() }}
                                        <div class="form-group">
                                                     <select  class="form-control segmenttypId" name="segmenttypId" id="segmenttypId" data-id="{{ $product->Id }}">
                                                         <option>Select segment TYpe</option>
                                                         @foreach($Segmenttype as $type)
                                                         @if(!empty($segments->productId))
                                                         <option value="{{$type->id }}" @if($segments->segmenttypeId == $type->id ) selected @endif >{{$type->segmenttype_name}}</option>
                                                         @else
                                                         <option value="{{$type->id }}" >{{$type->segmenttype_name}}</option>
                                                         @endif
                                                         
                                                         @endforeach
                                                    </select>
                                                    <input type="hidden" class="typeId" name="typeId" id="typeId" >
                                                    <input type="hidden" class="productId" name="productId" id="productId" value="{{ $product->Id }}">
                                                </div>
                                        </form>
                                        </div>
                                        <!-- <a href="{{ URL::to('manage/products/'.Crypt::encrypt($product->Id).'/edit') }}">
                                            <button type="button" class="btn btn-success"><i class="fa fa-pencil"></i></button>
                                        </a> -->
                                        
                                        {{ Form::open(array('url' => 'manage/segments/'.Crypt::encrypt($product->Id), 'method' => 'delete','onclick'=>'return confirm("Are you Sure")' ,'style'=>'display:inline')) }}
                                        @if(!empty($segments->productId))
                                             @if($segments->productId == $id)
                                             <button type="submit" class="btn btn-danger segmentremove"><i class="fa fa-trash"></i></button>
                                             @endif
                                         @else
                                         <button type="submit" class="btn btn-danger " style="display: none;"><i class="fa fa-trash"></i></button>
                                         @endif
                                         {{ Form::close() }}
                                         
                                    </td>
                                </tr>
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
                //alert($.session.get("message"));

                var msg = sessionStorage.getItem("message");
                $('.messages').html(msg);
                 sessionStorage.clear();

                $('.segmenttypId').change(function(){
                    var typeid = $(this).val();
                     var productId = $(this).attr("data-id");
                    $.ajax({
                        type:"GET",
                        url:"{{url('manage/addtosegment')}}?type_id="+typeid+"&productId="+productId,
                        success : function(response){
                            console.log(response);
                            
                                        var successHtml = '<div class="alert alert-success">'+
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                            '<strong><i class="glyphicon glyphicon-ok-sign push-5-r"></</strong> '+ response.message +
                            '</div>';
                            sessionStorage.setItem("message", successHtml);
                            location.reload();
                        }
                    });


                });
            });
            </script>

            @endsection