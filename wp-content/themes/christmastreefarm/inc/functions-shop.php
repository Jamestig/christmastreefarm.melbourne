<?php
/**
 * Shop functions
 */

/**
 * Add products header template
 */
function products_header() {
	get_template_part( 'template-parts/products-header' );
}
add_action( 'storefront_content_top', 'products_header', 10 );