<?php
/**
 * BlueprintPlugin Post Type Factory
 *
 * @package BlueprintPlugin
 */

namespace BlueprintPlugin\PostTypes;

/**
 * Generate a custom post type
 */
class PostTypeFactory {

	/**
	 * Initialize the Custom Post Type registration
	 *
	 * @param string $name   Post Type Name
	 * @param string $plural Post type plural label
	 * @param array  $args   The post type arguments
	 * @param array  $labels The post type labels
	 */
	public function __construct( $name, $plural = null, $args = [], $labels = [] ) {
		$this->name      = sanitize_text_field( $name );
		$this->plural    = sanitize_text_field( $plural );
		$this->post_type = sanitize_title_with_dashes( $this->name );
		$this->labels    = array_map( 'sanitize_text_field', $labels );
		$this->args      = $args;

		if ( ! post_type_exists( $this->post_type ) ) {
			$this->register();
		}
	}

	/**
	 * Register Custom Post Type with WP
	 */
	public function register() {
		$plural = $this->plural ?? $this->name;

		$labels = array_merge(
			[
				'name'               => $plural,
				'singular_name'      => $this->name,
				// Translators: Add New Post Item Label
				'add_new_item'       => sprintf( __( 'Add New %s', 'blueprint' ), $this->name ),
				// Translators: Edit Post Type Label
				'edit_item'          => sprintf( __( 'Edit %s', 'blueprint' ), $this->name ),
				// Translators: New Post Item Label
				'new_item'           => sprintf( __( 'New %s', 'blueprint' ), $this->name ),
				// Translators: All Post Items
				'all_items'          => sprintf( __( 'All %s', 'blueprint' ), $plural ),
				// Translators: View All Post Items
				'view_item'          => sprintf( __( 'View %s', 'blueprint' ), $this->name ),
				// Translators: Search All Post Items
				'search_items'       => sprintf( __( 'Search %s', 'blueprint' ), $plural ),
				// Translators: No Post Items Found
				'not_found'          => sprintf( __( 'No %s found.', 'blueprint' ), $plural ),
				// Translators: No Post Items Found in Trash
				'not_found_in_trash' => sprintf( __( 'No %s found in trash.', 'blueprint' ), $plural ),
				'parent_item_colon'  => '',
				'menu_name'          => $plural,
			],
			$this->labels
		);

		$args = array_merge(
			[
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_rest'       => true,
				'query_var'          => true,
				'capability_type'    => 'post',
				'has_archive'        => $this->post_type,
				'hierarchical'       => false,
				'menu_position'      => 5,
				'supports'           => [
					'title',
					'editor',
					'excerpt',
					'author',
					'thumbnail',
					'revisions',
				],
				'rewrite'            => [
					'slug'       => $this->post_type,
					'with_front' => false,
				],
			],
			$this->args
		);

		register_post_type( $this->post_type, $args );
	}

}
