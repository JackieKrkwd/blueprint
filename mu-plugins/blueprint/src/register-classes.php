<?php
/**
 * Register the Blueprint Blocks classes
 *
 * @package Blueprint Plugins
 */

$classes = array(
	\BlueprintBlocks\FeaturedContent\FeaturedContent::class,
);

foreach ( $classes as $class ) {
	( new $class() )->setup();
}
