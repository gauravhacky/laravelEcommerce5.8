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
                    <h2>Change Password</h2>
                <form action="{{route('user.changePassStore')}}" id="contactForm registerForm" method="Post">
                    @csrf
                        <div class="row">
                           <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="old_pwd">
                                    <input type="password" class="form-control" placeholder="Your old password" id="current_password" name="current_password" required data-error="Please Enter Your Email">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Your new password" id="password" name="new_pwd" required data-error="Please Enter Your Password">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="submit-button text-cener">
                                    <button class="btn hvr-hover" id="submit" type="submit">Change Password</button>
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
