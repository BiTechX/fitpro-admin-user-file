<?php
require('../../../wp-load.php');
$sender_id = "";
$reciver_id = "";
if(isset($_GET['sender']) && isset($_GET['receiver'])){
    if(!empty($_GET['sender']) &&  !empty($_GET['receiver'])){
        $sender_id = $_GET['sender'];
        $reciver_id = $_GET['receiver'];
    }
    else{
        echo "Please give sender and receiver info";
        exit;
    }
}


//echo $sender_id." ".$reciver_id;
$user_subsc_info = get_userdata($reciver_id);
?>
<style>

</style>
<div class="row no-margin grey-border drop-shadow b comment msg-padding" style="width:100%;align-items:center;">
                             
                                 <div class="col-xl-1 col-2 no-padding ">
                                    <p class="text-center" style="margin-bottom:0px;">
                                         <?php 
                                           
                                          $val = get_user_meta( $reciver_id  , 'profile_photo', true );
                                          if($val){
                                              $url_profile = get_site_url()."/wp-content/uploads/ultimatemember/".$reciver_id ."/".$val.'?'.rand(15587000000,1568712237);
                                          } 
                                          else{
                                              $url_profile = get_avatar_url($reciver_id ) ;
                                          }
                                        ?>
                               
                                      <img src="<?php echo $url_profile; ?>" class="profile-img-msg">  
                                     </p>
                                </div>
                                <div class=" col-6 col-xl-7 no-padding-desktop">
                                    <div style="padding:0px 25px;" class="">
                                        
                                        <h4 class=" primary-color1 dashboard-title3-bold" style="text-transform:none;margin-top:10px;display:inline" id="author">   <?php echo  $user_subsc_info->display_name ?> </h4>
                                       
                                    </div>
                                </div>
                                <div class="col-4">
                              
                                </div>
                                
                        <div id="chatMessageLoad" class="grey-border">
                           
                                
                        </div>
                             
                             
                             <form id='ChatForm' action="javascript:void(0)" method="post"  enctype="multipart/form-data" style="width:100%;">

                                 <div class =" row no-margin" style="width:100%;margin-top:10px;">
                                   <div class ="col-10">
                                       <div style="border-radius:100px;border:1px solid rgba(0,0,0,0.1);display:flex;align-items:center;justify-content:flex-end">
                                         
                                            <div contentEditable="true" class="form-control send-text" id="MessageBox"></div>
                                        
                                           <input type="file" name="fileToUpload" id='fileid' hidden>
                                           <i class="flaticon-link grey icon-sm link-button" style="" id='buttonid'></i>
                                          
                                           
                                       </div> 
                                       
                                   </div>
                                  
                                   
                                
                                   <div class="col-2 no-padding" style="display:flex;align-items:center;">
                                      <button type="submit"  class="send-button secondary-color1-background" id="ActionButton" >
                                            <i class="flaticon-send white icon-sm" style=""></i>
                                      </button>    
                                   </div>
                                    
                                 </div>
                                    <div class="padding-15px" style="margin-top:20px;">
                                         <div id="textAddFile"></div>
                                         <div id="MessageBoxImage"></div>  
                                   </div>
                             </form>
                             
                             
                             
                            </div>
                            
                            