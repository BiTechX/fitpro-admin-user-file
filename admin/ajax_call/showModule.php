<?php

$post_id = $_POST["postData"];
require_once('../../wp-content/plugins/fit-pro-plugin/lib/api-call.php');
include_once "../../wp-config.php";
include_once('../../wp-content/plugins/fit-pro-plugin/fit-pro-plugin.php');

global $wpdb;
global $post;
$val = $wpdb->prefix . "posts";
$modules = $wpdb->get_results( "SELECT * FROM ".module_db_name()." WHERE course_id = '".$post_id."' ORDER BY id ASC", ARRAY_A );
$i = 0;
$total = count($modules);
foreach($modules as $module)
{
$res = $wpdb->get_results( "SELECT * FROM ".$val." WHERE ID = '".$module["module_id"]."'", ARRAY_A );
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
echo                '<a href = "'.site_url().'/admin/edit_module.php?id='.$res[0]["ID"].'" style="padding-left:10px;padding-right:10px;"><i class="flt flaticon-writing" ></i></a>
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
                    location.reload();
                });
            });
            });
        </script> 
        ';
$i++;
}
?>