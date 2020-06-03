@extends('admin.layout.master')
@section('title','Product List')
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
        <div id="message_success" style="display:none;" class="alert-sm alert-success">Status Enabled</div> 
        <div id="message_error" style="display:none;" class="alert-sm alert-danger">Status Disabled</div> 
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
                                       <th>Category Id</th>
                                       <th>Code</th>
                                       <th>Color</th>
                                       <th>Price</th>
                                       <th>Description</th>
                                       {{-- <th>Added At</th> --}}
                                       <th>Status</th>
                                       <th>Featured Product</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 @foreach($products as $key => $product)
                                    <tr>
                                       <td><img src="{{ URL::asset('uploads/products/'.$product->image) }}" class="img-circle" alt="User Image" width="50" height="50"> </td>
                                       <td>{{ $product->name }}</td>
                                       <td>{{ $product->category_id }}</td>
                                       <td>{{ $product->code }}</td>
                                       <td>{{ $product->color }}</td>
                                       <td>{{ $product->price }}</td>
                                       <td>{{ $product->description }}</td>
                                      {{-- <td>{{ date('d-m-y', strtotime($product->created_at)) }}
                                       </td> --}}
                                       <td>
                                      <input type="checkbox" class="ProductStatus btn btn-success" rel="{{$product->id}}" data-toggle="toggle" data-on="Enabled" data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                                      @if($product->status=="1") checked @endif>
                                      <div id="myElem" style="display:none;" class="alert alert-success">Status Enabled</div>
                                       </td>
                                       <td>
                                          <input type="checkbox" class="featuredProductStatus btn btn-success" rel="{{$product->id}}" data-toggle="toggle" data-on="Enabled" data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                                          @if($product->featured_products=="1") checked @endif>
                                          <div id="myElem" style="display:none;" class="alert alert-success">Status Enabled</div>
                                           </td>
                                       <td>
                                          <a href="{{route('addAttributimages.product',$product->id)}}" class="btn btn-add btn-sm" title="Add Images" data-target=""><i class="fa fa-image"></i></a>
                                          <a href="{{route('edit.product',$product->id)}}" class="btn btn-add btn-sm" title="Edit Product" data-target=""><i class="fa fa-pencil"></i></a>
                                          <a href="{{route('addAttribute.product',$product->id)}}" class="btn btn-add btn-sm" title="Add Attributes" data-target=""><i class="fa fa-list"></i></a>
                                          <button class="deleteRecord" data-id="{{ $product->id }}"  ><i class="fa fa-trash-o"></i> </button>
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
            </section>
         </div>
@endsection
@section('js')
<script>
$(document).ready( function () {
    $('#list_table').DataTable();
    $(".ProductStatus").change(function()
{
 var id=$(this).attr('rel');
 if($(this).prop("checked")==true){
    $.ajax({
       headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type : 'post',
       url : '/product/status',
       data : {status:'1',id:id},
       success:function(data){
          $("#message_success").show();
          setTimeout(function(){
             $("#message_success").fadeOut('slow'); },2000);
       },error:function(){
          alert("error");
       }
    });
 }else{ 
   $.ajax({
       headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type : 'post',
       url : '/product/status',
       data : {status:'0',id:id},
       success:function(resp){
          $("#message_error").show();
          setTimeout(function(){
             $("#message_error").fadeOut('slow'); },2000);
       },error:function(){
          alert("error");
       }
    });
 }
});
});

$(".deleteRecord").click(function(){
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
   
    $.ajax(
    {
        url: "/delete/product/"+id,
        type: 'get',
        data: {
            "id": id,
            "_token": token,
        },
        
        success: function (){
           
        }
        
    });
   
});

$(".featuredProductStatus").change(function()
{
 var id=$(this).attr('rel');
 if($(this).prop("checked")==true){
    $.ajax({
       headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type : 'post',
       url : '/featuredproduct/status',
       data : {featured_products:'1',id:id},
       success:function(data){
          $("#message_success").show();
          setTimeout(function(){
             $("#message_success").fadeOut('slow'); },2000);
       },error:function(){
          alert("error");
       }
    });
 }else{ 
   $.ajax({
       headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type : 'post',
       url : '/featuredproduct/status',
       data : {featured_products:'0',id:id},
       success:function(resp){
          $("#message_error").show();
          setTimeout(function(){
             $("#message_error").fadeOut('slow'); },2000);
       },error:function(){
          alert("error");
       }
    });
 }
});

</script>
@endsection