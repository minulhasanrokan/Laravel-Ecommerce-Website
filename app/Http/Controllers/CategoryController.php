<?php

namespace App\Http\Controllers;
use App\Http\Middleware\Auth;
use App\Models\Category;

use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){

        return view('admin.category.create');
    }

    public function index(){
        
        $categories  = Category::where('status',1)
                        -> paginate(10);

        return view('admin.category.index',compact('categories'));
    }


    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'cat_status' => 'required',
            'image' => 'required'
        ]);

        $data = array();

        $data['name']=$request->name;
        $data['description']=$request->description;
        $data['cat_status']=$request->cat_status;

        $categoryUrl = $this->createSlug($request->name);

        $data['category_url']=$categoryUrl;

        $categoryName = str_replace(' ','_',$request->name);

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            $fileName = $categoryName.'_'.time().'.'.$extension;

            $file->move('category',$fileName);

            $imageName=$fileName;

            $data['image']=$imageName;

            $category = DB::table('categories')->insert($data);

            if ($category) {
                $notification  = array(
                    'messege'=>'New Category Created Successfully',
                    'alert-type'=>'success'
                );
                return redirect()->back()->with($notification);
            }
            else{
                $notification  = array(
                    'messege'=>'New Category Not Created Successfully',
                    'alert-type'=>'error'
                );
                return redirect()->back()->with($notification);
            }
        }
        else{

            $notification  = array(
                'messege'=>'New Category Image Not Found',
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }

    }

    public function change_status($id){

        $category = Category::where('id',$id)
                        ->where('status',1)
                        ->first();

        $categoryStatus = $category->cat_status;

        if ($categoryStatus==1) {
            
            $updateCategoryStatus = Category::where('id',$id)
                            ->update(
                                [
                                    'cat_status'=>0
                                ]);
        }
        else{

            $updateCategoryStatus = Category::where('id',$id)
                            ->update(
                                [
                                    'cat_status'=>1
                                ]);
        }

        if ($updateCategoryStatus) {
            $notification  = array(
                'messege'=>'Category Status Changed Successfully',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }
        else{
            $notification  = array(
                'messege'=>'Category Status Not Changed Successfully',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function edit_category($id){

        $category  = Category::where('id',$id)
                        ->first();

        $data= compact('category');

        if($data['category']!=''){
           return view('admin.category.edit',compact('category'));
        }
        else{
            return view ('admin.404');
        }

    }

    public function update(Request $request, $id){

        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'cat_status' => 'required'
        ]);

        $data = array();

        $data['name']=$request->name;
        $data['description']=$request->description;
        $data['cat_status']=$request->cat_status;


        $categoryName = str_replace(' ','_',$request->name);


        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            $fileName = $categoryName.'_'.time().'.'.$extension;

            $file->move('category',$fileName);

            $imageName=$fileName;

            $data['image']=$imageName;

            $deleteImage = DB::table('categories')
                        ->where('id',$id)
                        ->first();
            $deletePhoto = "category/".$deleteImage->image;
            unlink($deletePhoto);

            $updateCategory = DB::table('categories')
                    ->where('id',$id)
                    ->update($data);

            if ($updateCategory) {
                $notification  = array(
                    'messege'=>'Category Updated Successfully',
                    'alert-type'=>'success'
                );
                return redirect()->back()->with($notification);
            }
            else{
                $notification  = array(
                    'messege'=>'Category Not Updated Successfully',
                    'alert-type'=>'error'
                );
                return redirect()->back()->with($notification);
            }
        }
        else{

            $updateCategory = DB::table('categories')
                    ->where('id',$id)
                    ->update($data);

            if ($updateCategory) {
                $notification  = array(
                    'messege'=>'Category Updated Successfully',
                    'alert-type'=>'success'
                );
                return redirect()->back()->with($notification);
            }
            else{
                $notification  = array(
                    'messege'=>'Category Not Updated Successfully',
                    'alert-type'=>'error'
                );
                return redirect()->back()->with($notification);
            }
        }

    }

    public function delete($id){

       // $delete = DB::table('categories')
        //            ->where('id',$id)
         //           ->first();
       // $photo = "category/".$delete->photo;
        //unlink($photo);

        //$dltCategory = DB::table('categories')
         //               ->where('id',$id)
         //               ->delete();

        $dltCategory = DB::table('categories')
                    ->where('id',$id)
                    ->update([
                        'status' => 0
                    ]);

        if ($dltCategory) {
            $notification  = array(
                'messege'=>'Category Deleted Successfully',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }
        else{
            $notification  = array(
                'messege'=>'Category Not Deleted Successfully',
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
        return Category::select('category_url')->where('category_url', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }

}
