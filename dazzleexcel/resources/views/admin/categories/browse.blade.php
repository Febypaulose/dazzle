 @extends('layouts.datatable')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            <a href="{{ URL::to('manage/categories/create') }}">
                                <button type="button" class="btn btn-custom">Add</button>
                            </a>
                            

                        </div>
                        <h4 class="page-title">Categories</h4>
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
                                    <th>Category Name</th>
                                    <th>Parent</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($categories as $cat)
                                @php
                                $parent = $cat->parentId;
                                if($parent == 0) {
                                $parentname = 'parent';
                                }
                                else {
                                $parentcat = DB::table('category')->where('Id',$parent)->first(); 
                                $parentname = $parentcat->category;
                                }

                                @endphp
                                <tr>
                                    <td>{{$cat->category}}</td>
                                    <td>{{$parentname}}</td>
                                    <td>
                                        <a href="{{ URL::to('manage/categories/'.Crypt::encrypt($cat->Id).'/edit') }}">
                                            <button type="button" class="btn btn-success"><i class="fa fa-pencil"></i></button>
                                        </a>
                                        {{ Form::open(array('url' => 'manage/categories/'.Crypt::encrypt($cat->Id), 'method' => 'delete','onclick'=>'return confirm("Are you Sure")' ,'style'=>'display:inline')) }}
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