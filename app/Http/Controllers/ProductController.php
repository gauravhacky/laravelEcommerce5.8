<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use App\Product;

class ProductController extends Controller
{
        
        public function productList(Request $request)
        {
            return view('admin.products.list');
        }

        public function addproduct()
        {
        return view('admin.products.add');
        }

        public function storeproduct(Request $request)
        {
                $products = new Product();
                $products->name = $request->product_name;
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
                return redirect()->route('add.product')->with('flash_message_success','Successfully Saved');
        }

        
}
