<?php 
/**
 * Theme Setup Class
 *
 * @package Blueprint
 */

namespace Blueprint;

class ThemeSetup {
	/**
	 * Hook onto WP Core
	 * 
	 * @return void
	 */
	function setup() {
		add_action( 'wp_enqueue_scripts', [ $this, 'add_scripts_and_styles' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'add_block_editor_fonts' ] );
		add_action( 'after_setup_theme', [ $this, 'add_theme_support' ] );
		add_action('enqueue_block_editor_assets', [ $this, 'add_block_overrides' ] );
	}

	/**
	 * Add scripts and styles to theme
	 * 
	 * @return void
	 */
	function add_scripts_and_styles() {
		/**
		 * Define assets file to use in CSS/JS version and JS Dependencies 
		 * 
		 */
		$assets_path = BLUEPRINT_PATH . 'build/index.asset.php';
		$assets = require_once $assets_path;
		/**
		 * Enqueue Styles 
		 * 
		 */
		wp_enqueue_style('blueprint-style', get_template_directory_uri() . '/build/index.css', array(), $assets['version']);
		/**
		 * Enqueue Google Fonts
		 * 
		 */
		wp_enqueue_style( 'blueprint-google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap' );
		/** 
		 * Enqueue Scripts 
		 * 
		 */
		wp_enqueue_script( 'blueprint-script', get_template_directory_uri() . '/build/index.js', $assets['dependencies'], $assets['version'], true);
	}

	/**
	 * Enqueue google fonts in editor
	 * 
	 * @return void
	 */
	function add_block_editor_fonts() {
		wp_enqueue_style( 'blueprint-block-editor-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap' );
	}

	/**
	 * Add theme supports that need to be added in php
	 * 
	 * @return void
	 */
	function add_theme_support() {
		/**
		 * Add theme support for feature images
		 * 
		 * @link https://codex.wordpress.org/Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		/**
		 * Add theme support for custom logo
		 * 
		 * @link https://developer.wordpress.org/themes/functionality/custom-logo/
		 */
		add_theme_support( 'custom-logo' );
		/**
		 * Add theme support for block styles 
		 */
		add_theme_support( 'wp-block-styles' );
		/**
		 * Add editor styles
		 * 
		 * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#editor-styles
		 */
		add_theme_support( 'editor-styles' );
		add_editor_style('build/index.css');
		/**
		 * To setup embeds so they are responsive w/ aspect ratio
		 * 
		 * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
		 */
		add_theme_support( 'responsive-embeds' );
		/**
		 * Remove default block patterns
		 * 
		 * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#disabling-the-default-block-patterns
		 */
		remove_theme_support( 'core-block-patterns' );
	}

	/** 
	 * Add block overrides
	 * 
	 * @return void
	 */
	function add_block_overrides() {
		/**
		 * Define assets file to use in CSS/JS version and JS Dependencies 
		 * 
		 */
		$assets_path = BLUEPRINT_PATH . 'build/index.asset.php';
		$assets = require_once $assets_path;
		/**
		 * Merge asset dependencies with dependencies required for block styles
		 * 
		 */
		$dependencies = array_merge( ['wp-blocks', 'wp-dom-ready', 'wp-edit-post'], $assets['dependencies'] );
		/**
		 * Enqueue script for block overrides
		 * 
		 */
		wp_enqueue_script( 'blueprint-block-overrides', get_template_directory_uri() . '/build/block-overrides.js', $dependencies, $assets['version'], true );
	}
}
