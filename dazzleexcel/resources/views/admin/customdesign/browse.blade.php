 @extends('layouts.datatable')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            <a href="{{ URL::to('manage/dressmaterial/create') }}">
                                <button type="button" class="btn btn-custom">Add</button>
                            </a>
                            

                        </div>
                        <h4 class="page-title">Custom  Design</h4>
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
                                    <th>Name</th>
                                    <th>E-mail</th>
                                    <th>Phone</th>
                                    <th>Dress Type</th>
                                    <th>Time Slot</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($customdesigns as $design)
                             
                                <tr>
                                    <td>{{$design->name}}</td>
                                    <td>{{$design->mail}}</td>
                                    <td>{{$design->phone}}</td>
                                    <td>{{$design->dresstypeselect->dresstype}}</td>
                                    <td>{{$design->preftime }}</td>
                                    <td>{{$design->prefdate}}</td>
                                    <td>
                                        <a href="{{ URL::to('manage/customdesigning/'.Crypt::encrypt($design->id)) }}">
                                            <button type="button" class="btn btn-success"><i class="fa fa-eye"></i></button>
                                        </a>
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