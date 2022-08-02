@extends('layouts.frontend_master')

@section('title')
Product Detals - {{$singleProduct->name}}
@endsection

@section('content')

@section('mete_description')
{{$singleProduct->short_description}}
@endsection

@section('content')

    <!-- product details start -->
    <div class="product-details-area">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="img-tab-area">
                        <div class="tab-content tab-img">
                            <div class="tab-pane fade show active" id="img1" role="tabpane">
                                <img width="100%" class="img-fluid" src="{{asset('')}}product/{{$singleProduct->image}}" alt="{{$singleProduct->name}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <!-- product-details -->
                    <div class="product-details">
                        <h2>{{$singleProduct->name}}</h2>
                        <p>{{$singleProduct->short_description}}</p>
                        <div class="price-pro">
                            <span><del>&#2547;{{$singleProduct->reguler_price}}&#2547;</del></span>
                            <span>&#2547;{{$singleProduct->sale_price}}</span>
                        </div>
                        <hr>
                    </div>
                    <!-- product-details End -->
                    <!-- options-area start -->
                    <div class="options-area">
                       <form action="{{route('cart_add_product')}}" class="cart-and-action">
                        @csrf
                        <div class="quanty clearfix mb-5">
                            <label class="float-left" for="">quantity</label>
                            <div class="float-left">
                            <input type="number" name="product_quantity" id="" min="1">
                            <input type="hidden" name="product_id" value="{{$singleProduct->id}}" min="1">
                            </div>
                        </div>
                        <div class="cart-pro ">
                            <button type="submit">Add to cart</button>
                            
                        </div>
                     </form>
                </div>
                <!-- options-area End -->
                <div class="cart-and-action clearfix">
                    <div class="product-action-pro">
                        <a href="#"><i class="far fa-eye"></i></a>
                        <a href="#"><i class="fas fa-balance-scale"></i></a>
                        <a href="#"><i class="fas fa-heart"></i></a>
                    </div>
                </div>
                    <div class="share-icon">
                        <img src="{{asset('')}}img/social-icon.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product info start -->
    <div class="product-info-area pt-5">
        <div class="container">
            <ul class="nav " role="tablist">
                <li class="nav-item">
                    <a class="nav-link " data-toggle="tab" href="#description" role="tab">Description</a>
                </li>
            </ul>
            <div class="tab-content pt-4">
                <div class="tab-pane fade show active" id="description" role="tabpanel">
                    <p>{{$singleProduct->long_description}}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- product info end -->

    <!-- related-product-area start -->
    <div class="related-product-area mb-5">
        <div class="container">
            <div class="related-product pt-5 mt-5">
                <h3>Related Products</h3>
                <!--owl-carousel start-->
                <div class="product-active owl-carousel nav-style">
                    @foreach($relatedProducts as $relatedProduct)
                    <div class="product-wrapper">
                        <div class="product-img">
                            <a href="{{route('product.details',$relatedProduct->product_url)}}"> <img src="{{asset('')}}product/{{$relatedProduct->image}}" alt="{{$singleProduct->name}}"></a>
                            <span>hot</span>
                            <div class="product-action">
                                <a href="#"><i class="far fa-eye"></i></a>
                                <a href="#"><i class="fas fa-balance-scale"></i></a>
                                <a href="#"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                        <div class="product-content text-center">
                            <h3><a href="{{route('product.details',$relatedProduct->product_url)}}">{{$relatedProduct->name}}</a></h3>
                            <div class="rating">
                            <a href="{{url('category-details',$relatedProduct->category_url)}}">{{$relatedProduct->cat_name}}</a>
                        </div>
                            <div class="price">
                                <span>&#2547;{{$relatedProduct->sale_price}}</span>
                                <span><del>&#2547;{{$relatedProduct->reguler_price}}</del></span>
                            </div>
                            <form action="{{route('cart_add_product')}}" class="cart-and-action">
                                @csrf
                                <div class="cart-btn">
                                    <input type="hidden" name="product_id" value="{{$relatedProduct->id}}" min="1">
                                    <input type="hidden" name="product_quantity" value="1" id="" min="1">
                                    <button class="btn btn-primary" type="submit">Add to cart</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!--owl-carousel end-->
            </div>
        </div>
    </div>
    <!-- related-product-area end -->
@endsection
