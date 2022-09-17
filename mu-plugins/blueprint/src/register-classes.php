<?php
/**
 * Register the Blueprint Blocks classes
 *
 * @package BlueprintPlugins
 */

$classes = array(
	\BlueprintBlocks\FeaturedContent\FeaturedContent::class,
);

foreach ( $classes as $class ) {
	( new $class() )->setup();
}
