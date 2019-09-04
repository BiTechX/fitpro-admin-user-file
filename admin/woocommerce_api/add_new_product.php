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

$images = [];

if (!empty($_FILES['mainImage']['name'])) 
{
	$name = $_FILES['mainImage']['name'];
	$uploadedfile = $_FILES['mainImage'];

    $upload_overrides = array( 'test_form' => false );
    
    $mainImage = wp_handle_upload( $uploadedfile, $upload_overrides );
    
    if ( $mainImage && ! isset( $mainImage['error'] ) ) {
        
        array_push($images,array('src' => $mainImage['url']));
        
        if(!empty($_FILES['secondaryImage']['name']))
        {
            $files = $_FILES['secondaryImage'];
            foreach ($files['name'] as $key => $value) {
                  if ($files['name'][$key]) {
                    $uploadedfile = array(
                        'name'     => $files['name'][$key],
                        'type'     => $files['type'][$key],
                        'tmp_name' => $files['tmp_name'][$key],
                        'error'    => $files['error'][$key],
                        'size'     => $files['size'][$key]
                    );
                    $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
            
                    if ( $movefile && !isset( $movefile['error'] ) ) {
                        array_push($images,array('src' => $movefile['url']));
                    }
                }
            }
        }
    } 
}

$tags = explode("," , strtolower($_POST['tags']));

$tags_id = [];

foreach($tags as $tag)
{
    $flag = true;
    $existing_tags = $woocommerce->get('products/tags',['search' => $tag]);
    foreach($existing_tags as $e_tag)
    {
        if($e_tag->name == $tag)
        {
            array_push($tags_id , array('id' => $e_tag->id));
            $flag = false;
        }
    }
    if($flag)
    {
        $data = ['name' => $tag];
        $response = $woocommerce->post('products/tags' , $data);
        array_push($tags_id , array('id' => $response->id));
    }
}

// echo "<pre>";
// echo print_r($images);
// echo "<pre>";

if (FALSE === get_option('high_value') && FALSE === update_option('high_value',FALSE)) 
{
    add_option('high_value',$_POST["regular_price"]);
}
else
{
    if(get_option('high_value') < $_POST["regular_price"])   
        update_option('high_value',$_POST["regular_price"]);
}

if (FALSE === get_option('low_value') && FALSE === update_option('low_value',FALSE)) 
{
    add_option('low_value',$_POST["regular_price"]);
}
else
{
    if(get_option('low_value') > $_POST["regular_price"])   
        update_option('low_value',$_POST["regular_price"]);
}

$data = array(
		'name' => $_POST["name"], 
		'status' => 'publish', 
		'regular_price' => $_POST["regular_price"],
		'description' => $_POST["description"],
		'sku' => $_POST["sku"],
		'weight' => $_POST["weight"],
		'stock_quantity' => $_POST["stock_quantity"],
 		'images' => $images,
 		'tags' => $tags_id,
 		'manage_stock' => true,
 		'categories' => array(array('id' => $_POST['category']))
	);

$api_response = $woocommerce->post('products' , $data);


if( $api_response ) {
	
	$id = $api_response->id;
    $collections = explode("," , $_POST['collection']);
    
    foreach($collections as $collection)
    {
        $table = product_collection_db_name();
        $data = array('product_id' => $id , 'collection_name' => $collection);
        $format = array('%d','%s');
        $wpdb->insert($table,$data,$format);
    }
    
    echo "Done";
}

?>