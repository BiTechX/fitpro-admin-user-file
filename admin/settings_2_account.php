<?php require('../wp-content/plugins/fit-pro-plugin/lib/api-call.php'); require('common-config.php');?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Settings - Account</title>

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
                <a href="settings_2_account.php"><button class="btn theme-rounded-button secondary-color1-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button current-page-button" >Account</button></a> 
                <!--<a href="settings_3_notifications.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Notifications</button></a>-->
                
                
                <!--<a href="settings_4_messages.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Messages</button></a>-->
                <a href="settings_5_billing_stripe.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Stripe</button></a>
                <a href="settings_5_billing_paypal.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Paypal</button></a>
                <a href="settings_6_manage users.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Manage users</button></a>
                <a href="settings_7_theme.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Theme</button></a>
                <a href="settings_8_categories.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Categories</button></a>
                <a href="settings_9_product_categories.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Product Categories</button></a>
                <a href="settings_10_product_collection.php"><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button" >Product Collection</button></a>           
            </div>  
            
            <form action="javascript:void(0)" id="AddCourse" method=POST enctype=multipart/form-data >
                
             <!--   <div class="row no-margin d-flex flex-wrap">
                    <div class="col-xl-3 col-lg-4 order-1 order-lg-0">

    
                            <div class="form-group">
                                <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">Full Name</h6>
                                <input type="text" class="form-control" name = "title" value="Michael Thompson">
                            </div>    

                            <div class="form-group">
                                <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">Display Name</h6>
                                <input type="text" class="form-control" name = "title" value="Michael Thompson">
                            </div>    
                            
                            <div class="form-group">
                                <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">Phone Number</h6>
                                <input type="text" class="form-control" name = "title" placeholder="Please provide your phone number">
                            </div>    
                        

    

                    </div>
                    
                    <div class="col-xl-3 col-lg-4 order-0 order-lg-1">

                        <div style="width:100%;margin-bottom:50px;" class="text-center">
                            <img src="../resources/images/profile.png" class="secondary-color1-border profile-image-big">
                        </div>
                        <div style="width:100%;margin-bottom: 30px;" class="text-center">
                            <button class="drop-shadow btn theme-rounded-button white-hover secondary-color1-background-hover secondary-color1-border secondary-color1-border-hover secondary-color1 transparent-background" type="submit">CHANGE AVATAR</button>
                        </div>                
                    </div>
                    

                </div> -->
                
                <div class="row no-margin">
                    <div class="col-xl-6 col-lg-8">
                        <div class="form-group">
                            <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">Email Address</h6>
                            <input type="email" class="form-control" name = "title" placeholder="Your public email address">
                        </div>  
                    </div>
                </div>
                <h4 class="secondary-color1 dashboard-title3 no-margin" style="padding:12px;margin-bottom:0px !important;" >CHANGE YOUR PASSWORD</h4>
                <div class="row no-margin">
                    <div class="col-xl-6 col-lg-8">
                        <div class="title-line" style="">
                          
                        </div>  
                    </div>
                </div>
                <div class="row no-margin">
                    <div class="col-xl-6 col-lg-8">
                        <div class="form-group">
                            <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">Old Password</h6>
                            <input type="text" class="form-control" name = "title" placeholder="Type in your old password">
                        </div>  
                    </div>
                </div>
                
                
                 <div class="row no-margin">
                    <div class="col-xl-6 col-lg-8">
                        <div class="form-group">
                            <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">New Password</h6>
                            <input type="text" class="form-control" name = "title" placeholder="Type in new password">
                        </div>  
                    </div>
                </div>
                <div class="row no-margin">
                    <div class="col-xl-6 col-lg-8">
                        <div class="form-group">
                            <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">Confirm New Password</h6>
                            <input type="text" class="form-control" name = "title" placeholder="Confirm New Password">
                        </div>  
                    </div>
                </div>

             <!--   <div class="row no-margin">
                    <div class="col-xl-3 col-lg-4">
                        <div class="form-group">
                            <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">Time zone</h6>
                            <div id="category" >
                                
                                <select class="input-lg form-control" name = "category">
                                    <option value = "Mustard">Mustard</option>
                                    <option value = "Ketchup">Ketchup</option>
                                    <option value = "Barbecue">Barbecue</option>
                                </select>
                                <i class="flt flaticon-back rotated-90 grey"></i>
                                
                                
                                <input type="hidden" value = "1" name = "userLevel">
                                <input type="hidden" id="FeaturedImageLink" name="feturedImage" value = 'abcd'>
                            </div>
                        </div>  
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="form-group">
                            <h6 class="dashboard-title3 small-text secondary-color1" style="text-transform:none;">Country</h6>
                            <div id="category" >
                                
                                <select class="input-lg form-control" name = "category">
                                    <option value = "Mustard">Mustard</option>
                                    <option value = "Ketchup">Ketchup</option>
                                    <option value = "Barbecue">Barbecue</option>
                                </select>
                                <i class="flt flaticon-back rotated-90 grey"></i>
                                
                                
                                <input type="hidden" value = "1" name = "userLevel">
                                <input type="hidden" id="FeaturedImageLink" name="feturedImage" value = 'abcd'>
                            </div>
                        </div>  
                    </div>
                </div> -->
                
                <div class="padding-15px text-lg-left text-center">
                    <button class="drop-shadow btn theme-rounded-button white-hover secondary-color1-background-hover secondary-color1-border secondary-color1-border-hover secondary-color1 transparent-background" type="submit" style="margin-bottom:20px">DISCARD</button>
                    <button class="drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover transparent-background-hover" type="submit" style="margin-bottom:20px">SAVE CHANGES</button>
                </div>
            </form>
        </div>
    </div>

    
    <script src="../resources/js/dashboard.js"></script>
    

</body>

</html>