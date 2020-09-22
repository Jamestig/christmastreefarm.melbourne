<?php
/**
 * Site-wide functions
 */

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