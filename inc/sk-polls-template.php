<?php
	$options = get_field( 'sk_survey_options', $poll_id );

	if ( !empty( $options ) ) :
		if ( !isset( $is_ajax ) ) : // pokud aktualizujeme jen <ul> seznam pri hlasovani, tak nezobrazime zbytek
?>

<li class="grid__cell size--t-6-12">
	<h3 class="section__subtitle text-center mb-40"><?php echo apply_filters( 'the_title', $post->post_title ); ?></h3>

	<ul class="b-quiz" id="poll-container-<?php echo $poll_id; ?>" data-poll-id="<?php echo $poll_id; ?>">
		<?php
		endif;

			$votes_summary = 0;
			foreach ( $options as $option ) {
				$votes_summary = $votes_summary + intval( $option['default_value'] ) + intval( $option['votes'] );
			}

			$pcleft = 100;
			foreach ( $options as $index => $option ) :
				if ( empty( $option['desc'] ) && empty( $option['default_value'] ) ) continue;

				$option_id = intval( $poll_id ) . '_' . intval( $index );

				$votes = intval( $option['default_value'] ) + intval( $option['votes'] );
				$votes_percent = round( $votes / ( $votes_summary / 100 ) );
				if($pcleft < $votes_percent){
					$votes_percent = $pcleft;
				}
				$pcleft -= $votes_percent;
		?>

		<li class="b-quiz__item" id="poll-vote-<?php echo $poll_id; ?>-<?php echo $index; ?>">
			<span class="b-quiz__value color-<?php echo esc_attr( $option['color'] ); ?>"><?php echo $votes_percent; ?> %</span>
			<a id="<?php echo esc_attr( $option_id ); ?>" href="#" data-poll-id="<?php echo $poll_id; ?>" data-vote-id="<?php echo $index; ?>" class="b-quiz__inner poll-vote"><?php echo esc_html( $option['desc'] ); ?></a>
		</li>

		<?php
			endforeach;

			if ( !isset( $is_ajax ) ) : // pokud aktualizujeme jen <ul> seznam pri hlasovani, tak nezobrazime zbytek
		?>
	</ul>
</li>

<?php
		endif;
	endif;
?>
