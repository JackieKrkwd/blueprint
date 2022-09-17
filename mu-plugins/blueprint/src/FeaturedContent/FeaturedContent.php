<?php 
/**
 * Registration Featured Content Block
 *
 * @package BlueprintPlugin
 */

namespace BlueprintBlocks\FeaturedContent;

class FeaturedContent {

	function setup() {
		add_action( 'init', [ $this, 'create_block' ] );
	}

	function create_block() {
		$block_json = BP_PLUGIN_PATH . 'build/FeaturedContent';
		register_block_type(
			$block_json,
			[
				'render_callback' => [ $this, 'render_block_html' ],
			]
		);
	}

	function render_block_html( $atts, $content, $block ) {
		ob_start();

		require plugin_dir_path( __FILE__ ) . 'template/block.php';

		return ob_get_clean();
	}

}
