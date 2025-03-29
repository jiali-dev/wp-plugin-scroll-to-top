<?php 

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Hook to add the Scroll to Top button and enqueue scripts/styles
function jst_scroll_to_top_layout() {
    // HTML for Scroll to Top button
    echo '<a id="jst-scroll-to-top" class="top-scroll" title="' . esc_attr__('Back to top', 'jiali-scroll-to-top-button') . '" href="#">
            <span>&uarr;</span>
          </a>';

    // Enqueue the styles and scripts
    wp_enqueue_style( 'jst-styles' );
    wp_enqueue_script( 'jst-main' );
}
add_action('wp_footer', 'jst_scroll_to_top_layout');

?>