<?php
/**
 * Template name: Doprava a platby
 *
 * @package ceskaecommerce
 */
?>

	<section class="section" role="region" id="dopravy-a-platby">
		<div class="row-main">

			<?php
				$transfer_title = get_field( 'sk_transfer_title', $pageID );
				if ( !empty( $transfer_title ) ) {
					printf( '<h2>%s</h2>', esc_html( $transfer_title ) );
				}
			?>

			<div class="grid grid--wider">
				<div class="grid__cell size--6-12">
					<div class="m-auto w-570">

						<?php
							$pricing_title = get_field( 'sk_transfer_pricing_title', $pageID );
							if ( !empty( $pricing_title ) ) {
								printf( '<h3 class="section__subtitle text-center">%s</h3>', esc_html( $pricing_title ) );
							}

							$pricing_desc = get_field( 'sk_transfer_pricing_desc', $pageID );
							if ( !empty( $pricing_desc ) ) {
								printf( '<p class="section__perex mb-25">%s</p>', wp_kses( $pricing_desc, $allowed_html ) );
							}

							$pricing_graph = get_field( 'sk_transfer_pricing_graph', $pageID );
							if ( !empty( $pricing_graph ) ) :

								$graph_classes = array(
									'b-bottom-gray size--s-6-12',
									'b-left-gray b-bottom-gray size--s-6-12',
									'size--s-6-12',
									'b-left-gray size--s-6-12'
								);
						?>

						<ul class="b-metro b-metro--square mb-150-d">

							<?php
								foreach ( $pricing_graph as $index => $data ) :

									if ( empty( $data['desc'] ) && empty( $data['value'] ) && empty( $data['steps'] ) )
										continue;

									$item_css_class = '';
									if ( isset( $graph_classes[$index] ) ) {
										$item_css_class = ' ' . $graph_classes[$index];
									}

									$val = intval( $data['value'] );
								
							?>

							<li class="b-metro__item<?php echo esc_attr( $item_css_class ); ?>">
								<div class="b-metro__inner">
									<?php sk_iconSVG( $data['icon'], 'b-metro__icon color-blue' ); ?>
									<span class="b-metro__label"><?php echo esc_html( $data['desc'] ); ?></span>
									<strong class="b-metro__value mr-5">
										<span class="" data-end="<?php echo $data['value']; ?>" data-step="<?php echo  $data['steps'] ; ?>"><?php echo $data['value']; ?></span> %</strong>
									<?php
										$icon_color = 'color-red';
										if ( 'arrow-up' === $data['arrow'] ) $icon_color = 'color-green';

										sk_iconSVG( $data['arrow'], $icon_color );
									?>
								</div>
							</li>

							<?php
								endforeach;
							?>

						</ul>

						<?php
							endif;

							// TESTIMONIALS
							$testimonial_img = get_field( 'sk_transfer_pricing_testimonial_img', $pageID );;
							$testimonial_name = get_field( 'sk_transfer_pricing_testimonial_name', $pageID );
							$testimonial_desc = get_field( 'sk_transfer_pricing_testimonial_desc', $pageID );

							if ( !empty( $testimonial_name ) && !empty( $testimonial_desc ) && !empty( $testimonial_img ) ) {
								$include = true;
								$testimonial_class = 'mb-40-d-max';
								$testimonial_content_class = '';

								include( locate_template( 'components/testimonials.php', false, false ) );
							}

						?>

					</div>
				</div>
				<div class="grid__cell size--6-12">
					<div class="m-auto w-570">

						<?php
							$transport_title = get_field( 'sk_transfer_transport_title', $pageID );
							if ( !empty( $transport_title ) ) {
								printf( '<h3 class="section__subtitle text-center">%s</h3>', esc_html( $transport_title ) );
							}

							$transport_desc = get_field( 'sk_transfer_transport_desc', $pageID );
							if ( !empty( $transport_desc ) ) {
								printf( '<p class="section__perex">%s</p>', wp_kses( $transport_desc, $allowed_html ) );
							}

							$transport_graph = get_field( 'sk_transfer_transport_graph', $pageID );
							if ( !empty( $transport_graph ) ) :
						?>
						<ul class="b-progress b-progress--right mb-40 mb-75-t">

							<?php
								foreach ( $transport_graph as $index => $data ) :

									if ( empty( $data['desc'] ) && empty( $data['value'] ) && empty( $data['width'] ) )
										continue;

									$bg_color = $data['color'];
									$color = $bg_color;
									if ( 'blue-dark' === $bg_color && 100 === intval( $data['width'] ) ) $color = 'white';
							?>

							<li class="b-progress__item">
								<span class="b-progress__table">
									<span class="b-progress__cell">
										<span class="b-progress__bar">
											<?php
												if ( 70 <= intval( $data['width'] ) ) :
											?>
											<span class="b-progress__percent bg-<?php echo esc_attr( $bg_color ); ?>" style="width:<?php echo intval( $data['width'] ); ?>%;">
												<strong class="b-progress__label color-<?php echo esc_attr( $color ); ?>"><?php echo esc_html( $data['desc'] ); ?></strong>
											</span>
											<?php
												else :
											?>
											<span class="b-progress__percent bg-<?php echo esc_attr( $bg_color ); ?>" style="width:<?php echo intval( $data['width'] ); ?>%;"></span>
											<strong class="b-progress__label color-<?php echo esc_attr( $color ); ?>"><?php echo esc_html( $data['desc'] ); ?></strong>
											<?php
												endif;
											?>
										</span>
									</span>
									<span class="b-progress__cell">
										<span class="b-progress__value color-<?php echo esc_attr( $bg_color ); ?>"><?php echo intval( $data['value'] ); ?> %</span>
									</span>
									<span class="b-progress__cell">
										<?php
											$icon_color = 'color-red';
											if ( 'arrow-up' === $data['icon'] ) $icon_color = 'color-green';

											sk_iconSVG( $data['icon'], $icon_color );
										?>
									</span>
								</span>
							</li>

							<?php
								endforeach;
							?>

						</ul>

						<?php
							endif;

							// TESTIMONIALS
							$testimonial_img = get_field( 'sk_transfer_transport_testimonial_img', $pageID );;
							$testimonial_name = get_field( 'sk_transfer_transport_testimonial_name', $pageID );
							$testimonial_desc = get_field( 'sk_transfer_transport_testimonial_desc', $pageID );

							if ( !empty( $testimonial_name ) && !empty( $testimonial_desc ) && !empty( $testimonial_img ) ) {
								$include = true;
								$testimonial_class = '';
								$testimonial_content_class = '';

								include( locate_template( 'components/testimonials.php', false, false ) );
							}
						?>

					</div>
				</div>
			</div>
		</div>
	</section>
