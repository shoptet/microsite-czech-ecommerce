<?php
/**
 * Template name: Reseni
 *
 * @package ceskaecommerce
 */
?>

	<section class="section section--green" role="region" id="reseni">
			<div class="row-main">

			<?php
				$solution_title = get_field( 'sk_solution_title', $pageID );
				if ( !empty( $solution_title ) ) {
					printf( '<h2 class="color-white">%s</h2>', esc_html( $solution_title ) );
				}

				$solution_desc = get_field( 'sk_solution_desc', $pageID );
				if ( !empty( $solution_desc ) ) {
					printf( '<p class="section__perex color-white">%s</p>', wp_kses( $solution_desc, $allowed_html ) );
				}
			?>

			<div class="w-320 m-auto mb-65-t no-print">
				<?php
					//include( locate_template( 'components/charts/eshop.php', false, false ) );
					include( locate_template( 'components/charts/eshop2.php', false, false ) );
				?>
			</div>

			<?php
				$testimonial_class = '';
				$testimonial_content_class = '';
				$include = false;
				include( locate_template( 'components/testimonials.php', false, false ) );
			?>

			</div>
		</section>
