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
    
    $start = $wpdb->get_results( "SELECT * FROM ".module_db_name()." WHERE module_id = '".$post_id."' ", ARRAY_A );
    $previous = $start[0]['id'];
    $result = $wpdb->get_results( "SELECT * FROM ".module_db_name()." WHERE course_id = '".$start[0]['course_id']."' AND id < '".$previous."' ORDER BY id DESC LIMIT 1", ARRAY_A );
    if(count($result) == 0)
    {
        echo "error";
        exit;
    }
    $target = $result[0]['id'];
    
    $wpdb->update( 
    	module_db_name(), 
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
    	module_db_name(), 
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
    	module_db_name(), 
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