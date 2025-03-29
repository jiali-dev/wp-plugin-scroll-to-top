<?php 

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Hook to add the Scroll to Top button and enqueue scripts/styles
function jst_scroll_to_top_layout() {
    // HTML for Scroll to Top button
    echo '<a id="jst-scroll-to-top" class="top-scroll" title="' . esc_attr__('Back to top', 'jst-custom-plugin') . '" href="#">
            <i class="ti-arrow-up"></i>
          </a>';

    // Enqueue the styles and scripts
    wp_enqueue_style( 'jst-styles' );
    wp_enqueue_script( 'jst-main' );
}
add_action('wp_footer', 'jst_scroll_to_top_layout');

// // Optional: Only enqueue styles/scripts on certain pages (e.g., only on the front end)
// function jst_plugin_enqueue_scripts() {
//     if (is_front_page() || is_single() || is_page()) { // Modify conditions as needed
//         wp_enqueue_style('jst-plugin-scroll-to-top-css', plugin_dir_url(__FILE__) . 'assets/css/scroll-to-top.css');
//         wp_enqueue_script('jst-plugin-scroll-to-top-js', plugin_dir_url(__FILE__) . 'assets/js/scroll-to-top.js', array('jquery'), null, true);
//     }
// }
// add_action('wp_enqueue_scripts', 'jst_plugin_enqueue_scripts');
