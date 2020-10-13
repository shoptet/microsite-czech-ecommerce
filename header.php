<?php
/**
 * The Header for our theme.
 *
 * @package ceskaecommerce
 */
?>

<!DOCTYPE html>
<!--[if IE 9 ]><html lang="cs" class="ie9 no-js"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="cs" class="no-js"><!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo THEME_WEB_ROOT; ?>/static/img/favicon.ico?v=2" />

		<?php wp_head(); ?>

		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-TP45SKR');</script>
		<!-- End Google Tag Manager -->

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-7713724-31"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());
		  gtag('config', 'UA-7713724-31');
		</script>

        <script>
        jQuery(document).ready(function($) {
            $(window).on('touchmove', function () {
                if($(document).scrollTop() > 0) {
                    $('#mainBrandingRow .header__cell--claim').slideUp();
                } else {
                    $('#mainBrandingRow .header__cell--claim').slideDown();
                }
            }).scroll();  // << Add this
        });
        </script>


	</head>
	<body>

		<?php
			/**
			 * sk_after_body_open hook.
			 *
			 * @hooked nothing() - 10
			 */
			do_action( 'sk_after_body_open', 'main' );
		?>

		<?php
			/**
			 * sk_before_header hook.
			 *
			 * @hooked sk_accessibility() - 10
			 */
			do_action( 'sk_before_header', 'main' );
		?>

		<?php
			/**
			 * sk_header hook.
			 *
			 * @hooked sk_the_header() - 10
			 */
			do_action( 'sk_header', 'main' );
		?>

		<?php
			/**
			 * sk_after_header hook.
			 *
			 * @hooked nothing() - 10
			 */
			do_action( 'sk_after_header', 'main' );
		?>

		<main role="main" id="main" class="main">
