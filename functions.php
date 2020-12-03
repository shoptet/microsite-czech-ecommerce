<?php

require __DIR__ . '/vendor/autoload.php';

/**
 * SK functions and definitions
 *
 * @package ceskaecommerce
 */

/*-----------------------------------------------------------------------------------*/
/*	Default theme constants
/*-----------------------------------------------------------------------------------*/
define( 'SM_THEME_NAME', 'ceskaecommerce' );
define( 'SM_THEME_VERSION', '1.1' );

define( 'THEME_WEB_ROOT', get_stylesheet_directory_uri() );
define( 'THEME_DOCUMENT_ROOT', get_stylesheet_directory() );

define( 'PAGE_POLLS_ID', 17 );

Shoptet\ShoptetExternal::init();
Shoptet\ShoptetUserRoles::init();
Shoptet\ShoptetStats::init();
Shoptet\ShoptetSecurity::init();

/*-----------------------------------------------------------------------------------*/
/*	ACF
/*-----------------------------------------------------------------------------------*/

add_filter( 'acf/settings/path', 'sk_acf_settings_path' );
function sk_acf_settings_path( $path ) {

	// update path
	$path = THEME_DOCUMENT_ROOT . '/acf/';
	// return
	return $path;

}

add_filter( 'acf/settings/dir', 'sk_acf_settings_dir' );
function sk_acf_settings_dir( $dir ) {

	// update path
	$dir = THEME_WEB_ROOT . '/acf/';
	// return
	return $dir;

}

/**
 * Hide ACF on production
 */

if ( ! WP_DEBUG ) {
	add_filter( 'acf/settings/show_admin', '__return_false' );
}

/*-----------------------------------------------------------------------------------*/
/*	Load Components
/*-----------------------------------------------------------------------------------*/

/**
 * Admin functions
 */
require get_parent_theme_file_path( '/acf/acf.php' );
require get_parent_theme_file_path( '/inc/sk-helper-functions.php' );
require get_parent_theme_file_path( '/inc/sk-image-filenames.php' );
require get_parent_theme_file_path( '/inc/admin/functions.php' );
require get_parent_theme_file_path( '/inc/admin/post-types.php' );

/**
 * Shortcodes
 */
require get_parent_theme_file_path( '/inc/shortcodes.php' );

/**
 * Components
 */
require get_parent_theme_file_path( '/inc/components.php' );

/**
 * Ankety
 */
require get_parent_theme_file_path( '/inc/sk-polls.php' );

/*-----------------------------------------------------------------------------------*/
/*	Load Options Page
/*-----------------------------------------------------------------------------------*/
if( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page( array(
		'page_title' 	=> __( 'E-commerce v ČR', 'ceskaecommerce' ),
		'menu_title'	=> __( 'E-commerce v ČR', 'ceskaecommerce' ),
		'menu_slug' 	=> 'ceskaecommerce-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	) );

}

/*-----------------------------------------------------------------------------------*/
/*	SK theme set up
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'sk_theme_setup' ) ) {
	function sk_theme_setup() {

		add_theme_support( 'title-tag' );

		// add_image_size( 'custom_size', 590, 334, true );

		// Set the default content width.
		$GLOBALS['content_width'] = apply_filters( 'sk_content_width', 640 );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_filter( 'use_default_gallery_style', '__return_false' );
		remove_action( 'wp_head', 'wp_generator' );
		// Admin bar
		if ( ! WP_DEBUG ) {
			show_admin_bar( false );
		}

		add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );
	}
}
add_action( 'after_setup_theme', 'sk_theme_setup' );

/*-----------------------------------------------------------------------------------*/
/*	Remove actions
/*-----------------------------------------------------------------------------------*/

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/*-----------------------------------------------------------------------------------*/
/*	Register and load JS
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'sk_enqueue_scripts' ) ) {
	function sk_enqueue_scripts() {

		/* Register our scripts -----------------------------------------------------*/
		wp_register_script( 'modernizr', THEME_WEB_ROOT . '/static/js/modernizr.min.js', array(), SM_THEME_VERSION, false );
		wp_register_script( 'polyfill', 'https://cdn.polyfill.io/v2/polyfill.min.js?features=default,Array.prototype.find', array(), SM_THEME_VERSION, true );
		wp_register_script( 'app', THEME_WEB_ROOT . '/static/js/app.js', array('jquery'), SM_THEME_VERSION, true );
		wp_register_script( 'ext', THEME_WEB_ROOT . '/static/js/ext.js', array('jquery'), SM_THEME_VERSION, true );

		// wp_localize_script( 'app', 'skwp', array(
		// 	'ajaxurl' => admin_url( 'admin-ajax.php' )
		// ) );

		/* Enqueue our scripts ------------------------------------------------------*/
		wp_enqueue_script( 'modernizr' );
		wp_enqueue_script( 'polyfill' );
		wp_enqueue_script( 'app' );
		wp_add_inline_script( 'app', 'App.run({})' );
		wp_enqueue_script( 'ext' );

		wp_deregister_script( 'wp-embed' );

		/* Load main CSS file -------------------------------------------------------*/
		wp_enqueue_style( 'sk-fonts', 'https://fonts.googleapis.com/css?family=Libre+Franklin:200,300,400,500,600|Source+Sans+Pro:400,600&amp;subset=latin-ext', array(), SM_THEME_VERSION, 'screen' );
		wp_enqueue_style( 'sk-style', THEME_WEB_ROOT . '/static/css/style.css', array(), SM_THEME_VERSION, 'screen' );
		wp_enqueue_style( 'sk-print', THEME_WEB_ROOT . '/static/css/print.css', array(), SM_THEME_VERSION, 'print' );
	}
}
add_action( 'wp_enqueue_scripts', 'sk_enqueue_scripts' );

/*-----------------------------------------------------------------------------------*/
/*  Remove paragraph from shortcode
/*-----------------------------------------------------------------------------------*/
add_filter( 'the_content', 'sk_shortcode_empty_paragraph_fix' );
function sk_shortcode_empty_paragraph_fix($content) {
	$array = array (
		'<p>[' => '[',
		']</p>' => ']',
		']<br />' => ']'
	);

	$content = strtr($content, $array);
	return $content;
}

/*-----------------------------------------------------------------------------------*/
/*	Adds custom classes to the array of body classes.
/*-----------------------------------------------------------------------------------*/
function sk_body_classes( $classes ) {

	if ( is_front_page() ) {
		$classes[] = 'page-homepage';
	} else {
		$classes[] = 'page-subpage';
	}

	return $classes;
}
add_filter( 'body_class', 'sk_body_classes' );

/*-----------------------------------------------------------------------------------*/
/*  Change excerpt
/*-----------------------------------------------------------------------------------*/
function sk_custom_excerpt_length( $length ) {
	return 50;
}
add_filter( 'excerpt_length', 'sk_custom_excerpt_length', 999 );

function sk_excerpt_more( $more ) {
	return '';
}
add_filter( 'excerpt_more', 'sk_excerpt_more' );

/**
 * Custom WordPress navigation
 */
add_action( 'after_setup_theme', 'main_menu_setup' );
if ( ! function_exists( 'main_menu_setup' ) ):

	function main_menu_setup(){
		add_action( 'init', 'register_menu' );

		function register_menu(){
			register_nav_menu( 'main_menu', 'Main Navigation' );
		}

		class Shp_Walker_Nav_Menu extends Walker_Nav_Menu {

			function start_lvl( &$output, $depth = 0, $args = array() ) {
				$indent = str_repeat( "\t", $depth );
				$output	   .= "\n$indent<ul class=\"shp_navigation-submenu dropdown-menu\" aria-labelledby=\"categoriesDropdown\">\n";
			}

			function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
				if (!is_object($args)) {
					return; // menu has not been configured
				}

				$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

				$li_attributes = '';
				$class_names = $value = '';

				$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
				$classes[] = 'shp_menu-item m-main__item';


				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
				$class_names = ' class="' . esc_attr( $class_names ) . '"';

				$output .= $indent . '<li' . $value . $class_names . $li_attributes . '>';

				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
				$attributes .= ($args->has_children) 	    ? ' class="shp_menu-item-link dropdown-toggle" data-target="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="shp_menu-item-link"';

				$item_output = $args->before;
				$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= ($args->has_children) ? ' <span class="caret"></span></a>' : '</a>';
				$item_output .= $args->after;

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}

			function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

				if ( !$element )
					return;

				$id_field = $this->db_fields['id'];

				//display this element
				if ( is_array( $args[0] ) )
					$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
				else if ( is_object( $args[0] ) )
					$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
				$cb_args = array_merge( array(&$output, $element, $depth), $args);
				call_user_func_array(array(&$this, 'start_el'), $cb_args);

				$id = $element->$id_field;

				// descend only when the depth is right and there are childrens for this element
				if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

					foreach( $children_elements[ $id ] as $child ){

						if ( !isset($newlevel) ) {
							$newlevel = true;
							//start the child delimiter
							$cb_args = array_merge( array(&$output, $depth), $args);
							call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
						}
						$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
					}
						unset( $children_elements[ $id ] );
				}

				if ( isset($newlevel) && $newlevel ){
					//end the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
				}

				//end this element
				$cb_args = array_merge( array(&$output, $element, $depth), $args);
				call_user_func_array(array(&$this, 'end_el'), $cb_args);
			}
		}
 	}
endif;

/**
 * Post Count API Plugin: Add a revenue
 */
add_filter( 'post-count-api-items', function ( $items ) {
  $size_page_id = 2;
  $statistics = get_field( 'sk_size_statistics', $size_page_id );
  if ( isset( $statistics[0]['number'] ) ) {
    $items['czechecommerceRevenueCount'] = intval( $statistics[0]['number'] );
  }
  return $items;
} );

/* Redirect to Shoptet favicon.ico */
function shp_favicon_redirect(){
	wp_redirect( get_template_directory_uri() . '/static/img/favicon.ico' );
	exit;
}
add_action( 'do_faviconico','shp_favicon_redirect' );