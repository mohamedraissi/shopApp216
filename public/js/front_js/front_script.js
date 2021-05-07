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
            if(resp['discounted_price']>0){
              $(".getAttrPrice").html("<del>"+resp['product_price']+"$"+"</del> <br>" +"<ins style=color:green>"+resp['discounted_price']+"$"+"</ins>");
            }else{
              $(".getAttrPrice").html(+resp['product_price']+"$");
            }
          },error:function(){
              alert("Error")
          }
      });
  });
});
// UPDATE CART ITEMS 
$(document).on('click','.qtybtn',function(){
    if($(this).hasClass('dec')){
      var quantity = $(this).prev().val();
      if(quantity<=1){
        alert("Item quantity must be more than 1!");
      return false;
      }else{
        new_qty = parseInt(quantity)-1;
      }
    }
    if ($(this).hasClass('inc')){
      var quantity = $(this).prev().prev().val();
      new_qty = parseInt(quantity)+1;
    }
    
    var cartid = $(this).data('cartid');
    
    $.ajax({
      data:{"cartid":cartid,"qty":new_qty},
      url:'/update-cart-item-qty',
      type:'post',
      success:function(resp){
        
        if(resp.status==false){
          alert ('Product Size is not avaibale !');
        }
        $("#AppendCartItems").html(resp.view);

      },error:function(){
        alert("error");
      }
    });
});


$(document).on('click','.btnItemDelete',function(){
  
  var cartid = $(this).data('cartid');
  var resutl = confirm("You want to delete this Cart Item ? ");
  if (result){$.ajax({
    data:{"cartid":cartid},
    url:'/delete-cart-item',
    type:'post',
    success:function(resp){
      $("#AppendCartItems").html(resp.view)
    },error:function(){
      alert("error");
    }
  });
  }
  
  
});


  // validate register form on keyup and submit
  $("#registerForm").validate({
    rules: {
      name: "required",
      mobile: {
        required: true,
        minlength: 11,
        maxlength: 12,
        digits: true,
      },
      email: {
        required: true,
        email: true,
        remote:"check-email"
      },
      password: {
        required: true,
        minlength: 5
      },
      confirm_password: {
        required: true,
        minlength: 5,
        equalTo: "#password"
      },
    },
    messages: {
      name: "Please enter your firstname",
      mobile: {
        required: "Please enter your phone number",
        minlength: "Your username must consist of at least 11 characters",
        digits: "Please enter your valid number",
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      confirm_password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long",
        equalTo: "Please enter the same password as above"
      },
      email:{
      required: "Please enter your Email",
      email: "Please enter a valid email address",
      remote: "Email already Exists !"
      }
    }

  });
  $("#loginForm").validate({
    rules: {
      email: {
        required: true,
      },
      password: {
        required: true,
      },
    },
    messages: {
       email:{
        required: "Please enter your Email",
       },
      password: {
        required: "Please Enter your Password",
      }
    }
  });