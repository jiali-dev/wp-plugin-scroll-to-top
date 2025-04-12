<?php 

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Add link for setting near Activate/Deactivate
function jialistt_add_plugin_settings_link($links) {
    $url = esc_url(admin_url('themes.php?page=jialistt-scroll-to-top'));
    $text = esc_html__('Settings', 'jiali-scroll-to-top-button');
    $settings_link = '<a href="' . $url . '">' . $text . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(dirname(__DIR__) . '/core.php'), 'jialistt_add_plugin_settings_link');

// Enqueue wp color picker 
function jialistt_enqueue_admin_scripts($hook) {
    if ($hook !== 'appearance_page_jialistt-scroll-to-top') {
        return;
    }

    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('jialistt-color-picker', esc_url(JIALISTT_JS_URI . '/admin-color-picker.js'), ['wp-color-picker'], '1.0.0', true);
}
add_action('admin_enqueue_scripts', 'jialistt_enqueue_admin_scripts');

// Register settings menu page
function jialistt_add_admin_menu() {
    add_theme_page(
        esc_html__('Scroll to Top Settings', 'jiali-scroll-to-top-button'),
        esc_html__('Scroll to Top', 'jiali-scroll-to-top-button'),
        'manage_options',
        'jialistt-scroll-to-top',
        'jialistt_settings_page'
    );
}
add_action('admin_menu', 'jialistt_add_admin_menu');

// Settings page content
function jialistt_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Scroll to Top Button Settings', 'jiali-scroll-to-top-button'); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('jialistt_settings_group');
            do_settings_sections('jialistt-scroll-to-top');
            submit_button(esc_html__('Save Changes', 'jiali-scroll-to-top-button'));
            ?>
        </form>
    </div>
    <?php
}

// Register plugin settings and fields
function jialistt_register_settings() {
    register_setting('jialistt_settings_group', 'jialistt_button_bg', 'sanitize_hex_color');
    register_setting('jialistt_settings_group', 'jialistt_button_color', 'sanitize_hex_color');
    register_setting('jialistt_settings_group', 'jialistt_button_size', 'absint');
    register_setting('jialistt_settings_group', 'jialistt_font_size', 'absint');
    register_setting('jialistt_settings_group', 'jialistt_position', 'sanitize_text_field');
    register_setting('jialistt_settings_group', 'jialistt_bottom_distance', 'absint');
    register_setting('jialistt_settings_group', 'jialistt_side_distance', 'absint');
    register_setting('jialistt_settings_group', 'jialistt_shape', 'sanitize_text_field');

    add_settings_section('jialistt_section', '', null, 'jialistt-scroll-to-top');

    add_settings_field('button_bg', esc_html__('Button Background Color', 'jiali-scroll-to-top-button'), 'jialistt_button_bg_callback', 'jialistt-scroll-to-top', 'jialistt_section');
    add_settings_field('button_color', esc_html__('Button Text Color', 'jiali-scroll-to-top-button'), 'jialistt_button_color_callback', 'jialistt-scroll-to-top', 'jialistt_section');
    add_settings_field('button_size', esc_html__('Button Size (px)', 'jiali-scroll-to-top-button'), 'jialistt_button_size_callback', 'jialistt-scroll-to-top', 'jialistt_section');
    add_settings_field('font_size', esc_html__('Font Size (px)', 'jiali-scroll-to-top-button'), 'jialistt_font_size_callback', 'jialistt-scroll-to-top', 'jialistt_section');
    add_settings_field('position', esc_html__('Button Position', 'jiali-scroll-to-top-button'), 'jialistt_position_callback', 'jialistt-scroll-to-top', 'jialistt_section');
    add_settings_field('bottom_distance', esc_html__('Distance from Bottom (px)', 'jiali-scroll-to-top-button'), 'jialistt_bottom_distance_callback', 'jialistt-scroll-to-top', 'jialistt_section');
    add_settings_field('side_distance', esc_html__('Distance from Side (px)', 'jiali-scroll-to-top-button'), 'jialistt_side_distance_callback', 'jialistt-scroll-to-top', 'jialistt_section');
    add_settings_field('shape', esc_html__('Button Shape', 'jiali-scroll-to-top-button'), 'jialistt_shape_callback', 'jialistt-scroll-to-top', 'jialistt_section');
}
add_action('admin_init', 'jialistt_register_settings');

// Field Callbacks
function jialistt_button_bg_callback() {
    $value = esc_attr(get_option('jialistt_button_bg', '#333c56'));
    echo '<input type="text" id="jialistt_button_bg" class="jialistt-color-field" name="jialistt_button_bg" value="' . esc_attr($value) . '">';
}

function jialistt_button_color_callback() {
    $value = esc_attr(get_option('jialistt_button_color', '#fff'));
    echo '<input type="text" id="jialistt_button_color" class="jialistt-color-field" name="jialistt_button_color" value="' . esc_attr($value) . '">';
}

function jialistt_button_size_callback() {
    $value = esc_attr(get_option('jialistt_button_size', '40'));
    echo '<input type="number" name="jialistt_button_size" value="' . esc_attr($value) . '" >';
}

function jialistt_font_size_callback() {
    $value = esc_attr(get_option('jialistt_font_size', '15'));
    echo '<input type="number" name="jialistt_font_size" value="' . esc_attr($value) . '" >';
}

function jialistt_position_callback() {
    $value = esc_attr(get_option('jialistt_position', 'right'));
    ?>
    <select name="jialistt_position">
        <option value="right" <?php selected($value, 'right'); ?>><?php esc_html_e('Right', 'jiali-scroll-to-top-button'); ?></option>
        <option value="left" <?php selected($value, 'left'); ?>><?php esc_html_e('Left', 'jiali-scroll-to-top-button'); ?></option>
    </select>
    <?php
}

function jialistt_bottom_distance_callback() {
    $value = esc_attr(get_option('jialistt_bottom_distance', '10'));
    echo '<input type="number" name="jialistt_bottom_distance" value="' . esc_attr($value) . '" min="0">';
}

function jialistt_side_distance_callback() {
    $value = esc_attr(get_option('jialistt_side_distance', '20'));
    echo '<input type="number" name="jialistt_side_distance" value="' . esc_attr($value) . '" min="0">';
}

function jialistt_shape_callback() {
    $value = esc_attr(get_option('jialistt_shape', 'square'));
    ?>
    <select name="jialistt_shape">
        <option value="square" <?php selected($value, 'square'); ?>><?php esc_html_e('Square', 'jiali-scroll-to-top-button'); ?></option>
        <option value="circle" <?php selected($value, 'circle'); ?>><?php esc_html_e('Circle', 'jiali-scroll-to-top-button'); ?></option>
    </select>
    <?php
}

// Enqueue dynamic custom styles
function jialistt_enqueue_styles() {
    $button_bg = esc_attr(get_option('jialistt_button_bg', '#333c56'));
    $button_color = esc_attr(get_option('jialistt_button_color', '#fff'));
    $button_size = absint(get_option('jialistt_button_size', '40'));
    $font_size = absint(get_option('jialistt_font_size', '15'));
    $position = sanitize_text_field(get_option('jialistt_position', 'right'));
    $bottom_distance = absint(get_option('jialistt_bottom_distance', '10'));
    $side_distance = absint(get_option('jialistt_side_distance', '20'));
    $shape = sanitize_text_field(get_option('jialistt_shape', 'square'));

    $position_css = ($position === 'left')
        ? "left: {$side_distance}px; right: auto;"
        : "right: {$side_distance}px; left: auto;";

    $border_radius = ($shape === 'circle') ? '50%' : '4px';

    $custom_css = "
        #jialistt-scroll-to-top {
            width: {$button_size}px;
            line-height: {$button_size}px;
            font-size: {$font_size}px;
            bottom: {$bottom_distance}px;
            {$position_css}
            border-radius: {$border_radius};
            background: {$button_bg};
            color: {$button_color};
            overflow: hidden;
            z-index: 999;
            display: none;
            cursor: pointer;
            position: fixed;
            text-align: center;
            text-decoration: none;
        }
    ";

    wp_add_inline_style('jialistt-styles', $custom_css);
}
add_action('wp_enqueue_scripts', 'jialistt_enqueue_styles');

?>
