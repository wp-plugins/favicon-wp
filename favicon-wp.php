<?php
/*
Plugin Name: Favicon WP
Plugin URI: http://plugins.extendedproduct.com/favicon-wp
Description: Allows you to display your own favicon on your website!
Version: 1.0.0
Author: ExtendedProduct
Author URI: http://www.extendedproduct.com
*/

/*  Copyright 2010 ExtendedProduct - support@extendedproduct.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Hook for adding admin menus
add_action('admin_menu', 'favicon_wp_add_pages');

// action function for above hook
function favicon_wp_add_pages() {
    add_options_page('Favicon WP', 'Favicon WP', 'administrator', 'favicon_wp', 'favicon_wp_options_page');
}

// favicon_wp_options_page() displays the page content for the Test Options submenu
function favicon_wp_options_page() {

    // variables for the field and option names
    $opt_name_1 = 'mt_Favicon_type';	
    $opt_name_5 = 'mt_Favicon_plugin_support';
	$opt_name_6 = 'mt_Favicon_amount';
    $hidden_field_name = 'mt_Favicon_submit_hidden';
	$data_field_name_1 = 'mt_Favicon_type';
    $data_field_name_5 = 'mt_Favicon_plugin_support';
	$data_field_name_6 = 'mt_Favicon_amount';

    // Read in existing option value from database
	$opt_val_1 = get_option($opt_name_1);
    $opt_val_5 = get_option($opt_name_5);
	$opt_val_6 = get_option($opt_name_6);
    

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
		$opt_val_1 = $_POST[$data_field_name_1];
        $opt_val_5 = $_POST[$data_field_name_5];
		$opt_val_6 = $_POST[$data_field_name_6];
		$opt_val_7 = $_POST["customurl"];
		$opt_val_8 = $_POST["customurl2"];
		$opt_val_9 = $_POST["customurl3"];

        // Save the posted value in the database
		update_option( $opt_name_1, $opt_val_1 );
        update_option( $opt_name_5, $opt_val_5 );
		update_option( $opt_name_6, $opt_val_6 );
		update_option( "mt_Favicon_custom", $opt_val_7 );
		update_option( "mt_Favicon_custom2", $opt_val_8 );
		update_option( "mt_Favicon_custom3", $opt_val_9 );

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'Favicon WP Plugin Options', 'mt_trans_domain' ) . "</h2>";

    // options form
    
    $change3 = get_option("mt_Favicon_plugin_support");

if ($change3=="Yes" || $change3=="") {
$change3="checked";
$change31="";
} else {
$change3="";
$change31="checked";
}

$customvar=get_option("mt_Favicon_custom");
$customvar2=get_option("mt_Favicon_custom2");

if ($customvar=="") {
$customvar="Enter URL to .ico image here";
}

if ($customvar2=="") {
$customvar2="Enter URL to .gif image here";
}
    ?>
<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<strong>It is recommended to use both the .ico file and .gif file - Both the same file in different formats - for maximum compatibility with browsers!</strong>

<p><?php _e("URLs to Image Files:", 'mt_trans_domain' ); ?> 
<br />URL to 16x16 or 32x32 pixel .ico file: <input type="text" name="customurl" value="<?php echo $customvar; ?>" /><br />
URL to 16x16 or 32x32 pixel .gif file: <input type="text" name="customurl2" value="<?php echo $customvar2; ?>" /><br /> 
</p><hr />

<p><?php _e("Show Plugin Support?", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="Yes" <?php echo $change3; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="No" <?php echo $change31; ?>>No
</p>

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p><hr />

</form>
<?php } ?>
<?php

function show_Favicon() {
$customvar=get_option("mt_Favicon_custom");
$customvar2=get_option("mt_Favicon_custom2");

?>
<link rel="shortcut icon" href="<?php echo $customvar; ?>" type="image/x-icon" />
<link rel="icon"          href="<?php echo $customvar2; ?>" type="image/gif"    />
<?php
}

$supportplugin=get_option("mt_Favicon_plugin_support");
if ($supportplugin=="" || $supportplugin=="Yes") {
add_action('wp_footer', 'Favicon_footer_plugin_support');
}

function Favicon_footer_plugin_support() {
  $pshow = "<p style='font-size:x-small'>Favicon Plugin made by <a href='http://www.xeromi.net'>Cheap Web Hosting</a></p>";
  echo $pshow;
}

add_action("wp_head", "show_Favicon");

?>
