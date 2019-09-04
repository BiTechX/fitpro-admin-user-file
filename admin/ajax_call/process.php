<?php
    
    include_once "../../wp-config.php";
    
    if ( ! function_exists( 'wp_handle_upload' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    }
    
    global $wpdb;
    
    // Check file size
	if ($_FILES['moduleFiles']['size'] > 25000000) 
	{
		echo "File_Size_Exceeded";
	}
	else
	{
	    $name = $_FILES['moduleFiles']['name'];
		$uploadedfile = $_FILES['moduleFiles'];
    
        $upload_overrides = array( 'test_form' => false );
        
        $ModuleFile = wp_handle_upload( $uploadedfile, $upload_overrides );
        
        if ( $ModuleFile && ! isset( $ModuleFile['error'] ) ) {
            echo "done";
        } 
        else 
            echo $ModuleFile['error'];
	}
	
	//Insert File into database
    $wpdb->insert( 
    TableName_module_file(), 
    array( 
    	'Module_ID' => $_POST['moduleID'],
    	'File_Location' => $ModuleFile['url'],
    	'File_ID' => $_POST['fileID'],
    	'File_Name' => $name,
    ), 
    array( 
    	'%s','%s','%s'
    ));

?>