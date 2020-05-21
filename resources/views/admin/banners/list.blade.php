@extends('admin.layout.master')
@section('title','Banners List')
@section('content')
<div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-eye"></i>
               </div>
               <div class="header-title">
                  <h1>Banners</h1>
                  <small>Banners List</small>
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
                                 <h4>Banners</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="{{route('add.banner')}}"> <i class="fa fa-plus"></i> Add Banner
                                 </a>  
                              </div>
                           </div>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="list_table" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info">
                                       <th>Name</th>
                                       <th>Sort Order</th>
                                       <th>Image</th>
                                       <th>Added At</th>
                                       <th>Status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 @foreach($banners as $key => $banner)
                                    <tr>
                                       <td>{{ $banner->name}}</td>
                                       <td>{{ $banner->sort_order }}</td>
                                       <td><img src="{{ URL::asset('uploads/banners/'.$banner->image) }}" class="img-square" alt="User Image" width="250" height="110"> </td>
                                       <td>{{ date('d-m-y', strtotime($banner->created_at)) }}
                                       </td>
                                       <td>
                                      <input type="checkbox" class="BannerStatus btn btn-success" rel="{{$banner->id}}" data-toggle="toggle" data-on="Enabled" data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                                      @if($banner->status=="1") checked @endif>
                                      <div id="myElem" style="display:none;" class="alert alert-success">Status Enabled</div>
                                       
                                       </td>
                                      <td>
                                          <a href="{{route('edit.banner',$banner->id)}}" class="btn btn-add btn-sm" data-target=""><i class="fa fa-pencil"></i></a>
                                          <button class="deleteBanner" data-id="{{ $banner->id }}"  ><i class="fa fa-trash-o"></i> </button>
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
    $(".BannerStatus").change(function()
{
 var id=$(this).attr('rel');
 if($(this).prop("checked")==true){
    $.ajax({
       headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type : 'post',
       url : '/banner/status',
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
       url : '/banner/status',
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
$(".deleteBanner").click(function(){
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
   
    $.ajax(
    {
        url: "/delete/banner/"+id,
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