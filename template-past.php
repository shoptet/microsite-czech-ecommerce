<?php
/**
 * Template name: Minulost
 *
 * @package ceskaecommerce
 */
?>

	<section class="section section--blue-border" role="region" id="minulost">
		<div class="row-main">

			<?php
				$past_title = get_field( 'sk_past_title', $pageID );
				if ( !empty( $past_title ) ) {
					printf( '<h2>%s</h2>', esc_html( $past_title ) );
				}

				$past_content = get_field( 'sk_past_content', $pageID );
				if ( !empty( $past_content ) ) :
			?>

			<ul class="b-timeline">

				<?php
					foreach ( $past_content as $item ) :
						if ( empty( $item['title'] ) && empty( $item['content'] ) ) continue;
				?>

				<li class="b-timeline__item">
					<a href="<?php echo strip_tags($item['content']); ?>" target="_blank" class="b-timeline__label"><?php echo esc_html( $item['title'] ); ?></a>
<?php
/*
<a data-fancybox="modal" data-src="#modal-<?php echo esc_attr( sanitize_title( $item['title'] ) ); ?>" href="javascript:;" class="b-timeline__label"><?php echo esc_html( $item['title'] ); ?></a>
*/
 ?>
				</li>

				<?php
					endforeach;
				?>

			</ul>

			<?php
			/*
				foreach ( $past_content as $item ) :
					if ( empty( $item['title'] ) && empty( $item['content'] ) ) continue;
			?>

			<div id="modal-<?php echo esc_attr( sanitize_title( $item['title'] ) ); ?>" class="fancybox-content">
				<?php
					printf( '<h3>%s</h3>', esc_html( $item['title'] ) );
					echo apply_filters( 'the_content', $item['content'] );
				?>
			</div>

			<?php
				endforeach;
*/
				endif;
			?>

		</div>
	</section>
