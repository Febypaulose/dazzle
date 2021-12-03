<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">

        <meta name="author" content="Coderthemes">

        <meta name="csrf-token" content="{{ csrf_token() }}">



        <!-- App Favicon -->

        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">



        <!-- App title -->

        <title>Reliance Cms - Admin</title>



        <!-- Switchery css -->

        <link href="{{ asset('assets/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />



        <!-- Bootstrap CSS -->

        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />



        <!-- App CSS -->

        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />



        <!-- Modernizr js -->

        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
        <style type="text/css">
    small {
    font-size: 58% !important;
    }
    </style>







        



    </head>





    <body>



        @include('layouts.navigation');







        <!-- ============================================================== -->

        <!-- Start right Content here -->

        <!-- ============================================================== -->

        <div class="wrapper">

             @yield('content')





            <!-- Footer -->

            <footer class="footer">

                2021  © daddy cool Technolgies.

            </footer>

            <!-- End Footer -->







            <!-- Right Sidebar -->

            <div class="side-bar right-bar">

                <div class="nicescroll">

                    <ul class="nav nav-pills nav-justified text-xs-center">

                        <li class="nav-item">

                            <a href="#home-2"  class="nav-link active" data-toggle="tab" aria-expanded="false">

                                Activity

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="#messages-2" class="nav-link" data-toggle="tab" aria-expanded="true">

                                Settings

                            </a>

                        </li>

                    </ul>



                    <div class="tab-content">

                        <div class="tab-pane fade active show" id="home-2">

                            <div class="timeline-2">

                                <div class="time-item">

                                    <div class="item-info">

                                        <small class="text-muted">5 minutes ago</small>

                                        <p><strong><a href="#" class="text-info">John Doe</a></strong> Uploaded a photo <strong>"DSC000586.jpg"</strong></p>

                                    </div>

                                </div>



                                <div class="time-item">

                                    <div class="item-info">

                                        <small class="text-muted">30 minutes ago</small>

                                        <p><a href="" class="text-info">Lorem</a> commented your post.</p>

                                        <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>

                                    </div>

                                </div>



                                <div class="time-item">

                                    <div class="item-info">

                                        <small class="text-muted">59 minutes ago</small>

                                        <p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John Doe</a>.</p>

                                        <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>

                                    </div>

                                </div>



                                <div class="time-item">

                                    <div class="item-info">

                                        <small class="text-muted">1 hour ago</small>

                                        <p><strong><a href="#" class="text-info">John Doe</a></strong>Uploaded 2 new photos</p>

                                    </div>

                                </div>



                                <div class="time-item">

                                    <div class="item-info">

                                        <small class="text-muted">3 hours ago</small>

                                        <p><a href="" class="text-info">Lorem</a> commented your post.</p>

                                        <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>

                                    </div>

                                </div>



                                <div class="time-item">

                                    <div class="item-info">

                                        <small class="text-muted">5 hours ago</small>

                                        <p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John Doe</a>.</p>

                                        <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <div class="tab-pane fade" id="messages-2">



                            <div class="row m-t-10">

                                <div class="col-8">

                                    <h5 class="m-0">Notifications</h5>

                                    <p class="text-muted m-b-0"><small>Do you need them?</small></p>

                                </div>

                                <div class="col-4 text-right">

                                    <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a" data-size="small"/>

                                </div>

                            </div>



                            <div class="row m-t-10">

                                <div class="col-8">

                                    <h5 class="m-0">API Access</h5>

                                    <p class="m-b-0 text-muted"><small>Enable/Disable access</small></p>

                                </div>

                                <div class="col-4 text-right">

                                    <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a" data-size="small"/>

                                </div>

                            </div>



                            <div class="row m-t-10">

                                <div class="col-8">

                                    <h5 class="m-0">Auto Updates</h5>

                                    <p class="m-b-0 text-muted"><small>Keep up to date</small></p>

                                </div>

                                <div class="col-4 text-right">

                                    <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a" data-size="small"/>

                                </div>

                            </div>



                            <div class="row m-t-10">

                                <div class="col-8">

                                    <h5 class="m-0">Online Status</h5>

                                    <p class="m-b-0 text-muted"><small>Show your status to all</small></p>

                                </div>

                                <div class="col-4 text-right">

                                    <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a" data-size="small"/>

                                </div>

                            </div>



                        </div>

                    </div>

                </div> <!-- end nicescroll -->

            </div>

            <!-- /Right-bar -->







        </div> <!-- End wrapper -->









        <script>

            var resizefunc = [];

        </script>



        <!-- jQuery  -->

        

        <script src="{{ asset('assets/js/popper.min.js') }}"></script><!-- Tether for Bootstrap -->

        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

        <script src="{{ asset('assets/js/waves.js') }}"></script>

        <script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>

        <script src="{{ asset('assets/plugins/switchery/switchery.min.js') }}"></script>

        <script src="{{ asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/plugins/autoNumeric/autoNumeric.js') }}" type="text/javascript"></script>









        <!-- Validation js (Parsleyjs) -->

        <script type="text/javascript" src="{{ asset('assets/plugins/parsleyjs/parsley.min.js') }}"></script>

        <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>



        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>



        <!-- App js -->

        <script src="{{ asset('assets/js/jquery.core.js') }}"></script>

        <script src="{{ asset('assets/js/jquery.app.js') }}"></script>



        <script type="text/javascript">

            $(document).ready(function() {

                $('form').parsley();

            });

        </script>







    </body>

</html>