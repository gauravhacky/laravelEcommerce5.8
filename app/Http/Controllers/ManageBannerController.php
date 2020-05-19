<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;
use Image;
use App\Banner;

class ManageBannerController extends Controller
{
    public function bannerList()
    {
        $banners=Banner::orderBy('id','desc')->get();
        return view('admin.banners.list',compact('banners'));
    }

    public function addBanner()
    {
        return view('admin.banners.add');
    }

    public function storeBanner(Request $request)
    {
        $banner=new Banner();
        $banner->name = $request->banner_name;
        $banner->text_style = $request->text_style;
        $banner->sort_order = $request->sort_order;
        $banner->content = $request->banner_content;
        $banner->link = $request->banner_link;
        $banner->image = $request->banner_image;
        if($request->hasfile('banner_image'))
                {
                        $img_tmp = Input::file('banner_image');
                        if($img_tmp->isValid())
                        {
                        $extension=$img_tmp->getClientOriginalExtension();
                        $filename=rand(111,99999).'.'.$extension;
                        $img_path='uploads/banners/'.$filename;
                        Image::make($img_tmp)->resize(500,500)->save($img_path);
                        $banner->image=$filename;

                }
        }
        $banner->save();
        Alert::success('Banner added Successfully','Success Message');
                return redirect()->route('list.banner');
    }

    public function editBanner($id)
    {
        $banner=Banner::find($id);
        return view('admin.banners.edit',compact('banner'));
    }

    public function updateBanner(Request $request,$id)
    {
        $banner=Banner::find($id);
        $banner->name = $request->banner_name;
        $banner->text_style = $request->text_style;
        $banner->sort_order = $request->sort_order;
        $banner->content = $request->banner_content;
        $banner->link = $request->banner_link;
        $banner->image = $request->banner_image;
        if($request->hasfile('banner_image'))
                {
                        $img_tmp = Input::file('banner_image');
                        if($img_tmp->isValid())
                        {
                        $extension=$img_tmp->getClientOriginalExtension();
                        $filename=rand(111,99999).'.'.$extension;
                        $img_path='uploads/banners/'.$filename;
                        Image::make($img_tmp)->resize(500,500)->save($img_path);
                }
        }
        else
        {
                     $filename= $request->current_image;
        }
        $banner->image=$filename;
        $banner->save();
        Alert::success('Banner updated Successfully','Success Message');
                return redirect()->route('list.banner');
    }

    public function updateBannerStatus(Request $request)
    {
        $data=$request->all();
               Banner::where('id',$data['id'])->update(['status'=>$data['status']]);
    }

    public function deleteBanner($id)
    {
        Banner::find($id)->delete($id);
                return response()->json([
                        'success' => 'Record deleted successfully!'
                ]);
    }
}

