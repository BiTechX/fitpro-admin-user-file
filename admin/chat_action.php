<?php
require_once('../wp-content/plugins/fit-pro-plugin/lib/api-call.php');
include_once "../wp-config.php";
include_once('../wp-content/plugins/fit-pro-plugin/fit-pro-plugin.php');

$message = $_POST["chat_message"];
$user_id = $_POST["user_id"];
$job = $_POST["action"];

global $wpdb;
global $post;
$val = $wpdb->prefix . "chat";

if($job == "get_message")
{
$send = $wpdb->get_results( "SELECT * FROM ".$val." WHERE sender_userid = '".$user_id."' OR reciever_userid = '".$user_id."' ", ARRAY_A );

echo "done";
}
else if($job == "send_message")
{
    $table = $val;
    $value = array("sender_userid" => $user_id , "reciever_userid" => 1 , "status" => 0);
    $format = array('%d' , '%d' , '%d');
    $wpdb->insert($table,$value,$format);
    echo "done";
}
else if($job == "check_notifications")
{
    $send = $wpdb->get_results( "SELECT * FROM ".$val." WHERE reciever_userid = '".$user_id."' AND status = 0 ", ARRAY_A );
    echo count($send);
}

?>