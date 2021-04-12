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