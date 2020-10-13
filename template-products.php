<?php
/**
 * Template name: Produkty
 *
 * @package ceskaecommerce
 */
?>

	<section class="section" role="region" id="produkty">
		<div class="row-main">

			<?php
				$products_title = get_field( 'sk_products_title', $pageID );
				if ( !empty( $products_title ) ) {
					printf( '<h2>%s</h2>', esc_html( $products_title ) );
				}
			?>

			<div class="grid grid--wider">
				<div class="grid__cell size--6-12">
					<div class="m-auto w-570">

						<?php
							$goods_title = get_field( 'sk_products_goods_title', $pageID );
							if ( !empty( $goods_title ) ) {
								printf( '<h3 class="section__subtitle text-center">%s</h3>', esc_html( $goods_title ) );
							}

							$goods_desc = get_field( 'sk_products_goods_desc', $pageID );
							if ( !empty( $goods_desc ) ) {
								printf( '<p class="section__perex mb-50">%s</p>', wp_kses( $goods_desc, $allowed_html ) );
							}

							$goods = get_field( 'sk_products_goods', $pageID );
							if ( !empty( $goods ) ) :
						?>

						<ul class="b-progress mb-40">

							<?php
								foreach ( $goods as $data ) :

									$color = $data['color'];
							?>

							<li class="b-progress__item">
								<span class="b-progress__table">
									<?php
										if ( !empty( $data['width'] ) && !empty( $data['desc'] ) ) :
									?>
									<span class="b-progress__cell">
										<span class="b-progress__bar">
											<span class="b-progress__percent bg-<?php echo esc_attr( $color ); ?>" style="width:<?php echo esc_attr( intval( $data['width'] ) ); ?>%;"></span>
										</span>
										<strong class="b-progress__label color-<?php echo esc_attr( $color ); ?>"><?php echo esc_html( $data['desc'] ); ?></strong>
									</span>
									<?php
										endif;

										if ( !empty( $data['value'] ) ) :
											$val = number_format( $data['value'], 0, '', '' );
									?>
									<span class="b-progress__cell">
										<span class="b-progress__value color-<?php echo esc_attr( $color ); ?>">
											<span class="" data-end="<?php echo esc_attr( $val ); ?>" data-step="1"><?php echo esc_html( $val ); ?></span> %
										</span>
									</span>
									<?php
										endif;

										if ( !empty( $data['icon'] ) ) :
											$color = 'color-green';
											if ( 'arrow-down' === $data['icon'] ) $color = 'color-red';
									?>
									<span class="b-progress__cell">
										<?php sk_iconSVG( $data['icon'], $color ); ?>
									</span>
									<?php
										endif;
									?>
								</span>
							</li>

							<?php
								endforeach;
							?>

						</ul>

						<?php
							endif;
						?>

					</div>
				</div>

				<div class="grid__cell size--6-12">
					<div class="m-auto w-570">

						<?php
							$best_title = get_field( 'sk_products_best_title', $pageID );
							if ( !empty( $best_title ) ) {
								printf( '<h3 class="section__subtitle text-center">%s</h3>', esc_html( $best_title ) );
							}

							$best_desc = get_field( 'sk_products_best_desc', $pageID );
							if ( !empty( $best_desc ) ) {
								printf( '<p class="section__perex mb-40">%s</p>', wp_kses( $best_desc, $allowed_html ) );
							}
						?>

						<ol class="b-winner mb-50">
							<li class="b-winner__item b-winner--gold">
								<img src="https://www.ceska-ecommerce.cz/wp-content/uploads/2017/11/phone.png" /><br /> Telefony
							</li>

							<li class="b-winner__item b-winner--silver">
								<img src="https://www.ceska-ecommerce.cz/wp-content/uploads/2017/11/gadgets.png" /><br /> Gadgety
							</li>

							<li class="b-winner__item b-winner--bronz">
								<img src="https://www.ceska-ecommerce.cz/wp-content/uploads/2017/11/pool.png" /><br /> Bazény
							</li>

						</ol>

						<?php
							$jumpers_title = get_field( 'sk_products_jumpers_title', $pageID );
							if ( !empty( $jumpers_title ) ) {
								printf( '<h3 class="section__subtitle text-center">%s</h3>', esc_html( $jumpers_title ) );
							}

							$jumpers_desc = get_field( 'sk_products_jumpers_desc', $pageID );
							if ( !empty( $jumpers_desc ) ) {
								printf( '<p class="section__perex mb-15">%s</p>', wp_kses( $jumpers_desc, $allowed_html ) );
							}

							$jumpers = get_field( 'sk_products_jumpers', $pageID );
							if ( !empty( $jumpers ) ) :
						?>

						<ul class="b-metro">

							<?php
								foreach ( $jumpers as $jumper ) :
									if ( empty( $jumper['title'] ) && empty( $jumper['color'] ) && empty( $jumper['value'] ) && empty( $jumper['steps'] ) )
										continue;
							?>

							<li class="b-metro__item size--s-6-12 size--t-4-12">
								<span class="b-metro__label"><?php echo esc_html( $jumper['title'] ); ?></span>
								<strong class="b-metro__value color-<?php echo esc_attr( $jumper['color'] ); ?>">
									<span class="js-counter" data-end="<?php echo esc_attr( $jumper['value'] ); ?>" data-step="<?php echo esc_attr( $jumper['steps'] ); ?>"><?php echo esc_html( number_format( $jumper['value'], 0, ',', ' ' ) ); ?></span> %
								</strong>
							</li>

							<?php
								endforeach;
							?>

						</ul>

						<?php
							endif;
						?>

					</div>
				</div>
			</div>

			<?php
				$testimonial_class = 'mt-40';
				$testimonial_content_class = '';
				$include = false;
				include( locate_template( 'components/testimonials.php', false, false ) );
			?>

		</div>
	</section>
