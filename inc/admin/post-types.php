<?php

/*-----------------------------------------------------------------------------------
/*	Add Custom Post Types
/*---------------------------------------------------------------------------------*/
function sk_custom_post_types() {

	// Surveys
	$args_surveys = array(
		'labels' => sk_post_type_labels( 'Anketa', 'Ankety' ),
		'public' => true,
		'has_archive' => false,
		'exclude_from_search' => true,
		'publicly_queryable' => false,
		'show_ui' => true,
		'query_var' => false,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 10,
		'rewrite' => false,
		'supports' => array('title', 'page-attributes'),
		'menu_icon' => 'dashicons-megaphone'
	);
	register_post_type( 'sk_surveys', $args_surveys );

}
add_action( 'init', 'sk_custom_post_types', 1 );
