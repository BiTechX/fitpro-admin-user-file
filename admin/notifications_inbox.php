<?php

require('common-config.php');

global $wpdb;
global $post;

$val = $wpdb->prefix . "posts";

$country =  json_decode(file_get_contents(get_site_url()."/user/country_list.json"),true);

$comments_count = wp_count_comments();

$args = array(
    'date_query' => array(
        'after' => '4 weeks ago',
        'before' => 'tomorrow',
        'inclusive' => true,
    ),
);
 
$comments = get_comments( $args ); 

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Settings - Profile</title>

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
    

    
</script>


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
        

            <h1 class="dashboard-title primary-color1 padding-15px"><a href="homepage.php"><i class="flaticon-back"></i></a>  View notifications</h1>
            
            <form  >
                
                <div class="row no-margin">
                    <div class="col-xl-7 order-1 order-xl-0">
                        <?php foreach($comments as $comment):?>
                            <!-- add secondary-color1-border class here for the selected notification -->
                        <?php if($comment->comment_approved): ?>
                        <div class="row no-margin grey-border drop-shadow primary-color1-border-hover comment" style="padding:15px;margin-bottom:20px;">
                        <? else: ?>
                        <div class="row no-margin grey-border drop-shadow primary-color1-border-hover primary-color2-border comment" style="padding:15px;margin-bottom:20px;">
                        <? endif; ?>
                            <div class="col-1 no-padding">
                                <i class="flaticon flaticon-chat horizontal-middle-flex" style="font-size:30px;vertical-align:middle;"></i>
                            </div>
                            <?php 
                            $time1=time();
                            $time2 = strtotime($comment->comment_date);
                            $diff = $time1-$time2;
                            $diff1 = floor($diff/60);
                            $diff2 = floor($diff1/(60));
                            $diff3 = floor($diff2/(24));
                            $diff4 = floor($diff3/(30));?>
                            <input type = "hidden" value = "<?php echo $comment->comment_ID; ?>" id="comment_id">
                            <div class="col-11 col-xl-7 no-padding-desktop" >
                                <div>
                                    <p class="small-text primary-color1 dashboard-title3-bold" style="text-transform:none;margin-top:10px;display:inline" id = "author"><?php echo $comment->comment_author; ?> commented on </p>
                                    <p class="small-text secondary-color1 dashboard-title3-bold" style="text-transform:none;width:100%;"><?php $results =  $wpdb->get_results( "SELECT * FROM ".$val." WHERE ID = '".$comment->comment_post_ID."' ", ARRAY_A );
                                                                                                                                            echo $results[0]['post_title'];?></p>
                                    <p class="small-text grey text-left text-xl-right d-block d-xl-none" style="text-transform:none;"> hours ago</p>
                                </div>
                            </div>
                            <div class="col-xl-4  d-none d-xl-block">
                                <p class="small-text grey text-left text-xl-right" style="text-transform:none;"><?php if($diff4 > 0) echo $diff4." months ago";
                                                                                                                    else if($diff3 > 0) echo $diff3." days ago";
                                                                                                                    else if($diff2 > 0) echo $diff2." hours ago";
                                                                                                                    else if($diff1 > 0) echo $diff1." minutes ago";
                                                                                                                    else $diff . " seconds ago";?></p>
                                <p class=" text-right" style="margin-bottom:0px;"><i class="flaticon-move-to-the-next-page-symbol flaticon secondary-color1"></i></p>
                            </div>
                            
                        </div>
                    <?php endforeach ?>

                    </div>

                    <div class="col-xl-5  order-0 order-xl-1" id = "details">

                    </div>
                </div>

              

                
             
                
                

            </form>
        </div>
    </div>

    
    <script src="../resources/js/dashboard.js"></script>
    <script>
        $(document).on('click', ".comment", function(e) {
            $('.comment').removeClass('secondary-color1-border');
            $(this).removeClass('primary-color2-border');
            $(this).addClass('secondary-color1-border');
            var value = $(this).children('#comment_id').val();
            var formData = new FormData();
            formData.append('comment_id' , value);
            $.ajax({
                url: 'ajax_call/showDetail.php',
                data: formData,
                async: false,
                contentType: false,
                processData: false,
                cache: false,
                type: "POST",
                success: function(data)
                {
                    $('#details').html(data); 
                },
            });    
        });
    </script>

    <script>
        $(document).on('click', "#replyButton", function(e) {
            var value = $('#reply_id').val();
            var value2 = $('#reply').val();
            console.log(value2);
            var formData = new FormData();
            formData.append('comment_id' , value);
            formData.append('comment_content' , value2);
            $.ajax({
                url: 'ajax_call/reply.php',
                data: formData,
                async: false,
                contentType: false,
                processData: false,
                cache: false,
                type: "POST",
            });    
        });
    </script>
    
    <script>
        $(document).on('click', "#approve", function(e) {
            var value = $('#reply_id').val();
            var formData = new FormData();
            formData.append('comment_id' , value);
            $.ajax({
                url: 'ajax_call/reply.php',
                data: formData,
                async: false,
                contentType: false,
                processData: false,
                cache: false,
                type: "POST",
            });    
        });
    </script>


</body>




</html>