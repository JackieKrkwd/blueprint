<?php
/**
 * Plugin Name:       Blueprint
 * Description:       Example block written with ESNext standard and JSX support – build step required.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       blueprint
 *
 * @package           create-block
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; //Exit if accessed directly
}

/**
 * Define constants for plugin
 * 
 */
define( 'BP_PLUGIN_PATH', plugin_dir_path(__FILE__) );
define( 'BP_PLUGIN_URL', plugins_url('/', __FILE__) );

/**
 * Require Composer autoloader if it exists.
 * 
 */
if ( file_exists( BP_PLUGIN_PATH . 'vendor/autoload.php' ) ) {
	require_once BP_PLUGIN_PATH . 'vendor/autoload.php';
}

/**
 * Include registration for classes
 * 
 */
require_once BP_PLUGIN_PATH . 'includes/register-classes.php';
require_once BP_PLUGIN_PATH . 'src/register-classes.php';
