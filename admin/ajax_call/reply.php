<?php
require('../common-config.php');
include_once "../../wp-config.php";

$comment_id = $_POST["comment_id"];
$comment_content = $_POST["comment_content"];

if(empty($comment_id))
{
    echo "error";
}
if(empty($comment_content))
{
    wp_set_comment_status($comment_id, 'approve');
}
else
{
    wp_set_comment_status($comment_id, 'approve');
    $comment = get_comment($comment_id);
    $time = current_time('mysql');
    $user_info = get_userdata(get_current_user_id());
    $userloginname = $user_info->user_login;
    $nicename = $user_info->user_nicename;
    $email = $user_info->user_email;
    $data = array(
        'comment_post_ID' => $comment->comment_post_ID,
        'comment_author' =>  $nicename,
        'comment_author_email' => $email,
        'comment_content' => $comment_content,
        'comment_type' => '',
        'comment_parent' => $comment_id,
        'user_id' => get_current_user_id(),
        'comment_date' => $time,
        'comment_approved' => 1,
    );
    
    wp_insert_comment($data);
}
?>