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
 * Remove sidebar
 */
function xm_remove_storefront_sidebar() {
	if ( is_product() ) {
		remove_action( 'storefront_sidebar', 'storefront_get_sidebar', 10 );
	}
}
add_action( 'get_header', 'xm_remove_storefront_sidebar' );

/**
 * Re-arrange breadcrumb
 */
function xm_rearrange_breadcrumb() {
	remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
	add_action( 'woocommerce_before_shop_loop', 'woocommerce_breadcrumb', 5 );
	add_action( 'storefront_page', 'woocommerce_breadcrumb', 15 );
	add_action( 'woocommerce_before_single_product', 'woocommerce_breadcrumb', 5 );
}
add_action( 'init', 'xm_rearrange_breadcrumb', 10 );

add_action( 'wp_print_styles', 'xm_blog_breadcrumb', 100 );
/**
 * Add breadcrumb to blog page.
 */
function xm_blog_breadcrumb() {
	if ( is_home() ) {
		add_action( 'storefront_content_top', 'woocommerce_breadcrumb', 10 );
	}
}

/**
 * Re-arrange single product
 */
function xm_rearrange_single() {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	add_action( 'woocommerce_product_thumbnails', 'woocommerce_template_single_meta', 25 );
}
add_action( 'init', 'xm_rearrange_single', 10 );

/**
 * Remove checkout coupon form
 */
function xm_remove_checkout_coupon() {
	remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
}
add_action( 'init', 'xm_remove_checkout_coupon', 10 );

/**
 * Remove downloads tab
 */
add_filter( 'woocommerce_account_menu_items', 'xm_remove_downloads_my_account', 999 );

function xm_remove_downloads_my_account( $items ) {
unset($items['downloads']);
return $items;
}

/**
 * Remove sidebar from product page
 */
function iconic_remove_sidebar( $is_active_sidebar, $index ) {
	if ( $index !== 'sidebar-1' ) {
		return $is_active_sidebar;
	}

	if ( ! is_product() ) {
		return $is_active_sidebar;
	}

	return false;
}
add_filter( 'is_active_sidebar', 'iconic_remove_sidebar', 10, 2 );

/**
 * Require functions
 */
require 'inc/remove-products.php';
