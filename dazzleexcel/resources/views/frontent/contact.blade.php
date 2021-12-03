 @extends('layouts.frontendinner')



@section('content')



            <div class="title-page space-padding-tb-50">
                <h3>Contact us</h3>
            </div>
            <div class="container container-ver2">
                <div class="row">
                    <div class="col-md-6 space-50">
                        <div class="title-box">
                            <h3>Write to us</h3>
                            <p>You can choose any colour for the background, text & boder.</p>
                             @if (Session::has('message'))
                            <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                             {{ Session::get('message') }}
                          </div>
                           @endif
                            <form class="form-horizontal space-50" method="post" action="{{ URL::to('sendenquiry') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" placeholder="Name*" id="inputName" name="fullname" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Mobile*" id="inputName" name="mobile" class="form-control">
                                </div>
                                <div class="form-group">
                                    <!--col-md-6-->
                                    <input type="text" placeholder="Email*" id="inputsumary" name="mail" class="form-control">
                                </div>
                                <div class="form-group">
                                    <textarea placeholder="Your Message" id="message" name="message" class="form-control"></textarea>
                                </div>
                                <button type="submit" class="button-v2 hover-white color-white" style="background-color: #000;">Send<i class="link-icon-white"></i></button>
                                <!-- <div>
                                    <a title="add tags" href="#" class="button-v2 hover-white color-white">Send<i class="link-icon-white"></i></a>
                                </div> -->
                            </form>

                        </div>
                        <!-- End title -->
                        <!-- End content -->
                    </div>
                    <div class="col-md-6 space-50">
                        <div class="title-box">
                            <h3>Re-Design your IMAGE</h3>
                            <p>Dazzle Knots is committed to bring the innovative design at your doorstep.</p>
                        </div>
                        <!-- End title -->
                        <div class="boxed-content images">
                            <div class="text">
                                <h2>REACH US ANYTIME</h2>
                                <p>Contact us anytime and our customer support team is always there to clear your queries.</p>
                            </div>
                            <!-- End text -->
                            <img src="{{ asset('frontend/images/box-content-images.png') }}" alt="Banner">
                        </div>
                        <!-- End content -->
                    </div>
                </div>
                <!-- End row -->
            
            </div>



 @endsection