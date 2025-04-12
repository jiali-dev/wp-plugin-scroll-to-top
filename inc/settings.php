<?php 

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Add link for setting near Activate/Deactivate
function jst_add_plugin_settings_link($links) {
    $url = esc_url(admin_url('themes.php?page=jst-scroll-to-top'));
    $text = esc_html__('Settings', 'jiali-scroll-to-top-button');
    $settings_link = '<a href="' . $url . '">' . $text . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(dirname(__DIR__) . '/core.php'), 'jst_add_plugin_settings_link');

// Enqueue wp color picker 
function jst_enqueue_admin_scripts($hook) {
    if ($hook !== 'appearance_page_jst-scroll-to-top') {
        return;
    }

    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('jst-color-picker', esc_url(JST_JS_URI . '/admin-color-picker.js'), ['wp-color-picker'], '1.0.0', true);
}
add_action('admin_enqueue_scripts', 'jst_enqueue_admin_scripts');

// Register settings menu page
function jst_add_admin_menu() {
    add_theme_page(
        esc_html__('Scroll to Top Settings', 'jiali-scroll-to-top-button'),
        esc_html__('Scroll to Top', 'jiali-scroll-to-top-button'),
        'manage_options',
        'jst-scroll-to-top',
        'jst_settings_page'
    );
}
add_action('admin_menu', 'jst_add_admin_menu');

// Settings page content
function jst_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Scroll to Top Button Settings', 'jiali-scroll-to-top-button'); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('jst_settings_group');
            do_settings_sections('jst-scroll-to-top');
            submit_button(esc_html__('Save Changes', 'jiali-scroll-to-top-button'));
            ?>
        </form>
    </div>
    <?php
}

// Register plugin settings and fields
function jst_register_settings() {
    register_setting('jst_settings_group', 'jst_button_bg', 'sanitize_hex_color');
    register_setting('jst_settings_group', 'jst_button_color', 'sanitize_hex_color');
    register_setting('jst_settings_group', 'jst_button_size', 'absint');
    register_setting('jst_settings_group', 'jst_font_size', 'absint');
    register_setting('jst_settings_group', 'jst_position', 'sanitize_text_field');
    register_setting('jst_settings_group', 'jst_bottom_distance', 'absint');
    register_setting('jst_settings_group', 'jst_side_distance', 'absint');
    register_setting('jst_settings_group', 'jst_shape', 'sanitize_text_field');

    add_settings_section('jst_section', '', null, 'jst-scroll-to-top');

    add_settings_field('button_bg', esc_html__('Button Background Color', 'jiali-scroll-to-top-button'), 'jst_button_bg_callback', 'jst-scroll-to-top', 'jst_section');
    add_settings_field('button_color', esc_html__('Button Text Color', 'jiali-scroll-to-top-button'), 'jst_button_color_callback', 'jst-scroll-to-top', 'jst_section');
    add_settings_field('button_size', esc_html__('Button Size (px)', 'jiali-scroll-to-top-button'), 'jst_button_size_callback', 'jst-scroll-to-top', 'jst_section');
    add_settings_field('font_size', esc_html__('Font Size (px)', 'jiali-scroll-to-top-button'), 'jst_font_size_callback', 'jst-scroll-to-top', 'jst_section');
    add_settings_field('position', esc_html__('Button Position', 'jiali-scroll-to-top-button'), 'jst_position_callback', 'jst-scroll-to-top', 'jst_section');
    add_settings_field('bottom_distance', esc_html__('Distance from Bottom (px)', 'jiali-scroll-to-top-button'), 'jst_bottom_distance_callback', 'jst-scroll-to-top', 'jst_section');
    add_settings_field('side_distance', esc_html__('Distance from Side (px)', 'jiali-scroll-to-top-button'), 'jst_side_distance_callback', 'jst-scroll-to-top', 'jst_section');
    add_settings_field('shape', esc_html__('Button Shape', 'jiali-scroll-to-top-button'), 'jst_shape_callback', 'jst-scroll-to-top', 'jst_section');
}
add_action('admin_init', 'jst_register_settings');

// Field Callbacks
function jst_button_bg_callback() {
    $value = esc_attr(get_option('jst_button_bg', '#333c56'));
    echo '<input type="text" id="jst_button_bg" class="jst-color-field" name="jst_button_bg" value="' . $value . '">';
}

function jst_button_color_callback() {
    $value = esc_attr(get_option('jst_button_color', '#fff'));
    echo '<input type="text" id="jst_button_color" class="jst-color-field" name="jst_button_color" value="' . $value . '">';
}

function jst_button_size_callback() {
    $value = esc_attr(get_option('jst_button_size', '40'));
    echo '<input type="number" name="jst_button_size" value="' . $value . '" >';
}

function jst_font_size_callback() {
    $value = esc_attr(get_option('jst_font_size', '15'));
    echo '<input type="number" name="jst_font_size" value="' . $value . '" >';
}

function jst_position_callback() {
    $value = esc_attr(get_option('jst_position', 'right'));
    ?>
    <select name="jst_position">
        <option value="right" <?php selected($value, 'right'); ?>><?php esc_html_e('Right', 'jiali-scroll-to-top-button'); ?></option>
        <option value="left" <?php selected($value, 'left'); ?>><?php esc_html_e('Left', 'jiali-scroll-to-top-button'); ?></option>
    </select>
    <?php
}

function jst_bottom_distance_callback() {
    $value = esc_attr(get_option('jst_bottom_distance', '10'));
    echo '<input type="number" name="jst_bottom_distance" value="' . $value . '" min="0">';
}

function jst_side_distance_callback() {
    $value = esc_attr(get_option('jst_side_distance', '20'));
    echo '<input type="number" name="jst_side_distance" value="' . $value . '" min="0">';
}

function jst_shape_callback() {
    $value = esc_attr(get_option('jst_shape', 'square'));
    ?>
    <select name="jst_shape">
        <option value="square" <?php selected($value, 'square'); ?>><?php esc_html_e('Square', 'jiali-scroll-to-top-button'); ?></option>
        <option value="circle" <?php selected($value, 'circle'); ?>><?php esc_html_e('Circle', 'jiali-scroll-to-top-button'); ?></option>
    </select>
    <?php
}

// Enqueue dynamic custom styles
function jst_enqueue_styles() {
    $button_bg = esc_attr(get_option('jst_button_bg', '#333c56'));
    $button_color = esc_attr(get_option('jst_button_color', '#fff'));
    $button_size = absint(get_option('jst_button_size', '40'));
    $font_size = absint(get_option('jst_font_size', '15'));
    $position = sanitize_text_field(get_option('jst_position', 'right'));
    $bottom_distance = absint(get_option('jst_bottom_distance', '10'));
    $side_distance = absint(get_option('jst_side_distance', '20'));
    $shape = sanitize_text_field(get_option('jst_shape', 'square'));

    $position_css = ($position === 'left')
        ? "left: {$side_distance}px; right: auto;"
        : "right: {$side_distance}px; left: auto;";

    $border_radius = ($shape === 'circle') ? '50%' : '4px';

    $custom_css = "
        #jst-scroll-to-top {
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

    wp_add_inline_style('jst-styles', $custom_css);
}
add_action('wp_enqueue_scripts', 'jst_enqueue_styles');

?>
