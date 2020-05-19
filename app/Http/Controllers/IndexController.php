<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;

class IndexController extends Controller
{
    public function index()
    {
        $bannerData = Banner::where('status','1')->orderBy('sort_status','asc')->get();
        return view('shop.index');
    }
}
