<?php

require('common-config.php');
//echo get_stylesheet_directory();
include_once "../wp-config.php";
global $wpdb;


$age = 0;
$val = $wpdb->prefix . "posts";
if($user_Info->birth_date){
    $birthDate = $user_Info->birth_date;
  
    $birthDate = explode("/", $birthDate);
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
        ? ((date("Y") - $birthDate[0]) - 1)
        : (date("Y") - $birthDate[0]));
}
$sums = $wpdb->get_results("SELECT * FROM ".course_db_name()."" , ARRAY_A);
$total = 0;
foreach($sums as $sum)
    $total = $total+$sum['view_count'];
$courses = $wpdb->get_results("SELECT * FROM ".course_db_name()." ORDER BY view_count DESC LIMIT 5" , ARRAY_A);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Home</title>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">    

    <link rel="stylesheet" href="../resources/css/colors.php">
    <link rel="stylesheet" href="../resources/css/dashboard.php">
    <link rel="stylesheet" href="../resources/css/flaticon/flaticon.css">
    
    

     
</head>


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
        

           
            
            
        

                <div class="row d-flex flex-wrap">
                   
                    <div class="col-xl-4 order-1 order-xl-0">
                        <div class="drop-shadow card-holder white-background" >
                            <div class="row no-margin ">
                                <div class="col-6 vertical-middle horizontal-middle-flex ">
                                    <i class="flt flaticon-write-board" style="font-size:70px;"></i>
                                    
                                </div>
                                <div class="col-6 vertical-middle horizontal-middle-flex">
                                    <div>
                                        <p class="primary-color1 dashboard-title3-bold text-center small-text">Total courses subscribed</p>
                                        <h1 class="secondary-color1 dashboard-title3-bold text-center "><?php echo $total; ?></h1>
                                    </div>
                                </div>
                            </div>
                            

                        </div>
 

                    </div>
                   
                    <div class="col-xl-4 order-2 order-xl-1">
                        <div class="drop-shadow card-holder white-background" >
                            <div class="row no-margin ">
                                <div class="col-6 vertical-middle horizontal-middle-flex ">
                                    <i class="flt flaticon-basket" style="font-size:70px;"></i>
                                    
                                </div>
                                <div class="col-6 vertical-middle horizontal-middle-flex">
                                    <div>
                                        <p class="primary-color1 dashboard-title3-bold text-center small-text">Total products sold</p>
                                        <h1 class="secondary-color1 dashboard-title3-bold text-center ">NONE</h1>
                                    </div>
                                </div>
                            </div>
                            

                        </div>
 

                    </div>
                    
                    <div class="col-xl-4 order-3 order-xl-2">
                        <div class="drop-shadow card-holder white-background" >
                            <div class="row no-margin ">
                                <div class="col-6 vertical-middle horizontal-middle-flex ">
                                    <i class="flt flaticon-money-1" style="font-size:70px;"></i>
                                    
                                </div>
                                <div class="col-6 vertical-middle horizontal-middle-flex">
                                    <div>
                                        <p class="primary-color1 dashboard-title3-bold text-center small-text">Total revenue generated</p>
                                        <h1 class="secondary-color1 dashboard-title3-bold text-center ">TBD</h1>
                                        
                                    </div>
                                </div>
                            </div>
                            

                        </div>
 

                    </div>
                    
                    <div class="col-xl-8 module-card-div order-3 order-xl-4">
                        <div class=" text-center text-xl-left">
                            <h1 class="dashboard-title primary-color1" style="display:inline-block;">courses subscribed</h1>
                            <!--
                            <button class="horizontal-middle drop-shadow btn theme-rounded-button primary-color1-background-hover primary-color1-border white-hover primary-color1-border-hover primary-color1 transparent-background" 
                            style="margin-bottom:22px;"   type="submit">PRODUCTS SOLD</button>
                            -->
                        </div>
                        <?php foreach($courses as $course):?>
                        <div class="drop-shadow white-background" style="margin-bottom:20px;border: 1px solid rgba(0,0,0,0.1);">
                            <div class="row">
                                <div class="col-xl-4 col-lg-3 ">
                                    <img src="<?php $image = get_post_meta($course["course_id"],'fitpro_th_course_image'); echo $image[0];?>" class="course-image">
                                </div>
                                <?php $name = $wpdb->get_results("SELECT * FROM ".$val." WHERE ID = ".$course['course_id'] , ARRAY_A); ?>
                                <div class="col-xl-5 col-lg-5 vertical-middle  padding-15px-vertical  text-lg-left text-center">
                                    <div class="padding-15px-mobile horizontal-middle-md">
                                        <h6 class=" primary-color1 dashboard-title3-bold" style="margin-bottom:20px;"><?php echo $name[0]['post_title']; ?></h6>
                                        <div class="row no-margin-desktop-tablet horizontal-middle-flex-mobile">
                                            <a href = "<?php echo get_site_url()."/admin/edit_course.php?course=".$course['course_id'];?>"><button class="horizontal-middle drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover 
                                            transparent-background-hover margin-bottom-10px-mobile" style="margin-right:10px;">EDIT</button></a> 
                                            <button class=" no-margin horizontal-middle drop-shadow btn theme-rounded-button white-hover secondary-color1-background-hover secondary-color1-border secondary-color1-border-hover secondary-color1 
                                            transparent-background margin-bottom-10px-mobile" id="deletebutton<?php echo $course['course_id'];?>">DELETE</button>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-xl-3 col-lg-4 vertical-middle text-center padding-15px-vertical">
                                    <div class="horizontal-middle">
                                        <p class="primary-color1 dashboard-title3-bold text-center small-text">Total</p>
                                        <p class="primary-color1 dashboard-title3-bold text-center small-text">subscribed</p>
                                        <h1 class="secondary-color1 dashboard-title3-bold" style="margin-bottom:0px;"><?php echo $course['view_count'];?></h1>
                                    </div>
                                </div>
    
                            </div>    
                        </div>
                        
                        <script>
                        $(document).ready(function(){
                            $("#deletebutton<?php echo $course['course_id']; ?>").click(function () {
                            var postvalue = {'ID':'<?php echo $course['course_id']; ?>'}; 
                            console.log(postvalue);
                            var url = "<?php echo FITPRO_THEME_BTX_fun_course_delete_api_url();?>";
                            console.log(postvalue);
                            $.post(url,postvalue,function(response){
                                //console.log(response);
                                var jsonData = jQuery.parseJSON(response);
                                //console.log(jsonData);
                            });
                        });
                        });
                        </script>  
                        
                        <?php endforeach; ?>
                    </div>

                    <div class="col-xl-4 module-card-div order-0 order-xl-5">
                        <div class="drop-shadow white-background" style="padding-top:50px;padding-bottom:50px;margin-bottom:20px;    border: 1px solid rgba(0,0,0,0.1);">
                            
                            <p class="text-center">
                                <?php 
                               
                                  $val = get_user_meta( $user_ID, 'profile_photo', true );
                                  if($val){
                                      $url_profile = get_site_url()."/wp-content/uploads/ultimatemember/".$user_ID."/".$val.'?'.rand(15587000000,1568712237);
                                  } 
                                  else{
                                      $url_profile = get_avatar_url($user_ID) ;
                                  }
                                    
                                ?>
                               <img src="<?php echo $url_profile; ?>" class="secondary-color1-border profile-image-small">  
                            </p>
                            
                            <h2 class="primary-color1 text-center" style="text-transform:uppercase;">Welcome</h2>
                            <h2 class="primary-color1 text-center" style="text-transform:uppercase;"><?php echo $user_Info->display_name ;?>!</h2>
                            <a href="settings_1_profile.php">
                                <p class="small-text secondary-color1 text-center dashboard-title3-bold" style="margin-bottom:30px;">EDIT<i class="flt flaticon-edit secondary-color1" style="font-size:15px;margin-left:10px;"></i></p>
                            </a>
                            <!--Hidden for now will show later-->
                            <!--<div class="row no-margin" style="margin-bottom:50px;">-->
                            <!--    <div class="col-4">-->
                            <!--        <p class="text-center" style="margin-bottom:0px;"><i class="flt flaticon-order primary-color1 text-center" style="font-size:25px;font-weight:600;"></i></p>-->
                            <!--        <p class="small-text primary-color1 text-center dashboard-title3-bold" style="margin-bottom:0px;">TOTAL</p>-->
                            <!--        <p class="small-text primary-color1 text-center dashboard-title3-bold" style="margin-bottom:0px;">ORDERS</p>-->
                            <!--        <h3 class=" secondary-color1 text-center">2</h3>-->
                                     
                            <!--    </div>-->
                            <!--    <div class="col-4">-->
                            <!--        <p class="text-center" style="margin-bottom:0px;"><i class="flt flaticon-document-1 primary-color1 text-center" style="font-size:25px;"></i></p>-->
                            <!--        <p class="small-text primary-color1 text-center dashboard-title3-bold" style="margin-bottom:0px;">ORDERS</p>-->
                            <!--        <p class="small-text primary-color1 text-center dashboard-title3-bold" style="margin-bottom:0px;">PENDING</p>-->
                            <!--        <h3 class=" secondary-color1 text-center">3</h3>-->
                                     
                            <!--    </div>-->
                            <!--    <div class="col-4">-->
                            <!--        <p class="text-center" style="margin-bottom:0px;"><i class="flt flaticon-completed-tasks primary-color1 text-center" style="font-size:25px;"></i></p>-->
                            <!--        <p class="small-text primary-color1 text-center dashboard-title3-bold" style="margin-bottom:0px;">ORDERS</p>-->
                            <!--        <p class="small-text primary-color1 text-center dashboard-title3-bold" style="margin-bottom:0px;">COMPLETED</p>-->
                            <!--        <h3 class=" secondary-color1 text-center">52</h3>-->
                                     
                            <!--    </div>-->
                                
                            <!--</div>-->
                            <p class="text-center" style="margin-bottom:0px;"><i class="flt flaticon-telephone primary-color1 text-center" style="font-size:25px;"></i></p>
                            <a href="tel:<?php echo $user_Info->mobile_number ;?>"><p class="secondary-color1 text-center small-text"><?php echo $user_Info->mobile_number ;?></p></a>
                            <p class="text-center" style="margin-bottom:0px;"><i class="flt flaticon-email primary-color1 text-center" style="font-size:25px;"></i></p>
                            <a href="mailto:<?php echo $user_Info->user_email ;?>"><p class="secondary-color1 text-center small-text"><?php echo $user_Info->user_email ;?></p></a>
                                


                    
                        </div>
 

                    </div>
                    
                </div>
                
        </div>
    </div>

    
    <script src="../resources/js/dashboard.js"></script>

</body>

</html>