@extends('admin.layout.master')
@section('content')
<div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-product-hunt"></i>
               </div>
               <div class="header-title">
                  <h1>Products</h1>
                  <small>Product List</small>
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
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="">
                                 <h4>Products</h4>
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
                              <button class="btn btn-exp btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Table Data</button>
                              <ul class="dropdown-menu exp-drop" role="menu">
                                 <li>
                                    <a href="#" onclick="$('#dataTableExample1').tableExport({type:'json',escape:'false'});"> 
                                    <img src="assets/dist/img/json.png" width="24" alt="logo"> JSON</a>
                                 </li>
                                <li class="divider"></li>
                                 <li>
                                    <a href="#" onclick="$('#dataTableExample1').tableExport({type:'excel',escape:'false'});"> 
                                    <img src="assets/dist/img/xls.png" width="24" alt="logo"> XLS</a>
                                 </li>
                                 <li class="divider"></li>
                                <li>
                                    <a href="#" onclick="$('#dataTableExample1').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});"> 
                                    <img src="assets/dist/img/pdf.png" width="24" alt="logo"> PDF</a>
                                 </li>
                              </ul>
                           </div>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="list_table" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info">
                                       <th>Image</th>
                                       <th>Product Name</th>
                                       <th>Code</th>
                                       <th>Color</th>
                                       <th>Price</th>
                                       <th>Description</th>
                                       <th>Heading</th>
                                       <th>Status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 @foreach($products as $product)
                                    <tr>
                                       <td><img src="{{ URL::asset('uploads/products/'.$product->image) }}" class="img-circle" alt="User Image" width="50" height="50"> </td>
                                       <td>{{ $product->name}}</td>
                                       <td>{{ $product->code }}</td>
                                       <td>{{ $product->color }}</td>
                                       <td>{{ $product->price }}</td>
                                       <td>{{ $product->description }}</td>
                                       <td>27th April,2017</td>
                                       <td><span class="label-custom label label-default">Active</span></td>
                                       <td>
                                          <a href="{{route('edit.product',$product->id)}}" class="btn btn-add btn-sm" data-toggle="modal" data-target=""><i class="fa fa-pencil"></i></a>
                                          <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customer2"><i class="fa fa-trash-o"></i> </a>
                                       </td>
                                    </tr>
                                 @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
              
               <!-- /.modal -->
            </section>
            <!-- /.content -->
         </div>
@endsection
@section('js')
<script>
$(document).ready( function () {
    $('#list_table').DataTable();
} );
</script>
@endsection