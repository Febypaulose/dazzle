@extends('layouts.frontend')



@section('content')



<style type="text/css">

.product_view .modal-dialog{max-width: 800px; width: 100%;}

        .pre-cost{text-decoration: line-through; color: #a5a5a5;}

        .space-ten{padding: 10px 0;}

.btn {

    width: 149px !important;

}

.link-ver1 i {

    color: #000000 !important;

}

.products .product .product-images img {

    /*height: 219px !important;*/

}
.orderby{ 
    width: 116px;
}

.colpricecurrent{
  margin-top: -5px;
  margin-left: 64px;
}

.colpricediscount{
  margin-left: -81px;
  margin-top: -27px;
  text-decoration: line-through;
}
.listpricediscount{
  margin-left: -81px;
  margin-top: -13px;
  text-decoration: line-through;
  display:none;
}
.listpricecurrent{
  margin-top: 41px;
  margin-left: 207px;
  display:none;
}

.colpricecurrent{
  margin-top: -5px;
  margin-left: 64px;
}

.colpricediscount{
  margin-left: -81px;
  margin-top: -27px;
  text-decoration: line-through;
}

.listpricediscount{
  margin-left: -81px;
  margin-top: -13px;
  text-decoration: line-through;
  display:none;
}
.listpricecurrent{
  margin-top: 41px;
  margin-left: 207px;
  display:none;
}
.colprice{
  margin-top: -5px;
  margin-left: 14px;
}
.listprice{
  margin-top: 38px;
  margin-left: 208px;
  padding-bottom: 25px;
  display:none
}

@media screen and (min-device-width: 1080px) and (max-device-width: 1920px){
  .listpricecurrent {
    margin-left: 305px;
    }
}
</style>




<div id="optionreload">

        <div class="container">



            <div class="banner-header banner-lbook3">



                <img src="{{ asset('frontend/images/banner-catalog1.jpg') }}" alt="Banner-header">



                <div class="text">



                    <h3>shop</h3>



                    <img class="border" src="{{ asset('frontend/images/Uno-slideshow-border-home1.png') }}" alt="border">



                    <p>Your search for the best attire ends here!</p>



                </div>



            </div>



        </div>



        <!-- End Banner Grid -->



        <div class="container">



            <div class="wrap-breadcrumb">



                <ul class="breadcrumb">



                    <li><a href="#">Home</a></li>



                    <li class="active">Shopping all products</li>



                </ul>



                <div class="ordering">



                    <span class="list"></span>



                    <span class="col active"></span>



                     <p class="result-count">Showing {{($products->currentPage()-1)* $products->perPage()+($products->total() ? 1:0)}}-{{($products->currentPage()-1)*$products->perPage()+count($products)}} of {{$products->total()}} Results,
                       @if(session()->has('option'))
                       @if(Session::get('option') =='lowhigh' )
                            Sort by price: low to high
                             @elseif(Session::get('option') =='highlow' )
                       Sort by price: high to low
                             
                             
                             @else
                          Sort by {{ Session::get('option')}}
                             @endif
                  
                            @endif
                    @php

                    $catid = '';

                    $segment = Request::segment(1); 

                    if($segment == 'womenproducts'){

                    $type='women';

                    } else if ($segment == 'childproducts'){

                    $type='Kids';

                    } else if ($segment == 'sortlist') {

                        $catid = session()->get('category'); 

                    } else if ($segment == 'searchresult') {

                        $catid = session()->get('category'); 

                    } else {

                    $catid = session()->get('category'); 

                    }

                    

                    

                    

                    if(Request::segment(2)) {



                    if(!empty($id) && Request::segment(1) == 'searchresult'){

                        $submenu = DB::table('category')->where('Id','=',$id)->first();

                        $subcategory = DB::table('category')->where('Id','=',$submenu->parentId)->first();

                        $parent = DB::table('category')->where('Id','=',$subcategory->parentId)->first();  

                        

                        if(!empty($parent)){

                            if($parent->category == 'women') {

                            session()->put('category',$parent->category);

                            }

                        } else{

                            if($subcategory->category == 'Kids') {

                            session()->put('category',$subcategory->category);

                            }

                        }

                    }

                    } else {

                    $catid = session()->get('category'); 

                    }

                    

                    

                    @endphp

                    <!--<form action="{{ URL::to('sortlist') }}" name="orderbyform" method="GET" class="order-by">-->
                    <!--     {{ csrf_field() }}-->
                        <input type="hidden" name="type" value="{{ $catid }}">
                        <input type="hidden" name="catid" value="{{ Request::segment(2) }}">
                        <select class="orderby" id="orderby" name="orderby">
                      <option>Filter</option>
                             <option value="newest">Sort by newest</option>
                            <option value="discount">Sort by Discount</option>
                            <option value="lowhigh">Sort by price: low to high</option>
                            <option value="highlow">Sort by price: high to low</option>
                            
                          
                        </select>
                    <!--</form>-->

                    <!--<form action="{{ URL::to('pagination') }}" name="paginationform" method="post" class="order-by paginate">-->
                    <!--     {{ csrf_field() }}-->
                    <!--    <input type="hidden" name="type" value="{{ $catid }}">-->
                    <!--     <input type="hidden" name="catid" value="{{ Request::segment(2) }}">-->
                    <!--    <select class="orderby" id="pagination" name="paginationcount" style="width: 74px;">-->
                    <!--         <option value="12" selected>12</option>-->
                    <!--        <option value="24">24</option>-->
                    <!--        <option value="36">36</option>-->
                    <!--    </select>-->
                    <!--</form>-->



                </div>



            </div>



        </div>



        <!-- End ordering -->



        <div class="container" >
<div id="results">
   @include('paginationlist')

         </div>
  
     @if(!empty($idss))                        
 <input type="hidden" name="productIds" id="productIds" value="{{$idss}}">
  <input type="hidden" name="productIdss" id="productIdss" value="{{$ids}}">
       @endif     <!-- End Primary -->


   @if(!empty($keyss))                        
 <input type="hidden" name="producsearch" id="producsearch" value="{{$keyss}}">
  <input type="hidden" name="productsearch" id="productsearch" value="{{$key}}">
       @endif




            @include('layouts.searchfilter');



            <!-- End Secondary -->



        </div>



        <!-- end product sidebar -->



        <div class="modal fade product_view" id="product_view">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header"> 

                <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-times"></span></a>

                <!-- <h3 class="modal-title">HTML5 is a markup language</h3> -->

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-md-6 product_img">

                        <img src="" class="img-responsive">

                    </div>

                    <div class="col-md-6 product_content">

                        <!--<h1>DESIGNER BLUE & PINK ANARKALI</h1>-->

                        

                        <div class="descr"></div>

                        <!-- <h3 class="cost"><span class="glyphicon glyphicon-usd"></span> 75.00 <small class="pre-cost"><span class="glyphicon glyphicon-usd"></span> 60.00</small></h3>  -->

                        <h3 class="cost">   

                         <!--<div class="price">$75.00</div>-->

                        </h3>

                        

                        <div class="space-ten"></div>

                        <div class="btn-ground">

                        <div class="action">

                               <form class="variations_form cart" method="post" action="{{ URL::to('addtocart') }}"> 
   {{ csrf_field() }}
                                        <!-- table class="variations">
                                            <tbody>
                                                <tr>
                                                    <td class="label"><label>Color</label></td>
                                                    <td class="value">
                                                        <select class="" name="attribute_pa_color">
                                                            <option value="">Choose an option</option>
                                                            <option value="black-with-red" >Black with Red</option>
                                                            <option value="white-with-gold"  selected='selected'>White with Gold</option>
                                                        </select>
                                                        <a class="reset_variations" href="#">Clear</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table> -->

                                     
                                        <div class="single_variation_wrap">
                                            <div class="woocommerce-variation single_variation"></div>
                                            <div class="woocommerce-variation-add-to-cart variations_button">
                                                <div class="quantity">
                                                    <label>Quantity:</label>
                                                    <input type="number" name="quantity" value="1" title="Qty" class="input-text qty text"/>
                                                     <!-- <input type="text" name="product_id" value="{{Crypt::encrypt($products->id )}}"/> -->
                                                </div>
                                                <button type="submit" class="single_add_to_cart_button button">Add to cart</button>
                                                
                                                <input type="hidden" name="add-to-cart" value="2452" />
                                              



                                            
                                             
                                            </div>
                                        </div>
                                    </form>

                            </div>

                            <a class="link-ver1 wish" title="Wishlist" href=""><i class="icon icon-heart"></i></a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</div>

</div>





         <script type="text/javascript">

         $(document).ready(function(){

            // $('.add-cart').click(function(){

            //     $('.addcart').submit();

            // });

             $('.add-cart-productlist').click(function(){

             var productid = $(this).attr("data-id"); 

             $('#productId').val(productid);

             var classname = '.productlist-'+productid;

            $(classname).submit();

            });

            // $('.orderby').change(function(){

            //     $('.order-by').submit();

            // });

            $('#pagination').change(function(){
                ('.paginate').submit();
            });

           $('.list').click(function(){

                $('.productcolname').hide();

                $('.productlistname').show();

                

                $('.listprice').show();

                $('.colprice').hide();

                

                $('.colpricediscount').hide();

                $('.colpricecurrent').hide();

                

                $('.listpricediscount').show();

                $('.listpricecurrent').show();

            });

            $('.col').click(function(){

                $('.productcolname').show();

                $('.productlistname').hide();

                

                $('.colprice').show();

                $('.listprice').hide();

                

                $('.colpricediscount').show();

                $('.colpricecurrent').show();

                

                $('.listpricediscount').hide();

                $('.listpricecurrent').hide();

            });

           $('.quickview').click(function(){

        var productid = $(this).attr("data-id");

        $('#productId').val(productid);

        $.ajax({

             url: "{{ URL::to('quickview') }}",

             type:'get',

             data: {id:productid},

             success : function(response){



                var productname = response.detail.product_name;

              if(response.detail.product_type=='normal'){
                var descr = response.detail.summary;
                
} 
if(response.detail.product_type=='luxury'){
                var descr = response.detail.product_name;
                
} 

                var price = '$'+ response.detail.product_price;

                var image = response.productimages.image_url;

                var productid = response.crypt;

                $('.product_content h1').html(productname);

                $('.product_content .descr').html(descr);

                $('.product_content .price').html(response.productprice);

                

                $('#product_price').val(response.productpriceval);

                var img_url ="{{ asset(env('PRODUCT_IMAGE'))}}" +'/'+image; 

                var wishlist_url ="{{ URL::to('customer/wishlist/') }}" + '/'+ productid ; 

                var carturl = "{{ URL::to('customer/addtocart/') }}"  + '/'+ productid ;

                $(".product_img img").attr("src",img_url);

                $(".wish").attr("href",wishlist_url);

                $(".addcart").attr("action",carturl);





             }

        })

    })

         });



         </script>







<script>
    $(document).ready(function() {

        $(document).on('click','.pagination a', function(event) {
            
            event.preventDefault();
            //   alert('x');
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

       function fetch_data(page) {

    var l = window.location;

                 var productid = $('#productIds').val();
                //  alert(productid);
                //  $(this).attr("data-id");

                //  $('#productId').val(productid);
    // the request path should be 
    // domain.com/welcome/pagination
if(productid !=undefined){
    $.ajax({
        url:"welcome/paginationlist/"+productid+"?page=" + page,
        success: function(products) {
            $('#results').html(products);
        }
    });
}
if(productid ==undefined){
     
                //  $(this).attr("data-id");

                //  $('#productId').val(productid);
      var productsearch = $('#productsearch').val();
    //   alert(productsearch);
    $.ajax({
        url:"welcome/paginationlist/"+productsearch+"?page=" + page,
        success: function(products) {
            // alert('x');
            $('#results').html(products);
        }
    });
}
}

    });
    
    
    
      $('#orderby').change(function(){
        	var option = $(this).val();
        	  var productid = $('#productIds').val();
        	  if(productid !=undefined){
        	$.ajax({
        		url: "option/"+productid+"?",
                type:'get',
                data: {option:option},
                success : function(response){
                	console.log(response);
    location.reload();
                //  	alert('y');
                // $("#optionreload").load(location.href + " #optionreload");
                //   $("#product_view").load(location.href + " #product_view");
                
                }
        	})
        	  }
        	   if(productid ==undefined){
        	        var productsearch = $('#productsearch').val();
        	  	$.ajax({
        		url: "option/"+productsearch+"?",
                type:'get',
                data: {option:option},
                success : function(response){
                	console.log(response);
    location.reload();
                //  	alert('y');
                // $("#optionreload").load(location.href + " #optionreload");
                //   $("#product_view").load(location.href + " #product_view");
                
                }
        	})
        	   }
        })
    
    
</script>





















































     @endsection



