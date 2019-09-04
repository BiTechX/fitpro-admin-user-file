<?php
require("common-config.php");
require_once('../wp-content/plugins/fit-pro-plugin/lib/api-call.php');
include_once "../wp-config.php";

global $wpdb;
global $post;

$categories = get_terms( 'category', array(
        'orderby'    => 'term_id',
        'order'    => 'ASC',
        'hide_empty' => 0
   ));


// echo $wpdb->prefix;
$val = $wpdb->prefix . "posts";
$results =  $wpdb->get_results( "SELECT * FROM ".$val." WHERE ID = '".$_GET['course']."' ", ARRAY_A );
$image = get_post_meta($results[0]["ID"],'fitpro_th_course_image');
$level = get_post_meta($results[0]["ID"],'fitpro_th_course_user_level');
$tags = get_the_tags($results[0]["ID"]);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo $results[0]["post_title"];?></title>

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

    <link rel="stylesheet" href="../resources/css/flaticon/flaticon.css">
    <link rel="stylesheet" href="../resources/css/colors.php">
    <link rel="stylesheet" href="../resources/css/dashboard.php">

     
</head>

<style>
.module-image-show img
{
    height: 85px;
}
    
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
        

            <h1 class="dashboard-title primary-color1 padding-15px"><a href="course_list.php"><i class="flaticon-back"></i></a>  <?php echo $results[0]["post_title"];?></h1>
            
            
                <div class="row no-margin">
                    
                    <div class="col-xl-4 col-lg-5  scrollbar-change secondary-color1-scrollbar  backend-overflow-div">
                    <form action="javascript:void(0)" id="AddCourse" method=POST enctype=multipart/form-data>
                        <input type="hidden" id="FeaturedImageLink" name="featuredImage" value = '<?php echo $image[0]; ?>'>
                        <input type="hidden" id="id" name="ID" value = '<?php echo $results[0]["ID"]; ?>'>
                        <div class="backend-course-image" >
                                <img src="<?php echo $image[0]; ?>" >
                        </div>
                        <div class="drop-shadow card-holder row no-margin no-padding">
                            <div class="col-7">
                                <h6 class="dashboard-title3-bold primary-color1" style="margin-top:5px;">Display picture</h6>
                            
                            </div>
                            <div class="col-5 display-picture-iconsholder">
                                <label class="flt flaticon-upload primary-color1" for="input-file-display-picture" ></label>
                                <input type="file" id="input-file-display-picture" class="file-upload-hidden" name = "courseImage"/>
                                
                            </div>
                            
                        </div>    
               
                        
                        <div class="drop-shadow card-holder">
                            <div class="collapsible-div-button" type="button" data-toggle="collapse" data-target="#general-info">
                                <h6 class="dashboard-title3-bold primary-color1">General information</h6>
                                <i class="flaticon-move-to-the-next-page-symbol flt"></i>
                            </div>
                            <div id="general-info" class="collapse collapsible-div" >
                                <div class="form-group">
                                    <h6 class="dashboard-title3 primary-color1">course title</h6>
                                    <input type="text" value = "<?php echo $results[0]["post_title"]; ?>" class="form-control" name = "title" >
                                </div>
                                <div class="form-group">
                                    <h6 class="dashboard-title3 primary-color1">course description</h6>
                                    <textarea  class="form-control" name = "content" cols="5"><?php echo $results[0]["post_content"];?></textarea>
                                </div>        
                            </div>
                        </div>

                        <div class="drop-shadow card-holder">
                            <div class="collapsible-div-button" type="button" data-toggle="collapse" data-target="#category">
                                <h6 class="dashboard-title3-bold primary-color1">category</h6>
                                <i class="flaticon-move-to-the-next-page-symbol flt"></i>
                            </div>
                            
                            <div id="category" class="collapse collapsible-div" >
                                <h6 class="dashboard-title3 primary-color1">category</h6>
                                <select name = "category" class="input-lg form-control">
                                    <?php foreach($categories as $category):?>
                                        <option value = "<?php echo $category->name ;?>"><?php echo $category->name ;?></option>
                                    <?endforeach;?>  
                                </select>
                                <i class="flt flaticon-back rotated-90 grey"></i>
                                <h6 class="dashboard-title3 primary-color1">Tags</h6>
                                <input type="text" data-role="tagsinput" class="form-control" id="tag" name="tags" value = "<?if ( $tags ) {
                                                                                                                        foreach( $tags as $tag ) {
                                                                                                                        echo $tag->name . ','; 
                                                                                                                        }
                                                                                                                    } ?>" >
                            </div>
                        </div>
                        <?php
                        $level = explode(",",$level[0]);
                        $all_plans = get_all_plan() ;
                        foreach($all_plans as $all_plan):
                        ?>
                        <?php if(in_array($all_plan->Id , $level)): ?>
                        <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="customRadio_<?php echo $all_plan->Id; ?>" checked>
                                  <label class="custom-control-label dashboard-title3 " style="text-transform:none;" for="customRadio_<?php echo $all_plan->Id; ?>"><?php echo $all_plan->plan_title; ?></label>
                        </div>
                        <?php else: ?>
                        <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="customRadio_<?php echo $all_plan->Id; ?>" >
                                  <label class="custom-control-label dashboard-title3 " style="text-transform:none;" for="customRadio_<?php echo $all_plan->Id; ?>"><?php echo $all_plan->plan_title; ?></label>
                        </div>
                        <?php endif; ?>
                        <?php endforeach ;?>
                        
                        
                        
                        
                        
                        
                        
                        
                    </form>
                    </div>


                    <div class="col-xl-8 col-lg-7 module-card-div">
                    <form action="javascript:void(0)" id="addModule" method=POST enctype=multipart/form-data>                   
                            <div class="drop-shadow card-holder secondary-color1-background" style="height:auto;">

                                <div class="row">
                                    <div class="col-xl-2 col-12 horizontal-middle-flex module-image-show"  >
                                        <label class="primary-color1 primary-color1-border text-center text-xl-left" style="font-size: 35px;border: 5px dashed rgba(255,255,255)!important; padding: 10px 20px;" for="input-file-display-picture-module">
                                            <i class="flt flaticon-upload white"></i>
                                        </label>
                                    </div>
                                    <input type="file" id="input-file-display-picture-module" class="file-upload-hidden" name="moduleImage">
                                    <div class="col-xl-7 col-12 "  style="margin-bottom:20px;" >
                                        
                                        <h6 class=" white text-xl-left text-center" style="margin-bottom:0px;margin-top:20px;">ENTER MODULE NAME:</h6>
                                        <input type="text" class="new-module-input dashboard-title3-bold white" style="text-transform:none;"id = 'moduleTitle'>

                                    </div>
                                    <div class="col-xl-3 col-12 backend-module-edit-iconsholder" style="justify-content:center;">
                                        <div id = "addModuleButton" class="btn theme-rounded-button white-background secondary-color1 white-border white-border-hover white-hover transparent-background-hover">ADD MODULE</div>  
                                                                           
                                    </div>
                                </div>
                            </div>                            
                        
                        <div class="generated-modules" id = "Modules">
                            <?php
                            $post_id = $results[0]["ID"];
                            $modules = $wpdb->get_results( "SELECT * FROM ".module_db_name()." WHERE course_id = '".$post_id."' ORDER BY id ASC", ARRAY_A );
                            $i = 0;
                            $total = count($modules);
                            foreach($modules as $module)
                            {
                            $res = $wpdb->get_results( "SELECT * FROM ".$val." WHERE ID = '".$module["module_id"]."' ", ARRAY_A );
                            $image = get_post_meta($res[0]["ID"],'fitpro_th_module_image');
                            echo '<div class="drop-shadow card-holder" >
                                        <div class="row">
                                            <div class="col-xl-2 col-2 backend-module-edit-iconsholder-left">
                                                <img src="'.$image[0].'" class="backend-module-icon">
                                            </div>
                                            <div class="col-xl-6 col-10 module-name " style="height:50px;">
                                                <h6 class="dashboard-title3-bold primary-color1 module-name">'.$res[0]["post_title"].'</h6>
                                            </div>
                                            <div class="col-xl-4 col-12 backend-module-edit-iconsholder justify-content-center justify-content-xl-end">';
                            if($res[0]["post_status"] == "publish")
                                echo '<button class="btn theme-rounded-button secondary-color1-border secondary-color1-border-hover secondary-color1 white-hover transparent-background secondary-color1-background-hover top-bar-button" style="opacity:1;" value="'.$res[0]["ID"].'" id="draft">Unpublish</button>';
                            else if($res[0]["post_status"] == "draft")
                                echo '<button class="btn theme-rounded-button secondary-color1-border secondary-color1-border-hover secondary-color1 white-hover transparent-background secondary-color1-background-hover top-bar-button" style="opacity:1;" value="'.$res[0]["ID"].'" id="publish">Publish</button>';
                            if($i == 0)
                            {
                               echo '<button class="flaticon-downwards-arrow-key flt grey" style="padding-left:10px;padding-right:10px;transform: rotate(180deg);border:0px;background:transparent;cursor:inherit;" value="'.$res[0]["ID"].'" type="button"></button>';
                            }
                            else
                            {
                                echo '<button class="flaticon-downwards-arrow-key flt secondary-color1" style="padding-left:10px;padding-right:10px;transform: rotate(180deg);" id="moduleUp" value="'.$res[0]["ID"].'" type="button"></button>';
                            }
                            if($i == $total-1)
                            {
                                echo '<button class="flaticon-downwards-arrow-key flt grey" style="padding-left:10px;padding-right:10px;border:0px;background:transparent;cursor:inherit;"  value="'.$res[0]["ID"].'" type="button"></button>';
                            }
                            else
                            {
                                echo '<button class="flaticon-downwards-arrow-key flt secondary-color1" style="padding-left:10px;padding-right:10px;" id="moduleDown" value="'.$res[0]["ID"].'" type="button"></button>';
                            }
                            echo'               <a href = "'.site_url().'/admin/edit_module.php?id='.$res[0]["ID"].'" style="padding-left:10px;padding-right:10px;"><i class="flt flaticon-writing" ></i></a>
                                                <i class="flaticon-rubbish-bin flt secondary-color1" style="padding-left:10px;padding-right:10px;" id = "moduleDelete'.$i.'"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $(document).ready(function(){
                                            $("#moduleDelete'.$i.'").click(function () {
                                            var postvalue = "ID='.$module["module_id"].'";  
                                            var url = "'.FITPRO_THEME_BTX_fun_module_delete_api_url().'";
                                            $.post(url,postvalue,function(response){
                                                var jsonData = jQuery.parseJSON(response);
                                                console.log(jsonData);
                                                location.reload();
                                            });
                                        });
                                        });
                                    </script> 
                                    ';
                            $i++;
                            }
                            ?>
                        </div>
                        
                        <!--<div class="drop-shadow card-holder" >-->
                        <!--    <div class="row">-->
                        <!--        <div class="col-2 backend-module-edit-iconsholder-left">-->
                        <!--            <img src="images/sample/module1.png" class="backend-module-icon">-->
                        <!--        </div>-->
                        <!--        <div class="col-6">-->
                        <!--            <h6 class="dashboard-title3-bold primary-color1 module-name">MODULE X: Client connection</h6>-->
                        <!--        </div>-->
                        <!--        <div class="col-4 backend-module-edit-iconsholder ">-->
                        <!--            <a href = "google.com" ><i class="flt flaticon-writing" ></i></a>-->
                        <!--            <i class="flaticon-rubbish-bin flt secondary-color1" style="padding-left:10px;"></i>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </form> 
                    </div>

                </div>

                <button class="delete-button drop-shadow btn theme-rounded-button white-hover secondary-color1-background-hover secondary-color1-border secondary-color1-border-hover secondary-color1 white-background" id = "deleteButton" style="z-index:2;" >DELETE</button>
                <button class="save-button drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover white-background-hover" id="saveButton" style="z-index:2;">SAVE</button>
                <div class="d-none d-xl-block drop-shadow" style="background-color: rgba(255,255,255,0.85);position: fixed;right: 19px;top: 108px;height: 80px;width: 250px;z-index: 1;"></div>
                
            <form id = "ModuleData">
                <input type = "hidden" id = "titledata" name = "title" value = "Module Title">
                <input type = "hidden" id = "post" name = "post_id">
                <input type = "hidden" id = "image_link" name = "image_link" value = "<?php echo get_site_url()."/resources/images/no-image.jpg"; ?>">
            </form>
            
            <script>
            $(document).on('click', '#draft' ,function(e){
                var sendData1 = new FormData();
                sendData1.append('ID' , $(this).val());
                $.ajax({
                    url: "ajax_call/draft.php",
                    data : sendData1,
            		async: false,
                    contentType: false,
                    processData: false,
                    cache: false,
            		type : "POST",
                    success : function(data) {
                        location.reload();
                    }
                });
            });
            </script>
            
            <script>
            $(document).on('click', '#publish' ,function(e){
                var sendData1 = new FormData();
                sendData1.append('ID' , $(this).val());
                $.ajax({
                    url: "ajax_call/publish.php",
                    data : sendData1,
            		async: false,
                    contentType: false,
                    processData: false,
                    cache: false,
            		type : "POST",
                    success : function(data) {
                        location.reload();
                    }
                });
            });
            </script>
            
            <script>
            $(document).ready(function(){
                $("#deleteButton").click(function () {
                var postvalue = {'ID':'<?php echo $results[0]["ID"]; ?>'}; 
                console.log(postvalue);
                var url = "<?php echo FITPRO_THEME_BTX_fun_course_delete_api_url();?>";
                console.log(postvalue);
                $.post(url,postvalue,function(response){
                    window.location.replace("<?php echo get_site_url()."/admin/course_list.php";?>");
                });
            });
            });
            </script>            

            <script>
            $(document).ready(function(){
                $('#input-file-display-picture').change(function(){
                    var total_file=document.getElementById("input-file-display-picture");
                    
                    $('.backend-course-image').html("<img src="+URL.createObjectURL(event.target.files[0]) + ">");
                    
                });
                /*
                $(document).on ("click", "#cross-button" ,function(){
                    
                    document.getElementById("input-file-now-custom-1").value = "";
                    $('#file-preview').html("");
                    $('#file-preview').removeClass(" drop-shadow card-holder");
                });
                */
            });
            </script>
            
            <script>
            $(document).ready(function(){
                $('#input-file-display-picture-module').change(function(){
                
                    var total_file=document.getElementById("input-file-display-picture-module");
                    $('.module-image-show').html("<img src="+URL.createObjectURL(event.target.files[0]) + ">");
                    
                });
                /*
                $(document).on ("click", "#cross-button" ,function(){
                    
                    document.getElementById("input-file-now-custom-1").value = "";
                    $('#file-preview').html("");
                    $('#file-preview').removeClass(" drop-shadow card-holder");
                });
                */
            });
            
            </script>
            
            <script>
                $(document).on('click', "#saveButton", function(e) {
                    var res = "";
                    <?php 
                    $all_plans = get_all_plan() ;
                    //print_r($all_plans);
                    foreach($all_plans as $all_plan)
                    {
                        echo 'if(document.getElementById("customRadio_'.$all_plan->Id.'").checked){ res = res+"'.$all_plan->Id.',";}';
                    }
                    ?>
                    res = res.slice(0,-1);
                    res = res.replace(",", "%2C");
                    if(document.getElementById("input-file-display-picture").files.length != 0)
                    {
                        var formData = new FormData();
                        var total_files=document.getElementById("input-file-display-picture").files;
                        var link;
                        formData.append('image',total_files[0]); 
                        $.ajax({
                            url: 'ajax_call/imageuploadaction.php',
                            data: formData,
                            async: true,
                            contentType: false,
                            processData: false,
                            cache: false,
                            type: 'POST',
                            beforeSend : function()
                            {
                                //console.log("SENDING"+total_files[0].name);//can add animation before send
                            },
                            success: function(data)
                            {
                                link = data;
                                jQuery("#FeaturedImageLink").val(link);
                                var postvalue =  jQuery("#AddCourse").serialize();
                                var url = "<?php echo FITPRO_THEME_BTX_fun_course_update_api_url();?>";
                                //console.log(postvalue);
                                $.post(url,postvalue,function(response){
                                    var jsonData = jQuery.parseJSON(response);
                                    //console.log(jsonData);
                                    location.reload();
                                });
                            },
                            error: function(e) 
                            {
                                $("#err").html(e).fadeIn();
                            }         
                        });
                    }
                    else
                    {
                        var postvalue =  jQuery("#AddCourse").serialize();
                        postvalue = postvalue + "&userLevel="+res;
                        var url = "<?php echo FITPRO_THEME_BTX_fun_course_update_api_url();?>";
                        //console.log(postvalue);
                        $.post(url,postvalue,function(response){
                            var jsonData = jQuery.parseJSON(response);
                            //console.log(jsonData);
                            location.reload();
                        });
                    }
                    
                });
            </script>  
            
            <script>
            $(document).on('click', "#addModuleButton", function(e) {
                if(document.getElementById("input-file-display-picture-module").files.length != 0)
                {
                    var formData = new FormData();
                    var total_files2=document.getElementById("input-file-display-picture-module").files;
                    var link;
                    formData.append('image',total_files2[0]); 
                    $.ajax({        
                        url: 'ajax_call/imageuploadaction.php',
                        data: formData,
                        async: true,
                        contentType: false,
                        processData: false,
                        cache: false,
                        type: 'POST',
                        beforeSend : function()
                        {
                            console.log("SENDING"+total_files2[0].name);//can add animation before send
                        },
                        success: function(data)
                        {
                            link = data;
                            jQuery("#image_link").val(link);
                            var title = $('#moduleTitle').val();
                            jQuery("#titledata").val(title);
                            var id = '<?php echo $results[0]["ID"];?>';
                            jQuery("#post").val(id);
                            var postvalue = jQuery("#ModuleData").serialize();
                            var url = "<?php echo FITPRO_THEME_BTX_fun_module_add_api_url();?>";
                            console.log(postvalue);
                            $.post(url,postvalue,function(response){
                                //console.log(response);
                                var jsonData = jQuery.parseJSON(response);
                                console.log(jsonData);
                                var sendData = new FormData();
                                sendData.append('postData' , '<?php echo $results[0]["ID"]; ?>');
                                $.ajax({
                            		url : 'ajax_call/showModule.php',
                            		data : sendData,
                            		async: false,
                                    contentType: false,
                                    processData: false,
                                    cache: false,
                            		type : 'POST',
                                    success : function(data) {
                                        //console.log(data);
                            			$('#Modules').html(data);
                                    }
                		        });
            	            });
                        },
                    });
                }
                else
                {
                    alert("No Image");
                }
            });
            </script>
            
            <script>
                $(document).on('click', '#moduleUp' ,function(e){
                    var sendData1 = new FormData();
                    sendData1.append('ID' , $(this).val());
                    console.log(sendData1);
                    $.ajax({
                        url: "ajax_call/moveUp.php",
                        data : sendData1,
                		async: false,
                        contentType: false,
                        processData: false,
                        cache: false,
                		type : "POST",
                        success : function(data) {
                            var sendData = new FormData();
                            sendData.append('postData' , '<?php echo $results[0]["ID"]; ?>');
                            $.ajax({
                        		url : "ajax_call/showModule.php",
                        		data : sendData,
                        		async: false,
                                contentType: false,
                                processData: false,
                                cache: false,
                        		type : "POST",
                                success : function(data) {
                                    $("#Modules").html(data);
                                }
            		        });
                        }
                    });
                });
            </script> 
            
            <script>
                $(document).on('click', '#moduleDown' ,function(e){
                    var sendData1 = new FormData();
                    sendData1.append('ID' , $(this).val());
                    $.ajax({
                        url: "ajax_call/moveDown.php",
                        data : sendData1,
                		async: false,
                        contentType: false,
                        processData: false,
                        cache: false,
                		type : "POST",
                        success : function(data) {
                            var sendData = new FormData();
                            sendData.append('postData' , '<?php echo $results[0]["ID"]; ?>');
                            $.ajax({
                        		url : "ajax_call/showModule.php",
                        		data : sendData,
                        		async: false,
                                contentType: false,
                                processData: false,
                                cache: false,
                        		type : "POST",
                                success : function(data) {
                                    $("#Modules").html(data);
                                }
            		        });
                        }
                    });
                });
            </script>
            
        </div> 
    </div>

    
    <script src="../resources/js/dashboard.js"></script>

</body>

</html>