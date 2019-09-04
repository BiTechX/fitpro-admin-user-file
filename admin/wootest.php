<?php
include_once "../wp-config.php";
//global $woocommerce;
//include_once "woo/index.php";

use Automattic\WooCommerce\Client;
//ck_58ca254b4d1b01e50e08a3a46f7c78e0fe7cf4f5
//cs_a8279c67aaf349c18711e4de9eac299f66d1076f
//new
//ck_6d9ccb7c073d847e292d60be042cb445e78640a8
//cs_2e7128f3e2248fb3d93dd2800bda1c1c279132e9
$woocommerce = new Client(
    site_url(), // Your store URL
    'ck_6d9ccb7c073d847e292d60be042cb445e78640a8', // Your consumer key
    'cs_2e7128f3e2248fb3d93dd2800bda1c1c279132e9', // Your consumer secret
    [
        'wp_api' => true, // Enable the WP REST API integration
        'version' => 'wc/v3' // WooCommerce WP REST API version
    ]
);


echo "<pre>";
//print_r($woocommerce->get('')); 
echo "</pre>";
 
//8e1ad7941398486f8cede7799b886b58
//print_r( $woocommerce->cart->get_cart_contents());

//$woocommerce->cart->add_to_cart(4319,7);
//$woocommerce->cart->remove_cart_item( '8e1ad7941398486f8cede7799b886b58' ) ;

print_r($woocommerce->get('products/tags'));
print_r($woocommerce->get('products'));

//$tag = $woocommerce->post('products/tags', $data);
/*
$data = [
    'name' => 'Premium Quality',
    'type' => 'simple',
    'regular_price' => '21.99',
    'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
    'short_description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
    'categories' => [
        [
            'id' => 9
        ],
        [
            'id' => 14
        ]
    ],
    "tags"=> [
            [
                'id'    => $tag->id, 
            ]
    ],
    'images' => [
        [
            'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_front.jpg'
        ],
        [
            'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_back.jpg'
        ]
    ]
];

print_r($woocommerce->post('products', $data));
*/