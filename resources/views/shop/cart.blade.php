@extends('shop.layouts.master')
@section('title','Cart')
@section('css')
<style>
    .quantity-box input {
    width: 55%;
}
</style>
@endsection
@section('content')
 <!-- Start Atribute Navigation -->
 <div class="attr-nav">
    <ul>
        <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
        <li class="side-menu"><a href="#">
        <i class="fa fa-shopping-bag"></i>
            <span class="badge">3</span>
    </a></li>
    </ul>
</div>
<!-- End Atribute Navigation -->
</div>
<!-- Start Side Menu -->
<div class="side">
<a href="#" class="close-side"><i class="fa fa-times"></i></a>
<li class="cart-box">
    <ul class="cart-list">
        <li>
            <a href="#" class="photo"><img src="images/img-pro-01.jpg" class="cart-thumb" alt="" /></a>
            <h6><a href="#">Delica omtantur </a></h6>
            <p>1x - <span class="price">$80.00</span></p>
        </li>
        <li>
            <a href="#" class="photo"><img src="images/img-pro-02.jpg" class="cart-thumb" alt="" /></a>
            <h6><a href="#">Omnes ocurreret</a></h6>
            <p>1x - <span class="price">$60.00</span></p>
        </li>
        <li>
            <a href="#" class="photo"><img src="images/img-pro-03.jpg" class="cart-thumb" alt="" /></a>
            <h6><a href="#">Agam facilisis</a></h6>
            <p>1x - <span class="price">$40.00</span></p>
        </li>
        <li class="total">
            <a href="#" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
            <span class="float-right"><strong>Total</strong>: $180.00</span>
        </li>
    </ul>
</li>
</div>
<!-- End Side Menu -->
</nav>
<!-- End Navigation -->
</header>
<!-- End Main Top -->

<!-- Start Top Search -->
<div class="top-search">
<div class="container">
<div class="input-group">
<span class="input-group-addon"><i class="fa fa-search"></i></span>
<input type="text" class="form-control" placeholder="Search">
<span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
</div>
</div>
</div>
<!-- End Top Search -->

<!-- Start All Title Box -->
<div class="all-title-box">
<div class="container">
<div class="row">
<div class="col-lg-12">
    <h2>Cart</h2>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Shop</a></li>
        <li class="breadcrumb-item active">Cart</li>
    </ul>
</div>
</div>
</div>
</div>
<!-- End All Title Box -->

<!-- Start Cart  -->
<div class="cart-box-main">
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
<div class="col-lg-12">
    <div class="table-main table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Images</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php $total_amount = 0; ?>
                @foreach($usercart as $cartDetail)
                <tr>
                    <td class="thumbnail-img">
                        <a href="#">
                    <img class="img-fluid" src="{{asset('/uploads/products/'.$cartDetail->image)}}" alt="" />
                </a>
                    </td>
                    <td class="name-pr">
                        <a href="#">
                    {{ $cartDetail->product_name}} | Size : {{$cartDetail->size}}
                </a>
                    </td>
                    <td class="price-pr">
                        <p>INR {{ $cartDetail->price}}</p>
                    </td>
                <td class="quantity-box"><a href="{{url('cart/update-quantity/' .$cartDetail->id.'/1')}}" 
                    style="font-size:25px;">+</a><input type="number" size="4" value="{{ $cartDetail->quantity}}" min="1" step="1" class="c-input-text qty text"><a href="{{url('cart/update-quantity/' .$cartDetail->id.'/- 1')}}" style="font-size:25px;">-</a></td>
                    <td class="total-pr">
                        <p>INR {{ $cartDetail->price*$cartDetail->quantity}}</p>
                    </td>
                    <td class="remove-pr">
                    <a href="{{route('delete.cart',$cartDetail->id)}}">
                    <i class="fas fa-times"></i>
                </a>
                    </td>
                </tr>
                <?php
                $total_amount = $total_amount + ($cartDetail->price * $cartDetail->quantity);
                ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
<div class="row my-5">
<div class="col-lg-6 col-sm-6">
<div class="coupon-box">
    <form action="{{route('apply.coupon')}}" method="POST">
    @csrf
    <div class="input-group input-group-sm">
            <input class="form-control" placeholder="Enter your coupon code" name="coupon_code" aria-label="Coupon code" type="text">
            <div class="input-group-append">
                <button class="btn btn-theme" type="submit">Apply Coupon</button>
            </div>
        </div>
    </form>
    </div>
</div>
<div class="col-lg-6 col-sm-6">
    <div class="order-box">
        <h3>Order summary</h3>
        @if(!empty(Session::get('CouponAmount')))
        <div class="d-flex">
            <h4>Sub Total</h4>
            <div class="ml-auto font-weight-bold"> INR <?php echo $total_amount ?></div>
        </div>
        <hr class="my-1">
        <div class="d-flex">
            <h4>Coupon Discount</h4>
            <div class="ml-auto font-weight-bold"> INR <?php echo Session::get('CouponAmount'); ?>  </div>
        </div>

        <hr>
        <div class="d-flex gr-total">
            <h5>Grand Total</h5>
            <div class="ml-auto h5"> INR <?php echo $total_amount - Session::get('CouponAmount'); ?></div>
        </div>
       <hr>
       @else
        <div class="d-flex gr-total">
            <h5>Grand Total</h5>
            <div class="ml-auto h5"> INR <?php echo $total_amount; ?></div>
        </div>
        @endif
       </div>
    <div class="col-12 d-flex shopping-box"><a href="checkout.html" class="ml-auto btn hvr-hover">Checkout</a> </div>
</div>
</div>


</div>
</div>
<!-- End Cart -->
@endsection