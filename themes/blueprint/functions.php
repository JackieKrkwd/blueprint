<?php 
/**
 * Define theme path
 *
 * @package Blueprint
 */

define( 'BLUEPRINT_VERSION', '0.1.0' );
define( 'BLUEPRINT_TEMPLATE_URL', get_template_directory_uri() );
define( 'BLUEPRINT_PATH', get_template_directory() . '/' );
define( 'BLUEPRINT_INC', BLUEPRINT_PATH . 'includes/' );

// Require Composer autoloader if it exists.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

require_once BLUEPRINT_INC . 'register-classes.php';
