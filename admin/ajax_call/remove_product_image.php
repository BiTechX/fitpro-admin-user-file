<?php
include_once "../../wp-config.php";
if ( ! function_exists( 'wp_handle_upload' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
}
if (file_exists (ABSPATH.'/wp-admin/includes/taxonomy.php')) {
    require_once (ABSPATH.'/wp-admin/includes/taxonomy.php'); 
}
use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    site_url(), // Your store URL
    'ck_6d9ccb7c073d847e292d60be042cb445e78640a8', // Your consumer key
    'cs_2e7128f3e2248fb3d93dd2800bda1c1c279132e9', // Your consumer secret
    [
        'wp_api' => true, // Enable the WP REST API integration
        'version' => 'wc/v3' // WooCommerce WP REST API version
    ]
);

$product = new WC_product($_POST['id']);
$attachmentIds = $product->get_gallery_image_ids();
$imgUrls = array();

foreach( $attachmentIds as $attachmentId )
{
	if($_POST['image_id'] != $attachmentId)
	    $imgUrls[] = wp_get_attachment_url( $attachmentId );
}

$updated_images = [array('src' => get_the_post_thumbnail_url($_POST['id']))];

for($i = 0 ; $i < count($imgUrls) ; $i++)
{
    array_push($updated_images , array('src' => $imgUrls[$i]));
}

$data = [
    'images' => $updated_images
];

$woocommerce->put('products/'.$_POST['id'], $data);

echo "Done";

?>