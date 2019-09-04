<?php
require('common-config.php');
if(empty($_GET['id']))
{
    return;
}
require_once('../wp-content/plugins/fit-pro-plugin/lib/api-call.php');
include_once "../wp-config.php";

global $wpdb;
global $post;

// echo $wpdb->prefix;
$val = $wpdb->prefix . "posts";
$results =  $wpdb->get_results( "SELECT * FROM ".$val." WHERE ID = '".$_GET['id']."' ", ARRAY_A );
$course =  $wpdb->get_results( "SELECT * FROM ".module_db_name()." WHERE module_id = '".$_GET['id']."' ", ARRAY_A );
$image = get_post_meta($results[0]["ID"],'fitpro_th_module_image');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Edit Module</title>

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
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">    
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="../resources/css/flaticon/flaticon.css">
    <link rel="stylesheet" href="../resources/css/colors.php">
    <link rel="stylesheet" href="../resources/css/dashboard.php">
    
    
    

     
</head>

<script>
    
    $(document).ready(function(){
        $('#input-file-display-picture').change(function(){
            var total_file=document.getElementById("input-file-thumbnail");
            
            $('.backend-module-thumbnail').html("<img src="+URL.createObjectURL(event.target.files[0]) + ">");
            
        });
        
        $(document).on ("click", "#cross-button" ,function(){
            
            document.getElementById("input-file-now-custom-1").value = "";
            $('#file-preview').html("");
            $('#file-preview').removeClass(" drop-shadow card-holder");
        });
        
    });
     function ValidVideo(title,url) {
        var tit = title;
         
        if(url === ""){
            return true;
        }
        var pat = url.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
        var res = url.search('https://player.vimeo.com/video/');
        
        if(/^ *$/.test(tit)){
           alert("Please check video name") ;
           return false
        }
        else if(pat == null ||  res != 0){
             alert("Please use the format: https://player.vimeo.com/video/12345678") ;
            return false;
        }
        else{
            return true;
        }
    }
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
        

            <h1 class="dashboard-title primary-color1 padding-15px"><a href = "<?php echo get_site_url()."/admin/edit_course.php?course=".$course[0]['course_id']; ?>"><i class="flaticon-back"></i></a>  Edit module</h1>
            
            
                
                <div class="row no-margin">
                    <div class="col-xl-4 col-lg-5 scrollbar-change secondary-color1-scrollbar  backend-overflow-div">
                        <form action="javascript:void(0)" id="EditModule" method=POST enctype=multipart/form-data>    
                        <div class="drop-shadow card-holder">
                            
                            
                            <div class="row" style="margin-bottom:20px;">
                                <div class="col-xl-4 backend-module-thumbnail-holder">
                                
                                    <label class="backend-module-thumbnail primary-color1 primary-color1-border text-center text-xl-left" style="font-size: 40px;cursor: initial;" for="input-file-thumbnail">
                                        <img src = "<?php echo $image[0]; ?>" >
                                    </label>
                                   
                                                                  
                                </div>
                                <div class="col-xl-8">
                                    <h6 class="dashboard-title3-bold primary-color1 text-center text-xl-left" style="margin-top:20px;">click here to</h6>
                                    <h6 class="dashboard-title3-bold primary-color1 text-center text-xl-left" >upload a thumbnail</h6>
                                    <div class="display-picture-iconsholder justifycontent-left-tablet-center" >
                                        <label class="flt flaticon-upload primary-color1" for="input-file-display-picture" ></label>
                                         
                                        <input type="file" id="input-file-display-picture" class="file-upload-hidden"  name = "imageFile"/>
                                    </div>
                                </div>
                            </div>   
                            <input type = "hidden" value = "<?php echo $image[0]; ?>" id = "image_link" name = "image_link">
                            <input type = "hidden" value = "<?php echo $_GET["id"]; ?>" id = "module_id" name = "module_id">
                            <div class="form-group" >
                                <h6 class="dashboard-title3-bold primary-color1 text-center text-xl-left" style="margin-bottom:20px">module name</h6>
                                <input type="text" class="form-control" style="margin-bottom:0px" name = "title" value = "<?php echo $results[0]['post_title']; ?>" placeholder = "<?php echo $results[0]['post_title']; ?>">
                            </div>

                        </div>
                        
                        </form>
                    
                        <div id="module-files">
                            <?php $files = $wpdb->get_results( "SELECT * FROM ".TableName_module_file()." WHERE Module_ID = '".$_GET["id"]."' ", ARRAY_A ); $i = 0;
                            foreach($files as $file)
                            {
                            echo '<div class="drop-shadow card-holder" id = "file-preview">
                                    <div class="row">
                                        <div class="col-1 backend-module-edit-iconsholder backend-module-edit-iconsholder-left">
                                            <i class="flt flaticon-document"></i>
                                        </div>
                                        <div class="col-7">
                                            <h6 class="primary-color1 module-name">'.$file["File_Name"].'</h6>
                                        </div>
                                        <div class="col-4 backend-module-edit-iconsholder " >
                                            
                                            <i id= "remove'.$i.'" class="flt flaticon-rubbish-bin secondary-color1" style="padding-left:10px;"></i>
                                            <input type="hidden" id="check'.$i.'" value= "'.$file['File_ID'].'" >
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $("#remove'.$i.'").click(function(){
                                        var file = $("#check'.$i.'").val();
                                        var formData = new FormData();
                                        formData.append("fileID" , file);
                                        formData.append("moduleID" , "'.$_GET["id"].'");
                                        $.ajax({
                                            url: "ajax_call/remove.php",
                                            data: formData,
                                            async: false,
                                            contentType: false,
                                            processData: false,
                                            cache: false,
                                            type: "POST",
                                            success: function(data)
                                            {
                                                var sendData = new FormData();
                                                sendData.append("postData" , "'.$_GET["id"].'");
                                                $.ajax({
                                            		url : "ajax_call/showFile.php",
                                            		data : sendData,
                                            		async: false,
                                                    contentType: false,
                                                    processData: false,
                                                    cache: false,
                                            		type : "POST",
                                                    success : function(data) {
                                                        //console.log(data);
                                                        console.log("here");
                                            			$("#module-files").html(data);
                                            		},
                                            	});
                                            },
                                        });
                                    });
                                </script>';
                                $i++;
                            }
                            ?>
                        </div>    

                        
                        <div class="card-holder" style="padding:0px;border:0px;">
                                <div class="form-group" style="margin-bottom:0px;">
                                  <div class="file-upload-wrapper-dashed">
                                    <label for="input-file-now-custom-1" class="file-upload-label">
                                        <div class="primary-color1-dashed-border">   
                                            <i class="flaticon-new-file file-icon primary-color1"></i>
                                            <h6 class="dashboard-title3 primary-color1">Drag and drop files</h6>
                                            <p class="primary-color1" style="margin-bottom:0px;padding-bottom:1rem;">OR</p>
                                        </div>
                                        <p class="primary-color1-background white dashboard-title3" style="padding:15px;margin-bottom:0px;">Browse files</p>
                                    </label>
                                    <input type="file" id="input-file-now-custom-1" class="file-upload-dashed"/>
                                    
                                    </div>
                                </div>
                                
                        </div>
                        
                        <div id="file-preview" class="file-preview">
                            
                        </div>
    
                        
    
                    </div>
                    <div class="col-xl-8 col-lg-7">
                        <div class="text-center text-lg-left">

                        <form action="javascript:void(0)" id="AddVideo" method='POST' enctype='multipart/form-data'>
                        <div class="drop-shadow card-holder secondary-color1-background">
                            <div class="row" style="justify-content: center;cursor:pointer;margin-bottom:20px;">
    
                                
                                <i class="flaticon-add-1 module-add-plus white" style="margin-right:10px;font-size: 30px;"></i>
                                <h6 class="dashboard-title3-bold module-name white">add video</h6>
                              
                            <input type = "hidden" value = "<?php echo $_GET["id"]; ?>" id = "module_id" name = "module_id">    
                            </div>
                            <div class="form-group" >
                                <h6 class="dashboard-title3-bold white" style="margin-bottom:20px">video name</h6>
                                <input type="text" class="form-control" style="margin-bottom:0px" id="Video_title" name = "title" required>
                            </div>

                            <div class="form-group" >
                                <h6 class="dashboard-title3-bold white" style="margin-bottom:20px">video link <span style="text-transform:none;font-weight:400;word-break: break-word;">(Please use the format: https://player.vimeo.com/video/12345678)</span></h6>
                                <input type="text" class="form-control" style="margin-bottom:0px" id="Video_url" name = "url" >
                            </div>

                            <div class="form-group" >
                                <h6 class="dashboard-title3-bold white" style="margin-bottom:20px">video details</h6>
                                <div class="dashboard-title3-bold white-background primary-color1" style="margin-bottom:20px;text-transform:none;" id = "video-description-div" ><p>video description</p></div>
                                <input class="form-control white-background primary-color1" cols="5" style="margin-bottom:0px" name = "description" id = "video-description" type = "hidden">
                                
                            </div>
                            <button class="drop-shadow btn theme-rounded-button white secondary-color1-background white-border white-border-hover secondary-color1-hover white-background-hover" id = "saveVideo" type = "submit">SAVE VIDEO</button>
                        </div>
                        </form>
                        <div id = "Videos">
                        <?php
                        $val = $wpdb->prefix . "posts";
                        $videos = $wpdb->get_results( "SELECT * FROM ".video_db_name()." WHERE module_id = '".$_GET["id"]."' ORDER BY id ASC", ARRAY_A );
                        $i = 0;
                        $total = count($videos);
                        foreach($videos as $video)
                        {
                        $res = $wpdb->get_results( "SELECT * FROM ".$val." WHERE ID = '".$video["video_id"]."' ", ARRAY_A );
                        $link = get_post_meta($res[0]["ID"],'fitpro_th_videos_url');
                        echo '<div class="drop-shadow card-holder" >
                                    <form action="javascript:void(0)" id="EditVideo'.$i.'" method="POST" enctype="multipart/form-data" >
                                    <div class="row">
                        
                                        <div class="col-xl-8 col-12">
                                            <h6 class="dashboard-title3-bold primary-color1 module-name justify-content-center justify-content-xl-start">'.$res[0]["post_title"].'</h6>
                                        </div>
                                        <div class="col-xl-4 col-12 text-center text-xl-right backend-module-edit-iconsholder  justify-content-center justify-content-xl-end ">';
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
                            echo            '<a  data-toggle="collapse" href="#video'.$i.'" style="padding-left:10px;padding-right:10px;"><i class="flt flaticon-writing" ></i></a>
                                            <i class="flaticon-rubbish-bin flt secondary-color1" style="padding-left:10px;padding-right:10px;" id="videoDelete'.$i.'"></i>
                                        </div>
                                    </div>
                                    <div class="collapse" id="video'.$i.'" style="margin-top:20px;">
                                        <input type = "hidden" value = "'.$res[0]["ID"].'" name = "video_id">
                                        <div class="form-group">
                                            <h6 class="dashboard-title3-bold primary-color1" style="margin-bottom:20px">video name</h6>
                                            <input type="text" class="form-control" style="margin-bottom:0px" id = "video_title_'.$i.'" name = "title" value = "'.$res[0]["post_title"].'">
                                        </div>
                        
                                        <div class="form-group" >
                                            <h6 class="dashboard-title3-bold primary-color1" style="margin-bottom:20px">video link</h6>
                                            <input type="text" class="form-control" style="margin-bottom:0px" id = "video_url_'.$i.'" name = "url" value = "'.$link[0].'">
                                        </div>
                        
                                        <div class="form-group" >
                                            <h6 class="dashboard-title3-bold primary-color1" style="margin-bottom:20px;">video details</h6>
                                            <div class="dashboard-title3-bold" style="margin-bottom:20px;text-transform:none;" id = "edit-video-description'.$i.'"></div>
                                            <input class="form-control" cols="5" style="margin-bottom:0px" name = "description" id = "video-description'.$i.'" type = "hidden">
                                        </div>
                                        
                                        <button class="drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover white-background-hover" type = "submit" id = "EditButton'.$i.'">SAVE VIDEO</button>
                                    </div>
                                    </form>
                                </div>
                                <script>
                                    var html = "'.html_entity_decode($res[0]["post_content"]).'";
                                    var quill'.$i.' = new Quill("#edit-video-description'.$i.'", {
                                      modules: {
                                        toolbar: [
                                          ["bold", "italic","underline","color","align"],
                                          [{ list: "ordered" }, { list: "bullet" }],
                                          ["link", "blockquote"]
                                        ]
                                      },
                                      theme: "snow"
                                    });
                                    quill'.$i.'.root.innerHTML = html;
                                </script>
                                <script>
                                    $(document).ready(function(){
                                        $("#videoDelete'.$i.'").click(function () {
                                        var postvalue = "ID='.$video["video_id"].'";  
                                        var url = "'.FITPRO_THEME_BTX_fun_video_delete_api_url().'";
                                        $.post(url,postvalue,function(response){
                                            var jsonData = jQuery.parseJSON(response);
                                            var sendData = new FormData();
                                            sendData.append("postData" , "'.$_GET["id"].'");
                                            $.ajax({
                                        		url : "ajax_call/showVideo.php",
                                        		data : sendData,
                                        		async: false,
                                                contentType: false,
                                                processData: false,
                                                cache: false,
                                        		type : "POST",
                                                success : function(data) {
                                                    $("#Videos").html(data);
                                        		},
                                        	});
                                        });
                                    });
                                    });
                                </script> 
                                <script>
                                $(document).on("click", "#EditButton'.$i.'", function(e) {
                                    var title =jQuery("#video_title_'.$i.'").val();
                                    var url = jQuery("#video_url_'.$i.'").val();
                                    if(ValidVideo(title,url) ){
                                        var video_description = document.querySelector("input[id=video-description'.$i.']");
                                        video_description.value = quill'.$i.'.root.innerHTML;
                                        var postvalue =  jQuery("#EditVideo'.$i.'").serialize();
                                        var url = "'.FITPRO_THEME_BTX_fun_video_update_api_url().'";
                                        console.log(postvalue);
                                        $.post(url,postvalue,function(response){
                                            location.reload();
                                        });
                                    }
                                });
                                </script>
                                '
                                ;
                        $i++;
                        }
                        ?>
                        </div>
                    </div>
                
                </div>

                <button class="delete-button drop-shadow btn theme-rounded-button white-hover secondary-color1-background-hover secondary-color1-border secondary-color1-border-hover secondary-color1 white-background" id = "deleteButton" style="z-index:2;" >DELETE</button>
                <button class="save-button drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover white-background-hover" id="saveButton" style="z-index:2;">SAVE</button>
                <div class="d-none d-xl-block drop-shadow" style="background-color: rgba(255,255,255,0.85);position: fixed;right: 19px;top: 108px;height: 80px;width: 250px;z-index: 1;"></div>
                
    
                
            
            
            
        </div>
    </div>
    
    <script>
        var quill = new Quill('#video-description-div', {
          modules: {
            toolbar: [
              ['bold', 'italic','underline','color','align'],
              [{ list: 'ordered' }, { list: 'bullet' }],
              ['link', 'blockquote']
            ]
          },
          theme: 'snow'
        });
    </script>

    <script>
        $(document).ready(function(){
            $("#deleteButton").click(function () {
            var postvalue = {'ID':'<?php echo $results[0]["ID"]; ?>'}; 
            console.log(postvalue);
            var url = "<?php echo FITPRO_THEME_BTX_fun_module_delete_api_url();?>";
            console.log(postvalue);
            $.post(url,postvalue,function(response){
                window.location.href = "<?php echo get_site_url()."/admin/edit_course.php?course=".$course[0]['course_id']; ?>";
            });
        });
        });
    </script>  
    
    <script>
        $(document).on('click', "#saveButton", function(e) {
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
                    success: function(data)
                    {
                        link = data;
                        jQuery("#image_link").val(link);
                        var postvalue =  jQuery("#EditModule").serialize();
                        var url = "<?php echo FITPRO_THEME_BTX_fun_module_update_api_url();?>";
                        console.log(postvalue);
                        $.post(url,postvalue,function(response){
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
                var postvalue =  jQuery("#EditModule").serialize();
                var url = "<?php echo FITPRO_THEME_BTX_fun_module_update_api_url();?>";
                console.log(postvalue);
                $.post(url,postvalue,function(response){
                    location.reload();
                });
            }
            
        });
    </script>
    
    
    <script>
   
        $(document).on('click', "#saveVideo", function(e) {
            var title =jQuery("#Video_title").val();
            var url = jQuery("#Video_url").val();
            if(ValidVideo(title,url) ){
                jQuery("#AddVideo")
                // Populate hidden form on submit
                var video_description = document.querySelector('input[name=description]');
                video_description.value = quill.root.innerHTML;
                var postvalue =  jQuery("#AddVideo").serialize();
                var url = "<?php echo FITPRO_THEME_BTX_fun_video_add_api_url();?>";
                console.log(postvalue);
                $.post(url,postvalue,function(response){
                    //console.log(response);
                    var jsonData = jQuery.parseJSON(response);
                    var sendData = new FormData();
                    sendData.append("postData" , "<?php echo $_GET["id"]; ?>");
                    $.ajax({
                		url : "ajax_call/showVideo.php",
                		data : sendData,
                		async: false,
                        contentType: false,
                        processData: false,
                        cache: false,
                		type : "POST",
                        success : function(data) {
                            //console.log(data);
                            console.log("here");
                			$("#Videos").html(data);
                		},
                	});
                });
                
                
            }
            
            
            
        });
    </script>
    
    <script>
        
        var moduleGetID = '<?php echo $results[0]["ID"]; ?>'; // will have to replace with $_GET FROM PHP 
        
        function makeid(length) {
           var result           = '';
           var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
           var charactersLength = characters.length;
           for ( var i = 0; i < length; i++ ) {
              result += characters.charAt(Math.floor(Math.random() * charactersLength));
           }
           return result;
        }
        
        $(document).ready(function(){
            $('#input-file-now-custom-1').change(function(){
                var total_file=document.getElementById("input-file-now-custom-1").files.length;
                
                for(var i=0;i<total_file;i++)
                {
                    var ID = makeid(5);
                    $('#module-files').append('<div class="drop-shadow card-holder" id = "file-preview">'+
                            '<div class="row">'+
                                '<div class="col-1 backend-module-edit-iconsholder backend-module-edit-iconsholder-left">'+
                                    '<i class="flt flaticon-document"></i>'+
                                '</div>'+
                                '<div class="col-7">'+
                                    '<h6 class="primary-color1 module-name">'+ event.target.files[i].name +'</h6>'+
                                '</div>'+
                                '<div class="col-4 backend-module-edit-iconsholder "  >'+
                                    '<i id= "remove" class="flt flaticon-rubbish-bin secondary-color1" style="padding-left:10px;"></i>'+
                                    '<input type="hidden" id="check" value= "'+ID+'" >'+
                                '</div>'+
                            '</div>'+
                        '</div>');
                
                    var formData = new FormData();
                    formData.append('moduleFiles', event.target.files[i]); 
                    formData.append('fileID' , ID);
                    formData.append('moduleID' , moduleGetID);
                	$.ajax({
                        url: 'ajax_call/process.php',
                        data: formData,
                        async: true,
                        contentType: false,
                        processData: false,
                        cache: false,
                        type: 'POST',
                        beforeSend : function()
                        {
                            console.log("SENDING"+event.target.files[i].name);//can add animation before send
                        },
                        success: function(data)
                        {
                            if(data=='File_Size_Exceeded')
                            {
                                //can add animation for error
                            }
                            else if(data == 'done')
                            {
                                var sendData = new FormData();
                                sendData.append("postData" , "<?php echo $_GET["id"]; ?>");
                                $.ajax({
                            		url : "ajax_call/showFile.php",
                            		data : sendData,
                            		async: false,
                                    contentType: false,
                                    processData: false,
                                    cache: false,
                            		type : "POST",
                                    success : function(data) {
                                        //console.log(data);
                                        console.log("here");
                            			$("#module-files").html(data);
                            		},
                            	});
                            }
                        },
                        error: function(e) 
                        {
                            $("#err").html(e).fadeIn();
                        }         
                    });  
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '#moduleUp' ,function(e){
            var sendData1 = new FormData();
            sendData1.append('ID' , $(this).val());
            console.log(sendData1);
            $.ajax({
                url: "ajax_call/videoMoveUp.php",
                data : sendData1,
        		async: false,
                contentType: false,
                processData: false,
                cache: false,
        		type : "POST",
                success : function(data) {
                    var sendData = new FormData();
                    sendData.append("postData" , "<?php echo $_GET["id"]; ?>");
                    $.ajax({
                		url : "ajax_call/showVideo.php",
                		data : sendData,
                		async: false,
                        contentType: false,
                        processData: false,
                        cache: false,
                		type : "POST",
                        success : function(data) {
                            $("#Videos").html(data);
                		},
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
                url: "ajax_call/videoMoveDown.php",
                data : sendData1,
        		async: false,
                contentType: false,
                processData: false,
                cache: false,
        		type : "POST",
                success : function(data) {
                    var sendData = new FormData();
                    sendData.append("postData" , "<?php echo $_GET["id"]; ?>");
                    $.ajax({
                		url : "ajax_call/showVideo.php",
                		data : sendData,
                		async: false,
                        contentType: false,
                        processData: false,
                        cache: false,
                		type : "POST",
                        success : function(data) {
                            $("#Videos").html(data);
                		},
                	});
                }
            });
        });
    </script>
    
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
    
    <script src="../resources/js/dashboard.js"></script>
    
</body>

</html>