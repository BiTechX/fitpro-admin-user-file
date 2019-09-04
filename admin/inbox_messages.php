<?php

require('common-config.php');


$results = $wpdb->get_results ( "
    SELECT * FROM `".chat_message_db_name()."` WHERE  `recever_id` = $user_ID   GROUP BY  `sender_id`
");


$results_count = $wpdb->get_results ("
    SELECT * FROM `".chat_message_db_name()."` WHERE  `recever_id` = $user_ID  AND `is_view_reciver` = 0  GROUP BY  `sender_id`
");
//echo count($results_count);
$updated = update_user_meta( $user_ID, 'user_chat_status', 1 );   
/*
$results = get_users([ 
    'role__in'  => [ 'subscriber' ] ,
    ] );

*/
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Settings - Inbox Messages</title>

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
    <link rel="stylesheet" href="../resources/css/messages.css">
    <link rel="stylesheet" href="../resources/css/colors.php">
    <link rel="stylesheet" href="../resources/css/dashboard.php">

    
     
</head>


<style>

.disabledbutton {
    pointer-events: none;
    opacity: 0.4;
  
    
}
</style>
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
        

           
            <div class="row no-margin" style="margin-bottom:15px">
                <div class ="col-xl-7 col-12">
                    <!--
                    <div class="tb" style="align-items:center;">
                     <h1 class="dashboard-title primary-color1 padding-15px" style="margin-bottom:0px"><a href=""><i class="flaticon-back"></i></a> Inbox <span class="secondary-color1 dashboard-title padding-15px" style="margin-bottom:0px;"><h2>3 NEW</h2></span></span> </h1>
                      <a href=""><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button">NOTIFICATIONS</button></a> 
                       <a href=""><button class="btn theme-rounded-button transparent-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button">PRODUCT UPDATES</button></a> 
                      <a href=""><button class="btn theme-rounded-button secondary-color1-border secondary-color1-border-hover secondary-color1 transparent-background top-bar-button current-page-button">MESSAGES</button></a>
                   </div>
                    -->

                </div>
                <div class ="col-xl-5 hide-row" style="display:grid ;align-items:center;justify-content: end;">
                    <div class="padding-15px text-lg-left text-center" style="align-items:center;">
                        <!--
                        <button class="drop-shadow btn theme-rounded-button white-hover secondary-color1-background-hover secondary-color1-border secondary-color1-border-hover secondary-color1 transparent-background" type="submit" style="">VIEW UNREAD</button>
                        <button class="drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover transparent-background-hover" type="submit" style="">CLEAR ALL</button>
                        -->
                        
                    </div>
                </div>
            </div>
            
          
                
                <div class="row no-margin">
                    <div class="col-xl-6 order-1 order-xl-0 padding-0-sm">
                        
                          <?php 
                            if(count($results) >= 1):
                            foreach($results as $result):  
                                $subsc_user_idinfo = get_userdata($result->sender_id);
                                //$subsc_user_idinfo = get_userdata($result->ID);
                                
                            ?>
                        
                        <div id="root_div_class_<?php echo $result->ID; ?>" class="row no-margin grey-border drop-shadow box-hide-sm comment padding-0-sm primary-color1-border-hover" style="padding:15px;margin-bottom:20px;">
                            
                          
                            <div class="row no-margin box-hide-pc  comment" style="width:100%;padding:15px;" id="subsc_user_info" data-id="<?php echo $subsc_user_idinfo->ID; ?>"  >
                             
                                 <div class="col-xl-1 col-2 no-padding ">
                                    <p class="text-center">
                                      <?php 
                                           
                                          $val = get_user_meta(  $subsc_user_idinfo->ID , 'profile_photo', true );
                                          if($val){
                                              $url_profile = get_site_url()."/wp-content/uploads/ultimatemember/".$subsc_user_idinfo->ID ."/".$val.'?'.rand(15587000000,1568712237);
                                          } 
                                          else{
                                              $url_profile = get_avatar_url($subsc_user_idinfo->ID ) ;
                                          }
                                        ?>
                                      <img src="<?php echo $url_profile; ?>" class="profile-img-msg">  
                                     </p>
                                </div>
                                <input type="hidden" value="178" id="comment_id">
                                <div class=" col-10 col-xl-7 no-padding-desktop">
                                    <div style="padding:0px 25px;" class="">
                                        <h4 class=" primary-color1 dashboard-title3-bold" style="text-transform:none;margin-top:10px;display:inline" id="author"><?php echo $subsc_user_idinfo->display_name ;?></h4>
                                        
                                        <?php 
                                        $sub_user_lastMessage = $wpdb->get_results ( "
                                            SELECT * FROM `".chat_message_db_name()."` WHERE  `sender_id` = $subsc_user_idinfo->ID  ORDER BY `ID` DESC  LIMIT 1;  
                                        ");
                                        $message = "";
                                        $elapsed = "";
                                        if(count($sub_user_lastMessage) >=1 ){
                                            $message = $sub_user_lastMessage[0]->message ;
                                            
                                            
                                            $datetime1 = new DateTime();
                                            $datetime2 = new DateTime(date('d-m-Y H:i:s',($sub_user_lastMessage[0]->sent_time)));
                                            $interval = $datetime2->diff($datetime1);
                                            $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
                                            $elapsed = $interval->format('%a');
                                            if($elapsed == 0){
                                                $hour = $interval->format('%H');
                                                $min = $interval->format('%i');
                                                $sec = $interval->format('%s');
                                                $elapsed = $hour." hours ago";
                                                if($hour == 0){
                                                    $elapsed = $min." minutes ago";
                                                    if($min == 0){
                                                        $elapsed = "now" ;
                                                    }
                                                }
                                                
                                            }else{
                                                $elapsed = date('d-m-Y H:i:s',($sub_user_lastMessage[0]->sent_time));
                                            }
                                            
                                            
                                        }
                                         ?>
                                        <p class="small-text primary-color1 dashboard-title3-bold" style="text-transform:none;width:100%;margin:5px 0px"><?php echo $message ; ?></p>
                                       <input type="hidden" id="user_last_chat_ID" value="<?php echo $sub_user_lastMessage[0]->ID ; ?>"/>
                                    </div>
                                </div>
                                <div class="col-xl-4  d-none d-xl-block">
                                    <p class="small-text grey text-left text-xl-right" style="text-transform:none;">
                                        <?php 
                                    
                                          
                                            
                                            echo $elapsed;
                                        
                                            
                                            
                                        ?>
                                    
                                        
                                    </p>
                                   <!-- <p class=" text-right" style="margin-bottom:0px;"><i class="flaticon-move-to-the-next-page-symbol flaticon secondary-color1"></i></p>-->
                                </div>
                                <div class="row no-margin" style="width:100%">
                                      <div class="title-line msg-line" style="">
                                  
                                      </div>
                                </div>      
                            </div>  
                            
                            
                            
                        </div>
                        <script>
                        <?php
                            if($sub_user_lastMessage[0]->is_view_reciver == 0){
                                   echo ' $("#root_div_class_'.$result->ID.'").addClass("primary-color2-border");';
                                }
                            
                        ?>
                            
                            $("#root_div_class_<?php echo $result->ID;?>").click(function(){
                             
                              $("*").removeClass("secondary-color1-border");
                              $(this).addClass("secondary-color1-border");
                               
                               
                            });
                           
                           
                        </script>
                         <?php endforeach; ?>
                            <?php else:
                                    echo "There are no messages currently . "
                            ?>
                            <?endif;?>
                        
                        
                      
                    </div>

                    <div class="col-xl-6  order-0 order-xl-1 padding-0-sm" id = "details" style="margin-bottom:20px;" >
                         
                    </div>
                </div>

              

                
             
          
          
        </div>
    </div>

    
    <script src="../resources/js/dashboard.js"></script>
    <script>
     var isscroll = true;
     var intervel  ;
     var Filecount = 0;
     var TotalChatMessage = 0;
     var fileData = {};
     
     var user_id_sub = $('#subsc_user_info').attr("data-id") ;
     var last_chatId = $("#user_last_chat_ID").val(); 
     var current_user = '<?php echo $user_ID;?>'; 
    
    
      $(document).on ("click", "#subsc_user_info" ,function(event){
                event.preventDefault();
                
                 clearInterval(intervel);
                 clearTimeout(intervel)
            
                 isscroll = true;
                 fileData = {};
                 TotalChatMessage = 0;
                 Filecount = 0;
                 
                 
                 user_id_sub = $(this).attr("data-id") ;
                 last_chatId = $("#user_last_chat_ID").val(); 
                 current_user = '<?php echo $user_ID;?>'; 
                
                //alert(user_id_sub);
                
                 var postData = {
                     "sender_id" : current_user,
                     "reciver_id" : user_id_sub,
                     "last_message" : last_chatId
                 }  
                 $('#details').html('');
                 console.log(postData);
                 
                 
        
                    var url = "<?php echo FITPRO_THEME_BTX_fun_chat_view_change_url();?>";
                   
                  
                    $.ajax({
                        url: url,
                        data: postData,
                        type: 'POST',
                        beforeSend : function()
                        {
                             $('#details').html('');
                            $("body").addClass("disabledbutton");
                            jQuery("#subsc_user_info").prop("disabled",true);
                        },
                        success: function(result){
                            Filecount = 0;
                            console.log(result);
                            jQuery("#subsc_user_info").prop("disabled",false);
                            call_chat_box();
                        },
                        error: function(e) 
                        {
                           window.location.href = "";
                        }   
                        
                    });
          
                 
          
    });
      
      
      
      
      
      
      function call_chat_box(){
            clearInterval(intervel);
            clearTimeout(intervel)
            TotalChatMessage = 0;
            $('#details').load('ajax_call/chat/user_message_box_chat.php?sender='+<?php echo $user_ID;?>+'&receiver='+user_id_sub,function (response, status, xhr) {
                        if(status == 'success'){
                            
                        isscroll = true;
                        clearInterval(intervel);
                        clearTimeout(intervel)
                           
                        function loadlink(){
                            console.log(user_id_sub);
                            $('#chatMessageLoad').load('ajax_call/chat/admin_chat.php?sender='+<?php echo $user_ID;?>+'&receiver='+user_id_sub,function (response, status, xhr) {
                                //console.log(response);
                                //console.log(status);
                                //console.log(xhr);
                               if(isscroll){
                                    $("*").removeClass("disabledbutton");
                                    $("#chatMessageLoad").animate({ 
                                        scrollTop: $('#chatMessageLoad').get(0).scrollHeight
                                    }, "slow");
                                    isscroll = false;
                               }
                               
                               
                            });
                        }
                        
                        
                        function ChatMessageCounter(){
            
            
                            var postvalue =  {
                                     'sender_id'  : '<?php echo $user_ID;?>',
                                     'reciver_id'  : user_id_sub,
                                 };
                            var url = "<?php echo FITPRO_THEME_BTX_fun_chat_message_count_user_url();?>";     
                            $.ajax({
                                        url: url,
                                        data: postvalue,
                                        type: 'POST',
                                        beforeSend : function()
                                        {
                                           
                                        },
                                        success: function(result){
                                            
                                            console.log(result);
                                            var data = jQuery.parseJSON(result);
                                            if (data.status == 1) {
                                                var newMessageCount = data.message;
                                                console.log(TotalChatMessage);
                                                if(TotalChatMessage < newMessageCount){
                                                     loadlink();
                                                     TotalChatMessage = newMessageCount;
                                                }
                                                
                                                intervel = setTimeout(ChatMessageCounter, 5000);
                                                
                                               
                                            }
                                          
                                        },
                                        error: function(e) 
                                        {
                                            console.log(e);
                                        }   
                                    
                                });
                                
                        }
                        ChatMessageCounter();
                        
                        /*
                        loadlink(); // This will run on page load
                        intervel = setInterval(function(){
                            loadlink() 
                        }, 2000);
                      
       */
                        
                        $("#buttonid").click(function(event){
                                event.preventDefault();
                                $('#fileid').click();
                        });  
                         
                        
                         $("#fileid").change(function(file){
                                
                               Filecount ++;
                               var input = file.target
                               fileData[Filecount] = this.files[0]
                                
                                //alert(this.files[0].size);
                                 
                                var fullPath = $(this).val();
                                var filename = "";
                                if (fullPath) {
                                    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                                    filename = fullPath.substring(startIndex);
                                    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                                        filename = filename.substring(1);
                                    }
                                }
                                 
                           
                                var url = URL.createObjectURL(this.files[0]);
                                console.log(url);
                                var reader = new FileReader();
                                reader.onload = function(){
                                var dataURL = reader.result;
                                if(Filecount >= 1){
                                    $('#textAddFile').html('<p class="primary-color1 small-text">File Attachment(s)</p>');
                                }else{
                                    $('#textAddFile').text("");
                                }
                                 
                                $('#MessageBoxImage').append("<div class='chat-file-send ' id='fileDiv' data-FileCount='"+  Filecount  +"'><a class='primary-color2-background primary-color1' style='padding:5px;' href='"+dataURL+"' target='_blank' download>"+filename+"</a><i class='flaticon-close deleteChatImage primary-color2-background primary-color1' style='padding: 2px 5px;cursor: pointer;'></i></div>");
                                  //output.src = dataURL;
                                };
                                reader.readAsDataURL(input.files[0]);
                        });
                         $("#MessageBox").keypress(function(event){
                                //event.preventDefault();
                                if(event.which == 13){
                                    $('#ChatForm').submit();
                                }
                        });  
                        
                         $(document).on ("click", ".deleteChatImage" ,function(event){
                             var val = $(this).parent().attr("data-FileCount");
                             delete fileData[val];
                             $(this).parent().remove();
                             Filecount--;
                              if(Filecount >= 1){
                                    $('#textAddFile').html('<p class="primary-color1 small-text">File Attachment(s)</p>');
                            }else{
                                $('#textAddFile').html("");
                            }
                         });
                         
                         $("#ChatForm").submit(function(event){
                                event.preventDefault();
                                $("i").remove(".deleteChatImage");
                                $('#MessageBox').attr("contentEditable","false");
           
                                var form = $('#ChatForm');
                                var data = $('#MessageBox').html();
                                
                                
                                var fileDataempty =  Object.entries(fileData).length === 0 && fileData.constructor === Object   ;
                               
                                if( fileDataempty == false  ){
                                    
                                    var formData = new FormData();
                                    jQuery.each(fileData, function(i, val) {
                                        formData.append('ChatFile[]',val);
                                    });
                                           
                                     $.ajax({
                                            url: "../user/ajax_call/Chat_file_uplode.php",
                                            data : formData ,
                                            type : 'POST',
                                            contentType : false,
                                            processData : false,
                                            
                                            beforeSend : function()
                                            {
                                                jQuery("#ActionButton").prop("disabled",true);
                                                jQuery("#ActionButton").html('<p class="white" style="margin-bottom:0px;">wait..</p>');
                                            },
                                            success: function(result){
                                                console.log(result)
                                                var data_return_file = JSON.parse(result);
                                                if(data_return_file.status == 1){
                                                    $('#MessageBoxImage').html(data_return_file.return);
                                                }
                                                
                                             
                                                var data2 = $('#MessageBoxImage').html();
                                    
                                                var Totaldata = data+data2
                    
                                               
                                                if( Totaldata.length >= 1 && Totaldata.length <= 2000000 &&  !(/^\s*$/.test(Totaldata))  ){
                                                     var postvalue =  {
                                                         'message' : Totaldata,
                                                         'sender_id'  : '<?php echo $user_ID;?>',
                                                         'reciver_id'  : user_id_sub,
                                                     };
                                                     var url = "<?php echo FITPRO_THEME_BTX_fun_chat_message_add_user_url();?>";
                                                     console.log(postvalue);
                                                  
                                                    $.ajax({
                                                        url: url,
                                                        data: postvalue,
                                                        type: 'POST',
                                                        beforeSend : function()
                                                        {
                                                            jQuery("#ActionButton").prop("disabled",true);
                                                            jQuery("#ActionButton").html('<p class="white" style="margin-bottom:0px;">wait..</p>');
                                                        },
                                                        success: function(result){
                                                             isscroll = true;
                                                             $('#MessageBox').html('');
                                                             $('#MessageBoxImage').html('');
                                                             $('#textAddFile').text("");
                                                             $('#MessageBox').attr("contentEditable","true");
                                                             fileData = {};
                                                            jQuery("#ActionButton").html('<i class="flaticon-send white icon-sm" style=""></i>');
                                                            jQuery("#ActionButton").prop("disabled",false);
                                                           
                                                        },
                                                        error: function(e) 
                                                        {
                                                            console.log(e);
                                                            alert("your are not allow this type of message");
                                                            $('#MessageBox').html('');
                                                            $('#MessageBoxImage').html('');
                                                            fileData = {};
                                                            $('#textAddFile').text("");
                                                            $('#MessageBox').attr("contentEditable","true");
                                                            jQuery("#ActionButton").html('<i class="flaticon-send white icon-sm" style=""></i>');
                                                            jQuery("#ActionButton").prop("disabled",false);
                                                        }   
                                                        
                                                    });
                                    
                                    
                                                }else{
                                                     alert("your message is too large or small");
                                                }
                                            },
                                            error: function(e) 
                                            {
                                                console.log(e);
                                               
                                               
                                            }   
                                            
                                        });
                                        
                                }else{
                                    
                                    var data = $('#MessageBox').html();
                                    var data2 = $('#MessageBoxImage').html();
                                    
                                    var Totaldata = data+data2
                                                
                                               
                                               
                                    if( Totaldata.length >= 1 && Totaldata.length <= 2000000 &&  !(/^\s*$/.test(Totaldata))  ){
                                        var postvalue =  {
                                            'message' : Totaldata,
                                            'sender_id'  : '<?php echo $user_ID;?>',
                                            'reciver_id'  : user_id_sub,
                                        };
                                        var url = "<?php echo FITPRO_THEME_BTX_fun_chat_message_add_user_url();?>";
                                        console.log(postvalue);
                                                  
                                        $.ajax({
                                            url: url,
                                            data: postvalue,
                                            type: 'POST',
                                            beforeSend : function()
                                            {
                                                jQuery("#ActionButton").prop("disabled",true);
                                                jQuery("#ActionButton").html('<p class="white" style="margin-bottom:0px;">wait..</p>');
                                            },
                                            success: function(result){
                                                isscroll = true;
                                                $('#MessageBox').html('');
                                                $('#MessageBoxImage').html('');
                                                fileData = {};
                                                $('#textAddFile').text("");
                                                $('#MessageBox').attr("contentEditable","true");
                                                console.log(result);
                                                jQuery("#ActionButton").html('<i class="flaticon-send white icon-sm" style=""></i>');
                                                jQuery("#ActionButton").prop("disabled",false);
                                                           
                                            },
                                            error: function(e) 
                                            {
                                                console.log(e);
                                                alert("your are not allow this type of message");
                                                $('#MessageBox').html('');
                                                $('#MessageBoxImage').html('');
                                                fileData = {};
                                                $('#textAddFile').text("");
                                                $('#MessageBox').attr("contentEditable","true");
                                                jQuery("#ActionButton").html('<i class="flaticon-send white icon-sm" style=""></i>');
                                                jQuery("#ActionButton").prop("disabled",false);
                                            }   
                                                        
                                        });
                                    
                                    
                                        }else{
                                            alert("your message is too large or small");
                                        }
                                    
                                    
                                }
                                
                                
                                
                                
                    
                                
                        });
                              
         
                        }
          
                });
      }
      
      
    </script>

   


</body>




</html>