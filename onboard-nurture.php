<?php
/**
 * @package onboard-nurture
 */
/*
Plugin Name: Onboard Nurture
Plugin URI: https://www.onboardinformatics.com/nav20
Description: The Nurture Bar component is a lead capture tool that automatically emails an in-depth property report and ongoing alerts when things change to the home value or area.  It is an effective way to not only capture online leads, but nurture them with content they 
Version: 1.0
Author: Onboard Informatics
Author URI: https://www.onboardinformatics.com/
Text Domain: Onboard Inc
*/

// File include using require_once from library folder
require_once(plugin_dir_path(__FILE__).'library/enqueuing.php' );

/*
Function name : obn_onboard_nurture_create
Discription : This function is used for display Onboard Nurture as admin menu over the wordpress admin panel
*/
add_action('admin_menu', 'obn_onboard_nurture_create');
function obn_onboard_nurture_create() {
    $page_title = 'Onboard Nurture';
    $menu_title = 'Onboard Nurture';
    $capability = 'edit_posts';
    $menu_slug = 'onboard_nurture_bar';
    $function = 'obn_custom_onboard_nurture_display';
    $icon_url = 'dashicons-location-alt';
    $position = 24;
    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}

/*
Function name : obn_custom_onboard_nurture_display
Discription : This function is used for display Nurture form when someone click on "Onboard Nurture" menu from wordpress admin panel, From this section user can save the script which is provided by Onboard Informatics to display property related lead on the website. 
*/
function obn_custom_onboard_nurture_display() {
	
	//Check form is posted or not
	if ( ! empty( $_POST ) ) {
		//Check for nonce field verification
		if (isset( $_POST['custom_onboard_nurture_display_field'] ) && $_POST['custom_onboard_nurture_display_field'] !="" || wp_verify_nonce( $_POST['custom_onboard_nurture_display_field'], 'obn_custom_onboard_nurture_display' )){
			
			//Update Lead widget text script code, It will capture user email, Phone number and Cell number field through iframe and send the specific notification to that user.
			//Update address 1 field
			if (isset($_POST['nurture_nav_address1']) && !empty($_POST['nurture_nav_address1'])) {   
				$nurture_nav_address1 = sanitize_text_field($_POST['nurture_nav_address1']);
				update_option('nurture_nav_address1', $nurture_nav_address1);
			}
			//Update address 2 field
			if (isset($_POST['nurture_nav_address2']) && !empty($_POST['nurture_nav_address2'])) {
				$nurture_nav_address2 = sanitize_text_field($_POST['nurture_nav_address2']);
				update_option('nurture_nav_address2', $nurture_nav_address2); 
			}
			//Update nav bar zip code field
			if (isset($_POST['nurture_nav_zip']) && !empty($_POST['nurture_nav_zip'])) {
				$nurture_nav_zip = sanitize_text_field($_POST['nurture_nav_zip']);
				update_option('nurture_nav_zip', $nurture_nav_zip);
			}
			if (isset($_POST['nurture_bar_text']) && !empty($_POST['nurture_bar_text'])) {
				
				//$nurture_bar_text = stripslashes(json_encode($_POST['nurture_bar_text']));
				$nurture_bar_text = sanitize_text_field(json_encode($_POST['nurture_bar_text']));
				//update_option('nurture_bar_text', $nurture_bar_text); //Update script code in wordpress with nurture_bar_text meta_value
				update_option('nurture_bar_text', $nurture_bar_text);
			}
		}
	}
	
	$nurture_nav_address1 	= get_option('nurture_nav_address1', ''); // get value of address 1 to display pre-filled in html form
    $nurture_nav_address2 	= get_option('nurture_nav_address2', ''); // get value of address 2 to display pre-filled in html form
    $nurture_nav_zip 		= get_option('nurture_nav_zip', ''); // get value of zip to display pre-filled in html form
	$wd_set = get_option('nurture_bar_text', ''); // get value of widget text script code to display pre-filled in html form
	
	if(!empty($wd_set)){
		//Get the saved value to pre-filled the data into form.
		$nurture_bar_text 	= stripslashes(json_decode($wd_set));  	
	}else{
		$nurture_bar_text 	= '';  	
	}
	
    //Get form from this file
    include 'nurture-bar-form-file.php';
}

/*
Function name : custom_nurture_shortcode
Discription : This function is used for generate shortcode so that user can easily use lead anywhere on his/her website. This lead widget display the form on your website to get the contact query which is related to property.
*/

function obn_custom_nurture_shortcode($atts) {
	
	if($atts['address1']=="" || $atts['address2']==""){
		return "Something went wrong, Please provide address1 and address2";
	}
	
	$leadbar_widget_script_set = get_option('nurture_bar_text');
	if(!empty($leadbar_widget_script_set)){
		$widgetScript 	= stripslashes(json_decode($leadbar_widget_script_set));  	
	}else{
		$widgetScript 	= $leadbar_widget_script_set;  	
	}
	
	$customAdd 			= "'address': '".$atts['address1']." ".$atts['zip'].", ".$atts['address2']."'";
	$widgetScript 		= str_replace("'address': ''",$customAdd,$widgetScript);
	
	echo  '<script type="text/javascript">'.$widgetScript.'</script>';	
}
add_shortcode( 'onboard-nurture', 'obn_custom_nurture_shortcode' );


function obn_custom_nurture_action_links( $links ) {
 $links = array_merge( array(
  '<a href="' . esc_url( admin_url( 'admin.php?page=onboard_nurture_bar' ) ) . '">' . __( 'Settings', 'textdomain' ) . '</a>'
 ), $links );
 return $links;
}
add_action( 'plugin_action_links_' . plugin_basename( __FILE__), 'obn_custom_nurture_action_links' );