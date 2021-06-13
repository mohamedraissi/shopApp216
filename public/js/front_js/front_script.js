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
    $('.filter-value').on('click',function(){
      
      var filter_value =get_filter(this.className);
      console.log(this.className);
      var sort =$("#sort option:selected").text();
      var filter_brand =get_filter('filter-brand');
      var url=$("#url").val();
      $.ajax({
        url:url,
        //method:"post",
        data:{filter_value:filter_value,filter_brand:filter_brand,sort:sort,url:url,},
        success:function(data){
          $(".product-list").html(data);
        }
    });
    });
    $('.filter-brand').on('click',function(){
      
      var filter_brand =get_filter(this.className);
      console.log(this.className);
      var sort =$("#sort option:selected").text();
      var filter_value =get_filter("filter-value");
      var url=$("#url").val();
      $.ajax({
        url:url,
        //method:"post",
        data:{filter_brand:filter_brand,filter_value:filter_value,sort:sort,url:url,},
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
             
              
              
              $(".getAttrPrice").html('<li class="list-inline-item h4 font-weight-light mb-0">'+resp['discounted_price']+'dt</li><li class="list-inline-item text-muted font-weight-light"><del>'+resp['product_price']+'</del></li>');
            }else{
              $(".getAttrPrice").html('<li class="list-inline-item h4 font-weight-light mb-0">'+resp['product_price']+'</li>dt');
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
        $(".totalCartItems").html(resp.totalCartItems);
        $("#AppendCartItems").html(resp.view);

      },error:function(){
        alert("error");
      }
    });
});


$(document).on('click','.btnItemDelete',function(){
  
  var cartid = $(this).data('cartid');
  var result = confirm("You want to delete this Cart Item ? ");
  if (result){$.ajax({
    data:{"cartid":cartid},
    url:'/delete-cart-item',
    type:'post',
    success:function(resp){
      $(".totalCartItems").html(resp.totalCartItems);
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
        minlength: 8,
        maxlength: 8,
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
        minlength: "Your username must consist of at least 8 characters",
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
        required: "Please Enter your Email",
       },
      password: {
        required: "Please Enter your Password",
      }
    }
  });


  $("#accountForm").validate({
    rules: {
      name: {
        required: true,
        accept: "[a-zA-Z]+"
      },
      mobile: {
        required: true,
        minlength: 8,
        maxlength: 8,
        digits: true,
      },
    },
    messages: {
      name: "Please enter your firstname",
      accept: "Please enter valid name",
      mobile: {
        required: "Please enter your phone number",
        minlength: "Your username must consist of at least 8 characters",
        digits: "Please enter your valid number",
      },
    }




  });

  // CHECK CURRENT USER PASSWORD

  $("#current_pwd").keyup(function(){
    var current_pwd = $(this).val();
    $.ajax({
      type:'post',
      url:'/check-user-pwd',
      data:{current_pwd:current_pwd},
      success:function(resp){
       
        if(resp=="false"){
          $("#chkpassword").html("<font color='red'>Current Password is Incorrect </font>");
        }else if (resp =="true"){
          $("#chkpassword").html("<font color='green'>Current Password Correct </font>");
        }
      },error:function(){
        alert("Error");
      }
    });
  });
  $("#passwordForm").validate({
    rules: {
      current_pwd: {
        required: true,
        minlength: 6,
      },
      new_pwd:{
        required: true,
        minlength: 6,
      },
      confirm_pwd:{
        required: true,
        minlength: 6,
        equalTo:"#new_pwd"
      },
    },
    messages: {
      name: "Please enter your firstname",
      accept: "Please enter valid name",
      mobile: {
        required: "Please enter your phone number",
        minlength: "Your username must consist of at least 8 characters",
        digits: "Please enter your valid number",
      },
    }
  });
// APPLY DISCOUNT CODE
$("#ApplyCoupon").submit(function(){
  var user = $(this).attr("user");
  if(user==1){

  }else {
    alert("Please login to apply Discount code!");
    return false;
  }
  var code = $("#code").val();
  
  $.ajax({
  type:'post',
  data:{code:code},
  url:'/apply-coupon',
  success:function(resp){
    if(resp.message!=""){
      alert(resp.message);
    }
    $(".totalCartItems").html(resp.totalCartItems);
    $("#AppendCartItems").html(resp.view);
      if(resp.CouponAmount>=0){
        $(".CouponAmount").text("$"+resp.CouponAmount+") =");
    }else {
        $(".CouponAmount").text("$0"+") =");
        }
        if(resp.CouponAmount>=0){
          $(".grand_total").text("$"+resp.grand_total);
      
        }
                
  },error:function(){
    alert("Error");
  }
})

});
//DELETE ADDRESS 
$(document).on('click','.addressDelete',function(){
var result = confirm("You want to delete this address?");
if(!result){
  return false;
  }
});
  