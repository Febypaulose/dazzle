 @extends('layouts.frontend')
@section('content')

<div class="container">
            <div class="banner-header banner-lbook3">
                <img src="{{ asset('frontend/images/banner-catalog1.jpg') }}" alt="Banner-header">
                <div class="text">
                    <h3>Customize</h3>
                    <img class="border" src="{{ asset('frontend/images/Uno-slideshow-border-home1.png') }}" alt="border">
                    <p>Schemas without professional niche markets</p>
                </div>
            </div>
</div>

<div class="container">
            <div class="wrap-breadcrumb">
             <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Customize</li>
            </ul>
            </div>
</div>

        <div class="container">
            <div class="tab-product-all-mason">
                <ul class="tabs tabs-title">
                    <li class="item" rel="all"><span>Choose the type</span></li>
                </ul>
                <div class="tab-container featured-product">
                    <div id="all" class="tab-content">
                        <div class="col-md-5">
                            <div class="products mason-v1">
                                <div class="product">
                                    <div class="product-images">
                                        <a href="{{ URL::to('customize') }}" title="product-images">
                                            <img class="primary_image" src="{{ asset('frontend/images/c1.jpg') }}" alt="" />
                                            <img class="secondary_image" src="{{ asset('frontend/images/c1.jpg') }}" alt="" />
                                        </a>
                                    </div>
                                    <a href="Customize.html" title="Bouble Fabric Blazer"><p class="product-title">Gown</p></a>

                                </div>
                                <!-- End product -->
                                <div class="product">
                                    <div class="product-images">
                                        <a href="{{ URL::to('customize') }}" title="product-images">
                                            <img class="primary_image" src="{{ asset('frontend/images/c2.jpg') }}" alt="" />
                                            <img class="secondary_image" src="{{ asset('frontend/images/c2.jpg') }}" alt="" />
                                        </a>
                                    </div>
                                    <a href="{{ URL::to('customize') }}" title="Bouble Fabric Blazer"><p class="product-title">Designer Lacha</p></a>
                                </div>
                                <!-- End product -->
                                <div class="product">
                                    <div class="product-images">
                                        <a href="{{ URL::to('customize') }}" title="product-images">
                                            <img class="primary_image" src="{{ asset('frontend/images/c3.jpg') }}" alt="" />
                                            <img class="secondary_image" src="{{ asset('frontend/images/c3.jpg') }}" alt="" />
                                        </a>
                                    </div>
                                    <a href="{{ URL::to('customize') }}" title="Bouble Fabric Blazer"><p class="product-title">Designer Dress</p></a>

                                </div>
                                <!-- End product -->
                            </div>
                            <!-- End products -->
                        </div>
                        <!-- End col-md-5 -->
                        <div class="col-md-7 space-60 padding-right-0">
                            <div class="products slider-one-item owl-nav-hidden dots-show">
                                <div class="product">
                                    <a class="product-images" href="{{ URL::to('customize') }}" title="">
                                        <img src="{{ asset('frontend/images/c4.jpg') }}" alt="" />
                                    </a>
                                    <a href="{{ URL::to('customize') }}" title="Kinflok Magazine"><p class="product-title">Bridal Saree</p></a>
                                </div>
                                <!-- End product -->
                                <div class="product">
                                    <a class="product-images" href="{{ URL::to('customize') }}" title="">
                                        <img src="{{ asset('frontend/images/c4.jpg') }}" alt="" />
                                    </a>
                                    <a href="Customize.html" title="Kinflok Magazine"><p class="product-title">Bridal Saree</p></a>
                                    <!--<p class="cat">ACCESSORIES</p>
                            <p class="product-price">$89.90</p>-->
                                </div>
                                <!-- End product -->
                            </div>
                            <!-- End products -->
                        </div>
                        <!-- End col-md-7 -->

                    </div>
                    <!-- End tab-container -->
                </div>
            </div>
            <!-- end tab product all -->












  @endsection