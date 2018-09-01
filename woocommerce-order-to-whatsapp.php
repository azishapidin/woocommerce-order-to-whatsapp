<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://azishapidin.com/
 * @since             1.0.0
 * @package           Woocommerce_Order_To_Whatsapp
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Order to WhatsApp
 * Plugin URI:        https://github.com/azishapidin/woocommerce-order-to-whatsapp
 * Description:       This is plugin for override Add To Cart button on WooCommerce to Chat via WhatsApp.
 * Version:           1.0.0
 * Author:            Azis Hapidin
 * Author URI:        https://azishapidin.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-order-to-whatsapp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woocommerce-order-to-whatsapp-activator.php
 */
function activate_woocommerce_order_to_whatsapp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-order-to-whatsapp-activator.php';
	Woocommerce_Order_To_Whatsapp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woocommerce-order-to-whatsapp-deactivator.php
 */
function deactivate_woocommerce_order_to_whatsapp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-order-to-whatsapp-deactivator.php';
	Woocommerce_Order_To_Whatsapp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woocommerce_order_to_whatsapp' );
register_deactivation_hook( __FILE__, 'deactivate_woocommerce_order_to_whatsapp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-order-to-whatsapp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woocommerce_order_to_whatsapp() {

	$plugin = new Woocommerce_Order_To_Whatsapp();
	$plugin->run();

}
run_woocommerce_order_to_whatsapp();


/**
 * Add submenu setting to WooCommerce.
 */
add_action('admin_menu', 'woocommerce_order_to_whatsapp_admin');

function woocommerce_order_to_whatsapp_admin(){
    add_submenu_page( 'woocommerce', 'WooCommerce Order to WhatsApp', 'Order to WhatsApp', 'manage_options', 'woocommerce-order-whatsapp', 'wooWaOrderAdmin' );
}
 
function wooWaOrderAdmin(){
    require 'admin/partials/woocommerce-order-to-whatsapp-admin-display.php';
}
