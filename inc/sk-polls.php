<?php

/*-----------------------------------------------------------------------------------*/
/*	Existuje anketa?
/*-----------------------------------------------------------------------------------*/
function sk_poll_exists( $poll_id ) {
	return ( get_post_status( $poll_id ) ? true : false );
}

/*-----------------------------------------------------------------------------------*/
/*	Muze uzivatel hlasovat v ankete?
/*-----------------------------------------------------------------------------------*/
function sk_poll_can_vote( $poll_id ) {
	global $wpdb;

	$ip_address = $_SERVER['REMOTE_ADDR'];
	$date_compare = date( 'Y-m-d H:i:s', time() - 86400 );

	return ( $wpdb->get_var( 'SELECT id FROM ' . $wpdb->prefix . 'votes WHERE poll_id = "' . $poll_id . '" AND ip_address = "' . $ip_address . '" AND date_created > "' . $date_compare . '"' ) == null ? true : false );
}

/*-----------------------------------------------------------------------------------*/
/*	Zahlasujeme v ankete
/*-----------------------------------------------------------------------------------*/
function sk_poll_vote( $poll_id, $vote_id ) {
	global $wpdb;

	$return = $wpdb->insert( $wpdb->prefix . 'votes', array(
		'poll_id' => $poll_id,
		'vote_id' => $vote_id,
		'ip_address' => $_SERVER['REMOTE_ADDR'],
		'date_created' => date( 'Y-m-d H:i:s' )
	) );

	sk_poll_update_votes( $poll_id, $vote_id );

	return $return;
}

/*-----------------------------------------------------------------------------------*/
/*	Aktualizujeme pocty hlasu
/*-----------------------------------------------------------------------------------*/
function sk_poll_update_votes( $poll_id, $vote_id ) {
	global $wpdb;

	$votes = intval( $wpdb->get_var( 'SELECT COUNT(id) FROM ' . $wpdb->prefix . 'votes WHERE poll_id = "' . $poll_id . '" AND vote_id = "' . $vote_id . '"' ) );

	update_sub_field( array( 'sk_survey_options', ( $vote_id + 1 ), 'votes'), $votes, $poll_id );
}

/*-----------------------------------------------------------------------------------*/
/*	AJAX: Hlasovani v ankete
/*-----------------------------------------------------------------------------------*/
function sk_ajax_poll_vote( $data ) {
	// inicializace promennych
	$poll_id = intval( $data['id'] );
	$vote_id = intval( $_POST['vote_id'] );
	$is_ajax = true;
	$html = null;

	// overime, jestli anketa existuje
	if ( sk_poll_exists( $poll_id ) ) {
		// muze uzivatel hlasovat?
		if ( sk_poll_can_vote( $poll_id ) ) {
			// posleme hlas
			if ( sk_poll_vote( $poll_id, $vote_id ) ) {

				$messages = array( 'type' => 'success', 'text' => __( 'Vaše hlasování bylo zaznamenáno', 'ecommerce' ) );

				// zobrazime sablonu
				ob_start();
				include( locate_template( 'inc/sk-polls-template.php' ) );
				$html = trim( ob_get_clean() );

				// ulozime do cookie, pro co hlasoval
				setcookie( 'poll_' . $poll_id, $vote_id, time() + 86400, '/' );

			} else {
				$messages = array( 'type' => 'error', 'text' => __( 'Chyba během hlasování', 'ecommerce' ) );
			}
		} else {
			$messages = array( 'type' => 'error', 'text' => __( 'V této anketě jste již hlasoval', 'ecommerce' ) );
		}
	} else {
		$messages = array( 'type' => 'error', 'text' => __( 'Anketa neexistuje', 'ecommerce' ) );
	}

	// promazeme cache
	delete_transient( 'sk_page_' . PAGE_POLLS_ID );

	// navratime json
	$return = array(
		'messages' => $messages,
		'html' => $html
	);

	wp_send_json( $return );
}

/*-----------------------------------------------------------------------------------*/
/*	Pridame endpoint pro hlasovani do WP-API
/*-----------------------------------------------------------------------------------*/
add_action( 'rest_api_init', function () {
	register_rest_route( 'sk-poll/v1', '/(?P<id>\d+)', array(
		'methods' => 'POST',
		'callback' => 'sk_ajax_poll_vote',
	) );
} );
