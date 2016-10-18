<?php

/**
 * WP Maintenance Mode
 *
 * Plugin Name: Extension du site Mois de la Photo
 * Plugin URI: http://moisdelaphoto.mep-fr.org
 * Description: 
 * Version: 1.0.0
 * Author: Thomas Florentin
 * Author URI: http://thomasflorentin.net
 * Text Domain: mdlp-plugin
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;


/**
 * DEFINE PATHS
 */
define('ODY_PATH', plugin_dir_path(__FILE__));
define('ODY_FUNC_PATH', ODY_PATH . 'functions/');
define('ODY_PT_PATH', ODY_PATH . 'post_types/');
define('ODY_TAXO_PATH', ODY_PATH . 'taxonomies/');
define('ODY_ACF_PATH', ODY_PATH . 'acf/');
define('ODY_UTILS_PATH', ODY_PATH . 'utils/');


/**
 * DEFINE SOCIAL ACCOMPTS
 */
define('FACEBOOK', '');



/**
 * Post Types & Taxonomies
 */
require_once(ODY_PT_PATH . 'post-types.php');
require_once(ODY_TAXO_PATH . 'taxonomies.php');


/**
 * Custom fields. Need ACF plugin.
 */
//require_once(ODY_ACF_PATH . 'acf.php');


/**
 * Utiles
 */
//require_once(ODY_UTILS_PATH . 'utils.php');





