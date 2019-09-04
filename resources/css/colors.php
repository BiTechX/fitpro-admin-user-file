<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/wp-load.php";
header("Content-type: text/css; charset: UTF-8");
 
  /**
     * 
     * hex2rgb() function use to change the hex to rgb colour convert
     * it have four parameter ($colour , $opacity ,$extra )
     * 
     * $colour is the hex code (required)
     * $opacity is use to add the opacity default value is 0.0  (optional)
     * $extra is use to extra attribute of css element default value (optional)
     * 
     * For example:
     *       echo hex2rgb('<?php echo $primary_color_1_HEX;  ?>' , '0.9'  , '!important' )  //input
     *       output is : rgba(14,43,61,0.9)!important
     * 
     * 
     * 
    */
    function hex2rgb( $colour , $opacity=0.0 , $extra = '' ) {
        if ( $colour[0] == '#' ) {
                $colour = substr( $colour, 1 );
        }
        if ( strlen( $colour ) == 6 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
        } elseif ( strlen( $colour ) == 3 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
        } else {
                return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        
        return 'rgba('.$r.','.$g.','.$b.','.$opacity.')'.$extra;

    }
   
    $options = get_option( 'theme_setting_change' );
    $primary_color_1_HEX = $options['opt-primary-color-1'];
    $primary_color_2_HEX = $options['opt-primary-color-2'];
    $secondary_color_1_HEX = $options['opt-secondary-color-1'];
    $secondary_color_2_HEX = $options['opt-secondary-color-2'];
    
   
    //echo $primary_color_1_HEX .'  '. hex2rgb($primary_color_1_HEX , '0.9','!important' )
?>




/* Primary Color 1 Navy blue */

.weird-problem
{

}

.primary-color1, .primary-color1-hover:hover
{
    color:<?php echo $primary_color_1_HEX;  ?>!important; 
    
}

.primary-color1-background, .primary-color1-background-hover:hover
{
	background-color:<?php echo $primary_color_1_HEX;  ?>!important;
}

.primary-color1-overlay:before
{
	background-color:<?php echo hex2rgb($primary_color_1_HEX , '0.9'); ?>;
}

.primary-color1-border, .primary-color1-border-hover:hover
{
    border: 2px solid <?php echo $primary_color_1_HEX;  ?>!important;
}


.primary-color1-background-transparent
{
    background-color:linear-gradient(<?php echo hex2rgb($primary_color_1_HEX , '0.9'); ?>, <?php echo hex2rgb($primary_color_1_HEX , '0.9'); ?> );
}

/* Primary Color 2 Yellow */
.primary-color2, .primary-color2-hover:hover
{
	color:<?php echo $primary_color_2_HEX;  ?>!important;
}
.primary-color2-background, .primary-color2-scrollbar::-webkit-scrollbar-thumb 
{
	background-color:<?php echo $primary_color_2_HEX;  ?>!important;
}

.primary-color2-background, .primary-color2-background-hover:hover
{
	background-color:<?php echo $primary_color_2_HEX;  ?>!important;
}

.primary-color2-overlay:before
{
	background-color:<?php echo hex2rgb($primary_color_2_HEX , '0.9'); ?>;
}


.primary-color2-border, .primary-color2-border-hover:hover
{
    border: 2px solid <?php echo $primary_color_2_HEX;  ?>!important;
}

/* Secondary Color 1 Red */
.secondary-color1, .et_pb_slide_content a, .et_pb_text_inner a, .secondary-color1-hover:hover
{
	color:<?php echo $secondary_color_1_HEX;  ?>!important;
}

.secondary-color1-background, .secondary-color1-background-hover:hover, .secondary-color1-scrollbar::-webkit-scrollbar-thumb 
{
	background-color:<?php echo $secondary_color_1_HEX;  ?>!important;
}


.secondary-color1-border, .secondary-color1-border-hover:hover
{
    border: 2px solid <?php echo $secondary_color_1_HEX;  ?>!important;
}

.secondary-color1-overlay:before
{
	background-color:<?php echo hex2rgb($secondary_color_1_HEX , '0.9'); ?>;
}


/* Secondary Color 2 Black*/
.secondary-color2
{
	color:<?php echo $secondary_color_2_HEX;  ?>;
}

/* White color */
.white, .white-hover:hover
{
	color:#fff!important;
}


.white-background, .white-background-hover:hover
{
	background-color:#fff!important;
}

.white-border, .white-border-hover
{
	border:2px solid #fff!important;
}

/* Transparent */
.transparent-background, .transparent-background-hover:hover
{
	background-color:transparent!important;
}

.transparent-border, .transparent-border-hover:hover
{
    border: 2px solid rgba(255,255,255,0)!important;
}

.grey-hover:hover, .transparent-border-hover:hover{
cursor:pointer;
}

.grey, .grey-hover:hover
{
    color:#7d7d7d !important;
    
}

.grey-border
{
    border: 2px solid rgba(0,0,0,0.1);    
}
.grey-background{
        background:#7d7d7d!important;
}
