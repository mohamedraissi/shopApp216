$(document).ready(function(){
    // verifier si mot de passe d'admin est correct
    $("#current_pwd").keyup(function(){
        var current_pwd = $("#current_pwd").val();
        // alert(current_pwd);
        $.ajax({
            type:'post',
            url:'/admin/check-current-pwd',
            data:{current_pwd:current_pwd},
            success:function(resp){
                
                if(resp=="false"){
                    $("#chkCurrentPassword").html("<font color=red>Current Password is incorrect</font>");
                }else if(resp=="true"){
                    $("#chkCurrentPassword").html("<font color=green>Current Password is correct</font>");
                }
            
            },error:function(){
                alert("Error");
            }
        })
    })
    
    $(" .updateOptionStatus").click(function(){
        var status =$(this).text();
        var option_id=$(this).attr("option_id");
        $.ajax({
            type:'post',
            url: '/admin/update-option-status',
            data:{status:status, option_id:option_id},
            success:function(resp){
              
              if (resp['status']==0){
                  $("#option-"+option_id).html("<a class='updateOptionStatus' href ='javascript::void(0)'> <span class='badge  badge-danger'>Inactive</span>  </a>");
              }else if (resp['status']==1){
                $("#option-"+option_id).html("<a class='updateOptionStatus' href ='javascript::void(0)'> <span class='badge  badge-success'>Active</span> </a>");


              }
                   
            },error:function(){
                alert("Error");
            }
        });

    });
    // Update Section Status
    $(" .updateSectionStatus").click(function(){
        var status =$(this).text();
        var section_id=$(this).attr("section_id");
        $.ajax({
            type:'post',
            url: '/admin/update-section-status',
            data:{status:status, section_id:section_id},
            success:function(resp){
              
              if (resp['status']==0){
                  $("#section-"+section_id).html("<a class='updateSectionStatus' href ='javascript::void(0)'> <span class='badge  badge-danger'>Inactive</span>  </a>");
              }else if (resp['status']==1){
                $("#section-"+section_id).html("<a class='updateSectionStatus' href ='javascript::void(0)'> <span class='badge  badge-success'>Active</span> </a>");


              }
                   
            },error:function(){
                alert("Error");
            }
        });

    });
    // Update Category Status
    $(" .updateCategoryStatus").click(function(){
        var status =$(this).text();
        var category_id=$(this).attr("category_id");
        $.ajax({
            type:'post',
            url: '/admin/update-category-status',
            data:{status:status, category_id:category_id},
            success:function(resp){
              
              if (resp['status']==0){
                  $("#category-"+category_id).html("<a class='updateSectionStatus' href ='javascript::void(0)'> <span class='badge  badge-danger'>Inactive</span>  </a>");
              }else if (resp['status']==1){
                $("#category-"+category_id).html("<a class='updateSectionStatus' href ='javascript::void(0)'> <span class='badge  badge-success'>Active</span>  </a>");


              }
                   
            },error:function(){
                alert("Error");
            }
        });

    });
    //Append Categories Level
    $('#section_id').change(function(){
      var section_id=$(this).val();
     $.ajax({
         type:'post',
         url:'/admin/append-categories-level',
         data:{section_id:section_id},
         success:function(resp){
         $("#appendCategoriesLevel").html(resp);
         },error:function(){
             alert("Error");
         }
         });
    
    });
   

    // Confirm Deletion with SweetAlert
    $(".confirmDelete").click(function(){
        var record =$(this).attr("record");
        var recordid =$(this).attr("recordid"); 
        Swal.fire({
         title: 'Are you sure?',
         text: "You won't be able to revert this!",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, delete it!'
       }).then((result) => {
         if (result.value) {
           window.location.href="/admin/delete-"+record+"/"+recordid;
         }
        });
        });


     });

      // Update Brand Status
    $(".updateBrandStatus").click(function(){
        var status =$(this).text();
        var brand_id=$(this).attr("brand_id");
        $.ajax({
            type:'post',
            url: '/admin/update-brand-status',
            data:{status:status, brand_id:brand_id},
            success:function(resp){
              
              if (resp['status']==0){
                  $("#brand-"+brand_id).html("<a class='updateBrandStatus' href ='javascript::void(0)'> <span class='badge  badge-danger'>Inactive</span>  </a>");
              }else if (resp['status']==1){
                $("#brand-"+brand_id).html("<a class='updateBrandStatus' href ='javascript::void(0)'> <span class='badge  badge-success'>Active</span> </a>");


              }
                   
            },error:function(){
                alert("Error");
            }
        });

    });
    // update banner status
    $(" .updateBannerStatus").click(function(){
        var status =$(this).text();
        var banner_id=$(this).attr("banner_id");
        $.ajax({
            type:'post',
            url: '/admin/update-banner-status',
            data:{status:status, banner_id:banner_id},
            success:function(resp){
              
              if (resp['status']==0){
                  $("#banner-"+banner_id).html("<a class='updateBannerStatus' href ='javascript::void(0)'> <span class='badge badge-danger'>Inactive </span></a>");
              }else if (resp['status']==1){
                $("#banner-"+banner_id).html("<a class='updateBannerStatus' href ='javascript::void(0)'><span class='badge badge-success'> Active </span> </a>");


              }
                   
            },error:function(){
                alert("Error");
            }
        });
        
    });
    // Update Section Status
    $(" .updateProductStatus").click(function(){
        var status =$(this).text();
        var product_id=$(this).attr("product_id");
        $.ajax({
            type:'post',
            url: '/admin/update-product-status',
            data:{status:status, product_id:product_id},
            success:function(resp){
              
              if (resp['status']==0){
                  $("#product-"+product_id).html("<a class='updateProductStatus' href ='javascript::void(0)'> <span class='badge badge-danger'>Inactive </span></a>");
              }else if (resp['status']==1){
                $("#product-"+product_id).html("<a class='updateProductStatus' href ='javascript::void(0)'><span class='badge badge-success'> Active </span> </a>");


              }
                   
            },error:function(){
                alert("Error");
            }
        });
    });
//add attr product
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="mt-2"><div style=""height:10px;></div><input type="text" name="size[]" style="width:120px"/>&nbsp;<input type="text" name="sku[]" style="width:120px"/>&nbsp<input type="text" name="price[]" style="width:120px"/>&nbsp;<input type="text" name="stock[]" style="width:120px"/>&nbsp;<a href="javascript:void(0);" class="remove_button">Delete</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
   
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

    $(" .updateAttributeStatus").click(function(){
        var status =$(this).text();
        var attribute_id=$(this).attr("attribute_id");
        $.ajax({
            type:'post',
            url: '/admin/update-attribute-status',
            data:{status:status, attribute_id:attribute_id},
            success:function(resp){
             
              if (resp['status']==0){
                  $("#attribute-"+attribute_id).html("Inactive");
              }else if (resp['status']==1){
                $("#attribute-"+attribute_id).html("Active");


              }
                  
            },error:function(){
                alert("Error");
           }
        });
   });
   $(".updatevalueStatus").click(function(){
      
    var status =$(this).text();
    var value_id=$(this).attr("value_id");
    $.ajax({
        type:'post',
        url: '/admin/update-value-status',
        data:{status:status, value_id:value_id},
        success:function(resp){
         
            if (resp['status']==0){
                $("#value-"+value_id).html("<a class='updateProductStatus' href ='javascript::void(0)'> <span class='badge badge-danger'>Inactive </span></a>");
            }else if (resp['status']==1){
              $("#value-"+value_id).html("<a class='updateProductStatus' href ='javascript::void(0)'><span class='badge badge-success'> Active </span> </a>");


            }
              
        },error:function(){
            alert("Error");
       }
    });
});
   $(" .updateImageStatus").click(function(){
    var status =$(this).text();
    var image_id=$(this).attr("image_id");
    $.ajax({
        type:'post',
        url: '/admin/update-image-status',
        data:{status:status, image_id:image_id},
        success:function(resp){
         
          if (resp['status']==0){
              $("#image-"+image_id).html("<a class='updateProductStatus' href ='javascript::void(0)'> <span class='badge badge-danger'>Inactive </span></a>");
          }else if (resp['status']==1){
            $("#image-"+image_id).html("<a class='updateProductStatus' href ='javascript::void(0)'><span class='badge badge-success'> Active </span> </a>");


          }
              
        },error:function(){
            alert("Error");
       }
    });
    
});
var values=[];
var options=[];
$('input[type="checkbox"]').change(function() {
    var text=$(this).next().text();
    var value=$(this).val();
    var option=$(this).attr('option-id');
    var dataid=$(this).attr('data-id');
    if(options.indexOf(option) == -1){
        options.push(option);  
        console.log("options")
        console.log(options)
    }
    
   
       
    if ($('input[option-id='+option+']:checked').length == 0) {
        options =$.grep(options, function(op) {
            return op != option;
          });
    }
    
    if ($(this).is(':checked')) {
    values.push(value);
    $('#text-values').append('<span class="tag label label-info">'+text+'<span class="remove" data-id="'+value+'" data-role="remove"></span></span>');
    }
    else{
            $("span[data-id="+value+"]").parent().remove();
            values =$.grep(values, function(value) {
                return value != dataid;
              });
              console.log("values")
              console.log(values)
    }
    $("#options").val(options);
    $("#values").val(values);
});
$('.mb-30').on('click','.remove',function() {
    $(this).parent().remove();
    var dataid=$(this).attr('data-id');
    $("input[value="+dataid+"]").prop('checked', false)
    values =$.grep(values, function(value) {
        return value != dataid;
      });
      $("#values").val(values);
});

$(" .updatecouponStatus").click(function(){
    var status =$(this).text();
    var coupon_id=$(this).attr("coupon_id");
    $.ajax({
        type:'post',
        url: '/admin/update-coupon-status',
        data:{status:status, coupon_id:coupon_id},
        success:function(resp){
          
          if (resp['status']==0){
              $("#coupon-"+coupon_id).html("<a class='updatecouponStatus' href ='javascript::void(0)'> <span class='badge badge-danger'>Inactive </span></a>");
          }else if (resp['status']==1){
            $("#coupon-"+coupon_id).html("<a class='updatecouponStatus' href ='javascript::void(0)'><span class='badge badge-success'> Active </span> </a>");

          }
               
        },error:function(){
            alert("Error");
        }
    });
   
   
      $("#ManualCoupon").click(function(){
        $("#couponField").show();
    });
 
    $("#AutomaticCoupon").click(function(){
     $("#couponField").hide();
 });
      // SHOW COURIER NAME AND TRACKING NUMBER 
      $("#courier_name").hide();
      $("#tracking_number").hide();
      $("#order_status").on("change",function(){
          alert(this.value);
     if(this.value == "Shipped"){
        $("#courier_name").show();
        $("#tracking_number").show();
     }else {
        $("#courier_name").hide();
        $("#tracking_number").hide();
     }
});
  
});


