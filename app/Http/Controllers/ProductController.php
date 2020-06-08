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
use App\Cart;
use App\ProductAttribute;
use App\ProductImage;

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

        public function updateFeaturedStatus(Request $request)
        {
                $data=$request->all();
                Product::where('id',$data['id'])->update(['featured_products'=>$data['featured_products']]); 
        }

        public function addAttribute(Request $request,$id)
        {
                $product=Product::with('attributes')->where(['id'=>$id])->first();
                return view('admin.products.add_attribute',compact('product'));
        }

        public function addAttributeStore(Request $request,$id)
        {
                $data = $request->all();
                foreach($data['sku'] as $key=>$val)
                {
                        if(!empty($val))   //Prevent duplicate SKU Record
                        { 
                        $attrCountSku = ProductAttribute::where('sku',$val)->count();
                        if($attrCountSku>0)
                        {
                        return redirect('/add/attribute/'.$id)->with('flash_message_error','Sku is Allready Exists please select another sku');
                        }              
                        $attrCountSizes = ProductAttribute::where(['product_id'=>$id,'size'=>$data['size']
                        [$key]])->count();  //Prevent dupicate Size
                        if($attrCountSizes>0)
                        {
                                return redirect('/add/attribute/'.$id)->with('flash_message_error',''.$data['size'][$key].'size is allready exists');

                        }
                        $attribute= new ProductAttribute;
                        $attribute->product_id=$id;
                        $attribute->sku=$val;
                        $attribute->size = $data['size'][$key];
                        $attribute->price = $data['price'][$key];
                        $attribute->stock = $data['stock'][$key];
                        $attribute->save();

                }
               
        }
        return redirect('/add/attribute/'.$id)->with('flash_message_success','Product attributes uploaded successfully.');
        }


        public function editAttributeedit(Request $request,$id)
        {
                $data = $request->all();
                foreach($data['attr'] as $key=>$attr)
                {
                        ProductAttribute::where(['id'=>$data['attr'][$key]])->update(['sku'=>$data['sku'][$key],
                        'size'=>$data['size'][$key],'price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
                }
                return redirect()->back()->with('flash_message_success','Products Attributes Updated');
        }

        public function addimages($id)
        {
                $product = Product::where('id',$id)->first();
                $productImages = ProductImage::where('product_id',$id)->get();
                return view('admin.products.add_images',compact('product','productImages'));
        }

        public function storeimages(Request $request,$id)
        {       
                $product_id = $request->id;
                if($request->hasfile('images'))
                {       
                       $files = $request->file('images');
                        foreach($files as $file)
                        {
                                $image = new ProductImage;
                                $extension = $file->getClientOriginalExtension();
                                $filename=rand(111,9999).'.'.$extension;
                                $image_path='uploads/products/'.$filename;
                                Image::make($file)->save($image_path);
                                $image->images=$filename;
                                $image->product_id =$product_id;
                                $image->save();
                        }
                }
                return redirect()->back()->with('flash_message_success','Products Images Added Successfully');

        }

        public function deleteproduct($id)
        {
                Product::find($id)->delete($id);
                return response()->json([
                        'success' => 'Record deleted successfully!'
                ]);
        }   

        public function deleteAttributeStore($id)
        {
                ProductAttribute::find($id)->delete($id);   
                return response()->json([
                        'success' => 'Record deleted successfully!'
                ]);
        }

        public function deleteproductImg($id)
        {
                $product_images=ProductImage::where(['id'=>$id])->first();
                //dd($product_images);
                $image_path = 'uploads/products/';
                if(file_exists($image_path.$product_images->images))
                {
                        ProductImage::where(['id'=>$id])->delete();
                        Alert::success('Deleted','Success Message');
                        return redirect()->back();
                }
        }

        public function addTocart()
        {       
               
                $session_id = Session::get('session_id');
                $usercart = Cart::where('session_id',$session_id)->orderBy('id','desc')->get();
                //dd($usercart);
                foreach($usercart as $key=>$products)
                {
                        $prodectDetails = Product::where('id',$products->product_id)->first();
                        $usercart[$key]->image = $prodectDetails->image;
                }
                return view('shop.cart',compact('usercart'));
        }

        public function addTocartStore(Request $request)
        {
                $session_id = Session::get('session_id');
                if(empty($session_id))
                {
                        $session_id=str_random(40);
                        Session::put('session_id',$session_id);
                }
                $sizeArr = explode("-",$request['size']);
                $countProducts = Cart::where(['product_id' => $request['product_id'],'product_name'=>$request->product_name,'size'=>$sizeArr[1],'session_id'=>$session_id])->count();
               if($countProducts>0)
                {
                  return redirect()->route('add.cart')->with('flash_message_error','Products already exist in cart.');       
                }

                else{
                        $cart = new Cart();
                        $cart->product_id = $request->product_id;
                        $cart->product_name = $request->product_name;
                        $cart->product_code = $request->product_code;
                        $cart->product_color = $request->color;
                        $cart->price = $request->price;
                        $cart->size = $sizeArr[1];
                        $cart->quantity = $request->quantity;  
                        $cart->session_id = $session_id;
                        $cart->save();
                }
        
        
        return redirect()->route('add.cart')->with('flash_message_success','Products Added Successfully in Cart');
        
        }

        public function deleteCartProduct($id)
        {
                Cart::find($id)->delete($id);
                return redirect()->route('add.cart')->with('flash_message_error','Products deleted Successfully.');
        }

        public function updateCartquantity($id,$quantity)
        {
            Cart::where('id',$id)->increment('quantity',$quantity);  
            return redirect()->route('add.cart')->with('flash_message_sucess','Products Quanitity updated Successfully.');  
        }
        
}


