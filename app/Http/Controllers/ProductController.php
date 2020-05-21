<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use Session;
use Image;
use App\Product;
use App\Category;

class ProductController extends Controller
{
        
        public function productList(Request $request)
        {
            $products=Product::orderBy('id','desc')->get();
            return view('admin.products.list',compact('products'));
        }

        public function addproduct()
        {
        $category=Category::where(['parent_id'=>0])->get();
        return view('admin.products.add',compact('category'));
        }

        public function storeproduct(Request $request)
        {
                $products = new Product();
                $products->name = $request->product_name;
                $products->category_id = $request->category_id;
                $products->code = $request->product_code;
                $products->color = $request->product_color;
                $products->price = $request->product_price;
                if(!empty($request->product_description))
                {
                $products->description = $request->product_description;
                }
                else{
                        $products->description = '';
                }
                if($request->hasfile('product_image'))
                {
                        $img_tmp = Input::file('product_image');
                        if($img_tmp->isValid())
                        {
                        $extension=$img_tmp->getClientOriginalExtension();
                        $filename=rand(111,99999).'.'.$extension;
                        $img_path='uploads/products/'.$filename;
                        Image::make($img_tmp)->resize(500,500)->save($img_path);
                        $products->image=$filename;

                }
        }
                $products->save();
                Alert::success('Product added Successfully','Success Message');
                return redirect()->route('add.product')->with('flash_message_success','Product Successfully Saved');
        }

        public function editproduct($id)
        {
                $product=Product::find($id);
                $category=Category::where(['parent_id'=>0])->get();
                return view('admin.products.edit',compact('product','category'));
        }

        public function updateproduct(Request $request,$id)
        {       
                $products = Product::find($id);
                $products->name = $request->product_name;
                $products->category_id = $request->category_id;
                $products->code = $request->product_code;
                $products->color = $request->product_color;
                $products->price = $request->product_price;
                if(!empty($request->product_description))
                {
                $products->description = $request->product_description;
                }
                else{
                        $products->description = '';
                }
                if($request->hasfile('product_image'))
                {
                        $img_tmp = Input::file('product_image');
                        if($img_tmp->isValid())
                        {
                        $extension=$img_tmp->getClientOriginalExtension();
                        $filename=rand(111,99999).'.'.$extension;
                        $img_path='uploads/products/'.$filename;
                        Image::make($img_tmp)->resize(500,500)->save($img_path);
                }
                
                }
                else
                {
                        $filename= $request->current_image;
                }
                $products->image=$filename;
                $products->save();
                Alert::success('Product updated Successfully','Success Message');
                return redirect()->route('list.product')->with('flash_message_success','Product Successfully Updated');
        }

        public function updateStatus(Request $request)
        {
               $data=$request->all();
               Product::where('id',$data['id'])->update(['status'=>$data['status']]);
        }

        public function addAttribute(Request $request,$id)
        {
                $product=Product::find($id);
                return view('admin.products.add_attribute',compact('product'));
        }

        public function deleteproduct($id)
        {
                Product::find($id)->delete($id);
                return response()->json([
                        'success' => 'Record deleted successfully!'
                ]);
                }   
        
}
