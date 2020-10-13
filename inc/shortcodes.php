<?php
/*-----------------------------------------------------------------------------------
/*	Shortcodes
/*---------------------------------------------------------------------------------*/

function sk_shortcode_button( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'text' => 'Popis',
		'url' => '#',
	), $atts ) );

	$output = '';
	if ( !empty( $url ) && !empty( $text ) ) {
		$output .= '<p><a href="' . esc_url( $url ) . '" class="btn btn--more"><span>' . $text . '</span></a></p>';
	}

	return $output;

}
// add_shortcode('button', 'sk_shortcode_button');

?>
