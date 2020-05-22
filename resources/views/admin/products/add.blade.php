@extends('admin.layout.master')
@section('title','Add Product')
@section('content')
   <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-product-hunt"></i>
               </div>
               <div class="header-title">
                  <h1>Add Product</h1>
                  <small>Product list</small>
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
                              <i class="fa fa-product-hunt"></i>  Product List </a>  
                           </div>
                        </div> 
                        <div class="panel-body">
                           <form class="col-sm-6" id="addproform" enctype="multipart/form-data" action="{{route('stores.product')}}" method="post">
                               @csrf
                              <div class="form-group">
                                 <label>Product Name</label>
                                 <input type="text" class="form-control" placeholder="Enter Product Name" name="product_name">
                              </div>
                              <div class="form-group">
                                 <label>Category</label>
                                 <select name="category_id" id="category_id" class="form-control">
                                 <option value="0">Category</option>
                                 @foreach($category as $cat)
                                 <option value="{{$cat->id}}">{{$cat->name}}</option>
                                 @endforeach
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Product Code</label>
                                 <input type="text" class="form-control" placeholder="Enter Product Code" name="product_code">
                              </div>
                              <div class="form-group">
                                 <label>Product Color</label>
                                 <input type="text" class="form-control" placeholder="Product Color"  name="product_color">
                              </div>
                              <div class="form-group">
                                 <label>Product Price</label>
                                 <input type="number" class="form-control" placeholder="Enter Product Price" name="product_price">
                              </div>
                              <div class="form-group">
                                 <label>Picture upload</label>
                                 <input type="file" name="product_image">
                                 <input type="hidden" name="old_picture">
                              </div>
                              <div class="form-group">
                                 <label>Product Description</label>
                                 <textarea class="form-control" rows="3" name="product_description"></textarea>
                              </div>
                              <div class="reset-button">
                                 <a href="#" class="btn btn-warning">Reset</a>
                                 <input type="submit" class="btn btn-success" value="Add Product">
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
@endsection
