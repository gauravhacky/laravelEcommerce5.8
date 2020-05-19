@extends('admin.layout.master')
@section('title','Category List')
@section('content')
<div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-product-hunt"></i>
               </div>
               <div class="header-title">
                  <h1>Category</h1>
                  <small>Category List</small>
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
                                 <h4>Category</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="{{route('add.category')}}"> <i class="fa fa-plus"></i> Add Category
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
                                       <th>Category Name</th>
                                       <th>Parant Id</th>
                                       <th>Url</th>
                                       <th>Description</th>
                                       <th>Status</th>
                                       <th>Added At</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 @foreach($category as $key => $cat)
                                    <tr>
                                       
                                       <td>{{ $cat->name}}</td>
                                       <td>{{ $cat->parent_id }}</td>
                                       <td>{{ $cat->url }}</td>
                                       <td>{{ $cat->description }}</td>
                                       <td>
                                      <input type="checkbox" class="CategoryStatus btn btn-success" rel="{{$cat->id}}" data-toggle="toggle" data-on="Enabled" data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                                      @if($cat->status=="1") checked @endif>
                                      <div id="myElem" style="display:none;" class="alert alert-success">Status Enabled</div>
                                       
                                       </td>
                                       <td>{{ date('d-m-y', strtotime($cat->created_at)) }}
                                       </td>
                                       <td>
                                          <a href="{{route('edit.category',$cat->id)}}" class="btn btn-add btn-sm" data-target=""><i class="fa fa-pencil"></i></a>
                                          <button class="deleteCat" data-id="{{ $cat->id }}"  ><i class="fa fa-trash-o"></i> </button>
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
    $(".CategoryStatus").change(function()
{
 var id=$(this).attr('rel');
 if($(this).prop("checked")==true){
    $.ajax({
       headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type : 'post',
       url : '/category/status',
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
       url : '/category/status',
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
$(".deleteCat").click(function(){
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
   
    $.ajax(
    {
        url: "/delete/category/"+id,
        type: 'get',
        data: {
            "id": id,
            "_token": token,
        },
        
        success: function (){
           
        }
        
    });
   
});


</script>
@endsection