<div id="secondary" class="widget-area col-xs-12 col-md-3">
                @php $segment = Request::segment(1); @endphp
                @if($segment == 'deals'|| $segment == 'searchresult' || $segment == 'womenproducts' || $segment == 'childproducts')
                <aside class="widget widget_product_categories">
                @else
                <aside class="widget widget_product_categories" style="display:none;">
                @endif
                

                    <h3 class="widget-title">Categories</h3>

                    <ul class="product-categories">
                         @php
                          $cat = session()->get('category');
                          $catid = session()->get('catid');
                          $segment = Request::segment(1);
                          if($segment == 'deals' || $segment == 'searchresult' || $segment == 'womenproducts' || $segment == 'childproducts'){
                          $colours =  DB::table('colours')->get();
                          $sizes =  DB::table('sizes')->get();
                          } else {
                          $colours =  DB::table('products')
                                      ->select('colours.id','colours.color_name','colours.color_code')
                                      ->join('productscategories', 'products.Id', '=', 'productscategories.productId')
                                      ->join('productscolor', 'products.Id', '=', 'productscolor.productId')
                                      ->join('colours', 'productscolor.colorId', '=', 'colours.id')
                                      ->where('productscategories.subcategoryId','=',$catid)
                                      ->distinct()
                                      ->get();
                         $sizes =  DB::table('products')
                                      ->select('sizes.id','sizes.size')
                                      ->join('productscategories', 'products.Id', '=', 'productscategories.productId')
                                      ->join('productsize', 'products.Id', '=', 'productsize.productId')
                                      ->join('sizes', 'productsize.sizeId', '=', 'sizes.id')
                                      ->where('productscategories.subcategoryId','=',$catid)
                                      ->distinct()
                                      ->get();
                          }

                         @endphp
                         @php
                         $categories = DB::table('category')->where('parentId','=',0)->orderBy('Id', 'DESC')->get();
                         @endphp
                         @foreach($categories as $category)
                         @php
                         $catid = $category->Id;
                         $subcategory = DB::table('category')->where('parentId','=',$catid)->orderBy('Id', 'DESC')->get();
                         @endphp
                         <li>
                             <a href="#" title="{{$category->category}}">{{$category->category}}</a>
                             @if(!empty($subcategory) && $category->category == 'Kids' )
                              <ul class="children">
                                @foreach($subcategory as $subcat)
                                 @php $serachkey = 'id='.$subcat->Id.'&type=subcat'; @endphp
                                 <li><a href="{{ URL::to('productlisting/'.Crypt::encrypt($subcat->Id)) }}" title="Designer Anarkali">{{ $subcat->category }}</a></li>
                                @endforeach
                              </ul>
                              @else
                              @php
                              $wsubcategory = DB::table('category')->where('parentId','=',$catid)->get(); 
                              @endphp
                              @foreach($wsubcategory as $wsubcat)
                              @php
                              $wsubmenu = DB::table('category')->where('parentId','!=',0)->get(); 
                              @endphp
                                  
                                  <ul class="children">
                                    @foreach($wsubmenu as $submenu)
                                     @if($submenu->parentId !=26)
                                     @php $serachkey = 'id='.$submenu->Id.'&type=subcat'; @endphp
                                     <li><a href="{{ URL::to('productlisting/'.Crypt::encrypt($submenu->Id)) }}" title="Designer Anarkali">{{ $submenu->category }}</a></li>
                                     @endif
                                     @endforeach
                                  </ul>
                                 
                              @endforeach
                              @endif
                         </li>
                         @endforeach


                        @php $serachall = 'type=all'; @endphp

                        <li><a href="{{ URL::to('searchresult/'.Crypt::encrypt($serachall)) }}" title="All Product">All Product</a></li>
                    </ul>
                </aside>

                

                <aside class="widget widget_color_option">

                    <h3 class="widget-title">Color Option</h3>

                    <ul>

                        @foreach($colours as $color)
                        @php
                        $colorid = $color->id;
                        $productcolor = DB::table('productscolor')
                                        ->where('colorId','=',$color->id)
                                        ->get(); 
                        @endphp
                        @if(count($productcolor) != 0)
                        @php $serachkeycol = 'id='.$color->id.'&type=color'.'&page=deals'; @endphp

                        <li><a href="{{ URL::to('searchresult/'.Crypt::encrypt($serachkeycol)) }}" title="{{ $color->color_name }}">{{ $color->color_name }}</a>
                        <!--<span class="count">{{count($productcolor)}}</span>-->
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </aside>

                <aside class="widget widget_size_option">

                    <h3 class="widget-title">Size options</h3>

                    <ul>

                        @foreach($sizes as $size)

                        @php

                        $productsize = DB::table('productsize')
                                       ->where('sizeId','=',$size->id)
                                       ->get();

                        @endphp

                        @if(count($productsize) !=0)

                        @php $serachkeysiz = 'id='.$size->id.'&type=size'; @endphp

                        <li><a href="{{ URL::to('searchresult/'.Crypt::encrypt($serachkeysiz)) }}" title="L">{{$size->size}}</a>
                        <!--<span class="count">{{count($productsize)}}</span>-->
                        </li>

                        @endif

                        @endforeach

                    </ul>

                </aside>

                <aside class="widget">

                    <div class="newsletter-content space-30">

                        <i class="icon icon-envelope-letter"></i>

                        <h3>Sign up for newsletter</h3>

                        <p>to receive updates</p>

                        <form accept-charset="utf-8" method="post" action="{{ URL::to('subscription/') }}">
                             {{ csrf_field() }}
                            <input type="text" name="email" id="newsletter" title="Sign up for our newsletter" class="input-text required-entry validate-email" value="Enter your email here..." onfocus="if(this.value != '') {this.value = ''}" onblur="if (this.value == '') {this.value = 'Enter your email here...'}">

                            <button type="submit" title="Subscribe" class="button button1 hover-black">Subscribe<i class="link-icon-black"></i></button>

                        </form>

                    </div>

                </aside>

            </div>