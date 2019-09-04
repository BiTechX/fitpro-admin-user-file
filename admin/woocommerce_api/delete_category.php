<?php
include_once "../../wp-config.php";

$api_response = wp_remote_post( get_site_url().'/wp-json/wc/v3/products/categories/'.$_POST['id'], array(
    'method' => 'delete',
 	'headers' => array(
		'Authorization' => 'Basic ' . base64_encode( 'ck_6d9ccb7c073d847e292d60be042cb445e78640a8:cs_2e7128f3e2248fb3d93dd2800bda1c1c279132e9' )
	),
	'body' => array(
	    'force' => true    
	)
) );

if( wp_remote_retrieve_response_message( $api_response ) === 'OK' ) {
	echo 1;
}
else
{
    echo 2;
}

?>