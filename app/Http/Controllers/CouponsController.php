<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Coupan;
use RealRashid\SweetAlert\Facades\Alert;

class CouponsController extends Controller
{
    public function getCoupon()
    {
        return view('admin.coupon.addcoupon');
    }

    public function listCoupon()
    {
        $couponDetails = Coupan::orderBy('id','desc')->get();
        return view('admin.coupon.listcoupon',compact('couponDetails'));
    }

    public function storeCoupon(Request $request)
    {
        $coupan = new Coupan();
        $coupan->coupon_code = $request->coupon_code;
        $coupan->amount = $request->ammount;
        $coupan->amount_type = $request->ammount_type;
        $coupan->expiry_date= $request->expiry_date;
        $coupan->save();
        Alert::success('Coupon Added Successfully','Success Message');
        return redirect()->route('list.coupon');

    }

    public function updateCouponStatus(Request $request)
    {
        $data=$request->all();
        Coupan::where('id',$data['id'])->update(['status'=>$data['status']]);
    }

    public function editCoupon($id)
    {
        $couponDetail = Coupan::find($id);
        return view('admin.coupon.editcoupon',compact('couponDetail'));

    }

    public function updateCoupon(Request $request,$id)
    {
        $coupan = Coupan::find($id);
        $coupan->coupon_code = $request->coupon_code;
        $coupan->amount = $request->ammount;
        $coupan->amount_type = $request->ammount_type;
        $coupan->expiry_date= $request->expiry_date;
        $coupan->save();
        Alert::success('Coupon Updated Successfully','Success Message');
        return redirect()->route('list.coupon');
    }

    public function deleteCouponStatus($id)
    {
        Coupan::find($id)->delete($id);
                return response()->json([
                        'success' => 'Record deleted successfully!'
                ]);
    }
    
}
