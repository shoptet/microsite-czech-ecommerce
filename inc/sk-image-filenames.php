<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SK_Image_Filenames {

	/**
	 * Settings.
	 *
	 * @var array
	 */

	public $settings = array(
		'version' 				=> '1.1',
		'default_mime_types' 	=> array(
			'image/gif',
			'image/jpeg',
			'image/pjpeg',
			'image/png',
			'image/tiff'
		)
	);

	/**
	 * Default types.
	 * images or all
	 *
	 * @var string Default file types for repair
	 */

	public $default_types = 'images';


	/**
	 * Sets up hooks, actions and filters that the plugin responds to.
	 */

	function __construct() {
		add_action( 'wp_handle_upload_prefilter', array( $this, 'upload_filter' ) );
	}

	/**
	 * Checks whether or not the current file should be cleaned.
	 *
	 * @param array The file information including the filename in $file['name'].
	 * @return array The file information with the cleaned or original filename.
	 */

	function upload_filter($file) {

		$mime_types_setting = $this->default_types;
		$default_mime_types = $this->settings['default_mime_types'];
		$valid_mime_types = apply_filters( 'clean_image_filenames_mime_types', $default_mime_types );

		if ( $valid_mime_types !== $default_mime_types ) {

			if ( in_array( $file['type'], $valid_mime_types ) ) {
				$file = $this->clean_filename( $file );
			}

		} else {

			if ( 'all' == $mime_types_setting ) {
				$file = $this->clean_filename( $file );
			} elseif ( 'images' == $mime_types_setting && in_array( $file['type'], $default_mime_types ) ) {
				$file = $this->clean_filename( $file );
			}
		}

		// Return cleaned file or input file if it didn't match
	    return $file;
	}


	/**
	 * Performs the filename cleaning.
	 *
	 * @param array File details including the filename in $file['name'].
	 * @return array The $file array with cleaned filename.
	 */

	function clean_filename($file) {

		$path = pathinfo( $file['name'] );
		$new_filename = preg_replace( '/.' . $path['extension'] . '$/', '', $file['name'] );
		$file['name'] = sanitize_title( $new_filename ) . '.' . $path['extension'];

		return $file;
	}
}

$sk_clean_image_filenames = new SK_Image_Filenames();
