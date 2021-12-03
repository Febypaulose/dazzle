 @extends('layouts.frontendinner')
@section('content')

<div class="title-page space-padding-tb-50">
    <h3>Wishlist</h3>
</div>

<div class="container container-ver2">
	    @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible">
 				<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  				<strong>Success!</strong> {{ Session::get('message') }}
			</div>
		@endif
    <table class="table wishlist">
        <tbody>
        	@foreach($wislists as $wishlist)
        	@php
            $image = DB::table('productsimages')->where('productId','=',$wishlist->Id)->first();
            @endphp
            <tr class="item_cart">
                <td class="product-remove">
                	<a href="{{ URL::to('customer/deletewishlist/'.Crypt::encrypt($wishlist->Id)) }}" title="">x</a>
                </td>
                <td class="product-photo">
                	<a href="{{ URL::to('productdetail/'.Crypt::encrypt($wishlist->Id)) }}" title="">
                	<img src="{{ asset(env('PRODUCT_IMAGE'))}}/{{ $image->image_url }}" alt="Futurelife">
                    </a>
                </td>
                <td class="produc-name">
                    @if($wishlist->product_type == 'normal')
                    <a href="{{ URL::to('productdetail/'.Crypt::encrypt($wishlist->Id)) }}" title="">{{ $wishlist->product_name}}
                    @else
                    <a href="{{ URL::to('luxury/'.Crypt::encrypt($wishlist->Id)) }}" title="">{{ $wishlist->product_name}}
                    @endif
                    
                </td>
                <td class="product-price">${{ $wishlist->product_price}}</td>
                <td class="product-instock"><a href="#" title="in stock">{{ $wishlist->stock_status}}</a></td>
                <td class="add-cart">
                <form method="post" action="{{ URL::to('customer/addtocart/'.Crypt::encrypt($wishlist->Id )) }}" class="addcartshoplooks">
                {{ csrf_field() }}
                <input data-step="1" value="1" title="Qty" name="qty" class="qty" size="4" type="hidden">
                <input type="hidden" name="productId" value="{{ $wishlist->Id }}">
                <input type="hidden" name="price" value="{{$wishlist->product_price}}">
                <button type="submit" class="btn link-button hover-white color-red" style="height: 44px;width: 130px;font-size: 10px;">Add to cart</button>
                </form>
                	<!-- <a class="btn link-button hover-white color-red" href="#" title="Add to cart">Add to cart</a> -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



















@endsection