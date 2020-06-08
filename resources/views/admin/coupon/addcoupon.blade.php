@extends('admin.layout.master')
@section('title','Add Coupon')
@section('content')
   <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-product-hunt"></i>
               </div>
               <div class="header-title">
                  <h1>Add Coupon</h1>
                  <small>Coupon list</small>
               </div>
            </section>
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
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonlist"> 
                              <a class="btn btn-add " href="{{route('list.product')}}"> 
                              <i class="fa fa-product-hunt"></i>Coupon List </a>  
                           </div>
                        </div> 
                        <div class="panel-body">
                           <form class="col-sm-6" id="addproform" enctype="multipart/form-data" action="{{route('store.coupon')}}" method="post">
                               @csrf
                            <div class="form-group">
                                 <label>Coupon Code</label>
                                 <input type="text" class="form-control" placeholder="coupon code"  name="coupon_code">
                              </div>
                              <div class="form-group">
                                 <label>Ammount</label>
                                 <input type="number" class="form-control" placeholder="Enter ammount Price" name="ammount">
                              </div>
                              <div class="form-group">
                                <label>Ammount Type</label>
                                <select name="ammount_type" id="ammount_type" class="form-control">
                                <option value="fixed">Fixed</option>
                                <option value="percentage">Percentage</option>
                                </select>
                             </div>
                             <div class="form-group">
                                <label>Expiry Date</label>
                                <input type="text" class="form-control" id="datepicker" placeholder="Enter expiry date" name="expiry_date">
                             </div>
                              <div class="reset-button">
                                 <a href="#" class="btn btn-warning">Reset</a>
                                 <input type="submit" class="btn btn-success" value="Add Coupon">
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- /.content -->
         </div>
@endsection
@section('js')
<script>
$(document).ready(function () {
$('#addproform').validate({ // initialize the plugin
    rules: {
      product_name: {
            required: true,
        },
        product_code: {
            required: true,
        },
        product_color: {
            required: true,
        },
        product_proce: {       
            required: true,
        },
        product_price: {       
            required: true,
        },
        product_image: {       
            required: true,
        }
    }
});

});
</script>
<script>
    $( function() {
      $( "#datepicker" ).datepicker({
        minDate:0,
        dateFormat:'yy-mm-dd',
   
      });
      });
    </script>
@endsection
