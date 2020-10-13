<?php

/*-----------------------------------------------------------------------------------
/*	Add to WP_HEAD
/*---------------------------------------------------------------------------------*/

function sk_extend_wp_head() {
?>

	<script>
		(function () {
			var className = document.documentElement.className;
			className = className.replace('no-js', 'js');

			if (window.name.indexOf('fontsLoaded=true') > -1) {
				className += ' fonts-loaded';
			}

			document.documentElement.className = className;
		}());
	</script>

<?php
}
add_action( 'wp_head', 'sk_extend_wp_head', 10 );

/*-----------------------------------------------------------------------------------
/*	Before header
/*---------------------------------------------------------------------------------*/

function sk_accessibility() {
	include( locate_template( 'components/header/accessibility.php', false, false ) );
}
add_action( 'sk_before_header', 'sk_accessibility', 10 );

/*-----------------------------------------------------------------------------------
/*	Header
/*---------------------------------------------------------------------------------*/

function sk_the_header() {
	include( locate_template( 'components/header.php', false, false ) );
}
add_action( 'sk_header', 'sk_the_header', 10 );


?>
