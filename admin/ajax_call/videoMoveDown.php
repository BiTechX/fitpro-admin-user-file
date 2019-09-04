<?php

$post_id = $_POST["ID"];
require_once('../../wp-content/plugins/fit-pro-plugin/lib/api-call.php');
include_once "../../wp-config.php";
include_once('../../wp-content/plugins/fit-pro-plugin/fit-pro-plugin.php');

if(empty($post_id))
{
    echo "error";
    exit;
}
else
{
    global $wpdb;
    global $post;
    
    $start = $wpdb->get_results( "SELECT * FROM ".video_db_name()." WHERE video_id = '".$post_id."' ", ARRAY_A );
    $previous = $start[0]['id'];
    $result = $wpdb->get_results( "SELECT * FROM ".video_db_name()." WHERE module_id = '".$start[0]['module_id']."' AND id > '".$previous."' ORDER BY id ASC LIMIT 1", ARRAY_A );
    if(count($result) == 0)
    {
        echo "error";
        exit;
    }
    $target = $result[0]['id'];
    
    $wpdb->update( 
    	video_db_name(), 
    	array( 
    		'id' => -1,
    	), 
    	array( 'id' => $target ), 
    	array( 
    		'%d'
    	), 
    	array( '%d' ) 
    );
    $wpdb->update( 
    	video_db_name(), 
    	array( 
    		'id' => $target,
    	), 
    	array( 'id' => $previous ), 
    	array( 
    		'%d'
    	), 
    	array( '%d' ) 
    );
    $wpdb->update( 
    	video_db_name(), 
    	array( 
    		'id' => $previous,
    	), 
    	array( 'id' => -1 ), 
    	array( 
    		'%d'
    	), 
    	array( '%d' ) 
    );
    echo "done";
}
?>