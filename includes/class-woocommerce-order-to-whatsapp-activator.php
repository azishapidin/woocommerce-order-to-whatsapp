<?php

/**
 * Fired during plugin activation
 *
 * @link       https://azishapidin.com/
 * @since      1.0.0
 *
 * @package    Woocommerce_Order_To_Whatsapp
 * @subpackage Woocommerce_Order_To_Whatsapp/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Woocommerce_Order_To_Whatsapp
 * @subpackage Woocommerce_Order_To_Whatsapp/includes
 * @author     Azis Hapidin <azishapidin@gmail.com>
 */
class Woocommerce_Order_To_Whatsapp_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		if (!class_exists('WooCommerce')) {
			die('To use this plugin, you must install WooCommerce.');
		}
	}

}
