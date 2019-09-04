<?php
include_once "../../wp-config.php";

$table = collection_db_name();
$data = array('collection_name' => $_POST['collection_name'] , 'collection_description' => $_POST['collection_description']);
$format = array('%s','%s');

if( $wpdb->insert($table,$data,$format) ) {
	echo 1;
}
else
{
    echo 2;
}

?>