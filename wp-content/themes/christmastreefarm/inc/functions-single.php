<?php
/**
 * Single product functions
 */

/**
 * Re-arrange single product
 */
function xm_rearrange_single() {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	add_action( 'woocommerce_product_thumbnails', 'woocommerce_template_single_meta', 25 );
}
add_action( 'init', 'xm_rearrange_single', 10 );

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