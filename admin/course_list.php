<?php
require('common-config.php');
include_once "../wp-config.php";
global $wpdb;
global $post;

 $args = array(  
       'post_type' => 'courses',
       'post_status' => 'publish',
       //'posts_per_page' => 10000,
       'orderby' => 'title',
       'order' => 'ASC',
   );
   
   $loop = new WP_Query( $args );
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>My Courses</title>

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
        

            <h1 class="dashboard-title primary-color1 padding-15px"><a href="homepage.php"><i class="flaticon-back"></i></a>  MY COURSES</h1>
            
            <form action="javascript:void(0)" id="AddCourse" method=POST enctype=multipart/form-data >
            
            
                <div class="row no-margin">
                   
                    <div class="col-12 module-card-div">
                        <div class="drop-shadow card-holder secondary-color1-background secondary-color1-border white" style="height:auto;">
                            <div class="row" style="justify-content: center;cursor:pointer;margin-bottom:20px;">
    
                                
                                <i class="flaticon-add-1 module-add-plus" style="margin-right:10px;font-size: 30px;"></i>
                                <h6 class="dashboard-title3-bold module-name">add course</h6>
                              
    
                            </div>
                            <div class="row">
                                <div class="col-xl-3">
                    
                                </div>
                                <div class="col-xl-6 col-8 ">
                                    <h6 class=" white" style="margin-bottom:0px;">ENTER COURSE NAME:</h6>
                                    <input type="text" class="new-module-input dashboard-title3-bold white" style="margin-bottom:20px;text-transform:none;" name = "title" required>
                                    <h6 class="white" style="margin-bottom:0px;">ENTER DESCRIPTION:</h6>
                                    
                                    <textarea class="new-module-input dashboard-title3-bold white" cols="5" name = "content" style="text-transform:none;" required></textarea>
                                    <input type = "hidden" name = "tags" value = "Courses">
                                    <input type = "hidden" name = "userLevel" value = "Free">
                                    <input type = "hidden" name = "featuredImage" value = "<?php echo get_site_url()."/resources/images/no-image.jpg"; ?>">
                                    <input type = "hidden" name = "category" value = "Uncategorized">
                                    
                                </div>
                                <div class="col-xl-3 col-3 backend-module-edit-iconsholder ">
                                    <button style="border: none;background: transparent;outline:none;"><i class="flt flaticon-check-box flt white" style="-webkit-appearance: initial;" type = "submit"></i></button>                                   
                                </div>
                            </div>
                        </div>
                        </a>
            </form>
                        
                        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

                        <div class="drop-shadow courses-holder primary-color1-background-hover " >
                           
                                <div class="row white-hover">
                                    <div class="col-xl-3 col-lg-3 col-12">
                                        <img src="<?php echo get_post_meta($post->ID, 'fitpro_th_course_image', true);?>" class="course-image">
                                    </div>
                                    
                                    <div class="col-xl-3 col-lg-3 col-sm-5 col-12 vertical-middle  padding-15px-vertical  text-lg-left text-center">
                                        <div class="horizontal-middle-md padding-15px-mobile">
                                            <h6 class=" primary-color1 dashboard-title3-bold" style="margin-bottom:0px;"><?php echo the_title(); ?></h6>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 d-none d-xl-block">
                                        
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-sm-3 col-6 vertical-middle text-center padding-15px-vertical">
                                        <div class="horizontal-middle copies">
                                            <h6 class="primary-color1" style="margin-bottom:0px;">SUBSCRIBED</h6>
                                            <h1 class="secondary-color1 dashboard-title3-bold" style="margin-bottom:0px;"><?php 
                                            $results =  $wpdb->get_results( "SELECT * FROM ".course_db_name()." WHERE course_id = '".get_the_ID()."' ", ARRAY_A );
                                            echo $results[0]["view_count"];
                                            ?></h1>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-sm-4 col-6 vertical-middle text-center padding-15px-vertical">
                                        <div class="horizontal-middle revenue">
                                            <h6 class="primary-color1" style="margin-bottom:0px;">MODULE</h6>
                                            <h1 class="secondary-color1 dashboard-title3-bold" style="margin-bottom:0px;"><?php 
                                            $results =  $wpdb->get_results( "SELECT * FROM ".module_db_name()." WHERE course_id = '".get_the_ID()."' ", ARRAY_A );
                                            echo count($results);
                                            ?></h1>
                                        </div>
                                        <div class="edit-icons white">
                                            
                                            <a href="<?php echo get_site_url()."/admin/edit_course.php?course=".get_the_ID();?>" class="course-page-link" >
                                                <div class="btn theme-rounded-button primary-color1 primary-color2-background primary-color2-border primary-color2-border-hover primary-color2-hover transparent-background-hover" style="margin-bottom:10px;">EDIT</div> 
                                            </a>
                                            <button class="btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover transparent-background-hover"  style="margin-bottom:10px;" id = "deleteButton" value = "<?php echo get_the_ID(); ?>" type="button">DELETE</button> 
                                            <a href="<?php echo get_site_url()."/user/modules_page.php?id=".get_the_ID();?>" class="course-page-link" >
                                                <div class="btn theme-rounded-button primary-color1 primary-color2-background primary-color2-border primary-color2-border-hover primary-color2-hover transparent-background-hover" style="margin-bottom:10px;">VIEW COURSE</div> 
                                            </a>
                                        </div>
                                    </div>
                                    
    
                                </div>

                        </div>
                        <?php
                            endwhile;
                            wp_reset_postdata();?>
                        
                        <!-- This script helps to make entire div clickable in mobile -->
                        <script>
                            if($(window).width() < 992) {
                                $(".courses-holder").click(function() {
                                  window.location = $(this).find("a.course-page-link").attr("href"); 
                                  return false;
                                });
                            }
                        </script>
                        
                    </div>
    
                </div>

        </div>
    </div>

    <script>
       
    $(document).on('submit', "#AddCourse", function(e) {
        var postvalue =  jQuery("#AddCourse").serialize();
        var url = "<?php echo FITPRO_THEME_BTX_fun_course_add_api_url();?>";
        console.log(postvalue);
        $.post(url,postvalue,function(response){
            //console.log(response);
            //var jsonData = jQuery.parseJSON(response);
            //console.log(jsonData);
            location.reload();
        });
    });
    </script>   

    <script src="../resources/js/dashboard.js"></script>
    
    <script>
    $(document).on('click', "#deleteButton", function(e) {
        var value = $(this).val();
        var postvalue = {'ID':value}; 
        console.log(postvalue);
        var url = "<?php echo FITPRO_THEME_BTX_fun_course_delete_api_url();?>";
        console.log(postvalue);
        $.post(url,postvalue,function(response){
            location.reload();
        });
    });
    </script>  
</body>

</html>