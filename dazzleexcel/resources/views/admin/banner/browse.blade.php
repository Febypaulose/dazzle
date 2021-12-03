 @extends('layouts.datatable')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            <a href="{{ URL::to('manage/banner/create') }}">
                                <button type="button" class="btn btn-custom">Add</button>
                            </a>
                            

                        </div>
                        <h4 class="page-title">Banners</h4>
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
                                    <th>Banner</th>
                                    <th>Title</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($banners as $banner)
                                <tr>
                                    <td>
                                        <img src="{{ asset(env('BANNER_IMAGE'))}}/{{ $banner->image}}/" height="100" width="100">
                                    </td>
                                    <td>{{$banner->title}}</td>
                                    <td>
                                        <a href="{{ URL::to('manage/banner/'.Crypt::encrypt($banner->id).'/edit') }}">
                                            <button type="button" class="btn btn-success"><i class="fa fa-pencil"></i></button>
                                        </a>
                                        {{ Form::open(array('url' => 'manage/banner/'.Crypt::encrypt($banner->id), 'method' => 'delete','onclick'=>'return confirm("Are you Sure")' ,'style'=>'display:inline')) }}
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