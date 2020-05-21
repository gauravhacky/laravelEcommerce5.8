<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Category;
use App\Product;

class IndexController extends Controller
{
    public function index()
    {
        $bannerData = Banner::where('status','1')->orderBy('sort_order','asc')->get();
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $products = Product::orderBy('id','desc')->get();
        return view('shop.index',compact('bannerData','categories','products'));
    }

    public function productDetail($id)
    {
        $id = base64_decode($id);
        $productDetails = Product::find($id);
        return view('shop.product_details',compact('productDetails'));
    }

    public function dynamicFields()
    {
        return view('shop.dynamicfields');
    }
}
