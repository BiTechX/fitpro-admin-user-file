<?php

$post_id = $_POST["postData"];
require_once('../../wp-content/plugins/fit-pro-plugin/lib/api-call.php');
include_once "../../wp-config.php";
include_once('../../wp-content/plugins/fit-pro-plugin/fit-pro-plugin.php');

global $wpdb;
global $post;
$val = $wpdb->prefix . "posts";
$videos = $wpdb->get_results( "SELECT * FROM ".video_db_name()." WHERE module_id = '".$post_id."' ORDER BY id ASC", ARRAY_A );
$i = 0;
$total = count($videos);
foreach($videos as $video)
{
$res = $wpdb->get_results( "SELECT * FROM ".$val." WHERE ID = '".$video["video_id"]."' ", ARRAY_A );
$link = get_post_meta($res[0]["ID"],'fitpro_th_videos_url');
echo '<div class="drop-shadow card-holder" >
            <form action="javascript:void(0)" id="EditVideo'.$i.'" method=POST enctype=multipart/form-data >
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
                            
                echo '<a  data-toggle="collapse" href="#video'.$i.'" style="padding-left:10px;padding-right:10px;"><i class="flt flaticon-writing" ></i></a>
                    <i class="flaticon-rubbish-bin flt secondary-color1" style="padding-left:10px;padding-right:10px;" id="videoDelete'.$i.'"></i>
                </div>
            </div>
            <div class="collapse" id="video'.$i.'" style="margin-top:20px;">
                <div class="form-group" >
                    <h6 class="dashboard-title3-bold primary-color1" style="margin-bottom:20px">video name</h6>
                    <input type="text" class="form-control" style="margin-bottom:0px" name = "title" value = "'.$res[0]["post_title"].'">
                </div>
                <input type = "hidden" value = "'.$res[0]["ID"].'" name = "video_id">
                
                <div class="form-group" >
                    <h6 class="dashboard-title3-bold primary-color1" style="margin-bottom:20px">video link</h6>
                    <input type="text" class="form-control" style="margin-bottom:0px" name = "url" value = "'.$link[0].'">
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
                    sendData.append("postData" , "'.$post_id.'");
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
        </script>';
$i++;
}
?>