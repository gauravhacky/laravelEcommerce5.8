@extends('shop.layouts.master')
@section('title','Checkout')
@section('css')
<style>
    #or{
       background: #d33b33;
       border-radius: 40px;
       color: #ffffff;
       font-family: 'Roboto', sans-serif;
       font-size: 16px;
       height: 50px;
       line-height: 50px;
       margin-top:75px;
       text-align:center;
    }
    </style>
@endsection
@section('content')
<div class="contact-box-main">
     @if(Session::has('flash_message_error'))
    <div class="alert alert-sm alert-danger alert-block" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
    <span aria-hidden="true">&times; </span>
    </button>
    <strong>{!! session('flash_message_error')!!} </strong>
    </div>
    @endif
    @if(Session::has('flash_message_success'))
    <div class="alert alert-sm alert-success alert-block" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
    <span aria-hidden="true">&times; </span>
    </button>
   
    <strong>{!! session('flash_message_success')!!} </strong>
    </div>
    @endif
    <form action="{{route('checkout.store')}}" id="contactForm registerForm" method="Post">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="contact-form-right">
                    <h2>Bill To</h2>
               
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Blling Name" id="billing_name" name="billing_name" value="{{$user_details->name}}" required data-error="Please Enter Your Name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Billing address" id="billing_address" name="billing_address" value="{{$user_details->address}}" required data-error="Please Enter Your Email">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Billing City" id="billing_city" name="billing_city"value="{{$user_details->city}}"  required data-error="Please Enter Your Password">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Billing State" id="billing_state" name="billing_state" value="{{$user_details->state}}"  required data-error="Please Enter Your Password">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                     <select name="billing_country" id="billing_country" class="form-control">
                                       <option value="1">Select country</option>
                                    @foreach($country as $countries) 
                                 <option value="{{$countries->name}}" @if($countries->name == $user_details->country) selected @endif>{{$countries->name}} - {{$countries->code}}
                                </option>
                                @endforeach
                                   </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Billing Pincode" id="billing_pincode" name="billing_pincode" value="{{$user_details->pincode}}"  required data-error="Please Enter Your Password">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Billing Mobile" id="billing_mobile" name="billing_mobile" value="{{$user_details->mobile}}"  required data-error="Please Enter Your Password">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" style="margin-left:30px;">
                                    <input type="checkbox" class="form-check-input" id="billtoship">
                                    <label class="form-check-label" for="billtoship">Shipping Address As Billing Address</label>
                                </div>
                            </div>
                            
                        </div>
                        </div>
                 </div>
               
                <div class="col-lg-6 col-sm-12">
                    <div class="contact-form-right">
                        <h2>Ship To</h2>
                   
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Shipping Name" id="shipping_name" name="shipping_name" value="{{$shippingDetails->name}}" required data-error="Please Enter Your Name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Shipping address" id="shipping_address" name="shipping_address" value="{{$shippingDetails->address}}" required data-error="Please Enter Your Email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Shipping City" id="shipping_city" name="shipping_city" value="{{$shippingDetails->city}}" required data-error="Please Enter Your Password">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Shipping State" id="shipping_state" name="shipping_state" value="{{$shippingDetails->state}}" required data-error="Please Enter Your Password">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select name="shipping_country" id="shipping_country" class="form-control">
                                            <option value="1">Select country</option>
                                         @foreach($country as $countries) 
                                      <option value="{{$countries->name}}"@if(!empty($shippingDetails->country) && $countries->name == $shippingDetails->country) selected @endif>
                                        {{$countries->name}}
                                     </option>
                                     @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Shipping Pincode" id="shipping_pincode" name="shipping_pincode" value="{{$shippingDetails->pincode}}" required data-error="Please Enter Your Password">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Shipping Mobile" id="shipping_mobile" name="shipping_mobile" value="{{$shippingDetails->mobile}}" required data-error="Please Enter Your Password">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="submit-button text-center">
                                        <button class="btn hvr-hover" type="submit">Checkout</button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                               
                            </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div> 
@endsection
@section('js')
<script>
$("#billtoship").click(function(){
if(this.checked)
{
    $("#shipping_name").val($("#billing_name").val()); 
    $("#shipping_address").val($("#billing_address").val()); 
    $("#shipping_city").val($("#billing_city").val()); 
    $("#shipping_state").val($("#billing_state").val()); 
    $("#shipping_country").val($("#billing_country").val()); 
    $("#shipping_pincode").val($("#billing_pincode").val()); 
    $("#shipping_mobile").val($("#billing_mobile").val()); 
   
}
else {
    $("#shipping_name").val('');
    $("#shipping_address").val('');
    $("#shipping_city").val('');
    $("#shipping_state").val('');
    $("#shipping_country").val('');
    $("#shipping_pincode").val('');
    $("#shipping_mobile").val('');
}
});

</script>
@endsection