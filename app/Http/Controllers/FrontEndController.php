<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;

//Illuminate\Support\Facades\View::share();
//Illuminate\Support\Facades\View::composer();


use Illuminate\Http\Request;
use DB;
use Cart;
use Illuminate\Support\Facades\View;
class FrontEndController extends Controller
{
    function index(){

        $allCategories  = Category::where('status',1)
                    ->where('cat_status',1)
                    ->get();

        $latestProducts = DB::table('products')
                ->join('categories', 'categories.id', '=', 'products.product_cat')
                ->select('products.*', 'categories.name as cat_name','categories.category_url')
                ->where('products.status',1)
                ->where('categories.status',1)
                ->where('categories.cat_status',1)
                ->where('products.product_status',1)
                ->orderBy('products.id','DESC')
                ->take(16)
                ->get();

        $allProducts = DB::table('products')
                ->join('categories', 'categories.id', '=', 'products.product_cat')
                ->select('products.*', 'categories.name as cat_name','categories.category_url')
                ->where('products.status',1)
                ->where('categories.status',1)
                ->where('categories.cat_status',1)
                ->where('products.product_status',1)
                ->inRandomOrder()
                ->get();

        return view('frontend.index',compact('latestProducts','allProducts','allCategories'));  
    }

    function shop(){

        $allCategories  = Category::where('status',1)
                    ->where('cat_status',1)
                    ->get();

        $latestProducts = DB::table('products')
                ->join('categories', 'categories.id', '=', 'products.product_cat')
                ->select('products.*', 'categories.name as cat_name','categories.category_url')
                ->where('products.status',1)
                ->where('categories.status',1)
                ->where('categories.cat_status',1)
                ->where('products.product_status',1)
                ->orderBy('products.id','DESC')
                ->take(16)
                ->get();

        $allProducts = DB::table('products')
                ->join('categories', 'categories.id', '=', 'products.product_cat')
                ->select('products.*', 'categories.name as cat_name','categories.category_url')
                ->where('products.status',1)
                ->where('categories.status',1)
                ->where('categories.cat_status',1)
                ->where('products.product_status',1)
                ->inRandomOrder()
                -> paginate(24);

        $data= compact('allProducts');

        if(count($data)>=1){
           return view('frontend.shop',compact('latestProducts','allProducts','allCategories'));
        }
        else{
            return view ('frontend.404');
        }
    }

    function product_details($url){

        $allCategories  = Category::where('status',1)
                    ->where('cat_status',1)
                    ->get();

        $singleProduct = Product::where('product_url',$url)
                ->join('categories', 'categories.id', '=', 'products.product_cat')
                ->select('products.*', 'categories.name as cat_name','categories.category_url')
                ->where('products.status',1)
                ->where('categories.status',1)
                ->where('categories.cat_status',1)
                ->where('products.product_status',1)
                ->first();

        $data= compact('singleProduct');

        if($data['singleProduct']!=''){

            $categoryId = $singleProduct->product_cat;

            $relatedProducts = Product::where('product_cat',$categoryId)
                    ->join('categories', 'categories.id', '=', 'products.product_cat')
                    ->select('products.*', 'categories.name as cat_name','categories.category_url')
                    ->where('products.status',1)
                    ->where('categories.status',1)
                    ->where('categories.cat_status',1)
                    ->where('products.product_status',1)
                    ->where('product_url', '!=' , $url)
                    ->inRandomOrder()
                    ->take(12)
                    ->get();

           return view('frontend.details',compact('singleProduct','allCategories','relatedProducts'));
        }
        else{
            return view ('frontend.404');
        }
  
    }

    function category_details($url){

        $allCategories  = Category::where('status',1)
                    ->where('cat_status',1)
                    ->get();
        $singleCategory  = Category::where('category_url',$url)
                    ->where('status',1)
                    ->where('cat_status',1)
                    ->first();
        $data= compact('singleCategory');

        if($data['singleCategory']!=''){

            $categoryId = $singleCategory->id;

            $allProducts = DB::table('products')
                    ->join('categories', 'categories.id', '=', 'products.product_cat')
                    ->select('products.*', 'categories.name as cat_name','categories.category_url')
                    ->where('products.status',1)
                    ->where('categories.status',1)
                    ->where('categories.cat_status',1)
                    ->where('products.product_status',1)
                    ->where('products.product_cat',$categoryId)
                    ->inRandomOrder()
                    ->paginate(24);


            return view('frontend.categorY_details',compact('allProducts','allCategories'));
   
        }
        else{
            return view ('frontend.404');
        }
    }
}
