<?php
/**
 * Template name: Sdilet na FB
 *
 * @package ceskaecommerce
 */
?>

	<?php
		$share_desc = get_field( 'sk_share_desc', $pageID );
		if ( !empty( $share_desc ) ) :
	?>

	<section class="section section--green pt-5 pb-5 no-print" role="region">
		<div class="row-main">
			<div class="b-line">
				<div class="b-line__cell">
					<p class="b-line__text"><?php echo wp_kses( $share_desc, $allowed_html ); ?></p>
				</div>
				<div class="b-line__cell">
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( home_url() ); ?>" class="b-btn--facebook" target="_blank"><?php sk_iconSVG('facebook'); ?> Sdílet na Facebooku</a>
				</div>
			</div>
		</div>
	</section>

	<?php
		endif;
	?>
