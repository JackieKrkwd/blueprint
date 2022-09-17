<?php 
/**
 * Settings for Blueprint Plugin
 *
 * @package Blueprint Plugin
 */

namespace BlueprintPlugin\Settings;

class BlockSettings {

	/**
	 * Hook into WP
	 * 
	 * @return void
	 */
	function setup() {
		add_action( 'after_setup_theme', [ $this, 'add_image_sizes' ] );
		add_filter( 'image_size_names_choose', [ $this, 'add_image_sizes_to_choices' ] );
		add_filter( 'block_categories_all', [ $this, 'add_block_categories' ], 10, 2 );
	}

	/**
	 * Add custom image sizes to WP
	 * 
	 * @return void
	 */
	function add_image_sizes() {
		add_image_size( 'bp-hero', 1920, 933, true );
		add_image_size( 'bp-hero-md', 1440, 700, true );
		add_image_size( 'bp-hero-sm', 600, 700, true ); // Portrait.
	
		add_image_size( 'bp-square', 1000, 1000, true );
		add_image_size( 'bp-square-md', 800, 800, true );
		add_image_size( 'bp-square-sm', 600, 600, true );
	
		add_image_size( 'bp-card', 1200, 628, true );
		add_image_size( 'bp-card-lg', 850, 575, true );
		add_image_size( 'bp-card-md', 640, 410, true );
		add_image_size( 'bp-card-sm', 400, 256, true );
	}

	/**
	 * Add custom image size names to choices for Gutenberg
	 * 
	 * @param array the array of image sizes
	 * @return array
	 */
	function add_image_sizes_to_choices( $sizes ) {
		$new_sizes = array(
			'bp-hero' => __( 'Blueprint Hero', 'blueprint' ),
			'bp-hero-md' => __( 'Blueprint Hero Md', 'blueprint' ),
			'bp-hero-sm' => __( 'Blueprint Hero Sm', 'blueprint' ),
			'bp-square' => __( 'Blueprint Square', 'blueprint' ),
			'bp-square-md' => __( 'Blueprint Square Md', 'blueprint' ),
			'bp-square-sm' => __( 'Blueprint Square Sm', 'blueprint' ),
			'bp-card' => __( 'Blueprint Card', 'blueprint' ),
			'bp-card-lg' => __( 'Blueprint Card Md', 'blueprint' ),
			'bp-card-md' => __( 'Blueprint Card Md', 'blueprint' ),
			'bp-card-sm' => __( 'Blueprint Card Sm', 'blueprint' ),
		);

		return array_merge( $sizes, $new_sizes );
	}
	
	/**
	 * Add custom category to block editor for custom blocks
	 * 
	 * @param array $block_categories the array of categories of block types
	 * @param class WP_Block_Editor_Context the current block editor context
	 * @return array
	 */
	function add_block_categories( $block_categories, $editor_context ) {
		if ( ! empty( $editor_context->post ) ) {
			array_push(
				$block_categories,
				array(
					'slug'  => 'blueprint-blocks',
					'title' => __( 'Blueprint Blocks', 'blueprint' ),
					'icon'  => 'admin-site',
				)
			);
		}
		return $block_categories;
	}
}
