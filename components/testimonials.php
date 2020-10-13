<?php
	$css_class = '';
	if ( isset( $testimonial_class ) && !empty( $testimonial_class ) ) {
		$css_class = ' ' . $testimonial_class;
	}

	$css_content_class = '';
	if ( isset( $testimonial_content_class ) && !empty( $testimonial_content_class ) ) {
		$css_content_class = ' ' . $testimonial_content_class;
	}

	$in_include = false;
	if ( isset( $include ) && $include ) {
		$in_include = true;
	}

	if ( ! $in_include ) {
		$testimonial_name = get_field( 'sk_testimonial_name', $pageID );
		$testimonial_desc = get_field( 'sk_testimonial_desc', $pageID );
		$testimonial_img = get_field( 'sk_testimonial_img', $pageID );
	}

	if ( !empty( $testimonial_name ) && !empty( $testimonial_desc ) ) :
?>

<div class="b-testimonial<?php echo esc_attr( $css_class ); ?>">
	<?php
		if ( !empty( $testimonial_img ) ) {
			$attachment = wp_get_attachment_image( intval( $testimonial_img ), 'thumbnail' );
			printf( '<div class="b-testimonial__avatar">%s</div>', $attachment );
		}
	?>

	<blockquote class="b-testimonial__content<?php echo esc_attr( $css_content_class ); ?>">
		<cite class="b-testimonial__cite"><?php echo esc_html( $testimonial_name ); ?></cite>
		<div>

			<?php
				$review = explode( PHP_EOL, $testimonial_desc );
				foreach ( $review as $content ) {
					printf( '<p class="b-testimonial__text">%s</p>', wp_kses( $content, $allowed_html ) );
				}
			?>

		</div>
	</blockquote>
</div>

<?php
	endif;
?>
