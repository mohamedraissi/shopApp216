$(document).ready(function(){
    /*$('#sort').on('change',function(){
        this.form.submit();
    });*/
    $('#sort').on('change',function(){
       var sort=$(this).val();
       var url=$("#url").val();
       var filter =get_filter("filter");
      $.ajax({
          url:url,
          //method:"post",
          data:{filter:filter,sort:sort,url:url},
          success:function(data){
            $(".product-list").html(data);
          }
      });
    });
    $('.filter').on('click',function(){
      
      var filter =get_filter(this.className);
      console.log(this.className);
      var sort =$("#sort option:selected").text();
      var url=$("#url").val();
      $.ajax({
        url:url,
        //method:"post",
        data:{filter:filter,sort:sort,url:url,},
        success:function(data){
          $(".product-list").html(data);
        }
    });
    });
    function get_filter(class_name){
      var filter=[];
      $("."+class_name+":checked").each(function(){
        filter.push($(this).val());
      });
      return  filter;
    }

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });


  $("#getPrice").change(function(){
      var size = $(this).val();
      if(size==""){
          alert("Please select Size");
          return false;
      }
      var product_id = $(this).attr("product-id");
      $.ajax({
          url:'/get-product-price',
          data:{size:size,product_id:product_id},
          type:'post',
          success:function(resp){
              //alert(resp);
              $(".getAttrPrice").html(+resp);
          },error:function(){
              alert("Error")
          }
      });
  });
});