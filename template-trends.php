<?php
/**
 * Template name: Trendy
 *
 * @package ceskaecommerce
 */
?>

	<section class="section section--gray" role="region" id="trendy">
		<div class="row-main">

			<?php
				$trends_title = get_field( 'sk_trends_title', $pageID );
				if ( !empty( $trends_title ) ) {
					printf( '<h2>%s</h2>', esc_html( $trends_title ) );
				}

				$trends = get_field( 'sk_trends', $pageID );
				if ( !empty( $trends ) ) :
			?>

			<div class="grid grid--y-wide">

				<?php
					foreach ( $trends as $data ) {

						$include = true;
						$testimonial_name = ( !empty( $data['name'] ) ) ? $data['name'] : null;
						$testimonial_desc = ( !empty( $data['desc'] ) ) ? $data['desc'] : null;
						$testimonial_img = ( !empty( $data['img'] ) ) ? $data['img'] : null;
						$testimonial_content_class = 'b-testimonial__content--white';

						echo '<div class="grid__cell size--t-6-12 size--4-12">';
						include( locate_template( 'components/testimonials.php', false, false ) );
						echo '</div>';

					}
				?>

			</div>

			<?php
				endif;
			?>

		</div>
	</section>
