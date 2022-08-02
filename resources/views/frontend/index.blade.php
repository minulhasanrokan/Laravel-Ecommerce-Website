@extends('layouts.frontend_master')

@section('title')
Home Page
@endsection

@section('content')
<!-- Carosel Area start-->
<section class="carousel-section pb-5">
    <div class="container">
        <div class="slider-active">
            <div class="slider-single-item">
                <img src="{{asset('frontend')}}/img/slider-img2.jpg" class="img-fluid" alt="no image">
                <div class="slider-text">
                    <h2>Cherner <span>Armchair</span></h2>
                    <p>The 1958 moulded plywood armchair by Norman Cherner.</p>
                    <a href="#">View now</a>
                </div>
            </div>
            <div class="slider-single-item">
                <img src="{{asset('frontend')}}/img/slider-img2.jpg"  class="img-fluid" alt="">
                <div class="slider-text">
                    <h2>Cherner <span>Armchair</span></h2>
                    <p>The 1958 moulded plywood armchair by Norman Cherner.</p>
                    <a href="#">View now</a>
                </div>
            </div>
            <div class="slider-single-item">
                <img src="{{asset('frontend')}}/img/slider-img3.jpg" class="img-fluid" alt="">
                <div class="slider-text">
                    <h2>Cherner <span>Armchair</span></h2>
                    <p>The 1958 moulded plywood armchair by Norman Cherner.</p>
                    <a href="#">View now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Carosel Area end-->

<!-- normal product area -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-12"><h3>Latest Product</h3></div>
        </div>
        <div class="row">
            @foreach($latestProducts as $latestProduct)
            <div class="col-md-3">
            <!--Single product start-->
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="{{route('product.details',$latestProduct->product_url)}}"> <img src="{{asset('')}}product/{{$latestProduct->image}}" alt=""></a>
                        
                        <span>hot</span>
                        <div class="product-action">
                            <a href="#"><i class="far fa-eye"></i></a>
                            <a href="#"><i class="fas fa-balance-scale"></i></a>
                            <a href="#"><i class="fas fa-heart"></i></a>
                        </div>
                    </div>
                    <div class="product-content text-center">
                        <h3><a href="#">{{$latestProduct->name}}</a></h3>
                        <div class="rating">
                            <a href="{{url('category-details',$latestProduct->category_url)}}">{{$latestProduct->cat_name}}</a>
                        </div>
                        <div class="price">
                            <span>{{$latestProduct->sale_price}} </span>
                            <span><del>{{$latestProduct->reguler_price}}</del></span>
                        </div>
                        <form action="{{route('cart_add_product')}}" class="cart-and-action">
                        @csrf
                            <div class="cart-btn">
                                <input type="hidden" name="product_id" value="{{$latestProduct->id}}" min="1">
                                <input type="hidden" name="product_quantity" value="1" id="" min="1">
                                <button class="btn btn-primary" type="submit">Add to cart</button>
                            </div>
                        </form>
                    </div>
                </div>
            <!--Single product End-->
            </div>
            @endforeach
    </div>
    </div>
</section>
<!--Product Area-->
<section class="product-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="product-tab cat_product">
                        <ul class="nav" role="tablist">
                            <li class="nav-item  pb-5">
                                <a class="nav-link active" data-toggle="tab" href="#all" role="tab">All</a>
                            </li>
                            @foreach($allCategories as $allCategory)
                            <li class="nav-item  pb-5">
                                <a class="nav-link" data-toggle="tab" href="#{{$allCategory->category_url}}" role="tab">{{$allCategory->name}}</a>
                            </li>
                            @endforeach

                        </ul>
                        <div class="tab-content">
                            <!--Tab start-->
                            <div class="tab-pane fade show active" id="all" role="tabpanel">
                                <!--owl-carousel start-->
                                <div class="product-active owl-carousel nav-style">
                                    @foreach($allProducts as $product)
                                    <!--Single product start-->
                                    <div class="product-wrapper">
                                        <div class="product-img">
                                            <a href="{{route('product.details',$latestProduct->product_url)}}"> <img src="{{asset('')}}product/{{$product->image}}" alt=""></a>
                                            <span>hot</span>
                                            <div class="product-action">
                                                <a href="#"><i class="far fa-eye"></i></a>
                                                <a href="#"><i class="fas fa-balance-scale"></i></a>
                                                <a href="#"><i class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content text-center">
                                            <h3><a href="{{route('product.details',$product->product_url)}}">{{$product->name}}</a></h3>
                                            <div class="rating">
                                                    <a href="{{url('category-details',$product->category_url)}}">{{$product->cat_name}}</a>
                                                </div>
                                            <div class="price">
                                                <span>&#2547;{{$product->sale_price}}</span>
                                                <span><del>&#2547;{{$product->reguler_price}}&#2547;</del></span>
                                            </div>
                                            <form action="{{route('cart_add_product')}}" class="cart-and-action">
                                            @csrf
                                                <div class="cart-btn">
                                                    <input type="hidden" name="product_id" value="{{$product->id}}" min="1">
                                                    <input type="hidden" name="product_quantity" value="1" id="" min="1">
                                                    <button class="btn btn-primary" type="submit">Add to cart</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!--Single product End-->
                                    @endforeach
                                </div>
                                <!--owl-carousel end-->
                            </div>
                            <!--Tab end-->
                            @foreach($allCategories as $allCategory)
                            <!--Tab start-->
                            <div class="tab-pane fade" id="{{$allCategory->category_url}}" role="tabpanel">
                                <!--owl-carousel start-->
                                <div class="product-active owl-carousel nav-style">
                                    @foreach($allProducts as $product)
                                    @if($product->product_cat==$allCategory->id)
                                    <!----  Single product start-->
                                    <div class="product-wrapper">
                                        <div class="product-img">
                                            <a href="{{route('product.details',$latestProduct->product_url)}}"> <img src="{{asset('')}}product/{{$product->image}}" alt=""></a>
                                            <span>hot</span>
                                            <div class="product-action">
                                                <a href="#"><i class="far fa-eye"></i></a>
                                                <a href="#"><i class="fas fa-balance-scale"></i></a>
                                                <a href="#"><i class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content text-center">
                                            <h3><a href="{{route('product.details',$latestProduct->product_url)}}">{{$product->name}}</a></h3>
                                            <div class="rating">
                                                    <a href="{{url('category-details',$product->category_url)}}">{{$product->cat_name}}</a>
                                                </div>
                                            <div class="rating">
                                                <i class="fas far fa-star"></i>
                                                <i class="fas far fa-star"></i>
                                                <i class="fas far fa-star"></i>
                                                <i class="fas far fa-star"></i>
                                                <i class="fas far fa-star"></i>
                                            </div>
                                            <div class="price">
                                                <span>&#2547;{{$product->sale_price}}</span>
                                                <span><del>&#2547;{{$product->reguler_price}}&#2547;</del></span>
                                            </div>
                                            <form action="{{route('cart_add_product')}}" class="cart-and-action">
                                            @csrf
                                                <div class="cart-btn">
                                                    <input type="hidden" name="product_id" value="{{$product->id}}" min="1">
                                                    <input type="hidden" name="product_quantity" value="1" id="" min="1">
                                                    <button class="btn btn-primary" type="submit">Add to cart</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!--Single product End-->
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!--Banner Area-->
<div class="banner-area pb-5">
    <div class="container">
        <div class="banner-img">
            <a href="#"><img class="img-fluid" src="{{asset('frontend')}}/banner-{{asset('frontend')}}/banner.jpg" alt=""></a>
        </div>
    </div>
</div>
<section class="subscribe-section  ">
    <div class="container">
        <div class="subscribe text-center py-5">
            <div class="rwo py-5">
                <div class="col-12 ">
                    <h2>KEEP UPDATED</h2>
                    <p>Sign up for our newletter to recevie updates an exlusive offers</p>
                </div>
                <div class="col-12 ">
                    <div class="input-group w-50  mx-auto pt-4">
                        <input type="text" placeholder="Enter Your Email" aria-label="Recipient's "
                            aria-describedby="my-addon">
                        <div class="input-group-append">
                            <span class="subscribe-text" id="my-addon">Subscribe</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Subcribe-section End-->
<!--Brand-section start-->
<div class="brand-section">
    <div class="container ">
        <div class="row">
            <div class="brand-active owl-carousel ">
                <div class="single-brand"><a href=""><img src="{{asset('frontend')}}/img/brand/brand1.jpg" alt="" class=""></a></div>
                <div class="single-brand"><a href=""><img src="{{asset('frontend')}}/img/brand/brand1.jpg" alt="" class=""></a></div>
                <div class="single-brand"><a href=""><img src="{{asset('frontend')}}/img/brand/brand1.jpg" alt="" class=""></a></div>
                <div class="single-brand"><a href=""><img src="{{asset('frontend')}}/img/brand/brand1.jpg" alt="" class=""></a></div>
                <div class="single-brand"><a href=""><img src="{{asset('frontend')}}/img/brand/brand1.jpg" alt="" class=""></a></div>
            </div>
        </div>
    </div>
</div>
<!--Brand-section End-->
@endsection
