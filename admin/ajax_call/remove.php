<?PHP

    include_once "../../wp-config.php";
    
    if ( ! function_exists( 'wp_handle_upload' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    }
    
    global $wpdb;
    
    // Check file size
	if(isset($_POST['fileID']) && isset($_POST['moduleID']))
    {
        //Insert File into database
        $wpdb->delete( 
        TableName_module_file(), 
        array( 
        	'Module_ID' => $_POST['moduleID'],
        	'File_ID' => $_POST['fileID'],
        ), 
        array( 
        	'%s','%s'
        ));
        echo "done";
    }

?>