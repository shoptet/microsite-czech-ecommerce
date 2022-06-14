<?php
/**
 * Template name: Zajimavosti
 *
 * @package ceskaecommerce
 */
?>

	<section class="section section--gray-border" role="region" id="zajimavosti">
		<div class="row-main">

			<?php
				$poi_title = get_field( 'sk_poi_title', $pageID );
				if ( !empty( $poi_title ) ) {
					printf( '<h2>%s</h2>', esc_html( $poi_title ) );
				}
			?>

			<ul class="grid grid--wider">
				<li class="grid__cell size--6-12">
					<div class="w-570 m-auto">

						<?php
							$devices_title = get_field( 'sk_poi_devices_title', $pageID );
							if ( !empty( $devices_title ) ) {
								printf( '<h3 class="section__subtitle text-center mb-50-t">%s</h3>', esc_html( $devices_title ) );
							}
						?>

						<div class="mb-35">
							<?php
								include( locate_template( 'components/charts/devices2.php', false, false ) );
							?>
						</div>
						<div class="b-chart mb-60 mb-35-t">
							<ul class="grid">
								<li class="grid__cell size--s-4-12 b-chart__item">
									<?php sk_iconSVG('desktop', 'color-blue'); ?>
									<strong class="b-chart__value">49 %</strong> Desktop
								</li>

								<li class="grid__cell size--s-4-12 pl-30-t pl-15 b-chart__item">
									<?php sk_iconSVG('mobile', 'color-orange'); ?>
									<strong class="b-chart__value">47 %</strong> Mobil
								</li>
								<li class="grid__cell size--s-4-12 pl-20-t pl-10 b-chart__item">
									<?php sk_iconSVG('tablet', 'color-green'); ?>
									<strong class="b-chart__value">4 %</strong> Tablet
								</li>
							</ul>
						</div>
					</div>
				</li>
				<li class="grid__cell size--6-12">
					<div class="w-570 m-auto">

						<?php
							$behavior_title = get_field( 'sk_poi_behavior_title', $pageID );
							if ( !empty( $behavior_title ) ) {
								printf( '<h3 class="section__subtitle text-center mb-35">%s</h3>', esc_html( $behavior_title ) );
							}

							$behavior = get_field( 'sk_poi_behavior', $pageID );
							if ( !empty( $behavior ) ) :
						?>

						<ul class="b-metro w-570 m-auto mb-40">

							<?php
								foreach ( $behavior as $index => $data ) :

									if ( empty( $data['value'] ) && empty( $data['desc'] ) ) continue;
							?>

							<li class="b-metro__item text-left-d size--t-4-12 size--s-6-12">
								<?php
									printf( '<strong class="b-metro__value b-metro__value--small color-%s">%s</strong>', esc_attr( $data['color'] ), esc_html( $data['value'] ) );
									printf( '<span class="b-metro__label b-metro__label--small">%s</span>', esc_html( $data['desc'] ) );
								?>
							</li>

							<?php
								endforeach;
							?>

						</ul>

						<?php
							endif;
						?>

					</div>
				</li>
			</ul>

			<?php
				$testimonial_class = '';
				$testimonial_content_class = '';
				$include = false;
				include( locate_template( 'components/testimonials.php', false, false ) );
			?>

		</div>
	</section>
