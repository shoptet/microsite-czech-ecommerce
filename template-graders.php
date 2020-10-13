<?php
/**
 * Template name: Srovnavace
 *
 * @package ceskaecommerce
 */
?>

	<section class="section section--gray-border" role="region"  id="srovnavace">
		<div class="row-main">

			<?php
				$graders_title = get_field( 'sk_graders_title', $pageID );
				if ( !empty( $graders_title ) ) {
					printf( '<h2>%s</h2>', esc_html( $graders_title ) );
				}
			?>

			<ul class="grid grid--wider">
				<li class="grid__cell size--6-12">
					<div class="m-auto w-570">

						<?php
							$price_title = get_field( 'sk_graders_price_title', $pageID );
							if ( !empty( $price_title ) ) {
								printf( '<h3 class="section__subtitle text-center">%s</h3>', esc_html( $price_title ) );
							}

							$price_desc = get_field( 'sk_graders_price_desc', $pageID );
							if ( !empty( $price_desc ) ) {
								printf( '<p class="section__perex mb-45">%s</p>', esc_html( $price_desc ) );
							}

							$price_graph = get_field( 'sk_graders_price_graph', $pageID );
							if ( !empty( $price_graph ) ) :
						?>

						<div class="b-columns">
							<ul class="b-columns__grid no-print">

								<?php
									for ( $i = count( $price_graph ); $i > 0; $i-- ) {
										echo '<li class="b-columns__cell b-columns__cell--tube">';
										for ( $x = 0; $x < $i; $x++ ) {
											echo '<span class="b-columns__oval"></span>';
										}
										echo '</li>';
									}
								?>

							</ul>
							<ul class="b-columns__grid">

								<?php
									foreach ( $price_graph as $index => $data ) {
										printf( '<li class="b-columns__cell"><strong class="b-columns__value">%s</strong> %s</li>', $data['price'], esc_html( $data['desc'] ) );
									}
								?>

							</ul>
						</div>

						<?php
							endif;
						?>

					</div>
				</li>
				<li class="grid__cell size--6-12">
					<div class="m-auto w-570">

						<?php
							$popularity_title = get_field( 'sk_graders_popularity_title', $pageID );
							if ( !empty( $popularity_title ) ) {
								printf( '<h3 class="section__subtitle text-center">%s</h3>', esc_html( $popularity_title ) );
							}

							$popularity_desc = get_field( 'sk_graders_popularity_desc', $pageID );
							if ( !empty( $popularity_desc ) ) {
								printf( '<p class="section__perex mb-45">%s</p>', esc_html( $popularity_desc ) );
							}
						?>

						<div class="w-360 m-auto">
							<?php
								include( locate_template( 'components/charts/goods2.php', false, false ) );
							?>
						</div>
					</div>
				</li>
			</ul>

			<?php
				$testimonial_class = 'mt-40 mt-75-t';
				$testimonial_content_class = '';
				$include = false;
				include( locate_template( 'components/testimonials.php', false, false ) );
			?>

		</div>
	</section>
