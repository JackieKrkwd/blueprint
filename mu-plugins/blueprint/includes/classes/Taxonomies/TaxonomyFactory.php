<?php
/**
 * ServiceExpress Taxonomy Factory
 *
 * @package ServiceExpress
 */

namespace ServiceExpress\Taxonomies;

/**
 * Generate a custom taxonomy
 */
class TaxonomyFactory {

	/**
	 * Initialize the Custom Taxonomy registration
	 *
	 * @param string $name      Taxonomy Name
	 * @param string $plural    Post type plural label
	 * @param string $post_type Post type to register taxonomy
	 * @param array  $args      Taxonomy arguments
	 * @param array  $labels    Taxonomy labels
	 */
	public function __construct( $name, $plural, $post_type = 'post', $args = [], $labels = [] ) {
		$this->name      = $name;
		$this->plural    = $plural;
		$this->post_type = $post_type;
		$this->labels    = array_map( 'sanitize_text_field', $labels );
		$this->args      = $args;

		if ( ! taxonomy_exists( $this->name ) ) {
			$this->register();
		}
	}

	/**
	 * Register Custom taxonomy with WP
	 */
	public function register() {
		$labels = array_merge(
			[
				'name'              => $this->plural,
				'singular_name'     => $this->name,
				'search_items'      => sprintf( __( 'Search %s', 'blueprint' ), $this->name ),
				'all_items'         => sprintf( __( 'All %s', 'blueprint' ), $this->name ),
				'parent_item'       => sprintf( __( 'Parent %s', 'blueprint' ), $this->name ),
				'parent_item_colon' => sprintf( __( 'Patent %s:', 'blueprint' ), $this->name ),
				'edit_item'         => sprintf( __( 'Edit %s', 'blueprint' ), $this->name ),
				'update_item'       => sprintf( __( 'Update %s', 'blueprint' ), $this->name ),
				'add_new_item'      => sprintf( __( 'Add New %s', 'blueprint' ), $this->name ),
				'new_item_name'     => sprintf( __( 'New %s name', 'blueprint' ), $this->name ),
				'menu_name'         => $this->plural,
				'back_to_items'     => sprintf( __( 'Go back to %s', 'blueprint' ), $this->plural ),
			],
			$this->labels
		);

		$args = array_merge(
			[
				'hierarchical'        => true,
				'labels'              => $labels,
				'public'              => true,
				'show_ui'             => true,
				'show_admin_column'   => true,
				'show_in_rest'        => true,
				'query_var'           => true,
				'rewrite'             => [ 'slug' => sanitize_title_with_dashes( strtolower( $this->name ) ) ],
				'exclude_from_search' => false,
				'has_archive'         => true,
			],
			$this->args
		);

		register_taxonomy( sanitize_title_with_dashes( $this->name ), [ $this->post_type ], $args );
	}
}
