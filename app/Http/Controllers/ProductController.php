<?php

namespace App\Http\Controllers;
use App\Http\Middleware\Auth;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){

        $categories  = Category::where('status',1)
                        ->where('cat_status',1)
                        ->get();

        return view('admin.product.create',compact('categories'));
    }

    public function index(){
        
        $products = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.product_cat')
            ->select('products.*', 'categories.name as cat_name')
            ->where('products.status',1)
            ->where('categories.status',1)
            ->where('categories.cat_status',1)
            ->paginate(10);

        return view('admin.product.index',compact('products'));
    }

    public function store(Request $request){

        $validated = $request->validate([
            'name' => 'required|max:255',
            'short_description' => 'required',
            'long_description' => 'required',
            'reguler_price' => 'required',
            'sale_price' => 'required',
            'product_cat' => 'required',
            'product_status' => 'required',
            'image' => 'required',
        ]);

        $data = array();

        $data['name']=$request->name;
        $data['short_description']=$request->short_description;
        $data['long_description']=$request->long_description;
        $data['reguler_price']=$request->reguler_price;
        $data['sale_price']=$request->sale_price;
        $data['product_cat']=$request->product_cat;
        $data['product_status']=$request->product_status;

        $productUrl = $this->createSlug($request->name);

        $data['product_url']=$productUrl;

        $productName = str_replace(' ','_',$request->name);

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            $fileName = $productName.'_'.time().'.'.$extension;

            $file->move('product',$fileName);

            $imageName=$fileName;

            $data['image']=$imageName;

            $category = DB::table('products')->insert($data);

            if ($category) {
                $notification  = array(
                    'messege'=>'New Product Created Successfully',
                    'alert-type'=>'success'
                );
                return redirect()->back()->with($notification);
            }
            else{
                $notification  = array(
                    'messege'=>'New Product Not Created Successfully',
                    'alert-type'=>'error'
                );
                return redirect()->back()->with($notification);
            }
        }
        else{

            $notification  = array(
                'messege'=>'New Product Image Not Found',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function createSlug($title, $id = 0)
    {

        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);

        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Product::select('product_url')->where('product_url', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }

    public function change_status($id){

        $product = Product::where('id',$id)
                        ->where('status',1)
                        ->first();

        $categoryStatus = $product->product_status;

        if ($categoryStatus==1) {
            
            $updateCategoryStatus = Product::where('id',$id)
                            ->update(
                                [
                                    'product_status'=>0
                                ]);
        }
        else{

            $updateCategoryStatus = Product::where('id',$id)
                            ->update(
                                [
                                    'product_status'=>1
                                ]);
        }

        if ($updateCategoryStatus) {
            $notification  = array(
                'messege'=>'Product Status Changed Successfully',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }
        else{
            $notification  = array(
                'messege'=>'Product Status Not Changed Successfully',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function delete($id){

       // $delete = DB::table('products')
        //            ->where('id',$id)
         //           ->first();
       // $photo = "category/".$delete->photo;
        //unlink($photo);

        //$dltCategory = DB::table('products')
         //               ->where('id',$id)
         //               ->delete();

        $dltCategory = DB::table('products')
                    ->where('id',$id)
                    ->update([
                        'status' => 0
                    ]);

        if ($dltCategory) {
            $notification  = array(
                'messege'=>'Product Deleted Successfully',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }
        else{
            $notification  = array(
                'messege'=>'Product Not Deleted Successfully',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function edit_product($id){

        $categories  = Category::where('status',1)
                        ->where('cat_status',1)
                        ->get();

        $product  = Product::where('id',$id)
                        ->first();

        $data= compact('product');

        if($data['product']!=''){
           return view('admin.product.edit',compact('product','categories'));
        }
        else{
            return view ('admin.404');
        }

    }

    public function update(Request $request, $id){

        $validated = $request->validate([
            'name' => 'required|max:255',
            'short_description' => 'required',
            'long_description' => 'required',
            'reguler_price' => 'required',
            'sale_price' => 'required',
            'product_cat' => 'required',
            'product_status' => 'required'
        ]);

        $data = array();

        $data['name']=$request->name;
        $data['short_description']=$request->short_description;
        $data['long_description']=$request->long_description;
        $data['reguler_price']=$request->reguler_price;
        $data['sale_price']=$request->sale_price;
        $data['product_cat']=$request->product_cat;
        $data['product_status']=$request->product_status;


        $productUrl = $this->createSlug($request->name);

        $data['product_url']=$productUrl;

        $productName = str_replace(' ','_',$request->name);


        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            $fileName = $productName.'_'.time().'.'.$extension;

            $file->move('product',$fileName);

            $imageName=$fileName;

            $data['image']=$imageName;

            $deleteImage = DB::table('products')
                        ->where('id',$id)
                        ->first();
            $deletePhoto = "product/".$deleteImage->image;
            unlink($deletePhoto);

            $updateCategory = DB::table('products')
                    ->where('id',$id)
                    ->update($data);

            if ($updateCategory) {
                $notification  = array(
                    'messege'=>'Product Updated Successfully',
                    'alert-type'=>'success'
                );
                return redirect()->back()->with($notification);
            }
            else{
                $notification  = array(
                    'messege'=>'Product Not Updated Successfully',
                    'alert-type'=>'error'
                );
                return redirect()->back()->with($notification);
            }
        }
        else{

            $updateCategory = DB::table('products')
                    ->where('id',$id)
                    ->update($data);

            if ($updateCategory) {
                $notification  = array(
                    'messege'=>'Product Updated Successfully',
                    'alert-type'=>'success'
                );
                return redirect()->back()->with($notification);
            }
            else{
                $notification  = array(
                    'messege'=>'Product Not Updated Successfully',
                    'alert-type'=>'error'
                );
                return redirect()->back()->with($notification);
            }
        }

    }

}
