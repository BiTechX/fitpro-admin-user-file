<?php

require('common-config.php');


    
    $categories = wp_remote_get( get_site_url().'/wp-json/wc/v3/products/categories', array(
     	'headers' => array(
    		'Authorization' => 'Basic ' . base64_encode( 'ck_6d9ccb7c073d847e292d60be042cb445e78640a8:cs_2e7128f3e2248fb3d93dd2800bda1c1c279132e9' )
    	),
    ) );

    $categories = json_decode($categories['body']);
    
    $options = get_option( 'theme_setting_change' );
    //print_r($categories);
    //print_r(get_option('low_value'));
 
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Settings - Website</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../resources/css/sidebar.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">    
    <link rel="stylesheet" href="../resources/css/flaticon/flaticon.css">
    <link rel="stylesheet" href="../resources/css/colors.php">
    <link rel="stylesheet" href="../resources/css/dashboard.php">
    
    

     
</head>

<script>
    
    $(document).ready(function(){
        $('#input-file-now-custom-1').change(function(){
            var total_file=document.getElementById("input-file-now-custom-1");
            
            $('#file-preview').html("<div style='text-align:right;'><i class='fas fa-times' id='cross-button'></i></div><img src="+URL.createObjectURL(event.target.files[0]) + "> </img>");
            $('#file-preview').addClass(" drop-shadow card-holder");
        });
        
        $(document).on ("click", "#cross-button" ,function(){
            
            document.getElementById("input-file-now-custom-1").value = "";
            $('#file-preview').html("");
            $('#file-preview').removeClass(" drop-shadow card-holder");
        });
        
    });
    
</script>

<script>
       

        
    </script>   


<style>

</style>
    
    

<body>
        
    <?php
        require('navbar-mobile.php');
    ?>

    <div class="wrapper">
        <?php
            require('sidebar.php');
        ?>

        <!-- Page Content  -->
        <div id="content">
            <?php
                require('navbar-top.php');
            ?>
        

            <h1 class="dashboard-title primary-color1 padding-15px"><a href="homepage.php"><i class="flaticon-back" style="margin-right:20px;"></i></a>Settings</h1>
            
            <div class="padding-15px" style="margin-bottom:20px;">
                <a href="settings_1_profile.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Profile</button></a>
                <a href="settings_2_account.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Account</button></a> 
                <!--<a href="settings_3_notifications.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Notifications</button></a>-->
                
                
                <!--<a href="settings_4_messages.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Messages</button></a>-->
                <a href="settings_5_billing_stripe.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Stripe</button></a>
                <a href="settings_5_billing_paypal.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Paypal</button></a>
                <a href="settings_6_manage users.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Manage users</button></a>
                <a href="settings_7_theme.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Theme</button></a>
                <a href="settings_8_categories.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button " >Categories </button></a>
                <a href="settings_9_product_categories.php"><button class="btn theme-rounded-button secondary-color1-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button current-page-button" >Product Categories</button></a>
                <a href="settings_10_product_collection.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Product Collection</button></a>
                
                            
            </div>
             
            
           
                
                <div class="row no-margin">
                    <div class="col-xl-6 col-lg-6">
                        
                        <form action="javascript:void(0)" id="AddNewCategory" >
                            <div class ="row no-margin"  style="align-items:center;margin-bottom:20px;">
                                <div class="col-xl-8 col-lg-8">
                                     <div class="form-group">
                                        <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">Add Category</h6>
                                        <input type="text" class="form-control" name ="category_name" required placeholder="">
                                    </div>  
                                </div>
                                <div class="col-xl-8 col-lg-8">
                                     <div class="form-group">
                                        <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;"> Category Description</h6>
                                         <textarea class="form-control"cols="5" name="category_description" ></textarea>
                                    </div>  
                                </div>
                                <div class="col-xl-4 col-lg-4">
                                    
                                        
                                </div>
                                 <div class="padding-15px text-lg-left text-center" style="padding-top:3%;">
                                        <button id="ActionButton" class="drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover transparent-background-hover" type="submit" style="">ADD</button>
                                    </div>
                            </div>
                        </form>
                        <div class="row no-margin" >
                            
                           <!-- 
                          
                         <div class ="row no-margin"  style="align-items:center;margin-bottom:20px;">
                            <div class="col-xl-8 col-lg-8">
                                 <div class="form-group">
                                    <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">User Homepage Image Link:</h6>
                                    <input type="text" class="form-control" name = "title" placeholder="">
                                </div>  
                            </div>
                          
                         </div>
                         <div class ="row no-margin"  style="align-items:center;margin-bottom:20px;">
                            <div class="col-xl-8 col-lg-8">
                                 <div class="form-group">
                                    <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">User Courses Progress Background:</h6>
                                    <input type="text" class="form-control" name = "title" placeholder="">
                                </div>  
                            </div>
                          
                         </div>
                        <div class="padding-15px text-lg-left text-center" style="">
                                       
                             <button class="drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover transparent-background-hover" type="submit" style="">UPDATE</button>
                        
                         </div>
                         -->
                            
                    </div> 
                       
                    </div>
                    
                    <div class="col-xl-6 col-lg-6" style="height: 400px;overflow-y: scroll;">
                        
                        
                      
                           <?php foreach($categories as $category):?>
                            <div class = "col-xl-11 col-lg-11 "> 
                                <div class="drop-shadow card-holder">
                                    <div class="row">
                                       <!-- <div class="col-1 backend-module-edit-iconsholder backend-module-edit-iconsholder-left">
                                            <i class="flt flaticon-document"></i>
                                        </div> -->
                                        <div class="col-7">
                                            <h6 class="primary-color1 module-name dashboard-title3"><?php echo $category->name ;?></h6>
                                        </div>
                                        <div class="col-4 backend-module-edit-iconsholder "  >
                                            <!--<i class="flt flaticon-writing  primary-color1"></i>-->
                                            <?php if( strcasecmp($category->name ,"UNCATEGORIZED") ): ?>
                                            <i class="flt flaticon-rubbish-bin secondary-color1" style="padding-left:10px;" id="delete_categary" data-id="<?php echo $category->id ;?>"></i>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                
                           </div>
                           
                         <?endforeach;?>  
                         
                         
                         
                         
                         
                    </div>
                </div>
                
            
        </div>
    </div>

    
    <script src="../resources/js/dashboard.js"></script>
    

</body>


<script>
       
    $(document).on('submit', "#AddNewCategory", function(e) {
    
    
            var postvalue =  jQuery(this).serialize();
            var url = "woocommerce_api/add_category.php";
              
                $.ajax({
                    url: url,
                    data: postvalue,
                    type: 'POST',
                    beforeSend : function()
                    {
                        jQuery("#ActionButton").prop("disabled",true);
                    },
                    success: function(result){
                        if(result == 1){
                             location.reload();
                        }
                        else if(result == 2){
                            alert('Category not created');
                        }
                       jQuery("#ActionButton").prop("disabled",false);
                      
                    },
                    error: function(e) 
                    {
                        location.reload();
                    }   
                    
                });
                
      
    
                
    });
    
      $(document).on('click', "#delete_categary", function(e) {
    
    
    
            var isconf = confirm("Are You Sure to Delete This Category ? ");
            if(isconf){
                
                var value =  jQuery(this).data("id");
                var url = "woocommerce_api/delete_category.php";
                  
                    $.ajax({
                        url: url,
                        data: {'id' :value},
                        type: 'POST',
                        beforeSend : function()
                        {
                            jQuery("#ActionButton").prop("disabled",true);
                            jQuery(this).prop("disabled",true);
                        },
                        success: function(result){
                            if(result == 1){
                                 location.reload();
                            }
                            else if(result == 2){
                                alert('Category was not deletd');
                            }
                            console.log(result);
                           jQuery("#ActionButton").prop("disabled",false);
                           jQuery(this).prop("disabled",false);
                          
                        },
                        error: function(e) 
                        {
                           location.reload();
                        }   
                        
                    });
                    
                
            }
           
      
    
                
    });
        
</script>  

</html>