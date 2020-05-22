@extends('admin.layout.master')
@section('title','Add Attribute')
@section('content')
   <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-product-hunt"></i>
               </div>
               <div class="header-title">
                  <h1>Add Attribute</h1>
                  <small>Product Attribute</small>
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
                           <form class="col-sm-6" action="{{route('addAttributeStore.product',$product->id)}}" id="addproform" enctype="multipart/form-data" action="" method="post">
                               @csrf
                              <div class="form-group">
                                 <label>Product Name</label>
                                 {{$product->name}}
                              </div>
                              <div class="form-group">
                                 <label>Product Code</label>
                                 {{$product->code}}
                              </div>
                              <div class="form-group">
                                 <label>Product Color</label>
                                 {{$product->color}}
                              </div>
                              <div class="form-group">
                              <div class="field_wrapper">
                                <div class="form-group">
                                <div class="field-wrapper">
                                <div style="display:flex;">
                                    <input type="text" name="sku[]" id="sku" placeholder="Sku" class="form-control" style="width:120px;margin-right:5px; margin-top:5px;" value=""/>
                                    <input type="text" name="size[]" id="size" placeholder="Size" class="form-control" style="width:120px;margin-right:5px;margin-top:5px;" value=""/>
                                    <input type="text" name="price[]" id="price" placeholder="Price" class="form-control" style="width:120px;margin-right:5px;margin-top:5px;" value=""/>
                                    <input type="text" name="stock[]" id="stock" placeholder="Stock" class="form-control" style="width:120px;margin-right:5px;margin-top:5px;" value=""/>
                                    <a href="javascript:void(0)" class="add_button" title="Add Fields">Add </a>
                                </div>
                                </div>
                            </div>
                            </div>
                             <div class="reset-button">
                                 <a href="#" class="btn btn-warning">Reset</a>
                                 <input type="submit" class="btn btn-success" value="Add Attribute">
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
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div style="display:flex;"> <input type="text" name="sku[]" id="sku" placeholder="Sku" class="form-control" style="width:120px;margin-right:5px;margin-top:5px;" value=""/><input type="text" name="size[]" id="size" placeholder="Size" class="form-control" style="width:120px;margin-right:5px;margin-top:5px;" value=""/> <input type="text" name="price[]" id="price" placeholder="Price" class="form-control" style="width:120px;margin-right:5px;margin-top:5px;" value=""/><input type="text" name="stock[]" id="stock" placeholder="Stock" class="form-control" style="width:120px;margin-top:5px;" value=""/><a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
@endsection

