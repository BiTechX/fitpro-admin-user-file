<?php
include_once "../../wp-config.php";

$api_response = wp_remote_get( get_site_url().'/wp-json/wc/v3/products', array(
 	'headers' => array(
		'Authorization' => 'Basic ' . base64_encode( 'ck_6d9ccb7c073d847e292d60be042cb445e78640a8:cs_2e7128f3e2248fb3d93dd2800bda1c1c279132e9' )
	),
) );

$res = json_decode($api_response['body']);
print_r($res);
foreach($res as $re)
{
    print_r($re->id);
    echo "<br>";
    $api_response = wp_remote_post( get_site_url().'/wp-json/wc/v3/products/'.$re->id, array(
        'method' => 'delete',
 	'headers' => array(
		'Authorization' => 'Basic ' . base64_encode( 'ck_6d9ccb7c073d847e292d60be042cb445e78640a8:cs_2e7128f3e2248fb3d93dd2800bda1c1c279132e9' )
	),
) );
}
?>