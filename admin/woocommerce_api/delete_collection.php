<?php
include_once "../../wp-config.php";

$id = $_POST['id'];
$table = collection_db_name();
$collections = $wpdb->get_results("SELECT * FROM $table WHERE id = $id", ARRAY_A);

if( $wpdb->delete( $table , array( 'id' => $id ), array( '%d' ) )) {
	if($wpdb->delete( product_collection_db_name() , array( 'collection_name' => $collections[0]['collection_name'] ), array( '%s' ) ))
	{
	    echo 2;
	}
	else
    {
        echo 1;
    }
}


?>