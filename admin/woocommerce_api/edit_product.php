<?php
include_once "../../wp-config.php";
if ( ! function_exists( 'wp_handle_upload' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
}
if (file_exists (ABSPATH.'/wp-admin/includes/taxonomy.php')) {
    require_once (ABSPATH.'/wp-admin/includes/taxonomy.php'); 
}

function string_fix($str)
{
    $res = site_url();
    $start = strpos($str , "/wp-content");
    $end = strpos($str , "?");
    $res = $res.substr( $str , $start , $end-$start );
    echo $res;
    return $res;
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

$time = strtotime($_POST['start_date']);

$startDate = date('Y-m-d',$time);

$time = strtotime($_POST['end_date']);

$endDate = date('Y-m-d',$time);

if (!empty($_FILES['mainImage']['name'])) 
{
	$name = $_FILES['mainImage']['name'];
	$uploadedfile = $_FILES['mainImage'];

    $upload_overrides = array( 'test_form' => false );
    
    $mainImage = wp_handle_upload( $uploadedfile, $upload_overrides );
    
    if ( $mainImage && ! isset( $mainImage['error'] ) ) {
        
        $product = new WC_product($_POST['id']);
    	$attachmentIds = $product->get_gallery_image_ids();
    	$imgUrls = array();
    	foreach( $attachmentIds as $attachmentId )
    	{
    		$imgUrls[] = wp_get_attachment_url( $attachmentId );
    	}
    	
        $uploadImage = [array('src' => $mainImage['url'])];
        
        for($i = 0 ; $i < count($imgUrls) ; $i++)
        {
            array_push($uploadImage , array('src' => $imgUrls[$i]));
        }
        
        $data = [
            'images' => $uploadImage
        ];
        
        $woocommerce->put('products/'.$_POST['id'], $data);
    } 
}

if(!empty($_FILES['secondaryImage']['name']))
{
    $product = new WC_product($_POST['id']);
	$attachmentIds = $product->get_gallery_image_ids();
	$imgUrls = array();
	foreach( $attachmentIds as $attachmentId )
	{
		$imgUrls[] = wp_get_attachment_url( $attachmentId );
	}
	
    $updated_images = [array('src' => get_the_post_thumbnail_url($_POST['id']))];
    
    for($i = 0 ; $i < count($imgUrls) ; $i++)
    {
        array_push($updated_images , array('src' => $imgUrls[$i]));
    }
    
    $upload_overrides = array( 'test_form' => false );
    
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
                echo $movefile['url'];
                array_push($updated_images,array('src' => $movefile['url']));
            }
        }
    }
    
    $data = [
        'images' => $updated_images
    ];
    
    $woocommerce->put('products/'.$_POST['id'], $data);
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
		'sale_price' => $_POST["sale_price"],
		'sku' => $_POST["sku"],
		'weight' => $_POST["weight"],
        'date_on_sale_from' => $startDate,
        'date_on_sale_to' => $endDate,
        'tags' => $tags_id,
	);

$api_response = $woocommerce->put('products/'.$_POST['id'] , $data);

$product = new WC_product($_POST['id']);
$product->set_category_ids([ $_POST['category'] ] );
$product->set_stock_quantity($_POST['stock_quantity']);
$product->save();

if( $api_response ) {
	
    $id = $_POST['id'];
    
    $wpdb->delete( product_collection_db_name() , array( 'product_id' => $id ) );
    
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