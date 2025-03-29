<?php 

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Define plugin directory URI for assets
define('JST_PLUGIN_URI', plugin_dir_url(dirname(__DIR__) . '/core.php'));
define('JST_ASSETS_URI', JST_PLUGIN_URI . 'assets');
define('JST_CSS_URI', JST_ASSETS_URI . '/css');
define('JST_JS_URI', JST_ASSETS_URI . '/js');

// Define plugin directory path for file inclusion
define('JST_PLUGIN_PATH', plugin_dir_path(dirname(__DIR__) . '/core.php'));
define('JST_INC_PATH', JST_PLUGIN_PATH . 'inc');

?>