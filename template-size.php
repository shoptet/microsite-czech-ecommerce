<?php
/**
 * Template name: Velikost
 *
 * @package ceskaecommerce
 */
?>
    <section class="section section-claim" role="region" id="velikost">
        <div class="section-inner row-main">
            <div class="claim">
                <div class="claim-inner">
                	<?php
        				$page_title = get_field( 'sk_size_title', $pageID );
        				if ( !empty( $page_title ) ) {
        					printf( '<h1>%s</h1>', esc_html( $page_title ) );
        				}

        				$page_desc = get_field( 'sk_size_desc', $pageID );
        				if ( !empty( $page_desc ) ) {
        					printf( '<p class="section__perex mb-40">%s</p>', wp_kses( $page_desc, $allowed_html ) );
        				}
        			?>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
		<div class="row-main">
			<?php
				// STATISTICS
				$statistics = get_field( 'sk_size_statistics', $pageID );
				if ( !empty( $statistics ) ) :

					$css_classes = array(
						'size--t-4-12',
						'size--t-3-12',
						'size--t-5-12'
					);
			?>

			<div class="b-intro mb-50">
				<ul class="grid">

					<?php
						foreach ( $statistics as $index => $data ) :
							$css_class = '';
							if ( isset( $css_classes[$index] ) ) {
								$css_class = ' ' . $css_classes[$index];
							}
					?>

					<li class="grid__cell<?php echo esc_attr( $css_class ); ?>">
						<?php
							// ICON
							if ( !empty( $data['icon'] ) ) {
								sk_iconSVG( $data['icon'] );
							}

							// TITLE
							if ( !empty( $data['title'] ) ) {
								printf( '<h3 class="b-intro__title">%s</h3>', esc_html( $data['title'] ) );
							}

							// PEREX
							if ( !empty( $data['number'] ) ) {
								$data_attr = '';
								if ( !empty( $data['steps'] ) ) {
									$data_attr .= ' data-end="' . esc_attr( $data['number'] ) . '"';
									$data_attr .= ' data-step="' . esc_attr( $data['steps'] ) . '"';
								}

								printf( '<p class="b-intro__perex"><span class="js-counter"%s>&nbsp;</span></p>', $data_attr, number_format( $data['number'], 0, ',', ' ' ) );
							}

							// YEAR
							if ( !empty( $data['year'] ) ) :
						?>
						<dl class="b-intro__list">
							<dt class="b-intro__label">Do konce roku:</dt>
							<dd class="b-intro__value"><?php echo number_format(esc_html( $data['year']), 0, ",", " " ); ?></dd>
						</dl>

						<?php
							endif;

							// CHANGE
							if ( !empty( $data['change'] ) ) :
						?>

						<dl class="b-intro__list">
							<dt class="b-intro__label">Meziroční změna:</dt>
							<dd class="b-intro__value color-green"><?php echo esc_html( $data['change'] ); ?></dd>
						</dl>

						<?php
							endif;
						?>

					</li>

					<?php
						endforeach;
					?>

				</ul>
			</div>

			<?php
				endif;

				// TESTIMONIALS
				$testimonial_class = '';
				$testimonial_content_class = '';
				$include = false;
				include( locate_template( 'components/testimonials.php', false, false ) );
			?>

		</div>
	</section>
