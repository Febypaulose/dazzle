 @extends('layouts.frontendinner')







@section('content')



<style type="text/css">



@import url(//fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800);



.testimonial2 {



  font-family: "Oswald", sans-serif;



  color: #8d97ad;



  font-weight: 300;



}







.testimonial2 h1,



.testimonial2 h2,



.testimonial2 h3,



.testimonial2 h4,



.testimonial2 h5,



.testimonial2 h6 {



  color: #3e4555;



}







.testimonial2 h5 {



    line-height: 22px;



    font-size: 18px;



		font-weight: 400;



}







.testimonial2 .font-weight-medium {



  font-weight: 500;



}







.testimonial2 .bg-light {



  background-color: #f4f8fa !important;



}







.testimonial2 .subtitle {



  color: #8d97ad;



  line-height: 24px;



}







.testimonial2 .testi2 .image-thumb {



  /*background: url({{ asset('frontend/images/greadint-bg.png') }}) no-repeat top center;*/

  



  text-align: center;



  padding: 8% 0;



}







.testimonial2 .testi2 .image-thumb img {



  width: 400px;

  /*filter: blur(8px);*/

  /*-webkit-filter: blur(3px);*/



}







.testimonial2 .testi2 .owl-dots {



  display: inline-block;



  position: relative;



  top: -100px;



}







.testimonial2 .testi2 .owl-dots .owl-dot {



  border-radius: 100%;



  width: 70px;



  height: 70px;



  background-size: cover;



  margin-right: 10px;



  opacity: 0.4;



  cursor: pointer;



}







.testimonial2 .testi2 .owl-dots .owl-dot span {



  display: none;



}







.testimonial2 .testi2 .owl-dots .owl-dot.active,



.testimonial2 .testi2 .owl-dots .owl-dot:hover {



  opacity: 1;



}







@media (max-width: 767px) {



  .testimonial2 .testi2 .owl-dots {



    top: 0px;



  }



}







.testimonial2 .btn-md {



    /*padding: 18px 0px;*/



    width: 60px;



    height: 41px;



    font-size: 20px;



}







.testimonial2 .btn-danger {



    background: #ff4d7e !important;



    border: 1px solid #ff4d7e !important;



}

.placeholder {

    margin-right: auto;

    margin-left:auto;

    margin-top: 20px;

    width: 200px;

    height: 200px;

    position: relative;

    /* this is the only relevant part for the example */

}

/* both DIVs have the same image */

 .bg-image-blur, .bg-image {

    position:absolute;

    top:0;

    left:0;

    width: 100%;

    height:100%;

}

/* blur the background, to make blurred edges that overflow the unblurred image that is on top */

 .bg-image-blur {

    -webkit-filter: blur(20px);

    -moz-filter: blur(20px);

    -o-filter: blur(20px);

    -ms-filter: blur(20px);

    filter: blur(20px);

}

/* I added this DIV in case you need to place content inside */

 .content {

    position: absolute;

    top:0;

    left:0;

    width: 100%;

    height: 100%;

    color: #fff;

    text-shadow: 0 0 3px #000;

    text-align: center;

    font-size: 30px;

}



.navbar-nav {



flex-direction: initial !important;



}



.item p {

    margin-top: 224px;

    margin-left: 324px;

}



.item h5 {

    margin-top: 3px;

    margin-left: 323px;

}



.note h2 {

    margin-left: 53px;

}

.note ul {

    margin-left: 53px;

}



</style>

<style>

.process-row {

    padding-top: 40px;

    margin-left: 70px;

}

.process-step::before {

    position: absolute;

    right: -123px;

    width: 110px;

    height: 2px;

    background-color: #a9852b;

    content: "";

    top: 80px;

    display: block;

}



.process-icon {

    width: 164px;

    text-align: center;

    height: 164px;

    float: left;

    border-radius: 100%;

    background-color: #fff;

    border: 2px solid #a9852b;

    position: relative;

    padding-top: 44px;

    margin-bottom: 10px;

}

.process-icon span {

    width: 56px;

    height: 56px;

    background-color: #090909;

    border: 2px solid #fff;

    color: #fff;

    line-height: 56px;

    font-size: 28px;

    position: absolute;

    left: -30px;

    top: 50%;

    margin-top: -30px;

    border-radius: 100%;

    font-weight: 700;

}

.process-step p {

    text-transform: uppercase;

    width: 100%;

    text-align: center;

    margin-top: 10px;

    clear: both;

}

.process-step p {

    margin-bottom: 0px;

}

p {

    margin: 0 0 10px;

}

.process-step {

    float: left;

    width: 164px;

    margin-right: 14%;

    position: relative;

}

.process-step:last-child {

    margin-right: 0px;

}

.process-step:last-child::before

 {

display:none;

}





/*.shadow*/

/*{*/

/*    display:block;*/

/*    position:relative;*/

/*}*/

    

.shadow img {

  border-top: 2px solid var(--border-color-top, var(--border-color, #8d97ad));

  border-bottom: 2px solid var(--border-color-bottom, var(--border-color, #8d97ad));

  border-right: 2px solid var(--border-color-right, var(--border-color, #8d97ad));

  border-left: 2px solid var(--border-color-left, var(--border-color, #8d97ad));

  box-shadow: 0 -4px 10px -1px var(--border-color-top, var(--border-color, #8d97ad)), 4px 0 10px -1px var(--border-color-right, var(--border-color, #8d97ad)), 0 4px 10px -1px var(--border-color-bottom, var(--border-color, #8d97ad)), -4px 0 10px -1px var(--border-color-left, var(--border-color, #8d97ad));

  margin: 10px;

}

    

/*.shadow:before*/

/*{*/

/*    display:block;*/

/*    content:'';*/

/*    position:absolute;*/

/*    width:100%;*/

/*    height:100%;*/

/*    -moz-box-shadow:inset 0px 0px 3px 1px rgba(0,0,0,1);*/

/*    -webkit-box-shadow:inset 0px 0px 3px 1px rgba(0,0,0,1);*/

/*    box-shadow:inset 0px 0px 3px 1px rgba(0,0,0,1);*/

/*}*/



@media screen and (min-device-width: 720px) and (max-device-width: 1600px){
    .item p {
    margin-top: 1px;
    margin-left: 122px;
    }
    .item h5 {
    margin-left: 124px;
    }
    /*.item p {*/

    /*    margin-top: 1px;*/

    /*    margin-left: 149px;*/

    /*}*/

    /*.item h5 {*/

    /*    margin-left :147px;*/

    /*}*/

}

@media screen and (min-device-width: 768px) and (max-device-width: 1366px){
  .item p {
    margin-top: 224px;
    margin-left: 324px;
}

.item h5 {
    margin-top: 3px;
    margin-left: 323px;
    }
}



@media screen and (min-device-width: 360px) and (max-device-width: 720px){

    .item p {

        margin-top: 1px;

        margin-left: 2px;

    }

    .item h5 {

        margin-left :14px;

    }

    .space-padding-tb-50 {

        padding-bottom : -17px !important;

    }

}



</style>



      

      <div class="title-page space-padding-tb-50">

    <h3>Testimonials</h3>

</div>



                            <!-- End Price -->

                        </div>

<div class="testimonial2 py-5">



  <div class="container">



    <div class="heading">



    </div>



    <div class="owl-carousel owl-theme testi2 mt-4">



      @foreach($testimonial as $comments)



      <div class="item">



        <div class="row position-relative">



          <div class="col-lg-6 col-md-6 align-self-center">



           <!--  <h4 class="my-3">Customer Reviews</h4> -->



            <p style="width: 360px;line-height: 24px;font-size: 17px;">{{$comments->message}}</p>



            <h5 class="mt-4">{{$comments->name}}</h5>



            <!-- <h6 class="subtitle font-weight-normal">Partner, Brevin</h6> -->



          </div>



          <div class="col-lg-6 col-md-6 image-thumb d-none d-md-block shadow">



            <img src="{{ asset(env('TESTIMONIAL_IMAGE'))}}/{{ $comments->image }}" alt="wrapkit" class="rounded-circle img-fluid" />

          



          </div>



        </div>



      



      



    </div>



    @endforeach



  </div>



</div>





<hr/>



<div class="row">

  <div class="col-md-12">

    <h2 style="text-align: center;">How to add testimonial</h2>

    <div class="process-row">

         <div class="process-step">

            <div class="process-icon">

              <span>1</span>

              <img src="http://web24service.com/demo/w-shipping/assets/images/process-icon1.png" alt="">

            </div>

            <p>Register/Login to customer</p>

         </div>

         <div class="process-step">

            <div class="process-icon">

              <span>2</span>

              <img src="http://web24service.com/demo/w-shipping/assets/images/process-icon2.png" alt="">

            </div>

            <p>Go to Testimononial page</p>

         </div>

         <div class="process-step">

            <div class="process-icon">

              <span>3</span>

              <img src="http://web24service.com/demo/w-shipping/assets/images/process-icon2.png" alt="">

            </div>

            <p>add Testimonials</p>

         </div>

         <div class="process-step">

            <div class="process-icon">

              <span>4</span>

              <img src="http://web24service.com/demo/w-shipping/assets/images/process-icon2.png" alt="">

            </div>

            <p>After Admin Approval it will be viewed</p>

         </div>

      </div>

   <!-- <ul class = "list-group">-->

   <!--<li class = "list-group-item">Register/Login to customer login</li>-->

   <!--<li class = "list-group-item">Go to Account page </li>-->

   <!--<li class = "list-group-item">add Testimonials</li>-->

   <!--</ul> -->

  </div>

  

</div>











<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"> -->



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" type="text/css">



<link rel="stylesheet" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css" type="text/css">



<link rel="stylesheet" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.theme.default.min.css" type="text/css">







<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->



<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>



<script type="text/javascript">







$('.testi2').owlCarousel({



  loop: true,



  margin: 20,



  nav: false,



  dots: true,



  autoplay: true,



  responsiveClass: true,



  responsive: {



    0: {



      items: 1,



      nav: false



    },



    1170: {



      items: 1



    }



  }



});







$(function() {



    // 1) ASSIGN EACH 'DOT' A NUMBER



    dotcount = 1;



    $('.testi2 .owl-dot').each(function() {



        $(this).addClass('dotnumber' + dotcount);



        $(this).attr('data-info', dotcount);



        dotcount = dotcount + 1;



    });



    // 2) ASSIGN EACH 'SLIDE' A NUMBER



    slidecount = 1;



    $('.testi2 .owl-item').not('.cloned').each(function() {



        $(this).addClass('slidenumber' + slidecount);



        slidecount = slidecount + 1;



    });



    $('.testi2 .owl-dot').each(function() {



        grab = jQuery(this).data('info');



        slidegrab = $('.slidenumber' + grab + ' img').attr('src');



        console.log(slidegrab);



        $(this).css("background-image", "url(" + slidegrab + ")");



    });



    // THIS FINAL BIT CAN BE REMOVED AND OVERRIDEN WITH YOUR OWN CSS OR FUNCTION, I JUST HAVE IT



    // TO MAKE IT ALL NEAT 







});



</script>







 @endsection



