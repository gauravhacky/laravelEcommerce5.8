@extends('admin.layout.master')
@section('title','Coupon List')
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
                                 <h4>Coupon</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="{{route('get.coupon')}}"> <i class="fa fa-plus"></i> Add Coupon
                                 </a>  
                              </div>
                           </div>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="list_table" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info">
                                       <th>Coupon Id</th>
                                       <th>Coupon Code</th>
                                       <th>Amount</th>
                                       <th>Amount Type</th>
                                       <th>Expiry Date</th>
                                       <th>Creted At</th>
                                       <th>Status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                     @foreach($couponDetails as $coupon)
                                 <tr>
                                 <td>{{ $coupon->id}}</td>
                                 <td>{{ $coupon->coupon_code}}</td>
                                 <td>{{ $coupon->amount}}</td>
                                 <td>{{ $coupon->amount_type}}</td>
                                 
                                       
                                       <td>{{$coupon->expiry_date}}
                                        <td>{{$coupon->created_at}}
                                       </td>
                                       <td>
                                     <input type="checkbox" class="CouponStatus btn btn-success" rel="{{$coupon->id}}" data-toggle="toggle" data-on="Enabled" data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                                     @if($coupon->status=="1") checked @endif> 
                                      <div id="myElem" style="display:none;" class="alert alert-success">Status Enabled</div>
                                       
                                       </td>
                                      <td>
                                         <a href="{{route('edit.coupon',$coupon->id)}}" class="btn btn-add btn-sm" data-target=""><i class="fa fa-pencil"></i></a>
                                          <button class="deleteCoupon" data-id="{{ $coupon->id }}"  ><i class="fa fa-trash-o"></i> </button> 
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
    $(".CouponStatus").change(function()
   
{
 var id=$(this).attr('rel');
 //alert(id);
 if($(this).prop("checked")==true){
    $.ajax({
       headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type : 'post',
       url : '/admin/coupon/status',
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
       url : '/admin/coupon/status',
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
$(".deleteCoupon").click(function(){
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
   
    $.ajax(
    {
        url: "/delete/coupon/"+id,
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