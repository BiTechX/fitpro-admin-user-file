<?php 

require('common-config.php');

$search = "";
$orderBy = "ASC";
if(isset($_GET['s']) && !empty($_GET['s'])){
    $search = $_GET['s'];
}
if(isset($_GET['sortby']) && !empty($_GET['sortby'])){
    $orderBy = $_GET['sortby'];
}
$users = get_users([ 
    'role__in'  => [ 'subscriber' ] ,
    'orderby'   => 'display_name'  , 
    'order'   => $orderBy  , 
    'search' => '*'.$search.'*'
    ] );

//print_r($users);


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Settings - Manage Users</title>

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
    $('#hide').click(function() {
      $('#line1').toggle();
    });
});
 $(document).ready(function(){
    $('#hide2').click(function() {
      $('#line2').toggle();
    });
});
 $(document).ready(function(){
    $('#hide3').click(function() {
      $('#line3').toggle();
    });
});
 $(document).ready(function(){
    $('#hide4').click(function() {
      $('#line4').toggle();
    });
});
$(document).ready(function(){
    $('#hide5').click(function() {
      $('#line5').toggle();
    });
});
</script>



<style>
.profile-image-sm{
        height:45px !important;
        width:45px !important;
        
    }
.grey-box-padding{
    padding-left: 6%;
    padding-right: 20px;
    padding-top: 20px;
}
 .word-height{
        height:30px;
        word-break:break-all;
    }
    .expansion-bool {
    
        transform: rotate(90deg) ; 
    }
a[aria-expanded=true] .expansion-bool {
 
 transform: rotate(270deg);

}
a[aria-expanded=true] .titleline {
 
 /*display:none !important;*/

}
a[aria-expanded=false] .titleline {
 
 display:initial;

}
a[aria-expanded=false] .expansion-bool {
 
   transform: rotate(90deg);
}
    

@media(max-width:767px){
    .profile-image-sm{
        height:30px !important;
        width:30px !important;
    }
    .grey-box-padding{
    padding:15px 6%;
    }
   
    .btn-small{
        padding: 1em 1.5em!important;
    }
}

@media(min-width:1200px){
    
    .height-60px-desktop{
        height:60px;
    }

}
.disabledbutton {
    pointer-events: none;
    opacity: 0.4;
  
    
}
    
</style>
<body id="mydiv">
        
    <?php
        require('navbar-mobile.php');
    ?>

    <div class="wrapper">
        <?php
            require('sidebar.php');
        ?>

        <!-- Page Content  -->
        <div id="content" style="padding-left:0px; padding-right:0px;">
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
                <a href="settings_6_manage users.php"><button class="btn theme-rounded-button secondary-color1-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button current-page-button" >Manage users</button></a>
                <a href="settings_7_theme.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Theme</button></a>
                <a href="settings_8_categories.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Categories</button></a>
                <a href="settings_9_product_categories.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Product Categories</button></a>
                <a href="settings_10_product_collection.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Product Collection</button></a>
                            
            </div>
            
                <form action="" method="get">
          
                <div class="row no-margin" >
                    <div class="col-xl-9 col-lg-10">
                         <div class="row no-margin" style="margin-bottom:20px;" >
                            <div class="col-xl-7 col-12 order-1 order-lg-0 " style=""> 
                                <div class="row no-margin height-60px-desktop" style="display:flex;align-items:center">
                                    <div class="col-3" style="">
                                        <h6 class="dashboard-title3 small-text primary-color1 word-height" style="text-align:center;justify-content: center;text-align: center;display: flex; margin: 0;align-items: center;">Sort by</h6>
                                    </div>
                                    <div class="col-4" style="">
                                    
                                        <div style="border-bottom: 1px solid rgba(0,0,0,0.15);padding:0px 10px">
                                           
                                           
                                          <div id="category">
                                
                                            <select class="input-lg form-control" name="sortby" >
                                               <option value="ASC">NAME A-Z</option>
                                               <option value="DESC">NAME Z-A</option>
                                            </select>
                                            <i class="flt flaticon-back rotated-90 grey"></i>
                                            
                                            
                                        </div>
                                       
                                        </div>
                                                 
                                    </div>
                                    <div class="col-5" style="display:flex;justify-content:center;">
                                       <div>
                                           <!--
                                       <button class="horizontal-middle drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover 
                                       transparent-background-hover margin-bottom-10px-mobile btn-small" type="submit" id="ActionButton">SAVE CHANGES</button>
                                        -->
                                        </div>
                                    </div>
                                    
                                </div>
                            
                            </div>
                               
                                 <div class="col-xl-5 col-12 order-0 order-lg-1" style="margin-bottom:20px;"> 
                                        <div class="height-60px-desktop vertical-middle ">
                                            <div class="row horizontal-middle-tablet " style="max-width:500px;">
                                                <div class="col-9 no-padding" style="margin-left:15px;margin-right:-15px;">
                                                    <input type="text" class="form-control secondary-color1" name="s" placeholder="Search by names "style="border-radius:60px;max-width:700px;line-height: 25px;padding-right:40px;margin-bottom:0px;" value="<?php echo $search; ?>"> 
                                                </div>
                                                <div class="col-3 no-padding" style="margin-left:-15px;margin-right:15px;">
                                               
                                                    <button id="ActionButton" class="drop-shadow btn theme-rounded-button white secondary-color1-background 
                                                    secondary-color1-border secondary-color1-border-hover secondary-color1-hover white-background-hover no-padding-mobile" style="margin-bottom:0px;width:100%;padding:1em 0em!important;" type="submit">SEARCH</button>
                                                
                                                </div>
                                            </div>
                                        </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
             </form>   
                <div class="row no-margin">
                    <div class="col-xl-9 col-lg-10">
                        <div class="row no-margin">
                            <div class="col-xl-2 col-2 ">
                                
                            </div>
                            <div class ="col-xl-3 col-4">
                                <h6 class="dashboard-title3 small-text secondary-color1">NAME</h6>
                            </div>
                            <div class ="col-xl-3 col-4">
                                 <h6 class="dashboard-title3 small-text secondary-color1">ACCOUNT STATUS</h6>
                            </div>
                            <div class ="col-xl-3  d-none d-xl-block ">
                                 <h6 class="dashboard-title3 small-text secondary-color1">ACTION</h6>
                            </div>
                            <div class ="col-xl-1 col-2">
                                 <h6 class="dashboard-title3 small-text secondary-color1" style="text-align:center">MORE</h6>
                            </div>
                        
                    </div>
                    
                </div>
               
                <div class="col-xl-4 col-lg-2">
                    
                </div> 
                 </div>
                <div class="row no-margin" style="width:100%">
                    <div class="col-xl-9 col-lg-10" >
                        <div class="title-line " style="">
                          
                        </div>  
                    </div>
                </div>
                
                
                <?php 
                    foreach($users as $user) :
                        $user_meta = get_user_meta($user->ID);
                        
                        //print_r($user_meta);
                ?>
                   <div class="row no-margin">
                    <div class="col-xl-9 col-lg-10">
                        <div class="row no-margin">
                            <div class="col-xl-2 col-2 ">
                                <div style="width:100%;margin-bottom:10px;" class="text-center">
                                        <img src="https://secure.gravatar.com/avatar/3592d72a6a42af850bb39243c55d0e29?s=96&amp;d=mm&amp;r=g" class="primary-color2-border profile-image-big profile-image-sm" >  
                        </div>
                            </div>
                            <div class ="col-xl-3 col-4">
                                <h6 class="dashboard-title3 small-text primary-color1" style="text-tranform:none;">  <?php echo $user->user_login; ?>   </h6>
                            </div>
                            <div class ="col-xl-3 col-4">
                                 <h6 class="dashboard-title3 small-text primary-color1 " style="text-tranform:none;"> <?php echo $user->account_status; ?> </h6>
                            </div>
                            <div class ="col-xl-3  d-none d-xl-block ">
                              
                            <div id="category">
                                
                                <select class="input-lg form-control" id="user_status_<?php echo $user->ID; ?>" data-id= "<?php echo $user->ID; ?>" >
                                   <option value="Select_Action">Select Action</option>
                                   <option value="deactivate">Deactivate</option>
                                   <option value="activate">Activate</option>
                                   <option value="delete">Delete</option>
                                </select>
                                <i class="flt flaticon-back rotated-90 grey"></i>
                                
                                <script>
                                     $(document).on('change', "#user_status_<?php echo $user->ID; ?>", function(e) {
                                         var datavalue = $( "#user_status_<?php echo $user->ID; ?>" ).data('id');
                                         var con = confirm( "Are You sure ? " );
                                         if(con){
                                             //$( "#user_status_<?php echo $user->ID; ?>" ).val('Select_Action');
                                             if($( "#user_status_<?php echo $user->ID; ?>" ).val() != 'Select_Action'){
                                                var postvalue = {
                                                    'user_status'   :  $( "#user_status_<?php echo $user->ID; ?>" ).val(),
                                                    'user_id'       : datavalue
                                                };
                                                
                                               
                                                var url = "<?php echo FITPRO_THEME_BTX_fun_admin_user_status_change_url();?>"+datavalue;
                                                console.log(postvalue);
                                             
                                                $.ajax({
                                                    url: url,
                                                    data: postvalue,
                                                    type: 'POST',
                                                    beforeSend : function()
                                                    {
                                                        $("#mydiv").addClass("disabledbutton");
                                                        jQuery(this).prop("disabled",true);
                                                    },
                                                    success: function(result){
                                                      
                                                        console.log(result);
                                                        var data = jQuery.parseJSON(result);
                                                        console.log(data);
                                                       
                                                      
                                                        if(data.status == 1){
                                                            window.location.href = "";
                                                        }
                                                         $("#mydiv").removeClass("disabledbutton");
                                                         
                                                    },
                                                    error: function(e) 
                                                    {
                                                         window.location.href = "";
                                                        $("#mydiv").removeClass("disabledbutton");
                                                       console.log(e);
                                                       jQuery(this).prop("disabled",false);
                                                    }   
                                                    
                                                });
                                                
                                             }
                                         } 
                                         else{
                                             $( "#user_status_<?php echo $user->ID; ?>" ).val('Select_Action');
                                         }
                                    });
                                </script>
                            </div>
                            
                            
                            </div>
                            <div class ="col-xl-1 col-2" style="display:block;text-align:center;">
                               <a data-toggle="collapse"  id ="hide" href="#grey-card_<?php echo $user->ID ; ?>">  
                               <i style="margin-top:-30px;" class="flaticon-move-to-the-next-page-symbol flt primary-color1 expansion-bool" > </i> </a>
                            </div>
                        
                    </div>
                      <div class="row no-margin " id="line1"  style="width:100%">
                    <div class="col-12" >
                        <div class="title-line "  style="">
                          
                        </div>  
                    </div>
                </div>
             <div class="row no-margin grey-box-padding collapse" id="grey-card_<?php echo $user->ID ; ?>"  style="margin-bottom:30px">
                <div class="row no-margin" style="background-color:#fafafa;padding:20px 0px;width:100%;">            
                   <div class="col-xl-6 col-12">
                       <div class="row no-margin">
                        <div class="col-6 no-padding" >
                            <h6 class="dashboard-title3 small-text secondary-color1 word-height" style="">First Name</h6>
                            <h6 class="dashboard-title3 small-text secondary-color1 word-height" style="">Last Name</h6>
                            <h6 class="dashboard-title3 small-text secondary-color1 word-height" style="">Email</h6>
                            
                        </div>
                        <div class="col-6 no-padding" >
                            
                            <h6 class="dashboard-title3 small-text primary-color1 word-height" style="text-transform:none;"><?php echo $user->first_name ; ?></h6>
                            <h6 class="dashboard-title3 small-text primary-color1 word-height" style="text-transform:none;"><?php echo $user->last_name; ?></h6>
                            <h6 class="dashboard-title3 small-text primary-color1 word-height" style="text-transform:none;"><?php echo $user->user_email; ?></h6>
                            
                        </div>
                       </div>    
                    </div>    
                    
                   <div class="col-xl-6 col-12">
                       <div class="row no-margin">
                         <div class="col-6 no-padding" >
                            <h6 class="dashboard-title3 small-text secondary-color1 word-height" style="">Country</h6>
                            <h6 class="dashboard-title3 small-text secondary-color1 word-height" style="word-break:break-all;"> Subscription </h6>
                            
                               
                        </div>
                        <div class="col-6 no-padding" >
                            <h6 class="dashboard-title3 small-text primary-color1 word-height" style="text-transform:none;">  <?php echo $user->country; ?>  </h6>
                            <h6 class="dashboard-title3 small-text primary-color1 word-height" style="text-transform:none;">  
                                
                                <?php 
                                    if(is_user_have_subscription_plan($user->ID)){
                                        $user_plan_info = get_user_current_subscription_info($user->ID);
                                        $plan_info = unserialize ( $user_plan_info['current_user_plan_info'] );
                                        echo $plan_info->plan_title;
                                    }else{
                                        echo "No subscription plan";
                                    }
                                ?> 
                        
                            </h6>
                            
                        </div>
                      </div>    
                    </div>   
                    <div class = "col-12 d-block d-xl-none" style=" padding: 20px 50px;">
                         <h6 class="dashboard-title3 small-text secondary-color1"> ACTION </h6>
                         
                        <div id="category">
                                
                                <select class="input-lg form-control" name="country_name" required="">
                                   <option value="Select Action">Select Action</option>
                                   <option value="Deactivate">Deactivate</option>
                                   <option value="Activate">Activate</option>
                                   <option value="Delete">Delete</option>
                                </select>
                                <i class="flt flaticon-back rotated-90 grey"></i>
                                
                                
                        </div>
                    </div>
                     </div>  
                
                   </div>  
                    
                </div>
               
                <div class="col-xl-4 col-lg-2">
                    
                </div> 
             
             
                </div>
                
                <?php endforeach ;?>
               
            
        </div>
    </div>


    
    <script src="../resources/js/dashboard.js"></script>
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
    var a= 1;
   


</script>
    

</body>

</html>