<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Cart;

use Illuminate\Http\Request;

class cartController extends Controller
{
    
    public function cart_add_product(Request $request){

        $product = Product::find($request->product_id);

        $singleCategory  = Category::where('id',$product->product_cat)
                    ->where('status',1)
                    ->where('cat_status',1)
                    ->first();

        $categoryurl = $singleCategory->category_url;
        Cart::add(array(
            'id' => $product->id, // inique row ID
            'name' => $product->name,
            'reguler_price' => $product->reguler_price,
            'price' => $product->sale_price,
            'quantity' => $request->product_quantity,
            'product_image' => $product->image,
            
            'attributes' => array(
                'image' => $product->image,
                'product_url' => $product->product_url,
            )
        ));

        return redirect()->route('category-details',$categoryurl);

        //return Cart::getContent();
    }

    public function remove_cart_product($id){
        Cart::remove($id);
        return back();
    }
    public function update_cart(Request $request){


        Cart::update($request->product_id, array(
          'quantity' => array(
              'relative' => false,
              'value' => $request->product_quantity
          ),
        ));

 return back();
    }
}
