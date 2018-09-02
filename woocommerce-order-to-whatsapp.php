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

// Remove default add to cart button
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart');


// Add action in product detail
function CallWAButton()
{
	global $product;
	$data = [];
	$data['title'] = $product->get_title();
	$data['link'] = get_permalink($product->get_id());
	$phoneNumber = esc_attr( get_option('woo_wa_phone_number') );
	$content = esc_attr( get_option('woo_wa_content') );
	$button = esc_attr( get_option('woo_wa_button') );
	foreach ($data as $key => $value) {
		$content = str_replace('{{' . $key . '}}', $value, $content);
	}

	?>
	<button id="chat-wa" type="button" onclick="openWA()"><?php echo $button ?></button>
	<script>
	function openWA(){
		var t = "<?php echo $phoneNumber ?>",
        	a = "<?php echo $content ?>";
		if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) var e = "https://wa.me/" + t + "?text=" + a;
		else e = "https://web.whatsapp.com/send?phone=" + t + "&text=" + a;
		var n = window.open(e, "_blank");
		n ? n.focus() : alert("Please allow popups for this website")
	}
	</script>
	<?php
}

if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    
    add_action('woocommerce_after_add_to_cart_button', 'CallWAButton');
}