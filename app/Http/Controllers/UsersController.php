<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Auth;
use Session;
use App\User;
use App\Country;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function userLoginRegister()
    {
        return view('shop.users.login_register');
    }

    public function userRegister(Request $request)
    {   
    $register = new User();
    $register->name = $request->name;
    $register->email = $request->email;
    $register->password =bcrypt($request->password);
    $register->save();
    if(Auth::attempt(['email' => $request['email'],'password' => $request['password']]))
    {
        Session::put('frontSession',$request['email']);
        return redirect()->route('add.cart');
    }
    }

    public function userLogin(Request $request)
    {
        if(Auth::attempt(['email' => $request['email'],'password'=>$request['password']]))
        {
            Session::put('frontSession',$request['email']);
            return redirect()->route('add.cart');
        }
        else{
            return redirect()->back()->with('flash_message_error','Invalid Username or Password');
        }
    }

    public function userAccount()
        {
            return view('shop.users.useraccount');
        }
    

    public function userLogout()
    {
        Session::forget('frontSession');
        Auth::logout();
        return redirect('/');

    }

    public function changePassword()
    {
        return view('shop.users.changepassword');
    }

    public function changePasswordStore(Request $request)
    {
        $old_pwd = User::where('id',Auth::User()->id)->first();
        $current_password = $request['current_password'];
        if(Hash::check($current_password,$old_pwd->password)){
            $new_pwd=bcrypt($request['new_pwd']);
            User::where('id',Auth::User()->id)->update(['password'=>$new_pwd]);
            return redirect()->back()->with('flash_message_success','Password Changed Successfully');
        }
        else {
            return redirect()->back()->with('flash_message_error','Something went wrong !');
        }
    }

    public function changeAddress()
    {
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        $countries = Country::get();
        return view('shop.users.changeaddress',compact('countries','userDetails'));
    }

    public function updateAddress(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = User::find($user_id);
        $data->name = $request->name;
        $data->address = $request->address;
        $data->country = $request->country;
        $data->pincode = $request->pincode;
        $data->city = $request->city;
        $data->state = $request->state;
        $data->mobile = $request->mobile;
        $data->save();
        return redirect()->route('user.address')->with('flash_message_success','User Details Updated Successfully');
    }
    
}
