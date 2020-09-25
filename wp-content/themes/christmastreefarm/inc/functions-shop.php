<?php
/**
 * Shop functions
 */

/**
 * Add products header template
 */
/*
function products_header() {
	get_template_part( 'template-parts/products-header' );
}
add_action( 'storefront_content_top', 'products_header', 10 );
*/

/**
 * Remove sidebar from shop page
 */
function xm_remove_sidebar( $is_active_sidebar, $index ) {
	if ( $index !== 'sidebar-1' ) {
		return $is_active_sidebar;
	}

	if ( ! is_product_category() ) {
		return $is_active_sidebar;
	}

	return false;
}
add_filter( 'is_active_sidebar', 'xm_remove_sidebar', 10, 2 );
