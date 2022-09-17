<?php
/**
 * Register the Blueprint classes
 *
 * @package BlueprintPlugins
 */

$classes = array(
	\BlueprintPlugin\Settings\BlockSettings::class,
	\BlueprintPlugin\Overrides\Overrides::class,
);

foreach ( $classes as $class ) {
	( new $class() )->setup();
}
