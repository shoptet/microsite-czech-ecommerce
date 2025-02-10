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
	ob_start();

	$template_name = get_page_template_slug( $page->ID );
	if ( !empty( $template_name ) && 0 === validate_file( $template_name ) ) {
		include( locate_template( $template_name, false, false ) );
	}

	$page_content = ob_get_clean();
	
	$output .= $page_content;

}
wp_reset_query();

// OUTPUT
echo $output;
if (!is_user_logged_in()):
?>
<div class="backdrop">
	<div class="modal">
		<img style="width: 100%; max-width: 20rem; height: auto; margin-bottom: 4rem;" src="<?php echo THEME_WEB_ROOT; ?>/static/img/illust/content/logo-ceska-ecommerce.svg" alt="Česká e-commerce" width="500" height="56">
		<h1><strong>Aktuální data se právě připravují&hellip;</strong></h1>
	</div>
</div>
<style>
	html,
	body {
		position: relative;
		overflow: hidden;
	}
	.backdrop {
		display: flex;
		align-items: center;
		justify-content: center;
		position: fixed;
		top: 0;
		left: 0;
		width: 100vw;
		height: 100vh;
		background-color: rgba(0, 0, 0, 0.85);
		z-index: 1000;
	}
	.modal {
		max-width: 500px;
		padding: 3rem 2rem 5rem 2rem;
		margin: 1rem;
		text-align: center;
		background-color: white;
	}
</style>
<?php
endif;
get_footer();
?>
