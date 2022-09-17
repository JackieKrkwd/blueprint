<?php
/**
 * Register the classes
 *
 * @package Blueprint
 */

$classes = array(
	\Blueprint\ThemeSetup::class,
);

foreach ( $classes as $class ) {
	( new $class() )->setup();
}
