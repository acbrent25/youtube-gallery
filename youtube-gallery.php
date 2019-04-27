<?php 
/*
Plugin Name: Youtube Gallery 
Description: Add a Youtube video gallery to your website
Version: 1.0
Author: Adam Champagne
Auther URI: https://adamchampagne.com/
*/

 // Exit if Accessed Directly
 if(!defined('ABSPATH')){
     exit;
 }

// Load Scripts
require_once(plugin_dir_path(__FILE__) . '/includes/youtube-gallery-scripts.php');

// Load Shortcodes
require_once(plugin_dir_path(__FILE__) . '/includes/youtube-gallery-shortcodes.php');

// Check if admin and load admin scripts
if( is_admin() ) {
    // Load Custom Post Types
    require_once(plugin_dir_path(__FILE__) . '/includes/youtube-gallery-cpt.php');
    
    // Load Settings
    require_once(plugin_dir_path(__FILE__) . '/includes/youtube-gallery-settings.php');

    // Load Fields
    require_once(plugin_dir_path(__FILE__) . '/includes/youtube-gallery-fields.php');
}




