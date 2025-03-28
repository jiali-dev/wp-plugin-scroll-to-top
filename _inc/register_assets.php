<?php 

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Add theme assets --> Register for globaly and enqueue for specific page
function jst_register_assets() {
    // Enqueue styles
    wp_register_style('jst-styles', JST_CSS_URI . '/styles.css' , array(), '1.0.0', 'all');

    // Enqueue scripts
    wp_register_script('jst-main', JST_JS_URI . '/main.js', array('jquery'), '1.0.0', true);
    
}
add_action('wp_enqueue_scripts', 'jst_register_assets');

?>

