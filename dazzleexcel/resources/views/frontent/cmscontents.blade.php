 @extends('layouts.frontendinner')



@section('content')



            <div class="main-content">

                <div class="title-page">

                    <h3>{{$help->title}}</h3>

                </div>



                <div class="login-box-container">

                    <div class="container">

                       
                        {!! $help->content  !!}

                    </div>

                    <!-- End container -->

                </div>

                <!-- End cat-box-container -->

            </div>



            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

            <script type="text/javascript" src="{{ asset('frontend/js/form-validation.js') }}"></script>







 @endsection