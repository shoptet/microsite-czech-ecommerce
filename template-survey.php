<?php
/**
 * Template name: Ankety
 *
 * @package ceskaecommerce
 */

if ( empty( $pageID ) ) {
	$pageID = PAGE_POLLS_ID;
}

?>

		<section class="alert hide" id="poll-alert">
			<div class="row-main">
				<div class="alert__inner"></div>
			</div>
		</section>

		<section class="section" role="region" id="ankety">
			<div class="row-main">
				<h2><?php echo get_the_title( $pageID ); ?></h2>

				<?php
					$args = array(
						'posts_per_page' => 20,
						'post_type' => 'sk_surveys',
						'orderby' => 'menu_order',
						'order' => 'ASC',
						'no_found_rows' => true,
						'suppress_filters' => false,
						'ignore_sticky_posts' => true,
						'post_status' => 'publish'
					);
					$surveys = new WP_Query( $args );
					if ( $surveys->have_posts() ) :
				?>

				<ul class="grid grid--wider">
					<?php
						foreach ( $surveys->posts as $post ) :
							$poll_id = $post->ID;
							include( locate_template( 'inc/sk-polls-template.php' ) );
						endforeach;
					?>
				</ul>

				<?php
					endif;
					wp_reset_postdata();

					// TESTIMONIALS
					$testimonial_class = '';
					$testimonial_content_class = '';
					$include = false;
					include( locate_template( 'components/testimonials.php', false, false ) );
				?>

			</div>
		</section>
