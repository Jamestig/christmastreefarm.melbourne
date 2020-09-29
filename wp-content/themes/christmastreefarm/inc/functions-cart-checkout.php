<?php
/**
 * Cart and checkout functions
 */

/**
 * Allows to remove products in checkout page.
 * 
 * @param string $product_name 
 * @param array $cart_item 
 * @param string $cart_item_key 
 * @return string
 */
function lionplugins_woocommerce_checkout_remove_item( $product_name, $cart_item, $cart_item_key ) {
	if ( is_checkout() ) {
		$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

		$remove_link = apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
			'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">×</a>',
			esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
			__( 'Remove this item', 'woocommerce' ),
			esc_attr( $product_id ),
			esc_attr( $_product->get_sku() )
			),
			$cart_item_key
		);

		return '<span>' . $remove_link . '</span> <span>' . $product_name . '</span>';
	}

	return $product_name;
}
add_filter( 'woocommerce_cart_item_name', 'lionplugins_woocommerce_checkout_remove_item', 10, 3 );

/**
 * Remove checkout coupon form
 */
function xm_remove_checkout_coupon() {
	remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
}
add_action( 'init', 'xm_remove_checkout_coupon', 10 );

/**
 * Shipping term
 */
add_filter( 'woocommerce_shipping_package_name', 'custom_shipping_package_name' );
function custom_shipping_package_name( $name ) {
	return 'Pickup/Delivery';
}

/**
 * Avoid Empty Cart Redirect @ WooCommerce Checkout
 */
add_filter( 'woocommerce_checkout_redirect_empty_cart', '__return_false' );
add_filter( 'woocommerce_checkout_update_order_review_expired', '__return_false' );
add_filter( 'wc_add_to_cart_message_html', '__return_false' );

/**
 * Deny checkout for two shipping methods
 */
function deny_checkout_if_weight( $posted ) {
	$classes = get_body_class();
	if ( in_array( 'shippingError', $classes ) ) {
		$notice = 'Sorry, please add products with only Delivery or Pickup';
		wc_add_notice( $notice, 'error' );
	}
}
add_action( 'woocommerce_before_checkout_form', 'deny_checkout_if_weight' );
