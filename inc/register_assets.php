<?php 

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Add theme assets --> Register for globaly and enqueue for specific page
function jialistt_register_assets() {
    // Register styles
    wp_register_style('jialistt-styles', JIALISTT_CSS_URI . '/styles.css' , array(), '1.0.0', 'all');

    // Register scripts
    wp_register_script('jialistt-main', JIALISTT_JS_URI . '/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'jialistt_register_assets');

?>