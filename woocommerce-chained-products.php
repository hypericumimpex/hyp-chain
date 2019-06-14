<?php
/**
 * Plugin Name: HYP Chain
 * Plugin URI: https://github.com/hypericumimpex/hyp-chain/
 * Description: Produse Legate.
 * Version: 2.9.2
 * Author: StoreApps
 * Author URI: https://github.com/hypericumimpex/hyp-chain/
 * Developer: StoreApps
 * Developer URI: https://github.com/hypericumimpex/
 * Requires at least: 4.1
 * Tested up to: 5.2.1
 * WC requires at least: 2.5.0
 * WC tested up to: 3.6.4
 * Text Domain: woocommerce-chained-products
 * Domain Path: /languages/
 * Woo: 18687:cc6e246e495745db10f9f7fddc5aa907
 * Copyright (c) 2012-2019 WooCommerce, StoreApps All rights reserved.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package woocommerce-chained-products
 */

/**
 * Required functions
 */
if ( ! function_exists( 'woothemes_queue_update' ) ) {
	require_once 'woo-includes/woo-functions.php';
}

/**
 * Plugin updates
 */
woothemes_queue_update( plugin_basename( __FILE__ ), 'cc6e246e495745db10f9f7fddc5aa907', '18687' );

/**
 * Function to set transient on plugin activation
 */
function chained_product_activate() {
	if ( ! is_network_admin() && ! isset( $_GET['activate-multi'] ) ) { // WPCS: input var ok, CSRF ok.
		set_transient( '_chained_products_activation_redirect', 1, 30 );
	}
}

register_activation_hook( __FILE__, 'chained_product_activate' );

if ( is_woocommerce_active() ) {

	/**
	 * Function to initiate Chained Products & its functionality
	 */
	function initialize_chained_products() {
		global $wc_cp;

		if ( ! defined( 'WC_CP_PLUGIN_DIRNAME' ) ) {
			define( 'WC_CP_PLUGIN_DIRNAME', dirname( plugin_basename( __FILE__ ) ) );
		}

		if ( ! defined( 'WC_CP_PLUGIN_FILE' ) ) {
			define( 'WC_CP_PLUGIN_FILE', __FILE__ );
		}

		include_once 'includes/class-wc-chained-products.php';

		$wc_cp = new WC_Chained_Products();
	}

	add_action( 'plugins_loaded', 'initialize_chained_products' );
}
