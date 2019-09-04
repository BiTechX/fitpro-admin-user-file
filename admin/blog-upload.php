<?php  
require('common-config.php');  
wp_head();
wp_enqueue_media();
$action = "";
$post_id = "";
if(isset($_GET['action'])){
    if(empty($_GET['action'])){
        wp_redirect( site_url()."/admin/blog-upload.php?action=new" ); exit; 
    }
    else{
        $action = $_GET['action'];
    }
}
else{
      wp_redirect( site_url()."/admin/blog-upload.php?action=new" ); exit; 
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Subscription</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../resources/css/sidebar.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- jQuery CDN - Slim version (=without AJAX)
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     -->
    
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

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
        <div id="content" style="overflow: hidden;">
            <?php
                require('navbar-top.php');
            ?>
        

           
            <?php if($_GET['action'] == 'new') :?>
            <form action="javascript:void(0)" action = "post" id="NewBlogAdd" >
            
        
                <h1 class="dashboard-title primary-color1 padding-15px" style="width:100%;"><a href="homepage.php"><i class="flaticon-back" style="margin-right:20px;"></i></a>Upload New Blog: </h1>
                
                     <div class="form-group padding-15px">
                        <h6 for="exampleInputEmail1" class="dashboard-title3-bold primary-color1">Title</h6>
                        <input type="text" class="form-control" id="title" name="title"  placeholder="Enter Title">
                      </div>
                      <div class="form-group padding-15px">
                          <h6 class="dashboard-title3-bold primary-color1" style="margin-top:5px;">Description</h6>
                        <label for="exampleInputEmail1"></label>
                        <?php 
                          
                            $content = '';
                            $editor_id = 'description_blog';
                            $settings = array( 
                                'media_buttons' => true
                                );
                            wp_editor($content,$editor_id,$settings) 
                        
                        ;?>
                      </div>
                     
                      <div class="backend-course-image padding-15px" id="FileLink_view">
                                
                      </div>
                      <div class="form-group padding-15px">
                          <div class="drop-shadow card-holder row no-margin">
                                <div class="col-7 no-padding">
                                    <h6 class="dashboard-title3-bold primary-color1" style="margin-top:5px;">Set featured image </h6>
                                
                                </div>
                                <div class="col-5 no-padding display-picture-iconsholder">
                                    <label class="flt flaticon-upload primary-color1" for="input-file-display-picture" id="btnImage"></label>
                                    <input type="hidden" id="FileLink" name="FileLink">
                                     <input type="hidden" id="thumbnail_id" name="thumbnail_id" value="">
                                    <input type="hidden" id="userId" name="userId" value="<?php echo $user_ID ;?>">
                                    </div>
                            </div>
                        </div>    
                      
                      <div class="padding-15px text-lg-left text-center">
                            <button id="ActionButton" class="drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover transparent-background-hover" style="margin-bottom:20px" type="submit">Publish</button>
                        </div>
            </form>
            
            
            
            <?php elseif($_GET['action'] == 'edit' && !empty($_GET['post_id_new'])  ) :
                    $post   = get_post( $_GET['post_id_new'] );
                   
                   if(count($post) <= 0){
                        wp_redirect( site_url()."/admin/blog-upload.php?action=new" ); exit; 
                    }
                    $featured_img_url = get_the_post_thumbnail_url($_GET['post_id_new'],'full'); 
                    $featured_img_id = get_post_thumbnail_id($_GET['post_id_new'])
            ?>
            
            
            
            
            
             <form action="javascript:void(0)" action ="post" id="editBlog">
            
    
                <h1 class="dashboard-title primary-color1 padding-15px" style="width:100%;"><a href="homepage.php"><i class="flaticon-back" style="margin-right:20px;"></i></a>Edit Blog: </h1>
                
                     <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $post->post_title ;?>"  placeholder="Enter Title">
                      </div>
                      <div class="form-group">
                        <?php echo site_url(); ?><input type="text" id="name" name="name" value="<?php echo $post->post_name ;?>"  placeholder="Enter Title">
                      </div>
                      <div class="form-group">
                          <h6 class="dashboard-title3-bold primary-color1" style="margin-top:5px;">Description address </h6>
                        <label for="exampleInputEmail1"></label>
                        <?php 
                          
                            $content = $post->post_content;
                            $editor_id = 'description_blog';
                            $settings = array( 
                                'media_buttons' => true
                                );
                            wp_editor($content,$editor_id,$settings) 
                        
                        ;?>
                      </div>
                     
                      <div class="backend-course-image" id="FileLink_view">
                          <?php
                            if(!empty($featured_img_url)){
                                echo '<img src="'.$featured_img_url.'"';
                            }
                          ?>
                               
                      </div>
                      <div class="drop-shadow card-holder row no-margin no-padding">
                            <div class="col-7">
                                <h6 class="dashboard-title3-bold primary-color1" style="margin-top:5px;">Set featured image </h6>
                            
                            </div>
                            <div class="col-5 display-picture-iconsholder">
                                <label class="flt flaticon-upload primary-color1" for="input-file-display-picture" id="btnImage"></label>
                                <input type="hidden" id="FileLink" name="FileLink" value="<?php echo $featured_img_url;?>">
                                <input type="hidden" id="thumbnail_id" name="thumbnail_id" value="<?php echo $featured_img_id;?>">
                                <input type="hidden" id="userId" name="userId" value="<?php echo $user_ID ;?>">
                                </div>
                        </div>    
                      
                      <div class="padding-15px text-lg-left text-center">
                            <button id="ActionButton_edit" class="drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover transparent-background-hover" style="margin-bottom:20px" type="submit">Publish</button>
                        </div>
            </form>
        
            
        <script>
            
            
      $(document).on('submit', "#editBlog", function(e) {
        
                var post_id = '<?php echo $_GET['post_id_new'] ;?>';
                var postvalue =  jQuery("#editBlog").serialize();
                var url = "<?php echo FITPRO_THEME_BTX_fun_edit_new_blog_url();?>"+post_id;
                console.log(postvalue);
              
                $.ajax({
                    url: url,
                    data: postvalue,
                    type: 'POST',
                    beforeSend : function()
                    {
                        jQuery("#ActionButton_edit").prop("disabled",true);
                    },
                    success: function(result){
                        console.log(result);
                       
                        var data = jQuery.parseJSON(result);
                        if (data.status == 1) {
                            window.location.href ="?action=edit&post_id_new="+data.message;
                        }
                        jQuery("#ActionButton_edit").prop("disabled",false);
                       
                    },
                    error: function(e) 
                    {
                       //window.location.href = "";
                    }   
                    
                });

                
    });
            
        </script>
            
            
            <?php endif;?>
            
            
            
        </div>
    </div>

    
    <script src="../resources/js/dashboard.js"></script>
<?php wp_footer(); ?>

<script>

    jQuery("#btnImage").on("click", function() {
        var images = wp.media({
            title: "Upload File",
            multiple: false
        }).open().on("select", function(e) {
            var uploadedImages = images.state().get("selection").first();
            console.log(uploadedImages.toJSON());
            console.log(uploadedImages.toJSON().url);
            var FileLink = uploadedImages.toJSON().url;
            var thumbnail_id = uploadedImages.toJSON().id;
            jQuery("#FileLink").val(FileLink);
            jQuery("#thumbnail_id").val(thumbnail_id);
            jQuery("#FileLink_view").html("<img src='"+FileLink+"' />");
           
            
        });
    });
    
    
    
    
        
      $(document).on('submit', "#NewBlogAdd", function(e) {
        
     
           var postvalue =  jQuery("#NewBlogAdd").serialize();
                var url = "<?php echo FITPRO_THEME_BTX_fun_add_new_blog_url();?>";
                console.log(postvalue);
              
                $.ajax({
                    url: url,
                    data: postvalue,
                    type: 'POST',
                    beforeSend : function()
                    {
                        jQuery("#ActionButton").prop("disabled",true);
                    },
                    success: function(result){
                        console.log(result);
                       
                        var data = jQuery.parseJSON(result);
                        if (data.status == 1) {
                            window.location.href ="?action=edit&post_id_new="+data.message;
                        }
                        jQuery("#ActionButton").prop("disabled",false);
                       //window.location.href ="";
                    },
                    error: function(e) 
                    {
                       //window.location.href = "";
                    }   
                    
                });

                
    });
    
    
    
    
</script>
</body>

</html>
