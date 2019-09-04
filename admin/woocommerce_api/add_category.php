<?php
include_once "../../wp-config.php";

$api_response;

if(isset($_POST['category_description']))
{
    $api_response = wp_remote_post( get_site_url().'/wp-json/wc/v3/products/categories', array(
     	'headers' => array(
    		'Authorization' => 'Basic ' . base64_encode( 'ck_6d9ccb7c073d847e292d60be042cb445e78640a8:cs_2e7128f3e2248fb3d93dd2800bda1c1c279132e9' )
    	),
    	'body' => array(
    	    'name' => $_POST['category_name'],
    	    'description' => $_POST['category_description']
    	)
    ) );
}
else
{
    $api_response = wp_remote_post( get_site_url().'/wp-json/wc/v3/products/categories', array(
     	'headers' => array(
    		'Authorization' => 'Basic ' . base64_encode( 'ck_6d9ccb7c073d847e292d60be042cb445e78640a8:cs_2e7128f3e2248fb3d93dd2800bda1c1c279132e9' )
    	),
    	'body' => array(
    	    'name' => $_POST['category_name'],
    	)
    ) );
}

if( wp_remote_retrieve_response_message( $api_response ) === 'Created' ) {
	echo 1;
}
else
{
    echo 2;
}

?>