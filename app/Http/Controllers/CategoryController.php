<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use Session;
use App\Product;
use App\Category;

class CategoryController extends Controller
{
    public function addCategory()
    {
        $levels= Category::where(['parent_id'=>0])->get();
        return view('admin.category.add',compact('levels'));
    }

    public function storeCategory(Request $request)
    {
        $category=new Category();
        $category->name = $request->category_name;
        $category->parent_id = $request->parent_id;
        $category->url = $request->category_url;
        $category->description = $request->category_description;
        $category->save();
        Alert::success('Category Added Successfully','Success Message');
        return redirect()->route('list.category');

    }

    public function listCategory()
    {
    $category= category::orderBy('id','desc')->get();
    return view('admin.category.list',compact('category'));   
    }

    public function editCategory($id)
    {
        $category= category::find($id);
        $levels= Category::where(['parent_id'=>0])->get();
        return view('admin.category.edit',compact('category','levels'));
    }

    public function updateCategory(Request $request,$id)
    {
        $category = Category::find($id);
        $category->name = $request->category_name;
        $category->parent_id = $request->parent_id;
        $category->url = $request->category_url;
        $category->description = $request->category_description;
        $category->save();

        Alert::success('Category updated Successfully','Success Message');
        return redirect()->route('list.category');

    }

    public function updatecategorystatus(Request $request)
    {
        $data=$request->all();
        Category::where('id',$data['id'])->update(['status'=>$data['status']]);
    }

    public function deleteCategory($id)
    {
        Category::find($id)->delete($id);
                return response()->json([
                        'success' => 'Record deleted successfully!'
                ]);
    }
}
