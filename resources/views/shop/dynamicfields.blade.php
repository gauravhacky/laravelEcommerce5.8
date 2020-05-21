@extends('shop.layouts.master')
@section('content')
<br/>
<div class="input_fields_container">
      <div>
      <input type="text" placeholder="product name" name="product_name[]">
      <input type="text" placeholder="product price" name="product_price[]">
      <input type="text" placeholder="product size" name="product_size[]">
      <button class="btn btn-sm btn-primary add_more_button">Add More Fields</button>
      </div>
    </div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
    var max_fields_limit      = 10; 
    var x = 1; //initialize counter for text box
    $('.add_more_button').click(function(e){ //click event on add more fields button having class add_more_button
        e.preventDefault();
        if(x < max_fields_limit){ //check conditions
            x++; //counter increment
            $('.input_fields_container').append('<div><input type="text" placeholder="product name"  name="product_name[]"/><a href="#" class="remove_field" style="margin-left:10px;">Remove</a></div>'); 
            
            
            
        }
    });  
    $('.input_fields_container').on("click",".remove_field", function(e){ //user click on remove text links
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
@endsection