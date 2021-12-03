@extends('layouts.frontend')
@section('content')


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
                    <p class="result-count">Showing {{($products->currentPage()-1)* $products->perPage()+($products->total() ? 1:0)}}-{{($products->currentPage()-1)*$products->perPage()+count($products)}} of {{$products->total()}} Results,</p>
                    
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
                    $segment = Request::segment(1); 
                    if($segment == 'womenproducts'){
                    $type='women';
                    } else if ($segment == 'childproducts'){
                    $type='Kids';
                    } else if ($segment == 'sortlist') {
                        $catid = session()->get('category'); 
                    } else if ($segment == 'searchresult') {
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
                    <!--<form action="{{ URL::to('sortlist') }}" name="orderbyform" method="post" class="order-by">-->
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

                    </form>
                </div>
            </div>
        </div>

                <!-- End ordering -->
        <div class="container">
            <div id="results">
            @include('paginationluxury')
            </div>
              @if(!empty($idss))                        
 <input type="hidden" name="productIds" id="productIds" value="{{$idss}}">
  <input type="hidden" name="productIdss" id="productIdss" value="{{$ids}}">
       @endif     <!-- End Primary -->


   @if(!empty($keyss))                        
 <input type="hidden" name="producsearch" id="producsearch" value="{{$keyss}}">
  <input type="hidden" name="productsearch" id="productsearch" value="{{$key}}">
       @endif
            <!-- End Primary -->

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

                            <form method="post" action="" class="addcart">

                            <div class="product-details-content">

                            

                                {{ csrf_field() }}

                                 <div class="product-signle-options product_15 clearfix">

                                     <div class="selector-wrapper size">

                                         <div class="quantity">

                                             <input data-step="1" value="1" title="Qty" name="qty" class="qty" size="4" type="text">

                                             <input type="hidden" name="productId" id="productId" value="">

                                             <input type="hidden" name="price" id="product_price" value="">

                                         </div>

                                     </div>

                                 </div>

                             

                         </div>

                           



                        </div>

                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>

                            </form>

                            <a class="link-ver1 wish" title="Wishlist" href=""><i class="icon icon-heart"></i></a>

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
            $('.add-cart').click(function(){
                $('.addcart').submit();
            });
            // $('.orderby').change(function(){
            //     $('.order-by').submit();
            // });
            
               $('.quickview').click(function(){

        var productid = $(this).attr("data-id");

        $('#productId').val(productid);

        $.ajax({

             url: "{{ URL::to('quickviewluxury') }}",

             type:'get',

             data: {id:productid},

             success : function(response){



                var productname = response.detail.product_name;

                var descr = response.detail.product_name;

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

    $.ajax({
        url:"welcome/paginationluxury/?page=" + page,
        success: function(products) {
            $('#results').html(products);
        }
    });


}

    });
    
    

    
        $('#orderby').change(function(){
        	
        	var option = $(this).val();
        	$.ajax({
        		url: "optionluxury",
                type:'get',
                data: {option:option},
                success : function(response){
                	console.log(response);
    location.reload();

                
                }
        	})
        	
        
        })
</script>








   @endsection