<?php
/**
 * This file contain available actions hooks to extend or customize Invoice or Packing Slip file info
 *
 * @package Woo_Invoice_Pro
 * User: Ohidul Islam
 * Date: 4/7/20
 * Time: 7:41 PM
 */

// ################## Language Switch  ######################
add_action('woo_invoice_switch_language','woo_invoice_switch_language_callback');
add_action('woo_invoice_restore_language','woo_invoice_restore_language_callback');
add_action( 'change_locale', 'woo_invoice_reload_text_domain' );

if ( ! function_exists('woo_invoice_custom_style') ) {
    /**
     * Set Data After the customer/shipping notes
     *
     * @param string $template_type Value: invoiceor packing_slip.
     *
     * @return string
     */
    function woo_invoice_custom_style( $template_type ) {
        ob_start();
        do_action('woo_invoice_custom_style', $template_type);
        return ob_get_clean();
    }
}


if ( ! function_exists('woo_invoice_before_document') ) {
    /**
     * Set Data Before all content on the document
     *
     * @param WC_Order $order         Order Object.
     * @param string   $template_type Value: invoiceor packing_slip.
     *
     * @return string
     */
    function woo_invoice_before_document( $order, $template_type ) {
        ob_start();
        do_action('woo_invoice_before_document', $order, $template_type);
        return ob_get_clean();
    }
}


if ( ! function_exists('woo_invoice_after_document') ) {
    /**
     * Set Data After all content on the document
     *
     * @param WC_Order $order         Order Object.
     * @param string   $template_type Value: invoiceor packing_slip.
     *
     * @return string
     */
    function woo_invoice_after_document( $order, $template_type ) {
        ob_start();
        do_action('woo_invoice_after_document', $order, $template_type);
        return ob_get_clean();
    }
}


if ( ! function_exists('woo_invoice_before_seller_info') ) {
    /**
     * Set Data Before Seller Info
     *
     * @param WC_Order $order         Order Object.
     * @param string   $template_type Value: invoiceor packing_slip.
     *
     * @return string
     */
    function woo_invoice_before_seller_info( $order, $template_type ) {
        ob_start();
        do_action('woo_invoice_before_seller_info', $order, $template_type);

        return ob_get_clean();
    }
}


if ( ! function_exists('woo_invoice_after_seller_info') ) {
    /**
     * Set Data After Seller Info
     *
     * @param WC_Order $order         Order Object.
     * @param string   $template_type Value: invoiceor packing_slip.
     *
     * @return string
     */
    function woo_invoice_after_seller_info( $order, $template_type ) {
        ob_start();
        do_action('woo_invoice_after_seller_info', $order, $template_type);

        return ob_get_clean();
    }
}


if ( ! function_exists('woo_invoice_before_billing_address') ) {
    /**
     * Set Data Before the billing address
     *
     * @param WC_Order $order         Order Object.
     * @param string   $template_type Value: invoiceor packing_slip.
     *
     * @return string
     */
    function woo_invoice_before_billing_address( $order, $template_type ) {
        ob_start();
        do_action('woo_invoice_before_billing_address', $order, $template_type);
        return ob_get_clean();
    }
}


if ( ! function_exists('woo_invoice_after_billing_address') ) {
    /**
     * Set Data After the billing address
     *
     * @param WC_Order $order         Order Object.
     * @param string   $template_type Value: invoiceor packing_slip.
     *
     * @return string
     */
    function woo_invoice_after_billing_address( $order, $template_type ) {
        ob_start();
        do_action('woo_invoice_after_billing_address', $order, $template_type);
        return ob_get_clean();
    }
}


if ( ! function_exists('woo_invoice_before_shipping_address') ) {
    /**
     * Set Data Before the shipping address
     *
     * @param WC_Order $order         Order Object.
     * @param string   $template_type Value: invoiceor packing_slip.
     *
     * @return string
     */
    function woo_invoice_before_shipping_address( $order, $template_type ) {
        ob_start();
        do_action('woo_invoice_before_shipping_address', $order, $template_type);
        return ob_get_clean();
    }
}


if ( ! function_exists('woo_invoice_after_shipping_address') ) {
    /**
     * Set Data After the shipping address
     *
     * @param WC_Order $order         Order Object.
     * @param string   $template_type Value: invoiceor packing_slip.
     *
     * @return string
     */
    function woo_invoice_after_shipping_address( $order, $template_type ) {
        ob_start();
        do_action('woo_invoice_after_shipping_address', $order, $template_type);
        return ob_get_clean();
    }
}


if ( ! function_exists('woo_invoice_before_order_data') ) {
    /**
     * Set Data Before the order data (invoice number, order date, etc.)
     *
     * @param WC_Order $order         Order Object.
     * @param string   $template_type Value: invoiceor packing_slip.
     *
     * @return string
     */
    function woo_invoice_before_order_data( $order, $template_type ) {
        ob_start();
        do_action('woo_invoice_before_order_data', $order, $template_type);
        return ob_get_clean();
    }
}


if ( ! function_exists('woo_invoice_after_order_data') ) {
    /**
     * Set Data After the order data
     *
     * @param WC_Order $order         Order Object.
     * @param string   $template_type Value: invoiceor packing_slip.
     *
     * @return string
     */
    function woo_invoice_after_order_data( $order, $template_type ) {
        ob_start();
        do_action('woo_invoice_after_order_data', $order, $template_type);
        return ob_get_clean();
    }
}


if ( ! function_exists('woo_invoice_before_product_list') ) {
    /**
     * Set Data Before the order details table with all items
     *
     * @param WC_Order $order         Order Object.
     * @param string   $template_type Value: invoiceor packing_slip.
     *
     * @return string
     */
    function woo_invoice_before_product_list( $order, $template_type ) {
        ob_start();
        do_action('woo_invoice_before_product_list', $order, $template_type);
        return ob_get_clean();
    }
}


if ( ! function_exists('woo_invoice_after_product_list') ) {
    /**
     * Set Data After the order details table
     *
     * @param WC_Order $order         Order Object.
     * @param string   $template_type Value: invoice or packing_slip.
     *
     * @return string
     */
    function woo_invoice_after_product_list( $order, $template_type ) {
        ob_start();
        do_action('woo_invoice_after_product_list', $order, $template_type);
        return ob_get_clean();
    }
}


if ( ! function_exists('woo_invoice_before_item_meta') ) {
    /**
     * Set Data Before the item meta (for each item in the order details table)
     *
     * @param WC_Product $product       Product Object.
     * @param WC_Order   $order         Order Object.
     * @param string     $template_type Value: invoice or packing_slip.
     *
     * @return string
     */
    function woo_invoice_before_item_meta( $product, $order, $template_type ) {
        ob_start();
        do_action('woo_invoice_before_item_meta', $product, $order, $template_type);
        return ob_get_clean();
    }
}


if ( ! function_exists('woo_invoice_after_item_meta') ) {
    /**
     * Set Data After the item meta (for each item in the order details table)
     *
     * @param WC_Product $product       Product Object.
     * @param WC_Order   $order         Order Object.
     * @param string     $template_type Value: invoice or packing_slip.
     *
     * @return string
     */
    function woo_invoice_after_item_meta( $product, $order, $template_type ) {
        ob_start();
        do_action('woo_invoice_after_item_meta', $product, $order, $template_type);
        return ob_get_clean();
    }
}



if ( ! function_exists('woo_invoice_before_customer_notes') ) {
    /**
     * Set Data Before the customer/shipping notes
     *
     * @param WC_Order $order         Order Object.
     * @param string   $template_type Value: invoice or packing_slip.
     *
     * @return string
     */
    function woo_invoice_before_customer_notes( $order, $template_type ) {
        ob_start();
        do_action('woo_invoice_before_customer_notes', $order, $template_type);
        return ob_get_clean();
    }
}


if ( ! function_exists('woo_invoice_after_customer_notes') ) {
    /**
     * Set Data After the customer/shipping notes
     *
     * @param WC_Order $order         Order Object.
     * @param string   $template_type Value: invoice or packing_slip.
     *
     * @return string
     */
    function woo_invoice_after_customer_notes( $order, $template_type ) {
        ob_start();
        do_action('woo_invoice_after_customer_notes', $order, $template_type);
        return ob_get_clean();
    }
}
