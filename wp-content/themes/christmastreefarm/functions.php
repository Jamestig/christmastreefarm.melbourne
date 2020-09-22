<?php
/**
 * Functions and definitions
 *
 * @package christmastreefarm
 */

/**
 * Add theme support
 */
add_theme_support( 'post-thumbnails' );

/**
 * Enable shortcodes in all locations
 */
add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );
add_filter( 'the_excerpt', 'shortcode_unautop' );
add_filter( 'the_excerpt', 'do_shortcode' );
add_filter( 'term_description', 'shortcode_unautop' );
add_filter( 'term_description', 'do_shortcode' );
add_filter( 'comment_text', 'shortcode_unautop' );
add_filter( 'comment_text', 'do_shortcode' );

/**
 * Enqueue parent and child styles, then fonts
 */
function ctf_enqueue_styles() {

	$parent_style = 'parent-style'; // This is 'storefront' style for the Storefront theme.

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', [], wp_get_theme( 'version' ), 'all' );
	wp_enqueue_style(
		'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		time(),
		'all'
	);
	wp_enqueue_style( 'web-fonts', 'https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap' );
}
add_action( 'wp_enqueue_scripts', 'ctf_enqueue_styles' );

/**
 * Enqueue JS
 */
function ctf_enqueue_scripts() {
	wp_enqueue_script( 'main_js', get_stylesheet_directory_uri() . '/assets/js/main.js', [ 'jquery' ], 1.0, true );
}
add_action( 'wp_enqueue_scripts', 'ctf_enqueue_scripts', 10 );

/**
 * Require functions
 */
require 'inc/functions-account.php';
require 'inc/functions-cart-checkout.php';
require 'inc/functions-shop.php';
require 'inc/functions-single.php';
require 'inc/functions-site.php';
