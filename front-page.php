<?php
/**
 * Template for displaying homepage
 *
 * @package ceskaecommerce
 */

get_header();
$allowed_html = sk_get_allowed_html();

// GET PAGES AND LOAD TEMPLATES
$output = '';
$args = array(
	'posts_per_page' => 20,
	'post_type' => 'page',
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'no_found_rows' => true,
	'suppress_filters' => false,
	'ignore_sticky_posts' => true,
	'post_status' => 'publish'
);
$pages = new WP_Query( $args );
foreach ( $pages->posts as $page ) {

	$pageID = $page->ID;
	$cache_key = 'sk_page_' . intval( $pageID );
	$page_content = '';
	if ( WP_DEBUG || false === ( $page_content = get_transient( $cache_key ) ) ) {

		ob_start();

		$template_name = get_page_template_slug( $page->ID );
		if ( !empty( $template_name ) && 0 === validate_file( $template_name ) ) {
			include( locate_template( $template_name, false, false ) );
		}

		$page_content = ob_get_clean();

		// SAVE TRANSIENT
		set_transient( $cache_key, $page_content, 7 * DAY_IN_SECONDS );

	}
	$output .= $page_content;

}
wp_reset_query();

// OUTPUT
echo $output;

get_footer();
?>
