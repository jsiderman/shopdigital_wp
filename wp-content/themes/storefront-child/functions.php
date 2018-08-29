<?php
/**
 * Functions and cusotmizations for the DGTL theme
 */

//exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
	wp_dequeue_style( 'storefront-style' );
	wp_dequeue_style( 'storefront-woocommerce-style' );
}

/**
 * Cache busting with filetime
 */
if ( !function_exists('enqueue_it' ) ) {
	function enqueue_it( $my_handle, $relpath, $type='script', $my_deps=array() ) {
		$uri = get_theme_file_uri($relpath);
		$vsn = filemtime(get_stylesheet_directory() . $relpath);
		if($type == 'script') wp_enqueue_script($my_handle, $uri, $my_deps, $vsn, true);
		else if($type == 'style') wp_enqueue_style($my_handle, $uri, $my_deps, $vsn);
	}
}

/**
 * Enqueue styles and scripts
 */
add_action( 'wp_enqueue_scripts', 'enqueue_my_files' );
function enqueue_my_files(){
	enqueue_it( 'dgtl-shop', '/assets/sass/style.css', 'style' );
	wp_enqueue_style( 'bootstrap', '//stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css', '', '4.1.3' );
	wp_enqueue_script( 'bootstrap', '//stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js');
}


add_filter( 'body_class', 'iot_add_body_class' );
/**
 * Adds landing page body class.
 *
 * @since 1.0.0
 *
 * @param array $classes Original body classes.
 * @return array Modified body classes.
 */
function iot_add_body_class( $classes ) {
	$classes[] = 'dgtl';
	return $classes;
}
