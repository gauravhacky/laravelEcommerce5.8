@extends('admin.layout.master')
@section('content')
   <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-product-hunt"></i>
               </div>
               <div class="header-title">
                  <h1>Edit Product</h1>
                  <small>Product Edit</small>
               </div>
            </section>
        
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonlist"> 
                              <a class="btn btn-add " href="{{route('list.product')}}"> 
                              <i class="fa fa-product-hunt"></i>  Product Edit </a>  
                           </div>
                        </div> 
                        <div class="panel-body">
                           <form class="col-sm-6" id="addproform" enctype="multipart/form-data" action="{{route('update.product',$product->id)}}" method="post">
                               @csrf
                              <div class="form-group">
                                 <label>Product Name</label>
                                 <input type="text" class="form-control" placeholder="Enter Product Name" name="product_name" value="{{$product->name}}">
                              </div>
                              <div class="form-group">
                                 <label>Product Code</label>
                                 <input type="text" class="form-control" placeholder="Enter Product Code" name="product_code" value="{{$product->code}}">
                              </div>
                              <div class="form-group">
                                 <label>Product Color</label>
                                 <input type="text" class="form-control" placeholder="Product Color"  name="product_color" value="{{$product->color}}">
                              </div>
                              <div class="form-group">
                                 <label>Product Price</label>
                                 <input type="number" class="form-control" placeholder="Enter Product Price" name="product_price" value="{{$product->price}}">
                              </div>
                              <div class="form-group">
                                 <label>Picture upload</label>
                                 <input type="file" name="product_image">
                                 <input type="hidden" name="current_image" value="{{$product->image}}">
                                 @if(!empty($product->image))
                                 <img src="{{asset('uploads/products/'.$product->image) }}" class="img-circle"  alt="User Image" width="50" height="50">
                                 @endif
                              </div>
                              <div class="form-group">
                                 <label>Product Description</label>
                                 <textarea class="form-control" rows="3" name="product_description">{{ $product->description }}</textarea>
                              </div>
                              <div class="reset-button">
                                 <a href="#" class="btn btn-warning">Reset</a>
                                 <input type="submit" class="btn btn-success" value="Update Product">
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
        }
    }
});

});
</script>
@endsection

