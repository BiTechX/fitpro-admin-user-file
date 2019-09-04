<?php
include_once "../../wp-config.php";

$id = $_POST['id'];

$api_response = wp_remote_post( get_site_url().'/wp-json/wc/v2/products/'.$id, array(
    'method' => 'delete',
        'headers' => array(
            'Authorization' => 'Basic ' . base64_encode( 'ck_6d9ccb7c073d847e292d60be042cb445e78640a8:cs_2e7128f3e2248fb3d93dd2800bda1c1c279132e9' )
        ),
    ) 
);

if( wp_remote_retrieve_response_message( $api_response ) === 'OK' ) {
	$wpdb->delete( product_collection_db_name() , array( 'product_id' => $id ) );
	echo "ok";
}
?>