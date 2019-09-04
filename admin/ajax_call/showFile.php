<?php

$post_id = $_POST["postData"];
require_once('../../wp-content/plugins/fit-pro-plugin/lib/api-call.php');
include_once "../../wp-config.php";
include_once('../../wp-content/plugins/fit-pro-plugin/fit-pro-plugin.php');

global $wpdb;
global $post;
$val = $wpdb->prefix . "posts";
$files = $wpdb->get_results( "SELECT * FROM ".TableName_module_file()." WHERE Module_ID = '".$post_id."' ", ARRAY_A );
$i = 0;
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
        formData.append("moduleID" , "'.$post_id.'");
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
                sendData.append("postData" , "'.$post_id.'");
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