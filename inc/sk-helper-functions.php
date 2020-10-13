<?php

/*-----------------------------------------------------------------------------------*/
/*	Get SVG icon
/*-----------------------------------------------------------------------------------*/
function sk_iconSVG( $name, $classes = '' ) {

	$css_class = '';
	if ( !empty( $classes ) ) $css_class = ' ' . $classes;
?>
	<span class="icon-svg icon-svg--<?php echo esc_attr( $name ) . esc_attr( $css_class ); ?>">
		<svg class="icon-svg__svg icon-svg--<?php echo esc_attr( $name ); ?>__svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			<use xlink:href="<?php echo THEME_WEB_ROOT; ?>/static/img/bg/icons-svg.svg#icon-<?php echo esc_attr( $name ); ?>" x="0" y="0" width="100%" height="100%"></use>
		</svg>
	</span>
<?php
}

function sk_get_iconSVG( $name, $classes = '' ) {

	$css_classes = '';
	if ( !empty( $classes ) ) $css_class = ' ' . $classes;

	return '<span class="icon-svg icon-svg--' . esc_attr( $name ) . esc_attr( $css_classes ) . '"><svg class="icon-svg__svg icon-svg--' . esc_attr( $name ) . '__svg" xmlns:xlink="http://www.w3.org/1999/xlink"><use xlink:href="' . esc_url( THEME_WEB_ROOT ) . '/static/img/bg/icons-svg.svg#icon-' . esc_attr( $name ) . '" x="0" y="0" width="100%" height="100%"></use></svg></span>';
}

/*-----------------------------------------------------------------------------------*/
/*  Function for testing if is ajax request
/*-----------------------------------------------------------------------------------*/
function sk_is_ajax() {

	return (
		(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest")
		|| isset($_GET['sk_ajax']) || isset($_POST['sk_ajax'])
		);

}

/*-----------------------------------------------------------------------------------*/
/*  Allowed HTML
/*-----------------------------------------------------------------------------------*/

function sk_get_allowed_html() {

	return array(
		'a' => array(
			'href' => array(),
			'title' => array()
		),
		'br' => array(),
		'strong' => array(),
		'em' => array(),
		'span' => array(),
	);

}


?>
