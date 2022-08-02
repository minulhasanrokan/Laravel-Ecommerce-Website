@extends('layouts.frontend_master')

@section('title')
Shop Page
@endsection

@section('content')
   <div class="shop-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- widget with Number start -->
                    <div class="widget-area ">
                        <ul id="myUL">
                            <!-- Title with underline-->
                            <div class="main-title-with-underline pb-4 mt-0">
                                <h4>categories</h4>
                            </div>
                            <!---  Furniture option-->
                            <li>
                            	@foreach($allCategories as $category)
                                <a href="{{url('/category-details',$category->category_url)}}">{{$category->name}}</a>
                                @endforeach
                            </li>
                            <!---  Color option End-->
                        </ul>
                    </div>
                    <!-- widget Number End  -->

                </div> <!-- Col-3  end-->
                <div class="col-lg-9">
                    <!-- List view and grid view tab start-->
                    <div class="shop-layout-area ">
                        <!-- tab content-->
                        <div class="tab-content">
                            <!-- tab grid content-->
                            <div class="tab-pane fade active show" id="grid-view" role="tabpanel">
                                <div class="row">
                                	@foreach($allProducts as $product)
                                    <div class="col-md-4">
                                        <!--Single product start-->
                                        <div class="product-wrapper">
                                            <div class="product-img">
                                                <a href="{{route('product.details',$product->product_url)}}"> <img src="{{asset('')}}product/{{$product->image}}" alt="{{$product->sale_price}}"></a>
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
                                                    <span>{{$product->sale_price}} </span>
                                                    <span><del>{{$product->reguler_price}}</del></span>
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
                                    </div>
                                    @endforeach
                                </div>
                                @if ($allProducts->hasPages())
								    <div class="pagination-wrapper">
								         {{ $allProducts->links() }}
								    </div>
								@endif
                            </div>
                        </div>
                    </div>
                    <!-- List view and grid view tab End-->
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
	.pagination-wrapper nav .flex {
		float: right !important;
	}
</style>
@endsection
