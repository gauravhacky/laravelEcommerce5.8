@extends('shop.layouts.master')
@section('title','login-register')
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
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-sm-12">
                <div class="contact-form">
                    <h2>Change Address</h2>
                <form action="{{route('user.updateaddress')}}" id="contactForm registerForm" method="Post">
                    @csrf
                        <div class="row">
                           <div class="col-md-12">
                                <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your name" id="name" name="name" value="{{$userDetails->name}}" required data-error="Please Enter Your name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your address" id="address" name="address" value="{{$userDetails->address}}" required data-error="Please Enter Your address">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your city" id="city" name="city" value="{{$userDetails->city}}" required data-error="Please Enter Your city">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your state" id="state" name="state" value="{{$userDetails->state}}" required data-error="Please Enter Your state">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                  
                                   <select name="country" id="" class="form-control">
                                       <option value="1">Select country</option>
                                    @foreach($countries as $country) 
                                 <option value="{{$country->name}}" @if($country->name == $userDetails->country) selected @endif>{{$country->name}} - {{$country->code}}
                                </option>
                                @endforeach
                                   </select>
                                
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="pincode" id="pincode" name="pincode" value="{{$userDetails->pincode}}"required data-error="Please Enter Your pincode">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="mobile" id="mobile" name="mobile" value="{{$userDetails->mobile}}" required data-error="Please Enter Your number">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                          
                            <div class="col-md-12">
                                <div class="submit-button text-cener">
                                    <button class="btn hvr-hover" id="submit" type="submit">Update Address</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>              
@endsection
