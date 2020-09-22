<?php
/**
 * Account area functions
 */

/**
 * Remove downloads tab
 */
add_filter( 'woocommerce_account_menu_items', 'xm_remove_downloads_my_account', 999 );

function xm_remove_downloads_my_account( $items ) {
unset($items['downloads']);
return $items;
}