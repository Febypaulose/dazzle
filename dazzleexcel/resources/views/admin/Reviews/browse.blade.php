 @extends('layouts.datatable')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.checked {
  color: #a57f20 !important;
}
</style>
 <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            <a href="{{ URL::to('manage/normalproducts/create') }}">
                                <button type="button" class="btn btn-custom">Add</button>
                            </a>
                            

                        </div>
                        <h4 class="page-title">Products</h4>
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
                                    <th>Reviewer Name</th>
                                    <th>Message</th>
                                    <th>Rating</th>
                                    <th>Actions</th>
                                </tr>
                                
                                </thead>


                                <tbody>
                                @foreach($reviews as $review)
                                <tr>
                                    <td>{{ $review->name}}</td>
                                    <td>{{ $review->summary}}</td>
                                    <td>
                                        @if($review->rating == 1)
                                      <span class="fa fa-star checked"></span>
                                      <span class="fa fa-star"></span>
                                      <span class="fa fa-star"></span>
                                      <span class="fa fa-star"></span>
                                      <span class="fa fa-star"></span>
                                     @elseif($review->rating == 2)
                                     <span class="fa fa-star checked"></span>
                                     <span class="fa fa-star checked"></span>
                                     <span class="fa fa-star"></span>
                                     <span class="fa fa-star"></span>
                                     <span class="fa fa-star"></span>
                                     @elseif($review->rating == 3)
                                     <span class="fa fa-star checked"></span>
                                     <span class="fa fa-star checked"></span>
                                     <span class="fa fa-star checked"></span>
                                     <span class="fa fa-star"></span>
                                     <span class="fa fa-star"></span>
                                     @elseif($review->rating == 4)
                                     <span class="fa fa-star checked"></span>
                                     <span class="fa fa-star checked"></span>
                                     <span class="fa fa-star checked"></span>
                                     <span class="fa fa-star checked"></span>
                                     <span class="fa fa-star"></span>
                                     @elseif($review->rating == 5)
                                     <span class="fa fa-star checked"></span>
                                     <span class="fa fa-star checked"></span>
                                     <span class="fa fa-star checked"></span>
                                     <span class="fa fa-star checked"></span>
                                     <span class="fa fa-star checked"></span>
                                     @endif
                                    </td>
                                    <td>
                                       
                                         {{ Form::open(array('url' => 'manage/reviewsdelete/'.Crypt::encrypt($review->id), 'method' => 'post','onclick'=>'return confirm("Are you Sure")' ,'style'=>'display:inline')) }}
                                         <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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

            @endsection