<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://azishapidin.com/
 * @since      1.0.0
 *
 * @package    Woocommerce_Order_To_Whatsapp
 * @subpackage Woocommerce_Order_To_Whatsapp/admin/partials
 */
?>

<?php
$default = 'Hello, I want to buy this product {{link}}';
if (count($_POST) > 0) {
    if (isset($_POST['woo_wa_phone_number'])) {
        if (!get_option('woo_wa_phone_number') || strlen(get_option('woo_wa_phone_number')) == 0) {
            add_option( 'woo_wa_phone_number', $_POST['woo_wa_phone_number'] );
        } else {
            update_option( 'woo_wa_phone_number', $_POST['woo_wa_phone_number'] );
        } 
    }
    if (isset($_POST['woo_wa_content'])) {
        if (!get_option('woo_wa_content') || strlen(get_option('woo_wa_content')) == 0) {
            add_option( 'woo_wa_content', $_POST['woo_wa_content'] );
        } else {
            update_option( 'woo_wa_content', $_POST['woo_wa_content'] );
        }
    }
} else {
    if (!get_option('woo_wa_content')) {
        add_option( 'woo_wa_content', $default );
    }
}
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h1>WooCommerce Order to WhatsApp Setting</h1>
    <form action="" method="post">
        <?php settings_fields( 'woocommerce-order-whatsapp' ); do_settings_sections( 'woocommerce-order-whatsapp' ); ?>
        <table class="form-table">
            <tr valign="top">
            <th scope="row">WhatsApp Phone Number</th>
            <td><input style="width: 300px;" type="text" name="woo_wa_phone_number" value="<?php echo esc_attr( get_option('woo_wa_phone_number') ); ?>" /></td>
            </tr>
            
            <tr valign="top">
            <th scope="row">Message</th>
            <td>
                <textarea  style="width: 300px;" rows="8" name="woo_wa_content"><?php echo esc_attr( get_option('woo_wa_content') ); ?></textarea><br>
                Formatting:
                <ul>
                    <li>You can use <strong>{{title}}</strong> to insert Product Name.</li>
                    <li>You can use <strong>{{link}}</strong> to insert Product URL.</li>
                </ul>
                Example: <em><?php echo $default ?></em> will be parsed to <strong>Hello, I want to buy this product https://example.com/store/product/cool-thsirt</strong>
            </td>
            </tr>
            
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>