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
                  <h1>Add Images</h1>
                  <small>Product Images</small>
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
                              <i class="fa fa-product-hunt"></i>  Product Detail </a>  
                           </div>
                        </div> 
                        <div class="panel-body">
                           <form class="col-sm-6" action="{{route('Attributimagesstore.product',$product->id)}}" id="addproform" enctype="multipart/form-data" action="" method="post">
                               @csrf
                               <input type="hidden" value="{{$product->id}}">
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
                                  <label>Images</label>
                                  <input type="file" name="images[]" id="image" multiple="multiple">
                              <div class="field_wrapper">
                                <div class="form-group">
                                
                            </div>
                            </div>
                             <div class="reset-button">
                                <input type="submit" class="btn btn-success" value="Add Attribute Images">
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <section class="content">
                <div class="row">
                   <div class="col-sm-12">
                      <div class="panel panel-bd lobidrag">
                         <div class="panel-heading">
                            <div class="btn-group" id="buttonexport">
                               <a href="">
                                  <h4>Attributes</h4>
                               </a>
                            </div>
                         </div>
                         <div class="panel-body">
                         <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                            <div class="btn-group">
                               <div class="buttonexport" id="buttonlist"> 
                                  <a class="btn btn-add" href="{{route('add.product')}}"> <i class="fa fa-plus"></i> Add Product
                                  </a>  
                               </div>
                            </div>
                            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                            <div class="table-responsive">
                               <table id="list_table" class="table table-bordered table-striped table-hover">
                               <form enctype="multipart/form-data" method="post" action="{{route('addAttributeedit.product', $product->id)}}">
                                  @csrf
                                  <thead>
                                     <tr class="info">
                                        <th>Id</th>
                                        <th>Product Id</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($productImages as $imgData)
                                <tr>
                                        <td>{{ $imgData->id }}</td>
                                        <td>{{ $imgData->product_id }}</td>
                                        <td>
                                        <img src="{{url('uploads/products/'.$imgData->images)}}" alt="img" style="width:80px;">
                                        </td>
                                        <td>
                                          <a href="{{route('imgdelete.product',$imgData->id)}}" class="btn btn-add btn-sm" title="Delete Product" data-target=""><i class="fa fa-trash-o"></i></a>
                                       </td>
                                     </tr>
                                @endforeach
                                  </tbody>
                               </table>
                            </form>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </section>
            <!-- /.content -->
         </div>
@endsection


