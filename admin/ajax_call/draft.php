<?php
$post_id = $_POST["ID"];

require_once('../../wp-content/plugins/fit-pro-plugin/lib/api-call.php');
include_once "../../wp-config.php";
include_once('../../wp-content/plugins/fit-pro-plugin/fit-pro-plugin.php');

global $wpdb;
global $post;

$val = $wpdb->prefix . "posts";

$wpdb->update( 
    	$val, 
    	array( 
    		'post_status' => "draft",
    	), 
    	array( 'id' => $post_id ), 
    	array( 
    		'%s'
    	), 
    	array( '%d' ) 
    );
    
?>