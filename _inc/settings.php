<?php 

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Register settings
function jst_add_admin_menu() {
    add_theme_page(
        __('Scroll to Top Settings', 'jst'), // Page title
        __('Scroll to Top', 'jst'), // Menu title
        'manage_options', // Capability
        'jst-scroll-to-top', // Menu slug
        'jst_settings_page' // Callback function
    );
}
add_action('admin_menu', 'jst_add_admin_menu');

// Settings section
function jst_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Scroll to Top Button Settings', 'jst'); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('jst_settings_group');
            do_settings_sections('jst-scroll-to-top');
            submit_button(__('Save Changes', 'jst'));
            ?>
        </form>
    </div>
    <?php
}

function jst_register_settings() {
    register_setting('jst_settings_group', 'jst_button_bg');
    register_setting('jst_settings_group', 'jst_button_color');
    register_setting('jst_settings_group', 'jst_button_size');

    add_settings_section('jst_section', '', null, 'jst-scroll-to-top');

    add_settings_field('button_bg', __('Button Background Color', 'jst'), 'jst_button_bg_callback', 'jst-scroll-to-top', 'jst_section');
    add_settings_field('button_color', __('Button Text Color', 'jst'), 'jst_button_color_callback', 'jst-scroll-to-top', 'jst_section');
    add_settings_field('button_size', __('Button Size (px)', 'jst'), 'jst_button_size_callback', 'jst-scroll-to-top', 'jst_section');
}
add_action('admin_init', 'jst_register_settings');

// Callbacks
function jst_button_bg_callback() {
    $value = get_option('jst_button_bg', '#333c56');
    echo '<input type="text" name="jst_button_bg" value="' . esc_attr($value) . '">';
}

function jst_button_color_callback() {
    $value = get_option('jst_button_color', '#fff');
    echo '<input type="text" name="jst_button_color" value="' . esc_attr($value) . '">';
}

function jst_button_size_callback() {
    $value = get_option('jst_button_size', '40');
    echo '<input type="number" name="jst_button_size" value="' . esc_attr($value) . '" min="20" max="100">';
}

function jst_enqueue_styles() {
    // wp_enqueue_style('jst-styles');

    $button_bg = get_option('jst_button_bg', '#333c56');
    $button_color = get_option('jst_button_color', '#fff');
    $button_size = get_option('jst_button_size', '40');

    $custom_css = "
        #back2Top {
            background: {$button_bg};
            color: {$button_color};
            width: {$button_size}px;
            line-height: {$button_size}px;
            font-size: 15px;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
            position: fixed;
            bottom: 10px;
            right: 20px;
            display: none;
        }
    ";

    wp_add_inline_style('jst-styles', $custom_css);
}
add_action('wp_enqueue_scripts', 'jst_enqueue_styles');

