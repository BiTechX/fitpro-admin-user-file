<?php
include_once "../../wp-config.php";
global $wpdb;
global $post;
$comment_id = $_POST["comment_id"];


if(empty($comment_id))
{
    return;
}
$val = $wpdb->prefix . "posts";
$comment = get_comment($comment_id);
$results =  $wpdb->get_results( "SELECT * FROM ".$val." WHERE ID = '".$comment->comment_post_ID."' ", ARRAY_A );
$site_url="";
if($results[0]['post_type'] == 'videos')
{
    $site_url = get_site_url()."/user/video.php?id=".$comment->comment_post_ID;
}
else
{
    $site_url = get_permalink($results[0]['ID']);
}
$site_url = get_site_url();
$time1=time();
$time2 = strtotime($comment->comment_date);
$diff = $time1-$time2;
$diff1 = floor($diff/60);
$diff2 = floor($diff1/(60));
$diff3 = floor($diff2/(24));
$diff4 = floor($diff3/(30));
$res = "";
if($diff4 > 0) $res = $diff4." months ago";
else if($diff3 > 0) $res = $diff3." days ago";
else if($diff2 > 0) $res = $diff2." hours ago";
else if($diff1 > 0) $res = $diff1." minutes ago";
else $res = $diff . " seconds ago";
if(!$comment->comment_approved)
{
echo '<div class="text-center text-xl-left" style="margin-bottom:20px;">
        <button class="drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover 
        transparent-background-hover margin-bottom-10px-mobile" id = "approve" >APPROVE THIS COMMENT</button>   
    </div>';
}
echo '<div class="grey-border drop-shadow " style="padding:15px;margin-bottom:20px;">

        <div class="row no-margin" style="padding:15px;margin-bottom:20px;">
            <div class="col-1 no-padding">
                <i class="flaticon flaticon-chat horizontal-middle-flex" style="font-size:30px;vertical-align:middle;"></i>
            </div>
            <div class="col-11 no-padding-desktop" >
                <div>
                    <p class="small-text primary-color1 dashboard-title3-bold" style="text-transform:none;margin-top:10px;display:inline">'.$comment->comment_author.' commented on your video</p>
                    <p class="small-text secondary-color1 dashboard-title3-bold" style="text-transform:none;width:100%;">'.$results[0]['post_title'].'</p>
                </div>
            </div>

        </div>                           


        <div class="title-line">
      
        </div>

        <div class="row no-margin">
            <div class="col-3 no-padding" style="max-width:100px;">
                <img src="https://secure.gravatar.com/avatar/3592d72a6a42af850bb39243c55d0e29?s=96&amp;d=mm&amp;r=g" class=" profile-image-small" style="width:100%;max-width:80px;height:auto;">
            </div>
            <div class="col-9 ">
                <h4 class="dashboard-title3 primary-color1" style="word-break: break-all;">
                    '.$comment->comment_author.'
                </h4>
                <p class="small-text grey text-left" style="text-transform:none;">'.$res.'</p>


            </div>
        </div>
        <div class="row no-margin">
            <p class="primary-color1 small-text">'.$comment->comment_content.'</p>
        </div>
        <div class="form-group">
                <h6 class="dashboard-title3 primary-color1">Reply To Comment</h6>
                <input type = "hidden" id = "reply_id" value = "'.$comment->comment_ID.'">
                <textarea  class="form-control" name = "content" cols="5" id = "reply" ></textarea>
            </div>
            
        <div class="row no-margin">
            <div class="col-5 no-padding">
                <button class="drop-shadow btn theme-rounded-button white secondary-color1-background secondary-color1-border secondary-color1-border-hover secondary-color1-hover 
                transparent-background-hover margin-bottom-10px-mobile" id = "replyButton" >POST REPLY</button>                                    
            </div>
            <div class="col-7 no-padding">
                <a href="'.$site_url.'" ><p class="secondary-color1 dashboard-title3-bold text-right" style="margin-top:5px;">go to post</p></a>
            </div>
        </div>
    </div>';

?>