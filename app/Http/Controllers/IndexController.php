<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Category;
use App\Product;
use App\ProductAttribute;
use App\ProductImage;

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
        //$id = base64_decode($id);
        $productDetails = Product::with('attributes')->where('id',$id)->first();
        $ProductsAltImages = ProductImage::where('product_id',$id)->get();
        $featuredProducts  = Product::where('featured_products','1')->get();
        return view('shop.product_details',compact('productDetails','ProductsAltImages','featuredProducts'));
    }

    public function categoryDetail($category_id)
    {
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $products = Product::where(['category_id'=>$category_id])->get();
        $product_name = Product::where(['category_id'=>$category_id])->first();
        return view('shop.category',compact('categories','products','product_name'));
    }

    public function getProductprice(Request $request)
    {
      $data = $request->all();
       //echo "<pre>"; print_r($data);die;
        $proArr = explode("-",$data['idSize']);
        $proAttr = ProductAttribute::where(['product_id'=>$proArr[0],'size'=>$proArr[1]])->first();
        echo $proAttr->price;
    }

    public function dynamicFields()
    {
        return view('shop.dynamicfields');
    }
}
