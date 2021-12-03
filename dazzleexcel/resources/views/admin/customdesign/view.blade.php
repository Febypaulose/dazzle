@extends('layouts.form')
@section('content')
<div class="container">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            <a href="{{ URL::to('manage/dressmaterial') }}">
                            <button type="button" class="btn btn-custom">Back</button>
                        </a>
                        </div>
                      
                        <h4 class="page-title">Custom Design</h4>
                        
                        
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12">
                                    <div class="p-20">
                                        @if ($errors->any())
                                             @foreach ($errors->all() as $error)
                                                 <div>{{$error}}</div>
                                             @endforeach
                                         @endif
                                        <form method="post" action="{{ URL::to('manage/customdesigning/'.Crypt::encrypt($customdesign->id)) }}" data-parsley-validate novalidate>
                                        <input type="hidden" name="_method" value="put">
                                        {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="userName">Name<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"   value="{{ $customdesign->name  }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="userName">E-mail<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"   value="{{ $customdesign->mail  }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="userName">Name<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"   value="{{ $customdesign->phone  }}" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                             <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="userName">Dress Type<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"   value="{{ $customdesign->dresstypeselect->dresstype  }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="userName">Dress Material<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"   value="{{ $customdesign->dressmaterialselect->material  }}" disabled>
                                                    </div>
                                                </div>
                                             </div>


                                             <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="userName">Colours<span class="text-danger">*</span></label>
                                                        @foreach($colours as $color)
                                                        <div>{{$color->color_name}}</div>
                                                        @endforeach
                                                       
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="userName">Handwork<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"   value="{{ $customdesign->handwork  }}" disabled>
                                                    </div>
                                                </div>
                                                
                                             </div>

                                             <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="userName">Design Sample<span class="text-danger">*</span></label><br/>
                                                        <img style="width: 100px; height: auto;" src="{{ asset(env('CUSTOMDESIGN_IMAGE'))}}/{{ $customdesign->design }}"> 
                                                    </div>
                                                </div>
                                             </div>

                                             <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="userName">Payment Type<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"   value="{{ $customdesign->paymenttype  }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="userName">Time Slot<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"   value="{{ $customdesign->preftime  }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="userName">Date<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"   value="{{ $customdesign->prefdate  }}" disabled>
                                                    </div>
                                                </div>
                                             </div>

                                              <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="userName">Additional <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"   value="{{ $customdesign->additional  }}" disabled>
                                                    </div>
                                                </div>
                                              </div>


                                             <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="userName">Amount<span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control" name="amount">
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














@endsection