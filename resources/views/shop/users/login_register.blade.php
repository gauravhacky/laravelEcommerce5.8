@extends('shop.layouts.master')
@section('title','login-register')
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
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-sm-12">
                <div class="contact-form-right">
                    <h2>New user Signup </h2>
                <form action="{{route('user.register')}}" id="contactForm registerForm" method="Post">
                    @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name" id="name" name="name" required data-error="Please Enter Your Name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your email" id="email" name="email" required data-error="Please Enter Your Email">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="password" id="password" name="password" required data-error="Please Enter Your Password">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="submit-button text-cener">
                                    <button class="btn hvr-hover" id="submit" type="submit">Signup</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-1 col-sm-12" id="or">
                    OR

                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="contact-form-right">
                        <h2>Already a Member | Login </h2>
                    <form action="{{route('user.Login')}}" id="contactForm oginForm" method="post">
                        @csrf
                            <div class="row">
                               <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Your email" id="email" name="email" required data-error="Please Enter Your Email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="password" id="password" name="password" required data-error="Please Enter Your Password">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="submit-button text-cener">
                                        <button class="btn hvr-hover" id="submit" type="submit">Login</button>
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
    </div>              
@endsection
