@extends('admin.layout.master')
@section('title','Edit Category')
@section('content')
   <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-product-hunt"></i>
               </div>
               <div class="header-title">
                  <h1>Edit Category</h1>
                  <small>Category list</small>
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
                              <a class="btn btn-add " href="}"> 
                              <i class="fa fa-product-hunt"></i>  Category List </a>  
                           </div>
                        </div> 
                        <div class="panel-body">
                           <form class="col-sm-6" id="addcatform"  action="{{route('update.categories',$category->id)}}" method="post">
                               @csrf
                              <div class="form-group">
                                 <label>Category Name</label>
                                 <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name" value="{{ $category->name}}">
                              </div>
                              <div class="form-group">
                                 <label>Parent Category</label>
                                 <select name="parent_id" id="parent_id" class="form-control">
                                 <option value="0">Parent Category</option>
                                 @foreach($levels as $cat)
                                 <option value="{{$cat->id}}" {{$category->parent_id == $cat->id ? 'selected' : ''}}>{{$cat->name}}</option>
                                 @endforeach
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Url</label>
                                 <input type="text" class="form-control" placeholder="Category Url"  name="category_url" value="{{ $category->url}}">
                              </div>
                              <div class="form-group">
                                 <label>Category Description</label>
                                 <textarea class="form-control" rows="3" name="category_description">{{ $category->description}}</textarea>
                              </div>
                              <div class="reset-button">
                                 <a href="#" class="btn btn-warning">Reset</a>
                                 <input type="submit" class="btn btn-success" value="Update Category">
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
$('#addcatform').validate({ // initialize the plugin
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

