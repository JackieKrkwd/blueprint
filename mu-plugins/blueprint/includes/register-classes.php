<?php
/**
 * Register the Blueprint classes
 *
 * @package Blueprint Plugins
 */

$classes = array(
	\BlueprintPlugin\Settings\BlockSettings::class,
);

foreach ( $classes as $class ) {
	( new $class() )->setup();
}
