<?php
/**
 * Template name: O projektu
 *
 * @package ceskaecommerce
 */
?>

	<section class="section section--gray pb-40" role="region" id="o-projektu">
		<div class="row-main">

			<?php
				$about_title = get_field( 'sk_about_title', $pageID );
				if ( !empty( $about_title ) ) {
					printf( '<h2>%s</h2>', esc_html( $about_title ) );
				}
			?>

			<div class="grid grid--wider mb-60">
				<?php
					if ( !empty( $page->post_content ) ) :
				?>
				<div class="grid__cell size--7-12">
					<?php
						echo apply_filters( 'the_content', $page->post_content );
					?>
				</div>
				<?php
					endif;
				?>
				<div class="grid__cell size--5-12">
					<?php
						$email_address = get_option( 'options_sk_global_email' );
						if ( !empty( $email_address ) ) :
					?>
					<strong class="b-about__subtitle">Kontakt pro média:</strong>
					<a href="mailto:<?php echo antispambot( $email_address ); ?>" class="b-about__link"><?php sk_iconSVG('envelope'); ?><?php echo antispambot( $email_address ); ?></a>
					<?php
						endif;

						// TESTIMONIALS
						$testimonial_class = 'mt-30';
						$testimonial_content_class = 'b-testimonial__content--white';
						$include = false;
						include( locate_template( 'components/testimonials.php', false, false ) );
					?>

				</div>
			</div>


		</div>
	</section>
