<?php 

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Define plugin directory URI for assets
define('JIALISTT_PLUGIN_URI', plugin_dir_url(dirname(__DIR__) . '/core.php'));
define('JIALISTT_ASSETS_URI', JIALISTT_PLUGIN_URI . 'assets');
define('JIALISTT_CSS_URI', JIALISTT_ASSETS_URI . '/css');
define('JIALISTT_JS_URI', JIALISTT_ASSETS_URI . '/js');

// Define plugin directory path for file inclusion
define('JIALISTT_PLUGIN_PATH', plugin_dir_path(dirname(__DIR__) . '/core.php'));
define('JIALISTT_INC_PATH', JIALISTT_PLUGIN_PATH . 'inc');

?>