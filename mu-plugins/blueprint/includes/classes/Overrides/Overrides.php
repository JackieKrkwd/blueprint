<?php
/**
 * BlueprintPlugin core over writes.
 *
 * @package BlueprintPlugin
 */

namespace BlueprintPlugin\Overrides;

class Overrides {
		/**
	 * Hook into WP
	 * 
	 * @return void
	 */
	function setup() {
		add_filter( 'upload_mimes', [ $this, 'mime_types' ], 10, 1 );
		add_filter( 'wp_check_filetype_and_ext', [ $this, 'svgs_upload_check' ], 10, 4 );
		add_filter( 'wp_check_filetype_and_ext', [ $this, 'svgs_allow_svg_upload' ], 10, 4 );
	}

	/**
	 * Add svg mime type.
	 *
	 * @param array $mimes List of allowed mime types.
	 *
	 * @return array
	 */
	function mime_types( $mimes ) {
		$mimes['svg']  = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';

		return $mimes;
	}
	

	/**
	 * Check mime types
	 *
	 * @param array    $checked  Values for the extension, mime type, and corrected filename.
	 * @param string   $file     Full path to the file.
	 * @param string   $filename The name of the file (may differ from $file due to
	 *                                                $file being in a tmp directory).
	 * @param string[] $mimes    Array of mime types keyed by their file extension regex.
	 *
	 * @return array
	 */
	function svgs_upload_check( $checked, $file, $filename, $mimes ) {
		if ( ! $checked['type'] ) {
			$check_filetype  = wp_check_filetype( $filename, $mimes );
			$ext             = $check_filetype['ext'];
			$type            = $check_filetype['type'];
			$proper_filename = $filename;

			if ( $type && 0 === strpos( $type, 'image/' ) && 'svg' !== $ext ) {
				$ext  = false;
				$type = false;
			}

			$checked = compact( 'ext', 'type', 'proper_filename' );
		}

		return $checked;
	}
	

	/**
	 * Mime Check fix for WP 4.7.1 / 4.7.2
	 *
	 * @param array    $data     Values for the extension, mime type, and corrected filename.
	 * @param string   $file     Full path to the file.
	 * @param string   $filename The name of the file (may differ from $file due to
	 *                                                $file being in a tmp directory).
	 * @param string[] $mimes    Array of mime types keyed by their file extension regex.
	 *
	 * @return array
	 */
	function svgs_allow_svg_upload( $data, $file, $filename, $mimes ) {
		global $wp_version;

		if ( '4.7.1' !== $wp_version || '4.7.2' !== $wp_version ) {
			return $data;
		}

		$filetype = wp_check_filetype( $filename, $mimes );

		return [
			'ext'             => $filetype['ext'],
			'type'            => $filetype['type'],
			'proper_filename' => $data['proper_filename'],
		];
	}
}
