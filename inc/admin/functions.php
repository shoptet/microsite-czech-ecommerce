<?php

/**
 * Generate the labels for custom post types
 *
 * @param string $singular The singular post type name
 * @param string $plural The plural post type name
 * @return array Array of labels
 */
function sk_post_type_labels( $singular, $plural = '' ) {

	if ( $plural == '') $plural = $singular;

	return array(
		'name' => _x( $plural, 'post type general name', 'sk-framework' ),
		'singular_name' => _x( $singular, 'post type singular name', 'sk-framework' ),
		'add_new' => __( 'Add New', 'sk-framework' ),
		'add_new_item' => sprintf( __( 'Add New %s', 'sk-framework' ), $singular),
		'edit_item' => sprintf( __( 'Edit %s', 'sk-framework' ), $singular),
		'new_item' => sprintf( __( 'New %s', 'sk-framework' ), $singular),
		'view_item' => sprintf( __( 'View %s', 'sk-framework' ), $singular),
		'search_items' => sprintf( __( 'Search %s', 'sk-framework' ), $plural),
		'not_found' =>  sprintf( __( 'No %s found', 'sk-framework' ), $plural),
		'not_found_in_trash' => sprintf( __( 'No %s found in Trash', 'sk-framework' ), $plural),
		'parent_item_colon' => ''
	);
}

/**
 * Generate the labels for custom taxonomies
 *
 * @param string $singular The singular taxonomy name
 * @param string $plural The plural taxonomy name
 * @return array Array of labels
 */
function sk_taxonomy_labels( $singular, $plural = '' ) {

	if ( $plural == '') $plural = $singular;

	return array(
		'name' => _x( $plural, 'taxonomy general name', 'sk-framework' ),
		'singular_name' => _x( $singular, 'taxonomy singular name', 'sk-framework' ),
		'search_items' => sprintf( __( 'Search %s', 'sk-framework' ), $plural),
		'popular_items' => sprintf( __( 'Popular %s', 'sk-framework' ), $plural),
		'all_items' => sprintf( __( 'All %s', 'sk-framework' ), $plural),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => sprintf( __( 'Edit %s', 'sk-framework' ), $singular),
		'update_item' => sprintf( __( 'Update %s', 'sk-framework' ), $singular),
		'add_new_item' => sprintf( __( 'Add New %s', 'sk-framework' ), $singular),
		'new_item_name' => sprintf( __( 'New %s Name', 'sk-framework' ), $singular),
		'separate_items_with_commas' => sprintf( __( 'Separate %s with commas', 'sk-framework' ), $plural),
		'add_or_remove_items' => sprintf( __( 'Add or remove %s', 'sk-framework' ), $plural),
		'choose_from_most_used' => sprintf( __( 'Choose from the most used %s', 'sk-framework' ), $plural)
	);
}

/*-----------------------------------------------------------------------------------*/
/*  DELETE TRANSIENTS
/*-----------------------------------------------------------------------------------*/

function sk_delete_transient_menu( $post_id ) {

	// If this is just a revision, exit
	if ( wp_is_post_revision( $post_id ) ) return;

	delete_transient( 'sk_main_menu' );

	// delete page content transients
	$cache_key = 'sk_page_' . intval( $post_id );
	delete_transient( $cache_key );

}
add_action( 'save_post_page', 'sk_delete_transient_menu', 10, 1 );

/*-----------------------------------------------------------------------------------*/
/*  DISABLE TEXT FIELD
/*-----------------------------------------------------------------------------------*/

function sk_disable_acf_load_field( $field ) {

	$field['disabled'] = 1;
	return $field;

}
add_filter( 'acf/load_field/key=field_59e89f1362582', 'sk_disable_acf_load_field' );
