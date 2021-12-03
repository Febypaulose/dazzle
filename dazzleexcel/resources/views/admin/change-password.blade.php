@extends('layouts.password')
@section('content')

<style type="text/css">
.error {
    color: red;
}
</style>

<div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                        	

                        </div>
                       
                       
                        <h4 class="page-title">Change Password</h4>
                       
                    </div>
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">

                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12">
                                	@if (Session::has('message'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong>Well done!</strong>{{ Session::get('message') }}
                                        </div>
                                    @endif
                                    @if (Session::has('error'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                                <strong>Well done!</strong>{{ Session::get('error') }}
                                            </div>
                                        @endif
                                    <div class="p-20">
                                        @if($edit == 1)
                                        
                                        <form method="post" action="{{ URL::to('manage/dashboard/'.Crypt::encrypt(Auth::guard('admin')->user()->id)) }}" name="changepass" data-parsley-validate novalidate>
                                        <input type="hidden" name="_method" value="put">
                                        @else
                                        <form method="post" action="{{ URL::to('manage/clients/') }}" name="changepass" data-parsley-validate novalidate>
                                        @endif
                                        
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                                <label for="userName">Old Password</label>
                                                <input type="text" name="oldpass" placeholder="Enter Old Password" class="form-control" id="oldpass" >
                                        </div>
                                        <div class="form-group">
                                                <label for="userName">New Password</label>
                                                <input type="text" name="npass" placeholder="Enter New Password" class="form-control" id="npass">
                                        </div>
                                        <div class="form-group">
                                                <label for="userName">Repeat Password</label>
                                                <input type="text" name="rpass" placeholder="Enter Repeat Password" class="form-control" id="rpass">
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



<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
      $("form[name='changepass']").validate({
    rules: {
      oldpass: "required",
      npass : "required",
      rpass : {
                    required : true,
                    equalTo : "#npass"
      }
     
      
     
    }, 
  
    messages: {
      oldpass: "Please enter your Old Password",
      npass: "Please enter your New Password",
      rpass: {
          required : "Please enter Password",
          equalTo : "Password and confirm password should be same"
      }                 
      
      
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
})
</script>








@endsection