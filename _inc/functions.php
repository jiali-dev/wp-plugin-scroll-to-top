<?php 

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Define Constant
require_once( plugin_dir_path(__FILE__) . 'define_constants.php' );


// Register theme assets
require_once( JST_INC_PATH . '/register_assets.php');

// Register theme assets
require_once( JST_INC_PATH . '/front.php');
