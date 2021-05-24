<?php
/**
 * Provide settings view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link  https://webappick.com
 * @since 1.0.0
 *
 * @package    Woo_Invoice
 * @subpackage Woo_Invoice/admin/partials
 */

// Checkbox Value to compare.
$woo_invoice_current = 1;

$woo_invoice_logo_dir   = plugin_dir_url( dirname( __FILE__ ) ) . 'images/woo-invoice-logo.svg';
$woo_invoice_banner_dir = plugin_dir_url( dirname( __FILE__ ) ) . 'images/get-chalan-pro.svg';

$woo_invoice_style  = 'max-width:80%;display:block;margin:0 auto;border: 3px solid #0F74A6;';
$woo_invoice_style2 = 'max-width:80%;display:block;margin:0 auto;border: 3px solid #1AA15F;';


if ( substr( get_option( 'wpifw_logo_attachment_id' ), 0, 7 ) === 'http://' || substr( get_option( 'wpifw_logo_attachment_id' ), 0, 8 ) === 'https://' ) {
	$woo_invoice_image_id       = attachment_url_to_postid( get_option( 'wpifw_logo_attachment_id' ) );
	$woo_invoice_full_size_path = get_attached_file( $woo_invoice_image_id );
	update_option( 'wpifw_logo_attachment_id', $woo_invoice_full_size_path );
	update_option( 'wpifw_logo_attachment_image_id', $woo_invoice_image_id );
}


// Allow to download invoice from my account base on order status.
$wpifw_invoice_download_check_list = ( get_option( 'wpifw_invoice_download_check_list' ) == false || is_null( get_option( 'wpifw_invoice_download_check_list' ) ) ) ? array() : get_option( 'wpifw_invoice_download_check_list' );
// Attach Invoice with email based on order status.
$wpifw_email_attach_check_list = ( get_option( 'wpifw_email_attach_check_list' ) == false || is_null( get_option( 'wpifw_email_attach_check_list' ) ) ) ? array() : get_option( 'wpifw_email_attach_check_list' );


?>


<div class="wrap">
    <h1 class="wp-heading-inline"><?php esc_html_e( 'Chalan', 'webappick-pdf-invoice-for-woocommerce' ); ?></h1>
</div><!-- end .wrap -->

<?php
//Promotion area
//$hide_promotion = (int) get_option('woo_invoice_hide_promotion');
//
//if( 1 !== $hide_promotion && empty($hide_promotion) ) { ?>
<!--    <div class="woo-invoice-promotion">-->
<!--        <a target="_blank" href="https://webappick.com/plugin/woocommerce-pdf-invoice-packing-slips/?utm_source=customer_site&utm_medium=free_vs_pro&utm_campaign=woo_invoice_free">-->
<!--            <img src="--><?php //echo esc_url( 'https://woo-invoice-assets.s3.amazonaws.com/black-friday-woo-invoice.gif' );?><!--" alt="Woo Invoice Pro Black Friday">-->
<!--        </a>-->
<!--        <span class="dashicons dashicons-no-alt woo-invoice-campaign-close-button" data-condition="1"></span>-->
<!--    </div>-->
<?php //} ?>

<div class="woo-invoice-wrap">
    <div class="woo-invoice-dashboard-header">
        <a class="wapk-woo-invoice-admin-logo"
           href="<?php echo esc_url( 'https://webappick.com/plugin/woocommerce-pdf-invoice-packing-slips/?utm_source=customer_site&utm_medium=free_vs_pro&utm_campaign=woo_invoice_free' ); ?>"
           target="_blank"><img
                    src="<?php echo esc_url( $woo_invoice_logo_dir ); ?>" alt="Woo Invoice"></a>
        <a class="wapk-woo-invoice-get-product-btn"
           href="<?php echo esc_url( 'https://webappick.com/plugin/woocommerce-pdf-invoice-packing-slips/?utm_source=customer_site&utm_medium=free_vs_pro&utm_campaign=woo_invoice_free' ); ?>"
           target="_blank"><img
                    src="<?php echo esc_url( $woo_invoice_banner_dir ); ?>" alt="Woo Invoice"></a>
        <div class="facebook-btn"><a target="__balnk"
                                     href="<?php echo esc_url( 'https://www.facebook.com/groups/chalanpdfinvoice' ); ?>"><img
                        src="data:image/gif;base64,R0lGODlhIAAVALIAAP////9SAN4AAP//ALUAOQAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwH4fwAh+QQJCgAFACwAAAAAIAAVAAADali63P4wqiCrDNRqFkTeWueFWGme4lilQuu+sBp1g1sP+N3WQv09NJ7OtivKHMEiT9lrtn6cpi7HHD6BTpzTdlsKCBDazmrcgsPbrjbdOqNjcJgbQqjb73iCaw6it/sWenyAD3WEgYeJEQkAIfkECQoABQAsAwABABkAEwAAA2BYutzRMMLwpHWi3htEnlQojp2nKaWnrqx6doMaD/TsxUKswbgt38BPgQfEFXNI0xBpqx19JtgNOs0ZBYRlj5rsZrW/Wu+HXaRaaNVXQWi733CCemORl+kS+RoPafPrFgkAIfkECQoABQAsBwABABkAEwAAA2BYutzRMMLwpHWi3htEnlQojp2nKaWnrqx6doMaD/TsxUKswbgt38BPgQfEFXNI0xBpqx19JtgNOs0ZBYRlj5rsZrW/Wu+HXaRaaNVXQWi733CCemORl+kS+RoPafPrFgkAIfkECQoABQAsAwABABkAEwAAA2BYutzRMMLwpHWi3htEnlQojp2nKaWnrqx6doMaD/TsxUKswbgt38BPgQfEFXNI0xBpqx19JtgNOs0ZBYRlj5rsZrW/Wu+HXaRaaNVXQWi733CCemORl+kS+RoPafPrFgkAIf4fT3B0aW1pemVkIGJ5IFVsZWFkIFNtYXJ0U2F2ZXIhAAA7"
                        alt="<?php echo esc_attr( 'facebook' ); ?>"> <?php echo esc_html__( 'Join Facebook Group', 'webappick-pdf-invoice-for-woocommerce' ); ?>
            </a></div>
        <a class="wapk-woo-invoice-support-btn" target="_blank"
           href="https://wordpress.org/support/plugin/webappick-pdf-invoice-for-woocommerce/#new-topic-0"><?php esc_html_e( 'Get free support', 'webappick-pdf-invoice-for-woocommerce' ); ?></a>
        <a class="wapk-woo-invoice-support-btn documentation" target="_blank"
           href="<?php echo esc_url( 'https://webappick.com/docs/' ); ?>"><?php esc_html_e( 'Documentation', 'webappick-pdf-invoice-for-woocommerce' ); ?></a>

    </div><!-- end .woo-invoice-dashboard-header -->
    <div class="woo-invoice-dashboard-body">
        <div class="woo-invoice-dashboard-sidebar">
            <div class="woo-invoice-sidebar-navbar woo-invoice-sidebar-navbar-vertical woo-invoice-fixed-left woo-invoice-sidebar-navbar-expand-md woo-invoice-sidebar-navbar-light"
                 id="woo-invoice-sidebar">
                <div class="container-fluid">
                    <!-- Toggler -->
                    <button class="woo-invoice-sidebar-navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#webappickSidebarCollapse" aria-controls="webappickSidebarCollapse"
                            aria-expanded="false" aria-label="Toggle woo-invoice-navigation">
                        <span class="woo-invoice-sidebar-navbar-toggler-icon"></span>
                    </button>

                    <!-- Brand -->
                    <!-- <a class="woo-invoice-sidebar-navbar-brand" href="https://webappick.com"><img src="../wp-content/plugins/woo-invoice-boilerplate/admin/images/woo-invoice-logo.png" alt="WEBAPPICK" style="width:100px;"></a> -->

                    <!-- Collapse -->
                    <ul class="collapse woo-invoice-sidebar-navbar-collapse" id="webappickSidebarCollapse">

                        <ul class="woo-invoice-sidebar-navbar-nav woo-invoice-mb-md-4">
                            <li class="woo-invoice-sidebar-nav-item">
                                <a class="woo-invoice-sidebar-nav-link" href="#">
                                    <span class="_winvoice-menu-thumbnail">
                                        <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgdmlld0JveD0iMCAwIDQyMy42MjMgNDIzLjYyMyIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDIzLjYyMyA0MjMuNjIzOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8Zz4NCgk8cGF0aCBzdHlsZT0iZmlsbDojNDU0QjU0OyIgZD0iTTQxMS42MjMsMjI0LjQxMmMtNi44LDAtMTItNS4yLTEyLTEyczUuMi0xMiwxMi0xMnMxMiw1LjIsMTIsMTJ2MC40DQoJCUM0MjMuNjIzLDIxOC44MTIsNDE4LjQyMywyMjQuNDEyLDQxMS42MjMsMjI0LjQxMnoiLz4NCgk8cGF0aCBzdHlsZT0iZmlsbDojNDU0QjU0OyIgZD0iTTE5OC40MjMsNDIzLjYxMmMtMC40LDAtMC40LDAtMC44LDBoLTAuNGMtNi44LTAuNC0xMS42LTYtMTEuMi0xMi44YzAuNC02LjgsNi0xMS42LDEyLjgtMTEuMmgwLjQNCgkJYzYuOCwwLjQsMTEuNiw2LjQsMTEuMiwxMi44UzIwNC40MjMsNDIzLjYxMiwxOTguNDIzLDQyMy42MTJ6IE0yMzguODIzLDQyMi4wMTJjLTYsMC0xMS4yLTQuNC0xMi0xMC40Yy0wLjgtNi40LDMuNi0xMi44LDEwLTEzLjYNCgkJaDAuNGM2LjQtMC44LDEyLjgsMy42LDEzLjYsMTAuNGMwLjgsNi40LTMuNiwxMi44LTEwLjQsMTMuNmgtMC40QzI0MC4wMjMsNDIyLjAxMiwyMzkuMjIzLDQyMi4wMTIsMjM4LjgyMyw0MjIuMDEyeg0KCQkgTTE1OC4wMjMsNDE2LjgxMmMtMS4yLDAtMi40LDAtMy4yLTAuNGwzLjItMTEuNmwtMy42LDExLjZjLTYuNC0xLjYtMTAtOC40LTguNC0xNC44czguNC0xMCwxNC44LTguNGgwLjhjNi40LDIsMTAsOC40LDguNCwxNC44DQoJCUMxNjguMDIzLDQxMy4yMTIsMTYzLjIyMyw0MTYuODEyLDE1OC4wMjMsNDE2LjgxMnogTTI3OC40MjMsNDEyLjQxMmMtNC44LDAtOS42LTMuMi0xMS4yLThjLTIuNC02LjQsMC44LTEzLjIsNy4yLTE1LjJoMC40DQoJCWM2LjQtMi40LDEzLjIsMC44LDE1LjIsNy4yYzIuNCw2LjQtMC44LDEzLjItNy4yLDE1LjJoLTAuNEMyODEuMjIzLDQxMi40MTIsMjgwLjAyMyw0MTIuNDEyLDI3OC40MjMsNDEyLjQxMnogTTEyMC4wMjMsNDAyLjAxMg0KCQljLTIsMC0zLjYtMC40LTUuNi0xLjJsLTAuNC0wLjRjLTYtMy4yLTgtMTAuNC00LjgtMTYuNHMxMC40LTgsMTYuNC00LjhzOC40LDEwLjQsNS4yLDE2LjQNCgkJQzEyOC40MjMsMzk5LjYxMiwxMjQuNDIzLDQwMi4wMTIsMTIwLjAyMyw0MDIuMDEyeiBNMzE1LjYyMywzOTQuODEyYy00LDAtOC0yLTEwLjQtNmMtMy42LTUuNi0xLjYtMTMuMiw0LTE2LjQNCgkJYzUuNi0zLjYsMTMuMi0yLDE2LjgsNGMzLjYsNS42LDIsMTIuOC0zLjYsMTYuNGwtMC40LDAuNEMzMTkuNjIzLDM5NC40MTIsMzE3LjYyMywzOTQuODEyLDMxNS42MjMsMzk0LjgxMnogTTg1LjYyMywzNzkuNjEyDQoJCWMtMi44LDAtNS4yLTAuOC03LjYtMi44aC0wLjRjLTUuMi00LTYtMTEuNi0yLTE2LjhjNC01LjIsMTEuNi02LDE2LjgtMmwwLjQsMC40YzUuMiw0LDYsMTEuNiwxLjYsMTYuOA0KCQlDOTIuODIzLDM3OC4wMTIsODkuMjIzLDM3OS42MTIsODUuNjIzLDM3OS42MTJ6IE0zNDguMDIzLDM3MC40MTJjLTMuMiwwLTYuNC0xLjItOC44LTRjLTQuNC00LjgtNC0xMi40LDAuOC0xNi44DQoJCXMxMi40LTQuNCwxNy4yLDAuNGM0LjQsNC44LDQuNCwxMi40LTAuNCwxNi44bC0wLjQsMC40QzM1NC4wMjMsMzY5LjIxMiwzNTAuODIzLDM3MC40MTIsMzQ4LjAyMywzNzAuNDEyeiBNNTYuODIzLDM1MC40MTINCgkJYy0zLjYsMC02LjgtMS42LTkuMi00LjRsMCwwYy00LjQtNS4yLTMuNi0xMi44LDEuNi0xNi44YzUuMi00LjQsMTIuNC0zLjYsMTYuOCwxLjZsMC40LDAuNGM0LjQsNS4yLDMuNiwxMi44LTEuNiwxNi44DQoJCUM2Mi4wMjMsMzQ5LjYxMiw1OS42MjMsMzUwLjQxMiw1Ni44MjMsMzUwLjQxMnogTTM3NC44MjMsMzM5LjYxMmMtMi40LDAtNC44LTAuOC02LjgtMi40Yy01LjItNC02LjgtMTEuMi0yLjgtMTYuOA0KCQljNC01LjYsMTEuMi02LjgsMTYuOC0zLjJjNS42LDQsNi44LDExLjIsMy4yLDE2LjRsLTAuNCwwLjRDMzgyLjQyMywzMzcuNjEyLDM3OC44MjMsMzM5LjYxMiwzNzQuODIzLDMzOS42MTJ6IE0zNC40MjMsMzE2LjQxMg0KCQljLTQuNCwwLTguNC0yLjQtMTAuOC02LjR2LTAuNGMtMy4yLTYtMC44LTEzLjIsNS4yLTE2LjRjNi0zLjIsMTMuMi0wLjgsMTYsNS4ydjAuNGMzLjIsNiwwLjgsMTMuMi01LjIsMTYuNA0KCQlDMzguMDIzLDMxNi4wMTIsMzYuMDIzLDMxNi40MTIsMzQuNDIzLDMxNi40MTJ6IE0zOTQuODIzLDMwNC4wMTJjLTEuNiwwLTMuMi0wLjQtNC40LTAuOGMtNi0yLjQtOS4yLTkuNi02LjQtMTUuNmwwLjQtMC44DQoJCWMyLjgtNiw5LjYtOC44LDE2LTZjNiwyLjgsOC44LDkuNiw2LDE2bC0xMC44LTQuOGwxMC44LDQuOEM0MDQuMDIzLDMwMS4yMTIsMzk5LjYyMywzMDQuMDEyLDM5NC44MjMsMzA0LjAxMnogTTE5LjIyMywyNzguNDEyDQoJCWMtNS4yLDAtMTAtMy42LTExLjYtOC44bDExLjYtMy4ybC0xMS42LDMuMmMtMS42LTYuNCwyLTEyLjgsOC0xNC44YzYuNC0yLDEyLjgsMS42LDE0LjgsOGwwLjQsMC44YzEuNiw2LjQtMiwxMi44LTguNCwxNC44DQoJCUMyMS4yMjMsMjc4LjQxMiwyMC4wMjMsMjc4LjQxMiwxOS4yMjMsMjc4LjQxMnogTTQwNy42MjMsMjY0LjgxMmMtMC44LDAtMS42LDAtMi40LTAuNGMtNi40LTEuMi0xMC44LTcuNi05LjItMTQuNA0KCQljMS4yLTYuNCw3LjYtMTAuOCwxNC40LTkuNmM2LjQsMS4yLDEwLjgsNy42LDkuMiwxNHYwLjRDNDE4LjAyMywyNjEuMjEyLDQxMi44MjMsMjY0LjgxMiw0MDcuNjIzLDI2NC44MTJ6IE0xMi4wMjMsMjM4LjQxMg0KCQljLTYuNCwwLTExLjYtNC44LTEyLTExLjJsMTItMC44bC0xMiwwLjRjLTAuNC02LjQsNC40LTEyLjQsMTEuMi0xMi44YzYuNC0wLjQsMTIuNCw0LjQsMTIuOCwxMC44djAuOGMwLjQsNi44LTQuOCwxMi40LTExLjIsMTIuOA0KCQlDMTIuNDIzLDIzOC40MTIsMTIuNDIzLDIzOC40MTIsMTIuMDIzLDIzOC40MTJ6IE0xMy4yMjMsMTk3LjIxMmMtMC40LDAtMS4yLDAtMS42LDBjLTYuNC0wLjgtMTEuMi03LjItMTAtMTMuNmwxMiwxLjZsLTEyLTINCgkJYzAuOC02LjQsNi44LTExLjIsMTMuNi0xMC40YzYuNCwwLjgsMTEuMiw2LjgsMTAuNCwxMy4ydjAuOEMyNC40MjMsMTkzLjIxMiwxOS4yMjMsMTk3LjIxMiwxMy4yMjMsMTk3LjIxMnogTTIyLjgyMywxNTcuNjEyDQoJCWMtMS4yLDAtMi44LTAuNC00LTAuOGMtNi40LTIuNC05LjYtOS4yLTcuMi0xNS4ybDExLjIsNGwtMTEuMi00LjRjMi02LjQsOS4yLTkuNiwxNS4yLTcuNmM2LjQsMiw5LjYsOC44LDcuNiwxNS4ybC0wLjQsMC44DQoJCUMzMi40MjMsMTU0LjQxMiwyNy42MjMsMTU3LjYxMiwyMi44MjMsMTU3LjYxMnogTTQwLjQyMywxMjAuODEyYy0yLDAtNC40LTAuNC02LjQtMS42Yy01LjYtMy42LTcuNi0xMC44LTQtMTYuNHYtMC40DQoJCWMzLjYtNS42LDEwLjgtNy42LDE2LjQtNHM3LjYsMTAuOCw0LDE2LjRsLTAuNCwwLjRDNDguNDIzLDExOC40MTIsNDQuNDIzLDEyMC44MTIsNDAuNDIzLDEyMC44MTJ6IE02NC44MjMsODguMDEyDQoJCWMtMi44LDAtNi0xLjItOC40LTMuMmMtNC44LTQuNC01LjItMTItMC40LTE2LjhsMCwwYzQuNC00LjgsMTItNS4yLDE2LjgtMC44czUuMiwxMiwwLjgsMTYuOGwwLDANCgkJQzcxLjIyMyw4Ni44MTIsNjguMDIzLDg4LjAxMiw2NC44MjMsODguMDEyeiBNOTUuNjIzLDYwLjgxMmMtMy42LDAtNy42LTEuNi05LjYtNS4yYy00LTUuMi0yLjgtMTIuOCwyLjgtMTYuOGwwLjQtMC40DQoJCWM1LjYtNCwxMi44LTIuOCwxNi44LDIuOGM0LDUuMiwyLjgsMTIuOC0yLjgsMTYuOGwtMC40LDAuNEMxMDAuNDIzLDYwLjQxMiw5OC4wMjMsNjAuODEyLDk1LjYyMyw2MC44MTJ6IE0xMzEuNjIzLDQwLjgxMg0KCQljLTQuOCwwLTkuMi0yLjgtMTEuMi03LjJjLTIuOC02LDAtMTMuMiw2LTE1LjZoMC40YzYtMi44LDEzLjIsMCwxNS42LDYuNGMyLjgsNiwwLDEzLjItNi40LDE1LjYNCgkJQzEzNC44MjMsNDAuNDEyLDEzMy4yMjMsNDAuODEyLDEzMS42MjMsNDAuODEyeiBNMTcwLjAyMywyOC40MTJjLTUuNiwwLTEwLjQtNC0xMS42LTkuNmMtMS4yLTYuNCwyLjgtMTIuOCw5LjItMTRoMC40DQoJCWM2LjQtMS42LDEyLjgsMi44LDE0LjQsOS4yYzEuMiw2LTIuOCwxMi40LTkuMiwxNGgtMC40QzE3MS42MjMsMjguNDEyLDE3MC44MjMsMjguNDEyLDE3MC4wMjMsMjguNDEyeiIvPg0KCTxwYXRoIHN0eWxlPSJmaWxsOiM0NTRCNTQ7IiBkPSJNMjExLjYyMywyNC4wMTJjLTYuOCwwLTEyLTUuMi0xMi0xMnM1LjItMTIsMTItMTJsMCwwYzYuOCwwLDEyLDUuMiwxMiwxMg0KCQlTMjE4LjQyMywyNC4wMTIsMjExLjYyMywyNC4wMTJ6Ii8+DQo8L2c+DQo8cGF0aCBzdHlsZT0iZmlsbDojRjE2Njc3OyIgZD0iTTQxMS42MjMsMjI0LjAxMmMtNi44LDAtMTItNS4yLTEyLTEyYzAtMTAzLjYtODQuNC0xODgtMTg4LTE4OGMtNi44LDAtMTItNS4yLTEyLTEyczUuMi0xMiwxMi0xMg0KCWMxMTYuOCwwLDIxMiw5NS4yLDIxMiwyMTJDNDIzLjYyMywyMTguODEyLDQxOC40MjMsMjI0LjAxMiw0MTEuNjIzLDIyNC4wMTJ6Ii8+DQo8cGF0aCBzdHlsZT0iZmlsbDojRkZGRkZGOyIgZD0iTTM1MS42MjMsMjM1LjIxMnYtNDYuNGgtMzcuNmMtMi44LTExLjYtNy4yLTIyLjgtMTMuNi0zMi40bDI2LjgtMjYuOGwtMzIuOC0zMi44bC0yNi44LDI2LjQNCgljLTEwLTYuNC0yMC44LTEwLjgtMzIuNC0xMy42di0zNy42aC00Ni44djM3LjZjLTExLjYsMi44LTIyLjgsNy4yLTMyLjQsMTMuNmwtMjYuOC0yNi44bC0zMi44LDMyLjhsMjYuOCwyNi44DQoJYy02LjQsMTAtMTAuOCwyMC44LTEzLjYsMzIuNGgtMzh2NDYuOGgzNy42YzIuOCwxMS42LDcuMiwyMi44LDEzLjYsMzIuNGwtMjYuOCwyNi44bDMyLjgsMzIuOGwyNi44LTI2LjgNCgljMTAsNi40LDIwLjgsMTAuOCwzMi40LDEzLjZ2MzhoNDYuOHYtMzcuNmMxMS42LTIuOCwyMi44LTcuMiwzMi40LTEzLjZsMjYuOCwyNi44bDMyLjgtMzIuOGwtMjYuNC0yNi44YzYuNC0xMCwxMC44LTIwLjgsMTMuNi0zMi40DQoJaDM3LjZWMjM1LjIxMnogTTIxMS42MjMsMjU4LjgxMmMtMjUuNiwwLTQ2LjgtMjAuOC00Ni44LTQ2LjhjMC0yNS42LDIwLjgtNDYuOCw0Ni44LTQ2LjhzNDYuOCwyMS4yLDQ2LjgsNDYuOA0KCVMyMzcuMjIzLDI1OC44MTIsMjExLjYyMywyNTguODEyeiIvPg0KPHBhdGggc3R5bGU9ImZpbGw6I0Q3RUNGODsiIGQ9Ik0yMTEuNjIzLDEzNS4yMTJjLTQyLjQsMC03Ni44LDM0LjQtNzYuOCw3Ni44czM0LjQsNzYuOCw3Ni44LDc2LjhzNzYuOC0zNC40LDc2LjgtNzYuOA0KCVMyNTQuMDIzLDEzNS4yMTIsMjExLjYyMywxMzUuMjEyeiBNMjExLjYyMywyNTguODEyYy0yNS42LDAtNDYuOC0yMC44LTQ2LjgtNDYuOGMwLTI1LjYsMjAuOC00Ni44LDQ2LjgtNDYuOHM0Ni44LDIxLjIsNDYuOCw0Ni44DQoJUzIzNy4yMjMsMjU4LjgxMiwyMTEuNjIzLDI1OC44MTJ6Ii8+DQo8cGF0aCBzdHlsZT0iZmlsbDojNDU0QjU0OyIgZD0iTTIzNC44MjMsMzY0LjAxMmgtNDYuNGMtNi44LDAtMTItNS4yLTEyLTEydi0yOC40Yy02LjQtMi0xMi40LTQuNC0xOC40LTcuNmwtMjAsMjANCgljLTQuOCw0LjgtMTIuNCw0LjgtMTYuOCwwbC0zMy42LTMzLjJjLTIuNC0yLjQtMy42LTUuMi0zLjYtOC40YzAtMy4yLDEuMi02LjQsMy42LTguNGwyMC0yMGMtMy4yLTYtNS42LTEyLTcuNi0xOC40aC0yOC40DQoJYy02LjgsMC0xMi01LjItMTItMTJ2LTQ2LjhjMC02LjgsNS4yLTEyLDEyLTEyaDI4LjRjMi02LjQsNC40LTEyLjQsNy42LTE4LjRsLTIwLTIwYy0yLjQtMi40LTMuNi01LjItMy42LTguNHMxLjItNi40LDMuNi04LjQNCglsMzIuOC0zMi44YzQuOC00LjgsMTIuNC00LjgsMTYuOCwwbDIwLDIwYzYtMy4yLDEyLTUuNiwxOC40LTcuNnYtMjkuMmMwLTYuOCw1LjItMTIsMTItMTJoNDYuOGM2LjgsMCwxMiw1LjIsMTIsMTJ2MjguNA0KCWM2LjQsMiwxMi40LDQuNCwxOC40LDcuNmwyMC0yMGM0LjgtNC44LDEyLjQtNC44LDE2LjgsMGwzMi44LDMyLjhjMi40LDIuNCwzLjYsNS4yLDMuNiw4LjRzLTEuMiw2LjQtMy42LDguNGwtMjAsMjANCgljMy4yLDYsNS42LDEyLDcuNiwxOC40aDI5LjZjNi44LDAsMTIsNS4yLDEyLDEydjQ2LjhjMCw2LjgtNS4yLDEyLTEyLDEyaC0yOC40Yy0yLDYuNC00LjQsMTIuNC03LjYsMTguNGwyMCwyMA0KCWMyLjQsMi40LDMuNiw1LjIsMy42LDguNGMwLDMuMi0xLjIsNi40LTMuNiw4LjRsLTMzLjIsMzRjLTQuOCw0LjgtMTIuNCw0LjgtMTYuOCwwbC0yMC0yMGMtNiwzLjItMTIsNS42LTE4LjQsNy42djI4LjQNCglDMjQ2LjgyMywzNTguODEyLDI0MS42MjMsMzY0LjAxMiwyMzQuODIzLDM2NC4wMTJ6IE0yMDAuNDIzLDM0MC4wMTJoMjIuOHYtMjUuNmMwLTUuNiw0LTEwLjQsOS4yLTExLjZjMTAuNC0yLjQsMjAtNi40LDI4LjgtMTINCgljNC44LTIuOCwxMC44LTIuNCwxNC44LDEuNmwxOCwxOGwxNi0xNmwtMTgtMThjLTQtNC00LjgtMTAtMS42LTE0LjhjNS42LTguOCw5LjYtMTguNCwxMi0yOC44YzEuMi01LjYsNi05LjIsMTEuNi05LjJoMjUuNnYtMjIuOA0KCWgtMjUuNmMtNS42LDAtMTAuNC00LTExLjYtOS4yYy0yLjQtMTAuNC02LjQtMjAtMTItMjguOGMtMi44LTQuOC0yLjQtMTAuOCwxLjYtMTQuOGwxOC0xOGwtMTYtMTZsLTE4LDE4Yy00LDQtMTAsNC44LTE0LjgsMS42DQoJYy04LjgtNS42LTE4LjQtOS42LTI4LjgtMTJjLTUuNi0xLjItOS4yLTYtOS4yLTExLjZ2LTI2aC0yMi44djI1LjZjMCw1LjYtNCwxMC40LTkuMiwxMS42Yy0xMC40LDIuNC0yMCw2LjQtMjguOCwxMg0KCWMtNC44LDIuOC0xMC44LDIuNC0xNC44LTEuNmwtMTgtMThsLTE2LDE2bDE4LDE4YzQsNCw0LjgsMTAsMS42LDE0LjhjLTUuNiw4LjgtOS42LDE4LjQtMTIsMjguOGMtMS4yLDUuNi02LDkuMi0xMS42LDkuMmgtMjZ2MjIuOA0KCWgyNS42YzUuNiwwLDEwLjQsNCwxMS42LDkuMmMyLjQsMTAuNCw2LjQsMjAsMTIsMjguOGMyLjgsNC44LDIuNCwxMC44LTEuNiwxNC44bC0xOCwxOGwxNiwxNmwxOC0xOGM0LTQsMTAtNC44LDE0LjgtMS42DQoJYzguOCw1LjYsMTguNCw5LjYsMjguOCwxMmM1LjYsMS4yLDkuMiw2LDkuMiwxMS42djI2SDIwMC40MjN6Ii8+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8L3N2Zz4NCg=="
                                             alt="setting">
                                    </span>
									<?php esc_html_e( 'Settings', 'webappick-pdf-invoice-for-woocommerce' ); ?>
                                </a>
                            </li>
                            <li class="woo-invoice-sidebar-nav-item">
                                <a class="woo-invoice-sidebar-nav-link" href="#">
                                    <span class="_winvoice-menu-thumbnail">
                                        <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNDU2LjggNDU2LjgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ1Ni44IDQ1Ni44OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8cGF0aCBzdHlsZT0iZmlsbDojQ0FEQkVBOyIgZD0iTTM4Ni40LDQzMS44aC0zMTZjLTIyLDAtNDAtMTgtNDAtMjBWODVjMC00MiwxOC02MCw0MC02MGgzMTZjMjIsMCw0MCwxOCw0MCw2MHYzMjYuNA0KCUM0MjYuNCw0MTMuOCw0MDguNCw0MzEuOCwzODYuNCw0MzEuOHoiLz4NCjxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMzg2LjQsNDMxLjhoLTMxNmMtMjIsMC00MC0xOC00MC00MFYxMDVoMzk2djI4Ni40QzQyNi40LDQxMy44LDQwOC40LDQzMS44LDM4Ni40LDQzMS44eiIvPg0KPGc+DQoJPHBhdGggc3R5bGU9ImZpbGw6IzQ0NEI1NDsiIGQ9Ik0zODYuNCw0NDMuOGgtMzE2Yy0yOC44LDAtNTItMjMuMi01Mi01MlYyMDljMC02LjgsNS4yLTEyLDEyLTEyczEyLDUuMiwxMiwxMnYxODIuOA0KCQljMCwxNS42LDEyLjQsMjgsMjgsMjhoMzE2YzE1LjYsMCwyOC0xMi40LDI4LTI4VjIwOWMwLTYuOCw1LjItMTIsMTItMTJzMTIsNS4yLDEyLDEydjE4Mi44QzQzOC40LDQyMC4yLDQxNS4yLDQ0My44LDM4Ni40LDQ0My44eiINCgkJLz4NCgk8cGF0aCBzdHlsZT0iZmlsbDojNDQ0QjU0OyIgZD0iTTQyNi40LDExN2MtNi44LDAtMTItNS4yLTEyLTEyVjY1YzAtMTUuNi0xMi40LTI4LTI4LTI4aC0zMTZjLTE1LjYsMC0yOCwxMi40LTI4LDI4djQwDQoJCWMwLDYuOC01LjIsMTItMTIsMTJzLTEyLTUuMi0xMi0xMlY2NWMwLTI4LjgsMjMuMi01Miw1Mi01MmgzMTZjMjguOCwwLDUyLDIzLjIsNTIsNTJ2NDBDNDM4LjQsMTExLjgsNDMzLjIsMTE3LDQyNi40LDExN3oiLz4NCjwvZz4NCjxnPg0KCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNNzAuNCw3N2MtMC44LDAtMS42LDAtMi40LTAuNGMtMC44LDAtMS42LTAuNC0yLjQtMC44Yy0wLjgtMC40LTEuMi0wLjgtMi0xLjINCgkJYy0wLjgtMC40LTEuMi0wLjgtMi0xLjZjLTAuOC0wLjgtMS4yLTEuMi0xLjYtMnMtMC44LTEuMi0xLjItMmMtMC40LTAuOC0wLjQtMS42LTAuOC0yLjRzLTAuNC0xLjYtMC40LTIuNGMwLTMuMiwxLjItNi40LDMuNi04LjQNCgkJYzAuNC0wLjQsMS4yLTEuMiwyLTEuNnMxLjItMC44LDItMS4yYzAuOC0wLjQsMS42LTAuNCwyLjQtMC44YzQtMC44LDgsMC40LDEwLjgsMy4yYzIuNCwyLjQsMy42LDUuMiwzLjYsOC40YzAsMC44LDAsMS42LTAuNCwyLjQNCgkJcy0wLjQsMS42LTAuOCwyLjRzLTAuOCwxLjYtMS4yLDJjLTAuNCwwLjgtMC44LDEuMi0xLjYsMkM3Ni44LDc1LjgsNzMuNiw3Nyw3MC40LDc3eiIvPg0KCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMTEwLjQsNzdjLTMuMiwwLTYuNC0xLjItOC40LTMuNmMtMi40LTIuNC0zLjYtNS4yLTMuNi04LjRjMC0zLjIsMS4yLTYuNCwzLjYtOC40DQoJCWMwLjQtMC40LDEuMi0xLjIsMi0xLjZzMS4yLTAuOCwyLTEuMmMwLjgtMC40LDEuNi0wLjQsMi40LTAuOGMxLjYtMC40LDMuMi0wLjQsNC44LDBjMC44LDAsMS42LDAuNCwyLjQsMC44YzAuOCwwLjQsMS42LDAuOCwyLDEuMg0KCQljMC44LDAuNCwxLjIsMC44LDIsMS42YzIuNCwyLjQsMy42LDUuMiwzLjYsOC40YzAsMy4yLTEuMiw2LjQtMy42LDguNEMxMTYuOCw3NS44LDExMy42LDc3LDExMC40LDc3eiIvPg0KCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMTUwLjQsNzdjLTAuOCwwLTEuNiwwLTIuNC0wLjRjLTAuOCwwLTEuNi0wLjQtMi40LTAuOGMtMC44LTAuNC0xLjItMC44LTItMS4yDQoJCWMtMC44LTAuNC0xLjItMC44LTItMS42Yy0wLjgtMC44LTEuMi0xLjItMS42LTJjLTAuNC0wLjgtMC44LTEuMi0xLjItMnMtMC40LTEuNi0wLjgtMi40Yy0wLjQtMC44LTAuNC0xLjYtMC40LTIuNA0KCQljMC0zLjIsMS4yLTYuNCwzLjYtOC40YzAuNC0wLjQsMS4yLTEuMiwyLTEuNmMwLjgtMC40LDEuMi0wLjgsMi0xLjJjMC44LTAuNCwxLjYtMC40LDIuNC0wLjhjNC0wLjgsOCwwLjQsMTAuOCwzLjINCgkJYzIuNCwyLjQsMy42LDUuMiwzLjYsOC40YzAsMC44LDAsMS42LTAuNCwyLjRzLTAuNCwxLjYtMC44LDIuNGMtMC40LDAuOC0wLjgsMS42LTEuMiwyYy0wLjQsMC44LTAuOCwxLjItMS42LDINCgkJQzE1Ni44LDc1LjgsMTUzLjYsNzcsMTUwLjQsNzd6Ii8+DQo8L2c+DQo8cGF0aCBzdHlsZT0iZmlsbDojNkFDRUY1OyIgZD0iTTE2LDEwNXY0NGMwLDExLjIsOC44LDIwLDIwLDIwaDM4NC44YzExLjIsMCwyMC04LjgsMjAtMjB2LTQ0SDE2eiIvPg0KPHBhdGggc3R5bGU9ImZpbGw6I0YxNzc4NjsiIGQ9Ik0xMiwxMDV2NDRjMCwxMS4yLDguOCwyMCwyMCwyMGgzOTIuOGMxMS4yLDAsMjAtOC44LDIwLTIwdi00NEgxMnoiLz4NCjxyZWN0IHg9IjE1Ni40IiB5PSIxMDguMiIgc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIHdpZHRoPSIyNCIgaGVpZ2h0PSI2MC44Ii8+DQo8cGF0aCBzdHlsZT0iZmlsbDojNDQ0QjU0OyIgZD0iTTE1NiwxODFoMjQuOGM2LjgsMCwxMi01LjIsMTItMTJzLTUuMi0xMi0xMi0xMkgxNTZjLTYuOCwwLTEyLDUuMi0xMiwxMlMxNDkuMiwxODEsMTU2LDE4MXoiLz4NCjxyZWN0IHg9Ijk2LjQiIHk9IjEwOC4yIiBzdHlsZT0iZmlsbDojRkZGRkZGOyIgd2lkdGg9IjI0IiBoZWlnaHQ9IjYwLjgiLz4NCjxwYXRoIHN0eWxlPSJmaWxsOiM0NDRCNTQ7IiBkPSJNOTYsMTgxaDI0LjhjNi44LDAsMTItNS4yLDEyLTEycy01LjItMTItMTItMTJIOTZjLTYuOCwwLTEyLDUuMi0xMiwxMlM4OS4yLDE4MSw5NiwxODF6Ii8+DQo8Zz4NCgk8cmVjdCB4PSIyMTYuNCIgeT0iMTA4LjIiIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiB3aWR0aD0iMjQiIGhlaWdodD0iNjAuOCIvPg0KCTxyZWN0IHg9IjI3Ni40IiB5PSIxMDguMiIgc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIHdpZHRoPSIyNCIgaGVpZ2h0PSI2MC44Ii8+DQoJPHJlY3QgeD0iMzM2LjQiIHk9IjEwOC4yIiBzdHlsZT0iZmlsbDojRkZGRkZGOyIgd2lkdGg9IjI0IiBoZWlnaHQ9IjYwLjgiLz4NCgk8cmVjdCB4PSIzOTYuNCIgeT0iMTA4LjIiIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiB3aWR0aD0iMjQiIGhlaWdodD0iNjAuOCIvPg0KCTxyZWN0IHg9IjM2LjQiIHk9IjEwOC4yIiBzdHlsZT0iZmlsbDojRkZGRkZGOyIgd2lkdGg9IjI0IiBoZWlnaHQ9IjYwLjgiLz4NCjwvZz4NCjxnPg0KCTxwYXRoIHN0eWxlPSJmaWxsOiM0NDRCNTQ7IiBkPSJNNDI0LjgsMTgxYy02LjgsMC0xMi01LjItMTItMTJzNS4yLTEyLDEyLTEyYzQuNCwwLDgtMy42LDgtOHYtMzJIMjR2MzJjMCw0LjQsMy42LDgsOCw4DQoJCWM2LjgsMCwxMiw1LjIsMTIsMTJzLTUuMiwxMi0xMiwxMmMtMTcuNiwwLTMyLTE0LjQtMzItMzJ2LTQ0YzAtNi44LDUuMi0xMiwxMi0xMmg0MzIuOGM2LjgsMCwxMiw1LjIsMTIsMTJ2NDQNCgkJQzQ1Ni44LDE2Ni42LDQ0Mi40LDE4MSw0MjQuOCwxODF6Ii8+DQoJPHBhdGggc3R5bGU9ImZpbGw6IzQ0NEI1NDsiIGQ9Ik0zOTYsMTgxaDI0LjhjNi44LDAsMTItNS4yLDEyLTEycy01LjItMTItMTItMTJIMzk2Yy02LjgsMC0xMiw1LjItMTIsMTJTMzg5LjIsMTgxLDM5NiwxODF6Ii8+DQoJPHBhdGggc3R5bGU9ImZpbGw6IzQ0NEI1NDsiIGQ9Ik0zMzYsMTgxaDI0LjhjNi44LDAsMTItNS4yLDEyLTEycy01LjItMTItMTItMTJIMzM2Yy02LjgsMC0xMiw1LjItMTIsMTJTMzI5LjIsMTgxLDMzNiwxODF6Ii8+DQoJPHBhdGggc3R5bGU9ImZpbGw6IzQ0NEI1NDsiIGQ9Ik0yNzYsMTgxaDI0LjhjNi44LDAsMTItNS4yLDEyLTEycy01LjItMTItMTItMTJIMjc2Yy02LjgsMC0xMiw1LjItMTIsMTJTMjY5LjIsMTgxLDI3NiwxODF6Ii8+DQoJPHBhdGggc3R5bGU9ImZpbGw6IzQ0NEI1NDsiIGQ9Ik0yMTYsMTgxaDI0LjhjNi44LDAsMTItNS4yLDEyLTEycy01LjItMTItMTItMTJIMjE2Yy02LjgsMC0xMiw1LjItMTIsMTJTMjA5LjIsMTgxLDIxNiwxODF6Ii8+DQoJPHBhdGggc3R5bGU9ImZpbGw6IzQ0NEI1NDsiIGQ9Ik0zNiwxODFoMjQuOGM2LjgsMCwxMi01LjIsMTItMTJzLTUuMi0xMi0xMi0xMkgzNmMtNi44LDAtMTIsNS4yLTEyLDEyUzI5LjIsMTgxLDM2LDE4MXoiLz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K"
                                             alt="seller & buyer">
                                    </span>
									<?php esc_html_e( 'Seller & Buyer', 'webappick-pdf-invoice-for-woocommerce' ); ?>
                                </a>
                            </li>
                            <li class="woo-invoice-sidebar-nav-item" style="display: none;">
                                <a class="woo-invoice-sidebar-nav-link" href="#">
									<?php esc_html_e( 'Localization', 'webappick-pdf-invoice-for-woocommerce' ); ?>
                                </a>
                            </li>
                            <li class="woo-invoice-sidebar-nav-item">
                                <a class="woo-invoice-sidebar-nav-link" href="#">
                                    <span class="_winvoice-menu-thumbnail">
                                        <img src="data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgMTI4IDEyOCIgaGVpZ2h0PSI1MTIiIHZpZXdCb3g9IjAgMCAxMjggMTI4IiB3aWR0aD0iNTEyIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxwYXRoIGQ9Im0xMTggMTI3aC0xMDZjLTEuNyAwLTMtMS4zLTMtM3YtMThjMC0xLjcgMS4zLTMgMy0zczMgMS4zIDMgM3YxNWgxMDB2LTE1YzAtMS43IDEuMy0zIDMtM3MzIDEuMyAzIDN2MThjMCAxLjctMS4zIDMtMyAzeiIgZmlsbD0iIzQ0NGI1NCIvPjxwYXRoIGQ9Im0xMDQuNyA0OC43Yy0zLjUtMy41LTkuMi0zLjUtMTIuNyAwbC0yMCAyMHYtNjMuN2gtMTZ2NjMuN2wtMjAtMjBjLTMuNS0zLjUtOS4yLTMuNS0xMi43IDAtMy41IDMuNS0zLjUgOS4yIDAgMTIuN2wzNC4zIDM0LjNjMy41IDMuNSA5LjIgMy41IDEyLjcgMGwzNC4zLTM0LjNjMy42LTMuNSAzLjYtOS4yLjEtMTIuN3oiIGZpbGw9IiNkM2Q4ZGQiLz48ZyBmaWxsPSIjNDQ0YjU0Ij48cGF0aCBkPSJtNjQgMTAxLjRjLTMuMiAwLTYuMi0xLjItOC41LTMuNWwtMzQuMy0zNC4zYy0yLjMtMi4zLTMuNS01LjMtMy41LTguNXMxLjItNi4yIDMuNS04LjVjNC43LTQuNyAxMi4zLTQuNyAxNyAwbDE0LjggMTQuOHYtNTYuNGMwLTEuNyAxLjMtMyAzLTNzMyAxLjMgMyAzdjYzLjdjMCAxLjItLjcgMi4zLTEuOSAyLjgtMS4xLjUtMi40LjItMy4zLS43bC0yMC0yMGMtMi4zLTIuMy02LjEtMi4zLTguNSAwLTEuMSAxLjEtMS44IDIuNi0xLjggNC4ycy42IDMuMSAxLjggNC4ybDM0LjMgMzQuM2MyLjMgMi4zIDYuMSAyLjMgOC41IDBsMzQuMy0zNC4zYzIuMy0yLjMgMi4zLTYuMSAwLTguNS0yLjMtMi4zLTYuMS0yLjMtOC41IDBsLTIwIDIwYy0uOS45LTIuMSAxLjEtMy4zLjctLjktLjQtMS42LTEuNS0xLjYtMi43di00My43YzAtMS43IDEuMy0zIDMtM3MzIDEuMyAzIDN2MzYuNGwxNC45LTE0LjljNC43LTQuNyAxMi4zLTQuNyAxNyAwczQuNyAxMi4zIDAgMTdsLTM0LjQgMzQuNGMtMi4zIDIuMy01LjMgMy41LTguNSAzLjV6Ii8+PGNpcmNsZSBjeD0iNzIiIGN5PSI1IiByPSIzIi8+PC9nPjwvc3ZnPg=="
                                             alt="bulk download">
                                    </span>
									<?php esc_html_e( 'Bulk download', 'webappick-pdf-invoice-for-woocommerce' ); ?>
                                </a>
                            </li>
                            <li class="woo-invoice-sidebar-nav-item">
                                <a class="woo-invoice-sidebar-nav-link" href="#">
                                    <span class="_winvoice-menu-thumbnail">
                                        <img src="data:image/svg+xml,%3Csvg%20id%3D%22Layer_1%22%20data-name%3D%22Layer%201%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2023.97%2023.99%22%3E%3Cdefs%3E%3Cstyle%3E.cls-1%7Bfill%3A%23fff%3B%7D.cls-2%7Bfill%3A%23aadee6%3B%7D.cls-3%7Bfill%3A%23444b54%3B%7D%3C%2Fstyle%3E%3C%2Fdefs%3E%3Ctitle%3Efont-download2%3C%2Ftitle%3E%3Cpath%20class%3D%22cls-1%22%20d%3D%22M20.55%2C6.16a9.9%2C9.9%2C0%2C0%2C0-1.34%2C4.16%2C31.16%2C31.16%2C0%2C0%2C0%2C.45%2C6.25L.85%2C23.18%2C7.29%2C4.45A13.87%2C13.87%2C0%2C0%2C0%2C17.92%2C3.33%22%20transform%3D%22translate%28-0.01%20-0.01%29%22%2F%3E%3Cpath%20class%3D%22cls-2%22%20d%3D%22M20.55%2C6.16a9.9%2C9.9%2C0%2C0%2C0-1.34%2C4.16%2C31.16%2C31.16%2C0%2C0%2C0%2C.45%2C6.25L.85%2C23.18S19.38%2C4.65%2C19.31%2C4.73%22%20transform%3D%22translate%28-0.01%20-0.01%29%22%2F%3E%3Cpath%20class%3D%22cls-3%22%20d%3D%22M23.74%2C8.18%2C15.81.25a.79.79%2C0%2C0%2C0-1.12%2C0h0a.81.81%2C0%2C0%2C0%2C0%2C1.14h0l1.76%2C1.76A11%2C11%2C0%2C0%2C1%2C13.16%2C4%2C22.12%2C22.12%2C0%2C0%2C1%2C7.9%2C3.58c-.48-.08-.78-.13-1%2C.17a.79.79%2C0%2C0%2C0-.2.31l-4.17%2C12a.82.82%2C0%2C0%2C0%2C.53%2C1H3a1.31%2C1.31%2C0%2C0%2C0%2C.27.06A.86.86%2C0%2C0%2C0%2C4%2C16.59L8%2C5.29a22.78%2C22.78%2C0%2C0%2C0%2C5.34.4%2C13.46%2C13.46%2C0%2C0%2C0%2C4.39-1.24L19.55%2C6.3a10%2C10%2C0%2C0%2C0-1.14%2C4%2C25.3%2C25.3%2C0%2C0%2C0%2C.34%2C5.7L.56%2C22.37a.8.8%2C0%2C0%2C0-.51%2C1h0a.87.87%2C0%2C0%2C0%2C.8.55h.27L19.94%2C17.4a.75.75%2C0%2C0%2C0%2C.3-.2c.31-.31.25-.59.17-1.15A25.91%2C25.91%2C0%2C0%2C1%2C20%2C10.42a9.4%2C9.4%2C0%2C0%2C1%2C.72-2.86l1.79%2C1.82a1%2C1%2C0%2C0%2C0%2C.6.25.9.9%2C0%2C0%2C0%2C.58-.25.79.79%2C0%2C0%2C0%2C.12-1.11h0Z%22%20transform%3D%22translate%28-0.01%20-0.01%29%22%2F%3E%3Cpath%20class%3D%22cls-3%22%20d%3D%22M.85%2C24a.84.84%2C0%2C0%2C1-.6-.25.83.83%2C0%2C0%2C1%2C0-1.15h0L11%2C11.9a.82.82%2C0%2C0%2C1%2C1.17%2C0h0a.84.84%2C0%2C0%2C1%2C0%2C1.11L1.43%2C23.77A.78.78%2C0%2C0%2C1%2C.85%2C24Z%22%20transform%3D%22translate%28-0.01%20-0.01%29%22%2F%3E%3Cpath%20class%3D%22cls-3%22%20d%3D%22M14.59%2C10.33a.85.85%2C0%2C1%2C1-.86-.84h0A.85.85%2C0%2C0%2C1%2C14.59%2C10.33Z%22%20transform%3D%22translate%28-0.01%20-0.01%29%22%2F%3E%3C%2Fsvg%3E"
                                             alt="free vs premium">
                                    </span>
									<?php esc_html_e( 'Upload Fonts', 'webappick-pdf-invoice-for-woocommerce' ); ?>
                                </a>
                            </li>

                            <li class="woo-invoice-sidebar-nav-item">
                                <a class="woo-invoice-sidebar-nav-link" href="#">
                                    <span class="_winvoice-menu-thumbnail">
                                        <img src="data:image/svg+xml,%3Csvg%20width%3D%22151%22%20height%3D%22151%22%20viewBox%3D%220%200%20151%20151%22%20fill%3D%22none%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3Cpath%20d%3D%22M75.41%207.5122C93.5142%207.5122%20110.535%2014.561%20123.335%2027.365C136.136%2040.1655%20143.188%2057.1858%20143.188%2075.29C143.188%2093.3942%20136.139%20110.415%20123.335%20123.215C110.535%20136.016%2093.5142%20143.068%2075.41%20143.068C57.3058%20143.068%2040.2855%20136.019%2027.485%20123.215C14.6846%20110.415%207.6322%2093.3942%207.6322%2075.29C7.6322%2057.1858%2014.681%2040.1655%2027.485%2027.365C40.2855%2014.5646%2057.3058%207.5122%2075.41%207.5122ZM75.41%200.290039C33.9882%200.290039%200.410034%2033.8682%200.410034%2075.29C0.410034%20116.712%2033.9882%20150.29%2075.41%20150.29C116.832%20150.29%20150.41%20116.712%20150.41%2075.29C150.41%2033.8682%20116.832%200.290039%2075.41%200.290039Z%22%20fill%3D%22%23444B54%22%2F%3E%0A%3Cpath%20d%3D%22M75.4101%2035.27C78.4919%2035.27%2080.9956%2037.7774%2080.9956%2040.8556C80.9956%2043.9374%2078.4882%2046.4411%2075.4101%2046.4411C72.3283%2046.4411%2069.8245%2043.9338%2069.8245%2040.8556C69.8245%2037.7738%2072.3283%2035.27%2075.4101%2035.27ZM75.4101%2028.0443C68.336%2028.0443%2062.5988%2033.7779%2062.5988%2040.8556C62.5988%2047.9296%2068.3324%2053.6669%2075.4101%2053.6669C82.4877%2053.6669%2088.2214%2047.9332%2088.2214%2040.8556C88.2214%2033.7815%2082.4841%2028.0443%2075.4101%2028.0443Z%22%20fill%3D%22%2371C2FF%22%2F%3E%0A%3Cpath%20d%3D%22M75.4101%2072.6526C78.4919%2072.6526%2080.9956%2075.1599%2080.9956%2078.2381V109.721C80.9956%20112.803%2078.4882%20115.306%2075.4101%20115.306C72.3319%20115.306%2069.8245%20112.799%2069.8245%20109.721V78.2381C69.8245%2075.1563%2072.3283%2072.6526%2075.4101%2072.6526ZM75.4101%2065.4304C68.336%2065.4304%2062.5988%2071.1641%2062.5988%2078.2417V109.724C62.5988%20116.799%2068.3324%20122.536%2075.4101%20122.536C82.4841%20122.536%2088.2214%20116.802%2088.2214%20109.724V78.2417C88.2214%2071.1641%2082.4841%2065.4304%2075.4101%2065.4304Z%22%20fill%3D%22%2371C2FF%22%2F%3E%0A%3C%2Fsvg%3E%0A"
                                             alt="free vs premium">
                                    </span>
									<?php esc_html_e( 'Status', 'webappick-pdf-invoice-for-woocommerce' ); ?>
                                </a>
                            </li>

                            <li class="woo-invoice-sidebar-nav-item">
                                <a class="woo-invoice-sidebar-nav-link" href="#">
                                    <span class="_winvoice-menu-thumbnail">
                                        <img src="data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgMTI4IDEyOCIgaGVpZ2h0PSI1MTIiIHZpZXdCb3g9IjAgMCAxMjggMTI4IiB3aWR0aD0iNTEyIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxwYXRoIGQ9Im02NCA0Yy0zMy4xIDAtNjAgMjYuOS02MCA2MHMyNi45IDYwIDYwIDYwIDYwLTI2LjkgNjAtNjAtMjYuOS02MC02MC02MHptMCA5MC41Yy0xNi44IDAtMzAuNS0xMy43LTMwLjUtMzAuNXMxMy43LTMwLjUgMzAuNS0zMC41IDMwLjUgMTMuNyAzMC41IDMwLjUtMTMuNyAzMC41LTMwLjUgMzAuNXoiIGZpbGw9IiNmZjU1NzYiLz48ZyBmaWxsPSIjZmZmIj48cGF0aCBkPSJtODYuMyA4MS4xaDIwdjI4LjJoLTIweiIgdHJhbnNmb3JtPSJtYXRyaXgoLjcwNyAtLjcwNyAuNzA3IC43MDcgLTM5LjExNiA5NS45NSkiLz48cGF0aCBkPSJtMjIuOSAxNy42aDIwdjI4LjZoLTIweiIgdHJhbnNmb3JtPSJtYXRyaXgoLjcwNyAtLjcwNyAuNzA3IC43MDcgLTEyLjg4IDMyLjYxMikiLz48cGF0aCBkPSJtNzkuOSAyMi4yaDI5Ljd2MjBoLTI5Ljd6IiB0cmFuc2Zvcm09Im1hdHJpeCguNzA3IC0uNzA3IC43MDcgLjcwNyA0Ljk0MSA3Ni4zOTkpIi8+PHBhdGggZD0ibTE3LjQgODQuN2gyOS43djIwaC0yOS43eiIgdHJhbnNmb3JtPSJtYXRyaXgoLjcwNyAtLjcwNyAuNzA3IC43MDcgLTU3LjUxNiA1MC41MjkpIi8+PC9nPjxwYXRoIGQ9Im02NCAxMjdjLTM0LjcgMC02My0yOC4zLTYzLTYzczI4LjMtNjMgNjMtNjMgNjMgMjguMyA2MyA2My0yOC4zIDYzLTYzIDYzem0wLTEyMGMtMzEuNCAwLTU3IDI1LjYtNTcgNTdzMjUuNiA1NyA1NyA1NyA1Ny0yNS42IDU3LTU3LTI1LjYtNTctNTctNTd6IiBmaWxsPSIjNDQ0YjU0Ii8+PHBhdGggZD0ibTY0IDk3LjVjLTE4LjUgMC0zMy41LTE1LTMzLjUtMzMuNXMxNS0zMy41IDMzLjUtMzMuNSAzMy41IDE1IDMzLjUgMzMuNS0xNSAzMy41LTMzLjUgMzMuNXptMC02MWMtMTUuMiAwLTI3LjUgMTIuMy0yNy41IDI3LjVzMTIuMyAyNy41IDI3LjUgMjcuNSAyNy41LTEyLjMgMjcuNS0yNy41LTEyLjMtMjcuNS0yNy41LTI3LjV6IiBmaWxsPSIjNDQ0YjU0Ii8+PHBhdGggZD0ibTEzLjggNDcuMmMtLjQgMC0uNy0uMS0xLjEtLjItMS41LS42LTIuMy0yLjQtMS43LTMuOSA2LjYtMTYuOCAyMS0yOS41IDM4LjQtMzQuMiAxLjYtLjQgMy4yLjUgMy43IDIuMS40IDEuNi0uNSAzLjItMi4xIDMuNy0xNS42IDQuMS0yOC40IDE1LjYtMzQuMyAzMC42LS42IDEuMi0xLjcgMS45LTIuOSAxLjl6IiBmaWxsPSIjZmZmIi8+PHBhdGggZD0ibTEwIDY0LjljLTEuMyAwLTMtLjktMy0zLjMgMC0yLjMgMS44LTMuMiAzLTMuMiAxLjIgMCAzIC45IDMgMy4ydi4xYy0uMSAyLjQtMS44IDMuMi0zIDMuMnoiIGZpbGw9IiNmZmYiLz48L3N2Zz4="
                                             alt="free vs premium">
                                    </span>
									<?php esc_html_e( 'Free vs Premium', 'webappick-pdf-invoice-for-woocommerce' ); ?>
                                </a>
                            </li>
                        </ul>

                    </ul>
                </div>
            </div>
        </div><!-- end .woo-invoice-dashboard-sidebar -->
        <div class="woo-invoice-dashboard-content">
            <!--START SETTING TAB-->
            <li>
                <div class="woo-invoice-row">
                    <div class="woo-invoice-col-sm-8 woo-invoice-col-12">
                        <div class="woo-invoice-card woo-invoice-mr-0">
                            <div class="woo-invoice-card-body">
                                <form action="" method="post">
									<?php wp_nonce_field( 'invoice_form_nonce' ); ?>
                                    <div class="woo-invoice-form-group">
                                        <div class="woo-invoice-custom-control woo-invoice-custom-switch"
                                             style="padding-left:0!important;">
                                            <div class="woo-invoice-toggle-label">
                                                <span class="woo-invoice-checkbox-label"><?php esc_html_e( 'Enable Invoicing', 'webappick-pdf-invoice-for-woocommerce' ); ?></span>
                                            </div>
                                            <div class="woo-invoice-toggle-container"
                                                 tooltip="Enable Invoicing to generate automatically." flow="right">
                                                <input type="hidden" name="wpifw_invoicing" value="0">
                                                <input type="checkbox" class="woo-invoice-custom-control-input"
                                                       id="wpifw_invoicing" name="wpifw_invoicing"
                                                       value="1" <?php checked( get_option( 'wpifw_invoicing' ), $woo_invoice_current, true ); ?>>
                                                <label class="woo-invoice-custom-control-label"
                                                       for="wpifw_invoicing"></label>
                                            </div>
                                        </div>
                                    </div><!-- end .woo-invoice-form-group -->
                                    <div class="woo-invoice-form-group">
                                        <div class="woo-invoice-custom-control woo-invoice-custom-switch"
                                             style="padding-left:0!important;">
                                            <div class="woo-invoice-toggle-label">
                                                <span class="woo-invoice-checkbox-label"><?php esc_html_e( 'Allow My Account To Download Invoice', 'webappick-pdf-invoice-for-woocommerce' ); ?></span>
                                            </div>
                                            <div class="woo-invoice-toggle-container"
                                                 tooltip="Allow customer to download invoice from my account order list."
                                                 flow="right">
                                                <input type="hidden" name="wpifw_download" value="0">
                                                <input title="Allow Customer to Download Invoice From My Account"
                                                       type="checkbox" class="woo-invoice-custom-control-input"
                                                       id="wpifw_download" name="wpifw_download"
                                                       value="1" <?php checked( get_option( 'wpifw_download' ), $woo_invoice_current, true ); ?>>
                                                <label class="woo-invoice-custom-control-label tips"
                                                       for="wpifw_download"
                                                       title="Allow Customer to Download Invoice From My Account"></label>
                                            </div>
                                        </div>
                                    </div><!-- end .woo-invoice-form-group -->

                                    <!--  Allow to download invoice from my account base on order status.-->
                                    <div class="woo-invoice-form-group" id="downloadAttechedData" style="display:
									<?php
									if ( ( get_option( 'wpifw_download' ) == 1 ) ) {
										echo 'block';
									} else {
										echo 'none';
									}
									?>
                                            ">
                                        <div class="woo-invoice-custom-checkbox-label"></div>
                                        <div class="woo-invoice-custom-checkbox-container">
                                            <div class="woo-invoice-custom-control woo-invoice-custom-checkbox">

                                                <input type="checkbox" name="wpifw_invoice_download_check_list[]"
                                                       class="woo-invoice-custom-control-input" id="downloadChecked1"
                                                       value="processing"
													<?php
													if ( in_array( 'processing', $wpifw_invoice_download_check_list ) ) {
														echo 'checked';
													}
													?>
                                                >
                                                <label class="woo-invoice-custom-control-label"
                                                       for="downloadChecked1"><?php esc_html_e( 'Processing Order', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                            </div>
                                            <div class="woo-invoice-custom-control woo-invoice-custom-checkbox">

                                                <input type="checkbox" name="wpifw_invoice_download_check_list[]"
                                                       class="woo-invoice-custom-control-input" id="downloadChecked2"
                                                       value="completed"
													<?php
													if ( in_array( 'completed', $wpifw_invoice_download_check_list ) ) {
														echo 'checked';
													}
													?>
                                                >
                                                <label class="woo-invoice-custom-control-label"
                                                       for="downloadChecked2"><?php esc_html_e( 'Complete Order', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                            </div>
                                            <div class="woo-invoice-custom-control woo-invoice-custom-checkbox">
                                                <input type="checkbox" name="wpifw_invoice_download_check_list[]"
                                                       class="woo-invoice-custom-control-input" id="downloadChecked3"
                                                       value="payment_complete"
													<?php
													if ( in_array( 'payment_complete', $wpifw_invoice_download_check_list ) ) {
														echo 'checked';
													}
													?>
                                                >
                                                <label class="woo-invoice-custom-control-label"
                                                       for="downloadChecked3"><?php esc_html_e( 'After Payment Complete', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                            </div>
                                            <div class="woo-invoice-custom-control woo-invoice-custom-checkbox">

                                                <input type="checkbox" name="wpifw_invoice_download_check_list[]"
                                                       class="woo-invoice-custom-control-input" id="downloadChecked4"
                                                       value="always_allow"
													<?php
													if ( in_array( 'always_allow', $wpifw_invoice_download_check_list ) ) {
														echo 'checked';
													}
													?>
                                                >
                                                <label class="woo-invoice-custom-control-label"
                                                       for="downloadChecked4"><?php esc_html_e( 'Always Allow', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="woo-invoice-form-group">
                                        <div class="woo-invoice-custom-control woo-invoice-custom-switch"
                                             style="padding-left:0!important;">
                                            <div class="woo-invoice-toggle-label">
                                                <span class="woo-invoice-checkbox-label"><?php esc_html_e( 'Invoice Attach to Email', 'webappick-pdf-invoice-for-woocommerce' ); ?></span>
                                            </div>

                                            <div class="woo-invoice-toggle-container"
                                                 tooltip="Attach Invoice to completed order email." flow="right">
                                                <input type="hidden" name="wpifw_order_email" value="0">

                                                <input type="checkbox" id="atttoorder"
                                                       class="woo-invoice-custom-control-input atttoorder"
                                                       name="wpifw_order_email"
                                                       value="1" <?php checked( get_option( 'wpifw_order_email' ), $woo_invoice_current, true ); ?>>
                                                <label class="woo-invoice-custom-control-label tips"
                                                       for="atttoorder"></label>
                                            </div>
                                        </div>
                                    </div><!-- end .woo-invoice-form-group -->
                                    <!-- Attach Invoice with email based on order status.-->
                                    <div class="woo-invoice-form-group" id="emailAttechedData" style="display:
									<?php
									if ( ( get_option( 'wpifw_order_email' ) == 1 ) ) {
										echo 'block';
									} else {
										echo 'none';
									}
									?>
                                            ">
                                        <span class="woo-invoice-custom-checkbox-label"></span>
                                        <div class="woo-invoice-custom-checkbox-container">
                                            <div class="woo-invoice-custom-control woo-invoice-custom-checkbox">

                                                <input type="checkbox" name="wpifw_email_attach_check_list[]"
                                                       class="woo-invoice-custom-control-input" id="emailChecked1"
                                                       value="new_order"
													<?php
													if ( in_array( 'new_order', $wpifw_email_attach_check_list ) ) {
														echo 'checked';
													}
													?>
                                                >
                                                <label class="woo-invoice-custom-control-label"
                                                       for="emailChecked1"><?php esc_html_e( 'New Order', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                            </div>

                                            <div class="woo-invoice-custom-control woo-invoice-custom-checkbox">

                                                <input type="checkbox" name="wpifw_email_attach_check_list[]"
                                                       class="woo-invoice-custom-control-input" id="emailChecked6"
                                                       value="customer_completed_order"
													<?php
													if ( in_array( 'customer_completed_order', $wpifw_email_attach_check_list ) ) {
														echo 'checked';
													}
													?>
                                                >
                                                <label class="woo-invoice-custom-control-label"
                                                       for="emailChecked6"><?php esc_html_e( 'Completed Order', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                            </div>
                                            <div class="woo-invoice-custom-control woo-invoice-custom-checkbox">

                                                <input type="checkbox" name="wpifw_email_attach_check_list[]"
                                                       class="woo-invoice-custom-control-input" id="emailChecked5"
                                                       value="customer_processing_order"
													<?php
													if ( in_array( 'customer_processing_order', $wpifw_email_attach_check_list ) ) {
														echo 'checked';
													}
													?>
                                                >
                                                <label class="woo-invoice-custom-control-label"
                                                       for="emailChecked5"><?php esc_html_e( 'Processing Order', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                            </div>
                                            <div class="woo-invoice-custom-control woo-invoice-custom-checkbox">

                                                <input type="checkbox" name="wpifw_email_attach_check_list[]"
                                                       class="woo-invoice-custom-control-input" id="emailChecked7"
                                                       value="customer_refunded_order"
													<?php
													if ( in_array( 'customer_refunded_order', $wpifw_email_attach_check_list ) ) {
														echo 'checked';
													}
													?>
                                                >
                                                <label class="woo-invoice-custom-control-label"
                                                       for="emailChecked7"><?php esc_html_e( 'Refunded Order', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                            </div>
                                            <div class="woo-invoice-custom-control woo-invoice-custom-checkbox">

                                                <input type="checkbox" name="wpifw_email_attach_check_list[]"
                                                       class="woo-invoice-custom-control-input" id="emailChecked8"
                                                       value="customer_invoice"
													<?php
													if ( in_array( 'customer_invoice', $wpifw_email_attach_check_list ) ) {
														echo 'checked';
													}
													?>
                                                >
                                                <label class="woo-invoice-custom-control-label"
                                                       for="emailChecked8"><?php esc_html_e( 'Customer Invoice', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <!--document output type html -->
                                    <div class="woo-invoice-form-group">
                                        <div class="woo-invoice-custom-control woo-invoice-custom-switch"
                                             style="padding-left:0!important;">
                                            <div class="woo-invoice-toggle-label">
                                                <span class="woo-invoice-checkbox-label"><?php esc_html_e( 'Document Type HTML', 'webappick-pdf-invoice-for-woocommerce' ); ?></span>
                                            </div>
                                            <div class="woo-invoice-toggle-container"
                                                 tooltip="Document output type html. Default is PDF." flow="right">
                                                <input type="hidden" name="wpifw_output_type_html" value="0">
                                                <input type="checkbox" id="atttoorder09"
                                                       class="woo-invoice-custom-control-input atttoorder09"
                                                       name="wpifw_output_type_html"
                                                       value="1" <?php checked( get_option( 'wpifw_output_type_html' ), $woo_invoice_current, true ); ?>>
                                                <label class="woo-invoice-custom-control-label tips"
                                                       for="atttoorder09"></label>
                                            </div>
                                        </div>
                                    </div><!-- end document output type html -->

                                    <div class="woo-invoice-form-group woo-invoice-template-select" tooltip=""
                                         flow="right">
                                        <label class="woo-invoice-custom-label"
                                               for="templateid"><?php esc_html_e( 'Invoice Template', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                        <a class="woo-invoice-btn woo-invoice-btn-primary" data-toggle="modal"
                                           data-target="#winvoiceModalTemplates"
                                           style="color:#fff"><?php esc_html_e( 'Select Template', 'webappick-pdf-invoice-for-woocommerce' ); ?></a>
                                        <div class="woo-invoice-modal fade" id="winvoiceModalTemplates" tabindex="-1"
                                             role="dialog" aria-hidden="true">
                                            <div class="woo-invoice-modal-dialog woo-invoice-modal-dialog-centered"
                                                 role="document">
                                                <div class="woo-invoice-modal-content">
                                                    <div class="woo-invoice-modal-card" data-toggle="lists"
                                                         data-lists-values="[&quot;name&quot;]">
                                                        <div class="woo-invoice-card-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true"
                                                                      style="font-size: 30px;text-align: right;display: block;">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="woo-invoice-card-body" style="height:650px">
                                                            <div class="woo-invoice-row">
                                                                <div class="woo-invoice-col-sm-4">
                                                                    <a href="#" class="woo-invoice-template-selection"
                                                                       data-template="invoice-1"><img
                                                                                src="<?php echo esc_attr( WOO_INVOICE_FREE_PLUGIN_URL . 'admin/images/templates/invoice-1.png' ); ?>"
                                                                                alt="" style="
																		<?php
																		if ( 'invoice-1' === get_option( 'wpifw_templateid' ) ) {
																			echo esc_attr( $woo_invoice_style2 );
																		} else {
																			echo esc_attr( $woo_invoice_style );
																		}
																		?>
                                                                                "></a>
                                                                </div>
                                                                <div class="woo-invoice-col-sm-4">
                                                                    <a href="#" class="woo-invoice-template-selection"
                                                                       data-template="invoice-2"><img
                                                                                src="<?php echo esc_attr( WOO_INVOICE_FREE_PLUGIN_URL . 'admin/images/templates/invoice-2.png' ); ?>"
                                                                                alt="" style="
																		<?php
																		if ( 'invoice-2' === get_option( 'wpifw_templateid' ) ) {
																			echo esc_attr( $woo_invoice_style2 );
																		} else {
																			echo esc_attr( $woo_invoice_style );
																		}
																		?>
                                                                                "></a>
                                                                </div>

                                                                <div class="woo-invoice-col-sm-4"
                                                                     style="position:relative">
                                                                    <a href="#" class="woo-invoice-element-disable"
                                                                       data-template=""
                                                                       style="position: absolute;top: 0;z-index: 3333;"><img
                                                                                src="<?php echo esc_attr( WOO_INVOICE_FREE_PLUGIN_URL . 'admin/images/templates/invoice-3.png' ); ?>"
                                                                                alt=""
                                                                                style="max-width:80%;display:block;margin:0 auto;border: 3px solid #0F74A6;"></a>
                                                                    <div style="width: 80%;height: 284px;position: absolute;top: 0;z-index:1111;background: #ddd;opacity: 0.7;margin-left: 25px;"></div>
                                                                    <a href="https://webappick.com/plugin/woocommerce-pdf-invoice-packing-slips/?utm_source=customer_site&utm_medium=free_vs_pro&utm_campaign=woo_invoice_free"
                                                                       target="_blank"
                                                                       style="position: absolute;top: 0;z-index: 2222;background: #DC4C40;color: #fff;padding: 5px;border-radius: 3px;text-transform: uppercase;margin: 120px 80px;">Premium</a>
                                                                </div>
                                                                <div class="woo-invoice-col-sm-4"
                                                                     style="position:relative;margin-top: 25px;">
                                                                    <a href="#" class="woo-invoice-element-disable"
                                                                       data-template=""
                                                                       style="position: absolute;top: 0;z-index: 3333;"><img
                                                                                src="<?php echo esc_attr( WOO_INVOICE_FREE_PLUGIN_URL . 'admin/images/templates/invoice-4.png' ); ?>"
                                                                                alt=""
                                                                                style="max-width:80%;display:block;margin:0 auto;border: 3px solid #0F74A6;"></a>
                                                                    <div style="width: 80%;height: 281px;position: absolute;top: 0;z-index:1111;background: #ddd;opacity: 0.7;margin-left: 25px;"></div>
                                                                    <a href="https://webappick.com/plugin/woocommerce-pdf-invoice-packing-slips/?utm_source=customer_site&utm_medium=free_vs_pro&utm_campaign=woo_invoice_free"
                                                                       target="_blank"
                                                                       style="position: absolute;top: 0;z-index: 2222;background: #DC4C40;color: #fff;padding: 5px;border-radius: 3px;text-transform: uppercase;margin: 120px 80px;">Premium</a>
                                                                </div>
                                                                <div class="woo-invoice-col-sm-4"
                                                                     style="position:relative;margin-top: 25px;">
                                                                    <a href="#" class="woo-invoice-element-disable"
                                                                       data-template=""
                                                                       style="position: absolute;top: 0;z-index: 3333;"><img
                                                                                src="<?php echo esc_attr( WOO_INVOICE_FREE_PLUGIN_URL . 'admin/images/templates/invoice-8.png' ); ?>"
                                                                                alt=""
                                                                                style="max-width:80%;display:block;margin:0 auto;border: 3px solid #0F74A6;"></a>
                                                                    <div style="width: 80%;height: 281px;position: absolute;top: 0;z-index:1111;background: #ddd;opacity: 0.7;margin-left: 25px;"></div>
                                                                    <a href="https://webappick.com/plugin/woocommerce-pdf-invoice-packing-slips/?utm_source=customer_site&utm_medium=free_vs_pro&utm_campaign=woo_invoice_free"
                                                                       target="_blank"
                                                                       style="position: absolute;top: 0;z-index: 2222;background: #DC4C40;color: #fff;padding: 5px;border-radius: 3px;text-transform: uppercase;margin: 120px 80px;">Premium</a>
                                                                </div>
                                                                <div class="woo-invoice-col-sm-4"
                                                                     style="position:relative;margin-top: 25px;">
                                                                    <a href="#" class="woo-invoice-element-disable"
                                                                       data-template=""
                                                                       style="position: absolute;top: 0;z-index: 3333;"><img
                                                                                src="<?php echo esc_attr( WOO_INVOICE_FREE_PLUGIN_URL . 'admin/images/templates/invoice-9.png' ); ?>"
                                                                                alt=""
                                                                                style="max-width:80%;display:block;margin:0 auto;border: 3px solid #0F74A6;"></a>
                                                                    <div style="width: 80%;height: 281px;position: absolute;top: 0;z-index:1111;background: #ddd;opacity: 0.7;margin-left: 25px;"></div>
                                                                    <a href="https://webappick.com/plugin/woocommerce-pdf-invoice-packing-slips/?utm_source=customer_site&utm_medium=free_vs_pro&utm_campaign=woo_invoice_free"
                                                                       target="_blank"
                                                                       style="position: absolute;top: 0;z-index: 2222;background: #DC4C40;color: #fff;padding: 5px;border-radius: 3px;text-transform: uppercase;margin: 120px 80px;">Premium</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="woo-invoice-card-footer">
                                                            <button class="woo-invoice-btn woo-invoice-btn-primary"
                                                                    data-dismiss="modal" aria-label="Close"
                                                                    style="float:right;margin-bottom: 20px;">Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end .woo-invoice-template -->

                                    <div class="woo-invoice-form-group" tooltip="" flow="right">
                                        <label class="woo-invoice-custom-label"
                                               for="woo_invoice_paper_size"> <?php esc_html_e( 'Paper Size', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                        <select class="woo-invoice-fixed-width woo-invoice-select-control"
                                                id="woo_invoice_paper_size" name="wpifw_invoice_paper_size">
                                            <option value="A4" <?php selected( get_option( 'wpifw_invoice_paper_size' ), 'A4', true ); ?>><?php esc_html_e( 'A4', 'webappick-pdf-invoice-for-woocommerce' ); ?></option>
                                            <option value="A5" <?php selected( get_option( 'wpifw_invoice_paper_size' ), 'A5', true ); ?>><?php esc_html_e( 'A5', 'webappick-pdf-invoice-for-woocommerce' ); ?></option>
                                            <option value="letter" <?php selected( get_option( 'wpifw_invoice_paper_size' ), 'letter', true ); ?>><?php esc_html_e( 'Letter', 'webappick-pdf-invoice-for-woocommerce' ); ?></option>
                                        </select>
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group" tooltip="" flow="right">
                                        <label class="woo-invoice-custom-label"
                                               for="invno"><?php esc_html_e( 'Next Invoice No.', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control woo-invoice-number-input"
                                               type="number" id="invno" name="wpifw_invoice_no"
                                               value="<?php echo esc_attr( get_option( 'wpifw_invoice_no' ) ); ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group" tooltip="" flow="right">
                                        <label class="woo-invoice-custom-label"
                                               for="invprefix"><?php esc_html_e( 'Invoice No. Prefix', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="invprefix" name="wpifw_invoice_no_prefix"
                                               value="<?php echo esc_attr( get_option( 'wpifw_invoice_no_prefix' ) ); ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group" tooltip="" flow="right">
                                        <label class="woo-invoice-custom-label"
                                               for="insuff"><?php esc_html_e( 'Invoice No. Suffix', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="insuff" name="wpifw_invoice_no_suffix"
                                               value="<?php echo esc_attr( get_option( 'wpifw_invoice_no_suffix' ) ); ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group" tooltip="Keep Empty for no limit" flow="right">
                                        <label class="woo-invoice-custom-label"
                                               for="title-limit"><?php esc_html_e( 'Product Title limit', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                        <input class="woo-invoice-fixed-width woo-invoice-number-input woo-invoice-form-control"
                                               type="number" id="title-limit" name="wpifw_invoice_product_title_length"
                                               value="<?php echo esc_attr( get_option( 'wpifw_invoice_product_title_length' ) ); ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group" tooltip="" flow="right">
                                        <label class="woo-invoice-custom-label"
                                               for="disid"> <?php esc_html_e( 'Display ID/SKU', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                        <select class="woo-invoice-fixed-width woo-invoice-select-control" id="disid"
                                                name="wpifw_disid">
                                            <option value="SKU" <?php selected( get_option( 'wpifw_disid' ), 'SKU', true ); ?>><?php esc_html_e( 'SKU', 'webappick-pdf-invoice-for-woocommerce' ); ?></option>
                                            <option value="ID" <?php selected( get_option( 'wpifw_disid' ), 'ID', true ); ?>><?php esc_html_e( 'ID', 'webappick-pdf-invoice-for-woocommerce' ); ?></option>
                                            <option value="None" <?php selected( get_option( 'wpifw_disid' ), 'None', true ); ?>><?php esc_html_e( 'None', 'webappick-pdf-invoice-for-woocommerce' ); ?></option>
                                        </select>
                                    </div><!-- end .woo-invoice-form-group -->
                                    <!--=======================================================================-->
                                    <!--  Display shipping total with tax and without tax-->
                                    <!--=======================================================================-->
                                    <div class="woo-invoice-form-group" tooltip=""
                                         flow="right">
                                        <label class="woo-invoice-custom-label"
                                               for="wpifw_invoice_display_shipping_total"> <?php esc_html_e( 'Display Shipping Total', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                        <select id="wpifw_invoice_display_shipping_total"
                                                name="wpifw_invoice_display_shipping_total"
                                                class="woo-invoice-fixed-width woo-invoice-select-control">
                                            <option value="wpifw_invoice_display_shipping_total_with_tax" <?php selected( get_option( 'wpifw_invoice_display_shipping_total' ), 'wpifw_invoice_display_shipping_total_with_tax', true ); ?>><?php esc_html_e( 'With Tax', 'webappick-pdf-invoice-for-woocommerce' ); ?></option>
                                            <option value="wpifw_invoice_display_shipping_total_without_tax" <?php selected( get_option( 'wpifw_invoice_display_shipping_total' ), 'wpifw_invoice_display_shipping_total_without_tax', true ); ?>><?php esc_html_e( 'Without Tax', 'webappick-pdf-invoice-for-woocommerce' ); ?></option>
                                        </select>
                                    </div>
                                    <!--=======================================================================-->
                                    <!--  Display shipping total with tax and without tax-->
                                    <!--=======================================================================-->

                                    <div class="woo-invoice-form-group" tooltip="" flow="right">
                                        <label class="woo-invoice-custom-label"
                                               for="date"> <?php esc_html_e( 'Date Format', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                        <select class="woo-invoice-fixed-width woo-invoice-select-control" id="date"
                                                name="wpifw_date_format">
                                            <option value="d M, o" <?php selected( get_option( 'wpifw_date_format' ), 'd M, o', true ); ?> >
                                                Date Month, Year
                                            </option>
                                            <option value="m/d/y" <?php selected( get_option( 'wpifw_date_format' ), 'm/d/y', true ); ?> >
                                                mm/dd/yy
                                            </option>
                                            <option value="d/m/y" <?php selected( get_option( 'wpifw_date_format' ), 'm/d/y', true ); ?> >
                                                dd/mm/yy
                                            </option>
                                            <option value="y/m/d" <?php selected( get_option( 'wpifw_date_format' ), 'y/m/d', true ); ?> >
                                                yy/mm/dd
                                            </option>
                                            <option value="d/m/Y" <?php selected( get_option( 'wpifw_date_format' ), 'd/m/Y', true ); ?>>
                                                dd/mm/yyyy
                                            </option>
                                            <option value="Y/m/d" <?php selected( get_option( 'wpifw_date_format' ), 'Y/m/d', true ); ?>>
                                                yyyy/mm/dd
                                            </option>
                                            <option value="m/d/Y" <?php selected( get_option( 'wpifw_date_format' ), 'm/d/Y', true ); ?>>
                                                mm/dd/yyyy
                                            </option>
                                            <option value="y-m-d" <?php selected( get_option( 'wpifw_date_format' ), 'y-m-d', true ); ?>>
                                                yy-mm-dd
                                            </option>
                                            <option value="Y-m-d" <?php selected( get_option( 'wpifw_date_format' ), 'Y-m-d', true ); ?>>
                                                yyyy-mm-dd
                                            </option>
                                        </select>
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group" tooltip="" flow="right">
                                        <label class="woo-invoice-custom-label"
                                               for="wpifw_pdf_invoice_button_behaviour"> <?php esc_html_e( 'Invoice Download as', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                        <select class="woo-invoice-fixed-width woo-invoice-select-control"
                                                id="wpifw_pdf_invoice_button_behaviour"
                                                name="wpifw_pdf_invoice_button_behaviour">
                                            <option value="new_tab" <?php selected( get_option( 'wpifw_pdf_invoice_button_behaviour' ), 'new_tab', true ); ?> >
                                                Open in new tab
                                            </option>
                                            <option value="download" <?php selected( get_option( 'wpifw_pdf_invoice_button_behaviour' ), 'download', true ); ?> >
                                                Direct download
                                            </option>
                                        </select>
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <div class="woo-invoice-custom-control woo-invoice-custom-switch"
                                             style="padding-left:0!important;">
                                            <div class="woo-invoice-toggle-label">
                                                <span class="woo-invoice-checkbox-label"><?php esc_html_e( 'Display Currency Code', 'webappick-pdf-invoice-for-woocommerce' ); ?></span>
                                            </div>
                                            <div class="woo-invoice-toggle-container" tooltip="" flow="right">
                                                <input type="hidden" name="wpifw_currency_code" value="0">
                                                <input type="checkbox" class="woo-invoice-custom-control-input"
                                                       id="discurrency" name="wpifw_currency_code"
                                                       value="1" <?php checked( get_option( 'wpifw_currency_code' ), $woo_invoice_current, true ); ?> >
                                                <label class="woo-invoice-custom-control-label"
                                                       title="Display Currency Code into Invoice Total"
                                                       for="discurrency"></label>
                                            </div>
                                        </div>
                                    </div><!-- end .woo-invoice-form-group -->

									<?php  $wpifw_payment_method_show = get_option( 'wpifw_payment_method_show' ) == '' ? true : get_option( 'wpifw_payment_method_show' ); ?>
                                    <div class="woo-invoice-form-group">
                                        <div class="woo-invoice-custom-control woo-invoice-custom-switch"
                                             style="padding-left:0!important;">
                                            <div class="woo-invoice-toggle-label">
                                                <span class="woo-invoice-checkbox-label"><?php esc_html_e( 'Display Payment Method', 'webappick-pdf-invoice-for-woocommerce' ); ?></span>
                                            </div>
                                            <div class="woo-invoice-toggle-container" tooltip="" flow="right">
                                                <input type="hidden" name="wpifw_payment_method_show" value="0">
                                                <input type="checkbox" class="woo-invoice-custom-control-input"
                                                       id="disPayment" name="wpifw_payment_method_show"
                                                       value="1" <?php checked( $wpifw_payment_method_show, $woo_invoice_current, true ); ?> >
                                                <label class="woo-invoice-custom-control-label"
                                                       title="Display Payment Method into Invoice"
                                                       for="disPayment"></label>
                                            </div>
                                        </div>
                                    </div><!-- end .woo-invoice-form-group -->

									<?php  $wpifw_show_order_note = get_option( 'wpifw_show_order_note' ) == '' ? 1 : get_option( 'wpifw_show_order_note' ); ?>

                                    <div class="woo-invoice-form-group">
                                        <div class="woo-invoice-custom-control woo-invoice-custom-switch"
                                             style="padding-left:0!important;">
                                            <div class="woo-invoice-toggle-label">
                                                <span class="woo-invoice-checkbox-label"><?php esc_html_e( 'Display Order Note', 'webappick-pdf-invoice-for-woocommerce' ); ?></span>
                                            </div>
                                            <div class="woo-invoice-toggle-container" tooltip="" flow="right">
                                                <input type="hidden" name="wpifw_show_order_note" value="0">
                                                <input type="checkbox" class="woo-invoice-custom-control-input"
                                                       id="wpifw_show_order_note" name="wpifw_show_order_note"
                                                       value="1" <?php checked( $wpifw_show_order_note, $woo_invoice_current, true ); ?> >
                                                <label class="woo-invoice-custom-control-label"
                                                       for="wpifw_show_order_note"></label>
                                            </div>
                                        </div>
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <div class="woo-invoice-custom-control woo-invoice-custom-switch"
                                             style="padding-left:0!important;">
                                            <div class="woo-invoice-toggle-label">
                                                <span class="woo-invoice-checkbox-label"><?php esc_html_e( 'Enable Debug Mode', 'webappick-pdf-invoice-for-woocommerce' ); ?></span>
                                            </div>
                                            <div class="woo-invoice-toggle-container"
                                                 tooltip="<?php esc_html_e( 'Enable debug mode to show errors.', 'webappick-pdf-invoice-for-woocommerce' ); ?>"
                                                 flow="right">
                                                <input type="hidden" name="wpifw_pdf_invoice_debug_mode" value="0">
                                                <input type="checkbox" class="woo-invoice-custom-control-input"
                                                       id="wpifw_pdf_invoice_debug_mode"
                                                       name="wpifw_pdf_invoice_debug_mode"
                                                       value="1" <?php checked( get_option( 'wpifw_pdf_invoice_debug_mode' ), $woo_invoice_current, true ); ?> >
                                                <label class="woo-invoice-custom-control-label"
                                                       for="wpifw_pdf_invoice_debug_mode"></label>
                                            </div>
                                        </div>
                                    </div><!-- end .woo-invoice-form-group -->


                                    <div class="woo-invoice-card-footer woo-invoice-save-changes-selector">
                                        <input style="float:right;" class="woo-invoice-btn woo-invoice-btn-primary"
                                               type="submit" name="wpifw_submit"
                                               value="<?php esc_html_e( 'Save Changes', 'webappick-pdf-invoice-for-woocommerce' ); ?>"/>
                                    </div><!-- end .woo-invoice-card-footer -->
                                </form>
                            </div><!-- end .woo-invoice-card-body -->
                        </div><!-- end .woo-invoice-card -->
                    </div><!-- end .woo-invoice-col-sm-8 -->

                    <div class="woo-invoice-col-sm-4 woo-invoice-col-12">
                        <div class="woo-invoice-card">
                            <div class="woo-invoice-card-header">
                                <h4><?php esc_html_e( 'SELECTED TEMPLATE', 'webappick-pdf-invoice-for-woocommerce' ); ?></h4>
                            </div><!-- end .woo-invoice-card-header -->
                            <div class="woo-invoice-card-body" style="text-align: center">
								<?php $template_name = get_option( 'wpifw_templateid' ); ?>
                                <img class="woo-invoice-template-preview"
                                     src="<?php echo esc_attr( WOO_INVOICE_FREE_PLUGIN_URL . 'admin/images/templates/' . $template_name ); ?>.png"
                                     alt="Preview Template">
                                <a class="invoice_template_preiview_btn" target="_blank"
                                   href="<?php echo esc_attr( WOO_INVOICE_FREE_PLUGIN_URL . 'admin/images/templates/' . $template_name ); ?>.png"><?php echo esc_html_e( 'PREVIEW', 'webappick-pdf-invoice-for-woocommerce' ) ?></a>
                            </div><!-- end .woo-invoice-card-body -->
                        </div><!-- end .woo-invoice-card -->
                    </div><!-- end .woo-invoice-col-sm-4 -->
                </div><!-- end .woo-invoice-row -->
            </li>
            <!--END SETTING TAB-->

            <!--START SELLER & BUYER  TAB-->
            <li>
                <div class="woo-invoice-row">
                    <div class="woo-invoice-col-sm-8">
                        <div class="woo-invoice-card woo-invoice-mr-0">
                            <div class="woo-invoice-card-body">
                                <form action="" method="post">
									<?php wp_nonce_field( 'seller_form_nonce' ); ?>
                                    <h3><?php esc_html_e( 'Seller Block', 'webappick-pdf-invoice-for-woocommerce' ); ?></h3>
                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label"
                                               for="logo"><?php esc_html_e( 'Logo Image', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>

                                        <div style="display:inline-block;">
											<?php wp_enqueue_media(); ?>
                                            <input id="wpifw_upload_logo_button" type="button" class="button"
                                                   value="<?php esc_html_e( 'Upload Logo', 'webappick-pdf-invoice-for-woocommerce' ); ?>"/>
                                            <input type='hidden' name='wpifw_logo_attachment_id'
                                                   id='wpifw_logo_attachment_id'
                                                   value='<?php echo esc_attr( get_option( 'wpifw_logo_attachment_image_id' ) ); ?>'>
                                        </div>
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label"
                                               for="logo-height-width"><?php esc_html_e( 'Logo Size', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                        <input class="woo-invoice-uploaded-logo-width woo-invoice-fixed-width woo-invoice-form-control"
                                               type="text" name="wpifw_logo_width"
                                               placeholder="<?php echo esc_html( '20%' ); ?>"
                                               value='<?php echo esc_attr( get_option( 'wpifw_logo_width' ) ); ?>'>
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label"
                                               for="bltitle"><?php esc_html_e( 'Seller Title', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="bltitle" name="wpifw_block_title_from"
                                               value="<?php echo esc_attr( get_option( 'wpifw_block_title_from' ) ); ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label"
                                               for="cname"><?php esc_html_e( 'Company Name', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="cname" name="wpifw_cname"
                                               value="<?php echo esc_attr( get_option( 'wpifw_cname' ) ); ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-tinymce-label"
                                               for="cdetails"><?php esc_html_e( 'Company Details', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>

                                        <div class="woo-invoice-tinymce-textarea">
                                            <textarea style="height:150px;" class="woo-invoice-form-control"
                                                      id="cdetails" name="wpifw_cdetails"
                                                      value=""><?php echo esc_attr( get_option( 'wpifw_cdetails' ) ); ?></textarea>
                                        </div><!-- end .woo-invoice-tinymce-textarea -->
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-tinymce-label"
                                               for="terms-and-condition"><?php esc_html_e( 'Footer 1', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                        <div class="woo-invoice-tinymce-textarea">
                                            <textarea style="height:150px;" class="woo-invoice-form-control"
                                                      id="terms-and-condition" name="wpifw_terms_and_condition"
                                                      value=""><?php echo esc_textarea( get_option( 'wpifw_terms_and_condition' ) ); ?></textarea>
                                        </div><!-- end .woo-invoice-tinymce-textarea -->

                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-tinymce-label"
                                               for="other-information"><?php esc_html_e( 'Footer 2', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>

                                        <div class="woo-invoice-tinymce-textarea">
                                            <textarea style="height:150px;" class="woo-invoice-form-control"
                                                      id="other-information" name="wpifw_other_information"
                                                      value=""><?php echo esc_textarea( get_option( 'wpifw_other_information' ) ); ?></textarea>
                                        </div>
                                    </div><!-- end .woo-invoice-form-group -->

                                    <h3><?php esc_html_e( 'Buyer Block', 'webappick-pdf-invoice-for-woocommerce' ); ?></h3>

                                    <div class="woo-invoice-form-group">
                                        <div class="woo-invoice-custom-control woo-invoice-custom-switch"
                                             style="padding-left:0!important;">
                                            <div class="woo-invoice-toggle-label">
                                                <span class="woo-invoice-checkbox-label"><?php esc_html_e( 'Disable Phone Number', 'webappick-pdf-invoice-for-woocommerce' ); ?></span>
                                            </div>
                                            <div class="woo-invoice-toggle-container" tooltip="Disable Phone Number."
                                                 flow="right">
                                                <input type="hidden" name="wpifw_display_phone" value="0">
                                                <input type="checkbox" class="woo-invoice-custom-control-input"
                                                       id="wpifw_display_phone" name="wpifw_display_phone"
                                                       value="1" <?php checked( get_option( 'wpifw_display_phone' ), $woo_invoice_current, true ); ?>>
                                                <label class="woo-invoice-custom-control-label"
                                                       for="wpifw_display_phone"></label>
                                            </div>
                                        </div>
                                    </div><!-- end .woo-invoice-form-group -->


                                    <div class="woo-invoice-form-group">
                                        <div class="woo-invoice-custom-control woo-invoice-custom-switch"
                                             style="padding-left:0!important;">
                                            <div class="woo-invoice-toggle-label">
                                                <span class="woo-invoice-checkbox-label"><?php esc_html_e( 'Disable Email Address', 'webappick-pdf-invoice-for-woocommerce' ); ?></span>
                                            </div>
                                            <div class="woo-invoice-toggle-container" tooltip="Disable Email Address."
                                                 flow="right">
                                                <input type="hidden" name="wpifw_display_email" value="0">
                                                <input type="checkbox" class="woo-invoice-custom-control-input"
                                                       id="wpifw_display_email" name="wpifw_display_email"
                                                       value="1" <?php checked( get_option( 'wpifw_display_email' ), $woo_invoice_current, true ); ?>>
                                                <label class="woo-invoice-custom-control-label"
                                                       for="wpifw_display_email"></label>
                                            </div>
                                        </div>
                                    </div><!-- end .woo-invoice-form-group -->


                                    <div class="woo-invoice-card-footer woo-invoice-save-changes-selector">
                                        <input type="submit" style="float:right;" name="wpifw_submit_seller&buyer"
                                               value="<?php esc_html_e( 'Save Changes', 'webappick-pdf-invoice-for-woocommerce' ); ?>"
                                               class="woo-invoice-btn woo-invoice-btn-primary"/>
                                    </div><!-- end .woo-invoice-card-footer -->
                                </form>

                            </div><!-- end .woo-invoice-card-body -->
                        </div><!-- end .woo-invoice-card -->
                    </div><!-- end .woo-invoice-col-sm-8 -->
                    <div class="woo-invoice-col-sm-4">
                        <div class="woo-invoice-card">
                            <div class="woo-invoice-card-header">
                                <div class="woo-invoice-card-header-title">
                                    <b><?php esc_html_e( 'Logo Preview', 'webappick-pdf-invoice-for-woocommerce' ); ?></b>
                                </div>
                            </div>
                            <div class="woo-invoice-card-body">
                                <div class='wpifw_logo-preview-wrapper'>
									<?php
									if ( get_option( 'wpifw_logo_attachment_image_id' ) && ! empty( get_option( 'wpifw_logo_attachment_image_id' ) ) ) {
										$woo_invoice_url = wp_get_attachment_url( get_option( 'wpifw_logo_attachment_image_id' ) );
										?>
                                        <img style="max-width:90px;display: block;margin:0 auto;"
                                             id='wpifw_logo-preview' src='<?php echo esc_url( $woo_invoice_url ); ?>'>
										<?php
									} else {
										?>
                                        <img style="max-width:90px;display: block;margin:0 auto;"
                                             id='wpifw_logo-preview' src=''>
										<?php
									}

									?>
                                </div>
                            </div>
                        </div>
                    </div><!-- end .woo-invoice-col-sm-4 -->
                </div><!-- end .woo-invoice-row -->
            </li>
            <!--END SELLER & BUYER  TAB-->

            <!--START LOCALIZATION TAB-->
            <li>
                <div class="woo-invoice-row">
                    <div class="woo-invoice-col-8">
                        <div class="woo-invoice-card woo-invoice-mr-0">
                            <div class="woo-invoice-card-body">
                                <form action="" method="post">
									<?php wp_nonce_field( 'localization_form_nonce' ); ?>
                                    <h3><?php esc_html_e( 'Invoice block', 'webappick-pdf-invoice-for-woocommerce' ); ?></h3>

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="invoice">Invoice</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="invoice" name="wpifw_INVOICE_TITLE"
                                               value="<?php echo ! empty( get_option( 'wpifw_INVOICE_TITLE' ) ) ? esc_attr( get_option( 'wpifw_INVOICE_TITLE' ) ) : 'Invoice'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="payment_method">Payment
                                            Method</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="payment_method" name="wpifw_payment_method_text"
                                               value="<?php echo ! empty( get_option( 'wpifw_payment_method_text' ) ) ? esc_attr( get_option( 'wpifw_payment_method_text' ) ) : 'Payment Method'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="Invoice-number">Invoice
                                            Number</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="Invoice-number" name="wpifw_INVOICE_NUMBER_TEXT"
                                               value="<?php echo ! empty( get_option( 'wpifw_INVOICE_NUMBER_TEXT' ) ) ? esc_attr( get_option( 'wpifw_INVOICE_NUMBER_TEXT' ) ) : 'Invoice Number'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="Invoice-date">Invoice Date</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="Invoice-date" name="wpifw_INVOICE_DATE_TEXT"
                                               value="<?php echo ! empty( get_option( 'wpifw_INVOICE_DATE_TEXT' ) ) ? esc_attr( get_option( 'wpifw_INVOICE_DATE_TEXT' ) ) : 'Invoice Date'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="order_number">Order Number</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="order_number" name="wpifw_ORDER_NUMBER_TEXT"
                                               value="<?php echo ! empty( get_option( 'wpifw_ORDER_NUMBER_TEXT' ) ) ? esc_attr( get_option( 'wpifw_ORDER_NUMBER_TEXT' ) ) : 'Order Number'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="order_date">Order Date</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="order_date" name="wpifw_ORDER_DATE_TEXT"
                                               value="<?php echo ! empty( get_option( 'wpifw_ORDER_DATE_TEXT' ) ) ? esc_attr( get_option( 'wpifw_ORDER_DATE_TEXT' ) ) : 'Order Date'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="sl">SL</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="sl" name="wpifw_SL"
                                               value="<?php echo ! empty( get_option( 'wpifw_SL' ) ) ? esc_attr( get_option( 'wpifw_SL' ) ) : 'SL'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="product">Product</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="product" name="wpifw_PRODUCT"
                                               value="<?php echo ! empty( get_option( 'wpifw_PRODUCT' ) ) ? esc_attr( get_option( 'wpifw_PRODUCT' ) ) : 'Product'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="price">Price</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="price" name="wpifw_PRICE"
                                               value="<?php echo ! empty( get_option( 'wpifw_PRICE' ) ) ? esc_attr( get_option( 'wpifw_PRICE' ) ) : 'Price'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="quantity">Quantity</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="quantity" name="wpifw_QUANTITY"
                                               value="<?php echo ! empty( get_option( 'wpifw_QUANTITY' ) ) ? esc_attr( get_option( 'wpifw_QUANTITY' ) ) : 'Quantity'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="total">Total</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="total" name="wpifw_ROW_TOTAL"
                                               value="<?php echo ! empty( get_option( 'wpifw_ROW_TOTAL' ) ) ? esc_attr( get_option( 'wpifw_ROW_TOTAL' ) ) : 'Total'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="su-total">Sub Total</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="su-total" name="wpifw_SUBTOTAL_TEXT"
                                               value="<?php echo ! empty( get_option( 'wpifw_SUBTOTAL_TEXT' ) ) ? esc_attr( get_option( 'wpifw_SUBTOTAL_TEXT' ) ) : 'Sub Total'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="Tax1">Tax</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="Tax1" name="wpifw_TAX_TEXT"
                                               value="<?php echo ! empty( get_option( 'wpifw_TAX_TEXT' ) ) ? esc_attr( get_option( 'wpifw_TAX_TEXT' ) ) : 'Tax'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="discount">Discount</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="discount" name="wpifw_DISCOUNT_TEXT"
                                               value="<?php echo ! empty( get_option( 'wpifw_DISCOUNT_TEXT' ) ) ? esc_attr( get_option( 'wpifw_DISCOUNT_TEXT' ) ) : 'Discount'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="grand-total-tax">REFUNDED</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="refund-tax" name="wpifw_REFUNDED_TEXT"
                                               value="<?php echo ! empty( get_option( 'wpifw_REFUNDED_TEXT' ) ) ? esc_attr( get_option( 'wpifw_REFUNDED_TEXT' ) ) : 'Refunded'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="shipping">SHIPPING</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="shipping" name="wpifw_SHIPPING_TEXT"
                                               value="<?php echo ! empty( get_option( 'wpifw_SHIPPING_TEXT' ) ) ? esc_attr( get_option( 'wpifw_SHIPPING_TEXT' ) ) : 'Shipping'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="grand-total-tax">Grand
                                            Total</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="grand-total-tax" name="wpifw_GRAND_TOTAL_TEXT"
                                               value="<?php echo ! empty( get_option( 'wpifw_GRAND_TOTAL_TEXT' ) ) ? esc_attr( get_option( 'wpifw_GRAND_TOTAL_TEXT' ) ) : 'Grand Total'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label woo-invoice-download-invoice"
                                               for="grand-total-tax">Download Invoice<br><span
                                                    style="font-size: xx-small">(For Email template)</span></label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="grand-total-tax" name="wpifw_DOWNLOAD_INVOICE_TEXT"
                                               value="<?php echo ! empty( get_option( 'wpifw_DOWNLOAD_INVOICE_TEXT' ) ) ? esc_attr( get_option( 'wpifw_DOWNLOAD_INVOICE_TEXT' ) ) : 'Download Invoice'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <h3><?php esc_html_e( 'Packing Slip block', 'webappick-pdf-invoice-for-woocommerce' ); ?></h3>


                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="packing_slip">Packing Slip</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="packing_slip" name="wpifw_PACKING_SLIP_TEXT"
                                               value="<?php echo ! empty( get_option( 'wpifw_PACKING_SLIP_TEXT' ) ) ? esc_attr( get_option( 'wpifw_PACKING_SLIP_TEXT' ) ) : 'Packing Slip'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="Invoice-number_slip">Order
                                            Number</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="Invoice-number_slip" name="wpifw_PACKING_SLIP_ORDER_NUMBER_TEXT"
                                               value="<?php echo ! empty( get_option( 'wpifw_PACKING_SLIP_ORDER_NUMBER_TEXT' ) ) ? esc_attr( get_option( 'wpifw_PACKING_SLIP_ORDER_NUMBER_TEXT' ) ) : 'Order Number'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="Invoice-date">Order Date</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="Invoice-date" name="wpifw_PACKING_SLIP_ORDER_DATE_TEXT"
                                               value="<?php echo ! empty( get_option( 'wpifw_PACKING_SLIP_ORDER_DATE_TEXT' ) ) ? esc_attr( get_option( 'wpifw_PACKING_SLIP_ORDER_DATE_TEXT' ) ) : 'Order Date'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="shipping_method">Shipping
                                            method</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="shipping_method" name="wpifw_PACKING_SLIP_ORDER_METHOD_TEXT"
                                               value="<?php echo ! empty( get_option( 'wpifw_PACKING_SLIP_ORDER_METHOD_TEXT' ) ) ? esc_attr( get_option( 'wpifw_PACKING_SLIP_ORDER_METHOD_TEXT' ) ) : 'Shipping method'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="product">Product</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="product" name="wpifw_PACKING_SLIP_PRODUCT_TEXT"
                                               value="<?php echo ! empty( get_option( 'wpifw_PACKING_SLIP_PRODUCT_TEXT' ) ) ? esc_attr( get_option( 'wpifw_PACKING_SLIP_PRODUCT_TEXT' ) ) : 'Product'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="weight">Weight</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="weight" name="wpifw_PACKING_SLIP_WEIGHT_TEXT"
                                               value="<?php echo ! empty( get_option( 'wpifw_PACKING_SLIP_WEIGHT_TEXT' ) ) ? esc_attr( get_option( 'wpifw_PACKING_SLIP_WEIGHT_TEXT' ) ) : 'Weight'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label" for="quantity">Quantity</label>
                                        <input class="woo-invoice-fixed-width woo-invoice-form-control" type="text"
                                               id="quantity" name="wpifw_PACKING_SLIP_QUANTITY_TEXT"
                                               value="<?php echo ! empty( get_option( 'wpifw_PACKING_SLIP_QUANTITY_TEXT' ) ) ? esc_attr( get_option( 'wpifw_PACKING_SLIP_QUANTITY_TEXT' ) ) : 'Quantity'; ?>">
                                    </div><!-- end .woo-invoice-form-group -->


                                    <div class="woo-invoice-card-footer woo-invoice-save-changes-selector">
                                        <input type="submit" style="float:right;" name="wpifw_submit_localization"
                                               value="<?php esc_html_e( 'Save Changes', 'webappick-pdf-invoice-for-woocommerce' ); ?>"
                                               class="woo-invoice-btn woo-invoice-btn-primary"/>
                                    </div><!-- end .woo-invoice-card-footer -->

                                </form>
                            </div><!-- end .woo-invoice-card-body -->
                        </div><!-- end .woo-invoice-card -->
                    </div><!-- end .woo-invoice-col-8 -->
                </div><!-- end .woo-invoice-row -->
            </li>
            <!--END LOCALIZATION TAB-->

            <!--START BULK DOWNLOAD TAB-->
            <li>
                <div class="woo-invoice-row">
                    <div class="woo-invoice-col-8">
                        <div class="woo-invoice-card woo-invoice-mr-0">
                            <div class="woo-invoice-card-body">
                                <form action="" method="post" target="_blank">
									<?php wp_nonce_field( 'bulk_download_form_nonce' ); ?>
                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label"
                                               for="disid"> <?php esc_html_e( 'Bulk Type', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                        <select class="woo-invoice-fixed-width woo-invoice-select-control" id="disid"
                                                name="wpifw_bulk_type">
                                            <option value="WPIFW_INVOICE_DOWNLOAD" <?php selected( get_option( 'wpifw_disid' ), 'SKU', true ); ?>><?php esc_html_e( 'Invoice', 'webappick-pdf-invoice-for-woocommerce' ); ?></option>
                                            <option value="WPIFW_PACKING_SLIP" <?php selected( get_option( 'wpifw_disid' ), 'ID', true ); ?>><?php esc_html_e( 'Packing Slip', 'webappick-pdf-invoice-for-woocommerce' ); ?></option>
                                        </select>
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label"
                                               for="Date-from"> <?php esc_html_e( 'Date From', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                        <input class="woo-invoice-fixed-width woo-invoice-datepicker woo-invoice-form-control"
                                               id="Date-from" name="wpifw_date_from"
                                               placeholder="<?php esc_html_e( 'Date From', 'webappick-pdf-invoice-for-woocommerce' ); ?>"
                                               max="<?php echo esc_attr( gmdate( 'Y-m-d' ) ); ?>" required
                                               autocomplete="off">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-form-group">
                                        <label class="woo-invoice-custom-label"
                                               for="Date-to"> <?php esc_html_e( 'Date To', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                        <input class="woo-invoice-fixed-width woo-invoice-datepicker woo-invoice-form-control"
                                               id="Date-to" name="wpifw_date_to"
                                               placeholder="<?php esc_html_e( 'Date To', 'webappick-pdf-invoice-for-woocommerce' ); ?>"
                                               max="<?php echo esc_attr( gmdate( 'Y-m-d' ) ); ?>" required
                                               autocomplete="off">
                                    </div><!-- end .woo-invoice-form-group -->

                                    <div class="woo-invoice-card-footer">
                                        <input type="submit" style="float: right;" name="wpifw_submit_bulk_download"
                                               value="<?php esc_html_e( 'Download', 'webappick-pdf-invoice-for-woocommerce' ); ?>"
                                               class="woo-invoice-btn woo-invoice-btn-primary"/>
                                    </div><!-- end .woo-invoice-card-footer -->
                                </form>
                                <!-- Fetch error message if not found table -->
								<?php if ( isset( $_GET['message'] ) ) { ?>
                                    <p style="margin:0; color:red; margin-top: -15px"> <?php echo esc_html( sanitize_text_field( wp_unslash( $_GET['message'] ) ) ); ?> </p>
								<?php } ?>
                            </div><!-- end .woo-invoice-card-body -->
                        </div><!-- end .woo-invoice-card -->
                    </div><!-- end .woo-invoice-col-8 -->
                </div><!-- end .woo-invoice-row -->
            </li>
            <li>
                <div class="woo-invoice-row">
                    <div class="woo-invoice-col-8">
                        <div class="woo-invoice-card woo-invoice-mr-0">
                            <div class="woo-invoice-card-body">
                                <form enctype="multipart/form-data">
                                    <div class="woo-invoice-row">
                                        <div class="woo-invoice-col-9">
                                            <div class="woo-invoice-form-group">
                                                <label class="woo-invoice-custom-label"
                                                       for="woo-invoice-font-upload"> <?php esc_html_e( 'Upload Fonts', 'webappick-pdf-invoice-for-woocommerce' ); ?></label>
                                                <input type="file" class="form-control-file"
                                                       id="woo-invoice-font-upload"/>
                                            </div><!-- end .woo-invoice-form-group -->
                                        </div>
                                        <div class="woo-invoice-col-1">
                                            <div id="loading-image"><img
                                                        src="data:image/gif,GIF89a%D8%00%D8%00%F2%07%00%F8%F8%F8%E0%E0%E0%C9%C9%C9%AC%AC%AC%8B%8B%8Bccc999%FF%FF%FF%21%FF%0BNETSCAPE2.0%03%01%00%00%00%21%FF%0BXMP%20DataXMP%3C%3Fxpacket%20begin%3D%22%EF%BB%BF%22%20id%3D%22W5M0MpCehiHzreSzNTczkc9d%22%3F%3E%20%3Cx%3Axmpmeta%20xmlns%3Ax%3D%22adobe%3Ans%3Ameta%2F%22%20x%3Axmptk%3D%22Adobe%20XMP%20Core%205.0-c060%2061.134777%2C%202010%2F02%2F12-17%3A32%3A00%20%20%20%20%20%20%20%20%22%3E%20%3Crdf%3ARDF%20xmlns%3Ardf%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2F02%2F22-rdf-syntax-ns%23%22%3E%20%3Crdf%3ADescription%20rdf%3Aabout%3D%22%22%20xmlns%3Axmp%3D%22http%3A%2F%2Fns.adobe.com%2Fxap%2F1.0%2F%22%20xmlns%3AxmpMM%3D%22http%3A%2F%2Fns.adobe.com%2Fxap%2F1.0%2Fmm%2F%22%20xmlns%3AstRef%3D%22http%3A%2F%2Fns.adobe.com%2Fxap%2F1.0%2FsType%2FResourceRef%23%22%20xmp%3ACreatorTool%3D%22Adobe%20Photoshop%20CS5%20Macintosh%22%20xmpMM%3AInstanceID%3D%22xmp.iid%3ACCEA6E1E9C0C11E2AE47CE5CE2BEC7E2%22%20xmpMM%3ADocumentID%3D%22xmp.did%3ACCEA6E1F9C0C11E2AE47CE5CE2BEC7E2%22%3E%20%3CxmpMM%3ADerivedFrom%20stRef%3AinstanceID%3D%22xmp.iid%3ACCEA6E1C9C0C11E2AE47CE5CE2BEC7E2%22%20stRef%3AdocumentID%3D%22xmp.did%3ACCEA6E1D9C0C11E2AE47CE5CE2BEC7E2%22%2F%3E%20%3C%2Frdf%3ADescription%3E%20%3C%2Frdf%3ARDF%3E%20%3C%2Fx%3Axmpmeta%3E%20%3C%3Fxpacket%20end%3D%22r%22%3F%3E%01%FF%FE%FD%FC%FB%FA%F9%F8%F7%F6%F5%F4%F3%F2%F1%F0%EF%EE%ED%EC%EB%EA%E9%E8%E7%E6%E5%E4%E3%E2%E1%E0%DF%DE%DD%DC%DB%DA%D9%D8%D7%D6%D5%D4%D3%D2%D1%D0%CF%CE%CD%CC%CB%CA%C9%C8%C7%C6%C5%C4%C3%C2%C1%C0%BF%BE%BD%BC%BB%BA%B9%B8%B7%B6%B5%B4%B3%B2%B1%B0%AF%AE%AD%AC%AB%AA%A9%A8%A7%A6%A5%A4%A3%A2%A1%A0%9F%9E%9D%9C%9B%9A%99%98%97%96%95%94%93%92%91%90%8F%8E%8D%8C%8B%8A%89%88%87%86%85%84%83%82%81%80%7F~%7D%7C%7Bzyxwvutsrqponmlkjihgfedcba%60_%5E%5D%5C%5BZYXWVUTSRQPONMLKJIHGFEDCBA%40%3F%3E%3D%3C%3B%3A9876543210%2F.-%2C%2B%2A%29%28%27%26%25%24%23%22%21%20%1F%1E%1D%1C%1B%1A%19%18%17%16%15%14%13%12%11%10%0F%0E%0D%0C%0B%0A%09%08%07%06%05%04%03%02%01%00%00%21%F9%04%05%0A%00%07%00%2C%00%00%00%00%D8%00%D8%00%00%03%FFx%BA%DC%FE0%CAI%AB%BD8%EB%CD%BB%FF%60%28%8Edi%9Eh%AA%AEl%EB%BEp%2C%CFtm%DFx%AE%EF%7C%EF%FF%C0%A0pH%2C%1A%8F%C8%A4r%C9l%3A%9F%D0%A8tJ%ADZ%AF%D8%ACv%CB%EDz%BF%E0%B0xL.%9B%CF%E8%B4z%CDn%BB%DF%F0%B8%7CN%AF%DB%EF%F8%BC~%CF%EF%FB%FF%80%81%82%83%84%85%86%87%88%89%8A%8B%8C%8D%8E%8F%90%91%92%93%94%95%96%97%98%99%9A%9B%9C%9D%9E%9F%A0%A1%A2%A3%A4%A5%A6%A7%A8%A9%AA%AB%AC%AD%AE%AF%B0%B1%B2%B3%B4%B5%B6%B7%B8%B9%BA%BB%BC%19%05%06%BD%20%01%06%03%0E%06%C0%0D%03%06%00%C1%16%C3%C8%0C%C7%C6%06%01%CD%15%00%C7%D5%D1%D0%0A%CF%CC%D6%0C%04%04%0E%BF%C5%DB%0D%04%06%05%0E%01%DF%BB%D8%06%02%C9%EA%0D%D2%0C%E5%0D%00%01%DA%BC%CA%05%EE%07%BC%9D%5B%00%8F%DF%01%7D%ED%82%01%F85n%9B%BC%05%F6%14%08%88%A8%00%21%C0%5D%13%A9%85%23%16m%FF%DD%82t%0D%2B%EE%BB8%2B%00%01%92%0C%19%08%28%F0%10%C2%CA%96%07%F79%D0GRU%BA%7F%0D%9E%19%D4%601%DF%BE%9D%AB%16%AA%DB%99%CE%1C%07%84%3EG%C6%12%8A%93%A0%80%9A%17%00He%800%A1%2C%A6%40IT%85%DA%8A%29%D7%0F%FA%04X%AD%25%14%A6V%A5%AE%94%0D%20%A9O%C5%D4%A4Y%3F%29SgvFX%99%A6%02%FC%1AJ%23%AC%D8%AF%A0V%1E%3B%09%03%E1_%C0%A1%00%0C%F8U%D7m%80%BF%B0%1E%23%3E%3B%19%DC.%BCB%DEz%FAU%80%C0%80%B8%7D%F7%09%18%0Dj1gu%04%40%B7%F0%3BZ%ACjL%8F%09p%F6H%E3%F1%E8v%955%05%F8l%83%A6%E5%DF%C0%83%0B%CFR%A0%B8%BA%E2%C5q%B4%5EN%BA%93%EC%E3%EA%0C%84%AC%C1%7C%F9%F0%EB%D8%B3k%07%B2%BB%F1%0B%DF%A7v%CB.%3E%5D%86%80%01%AD%C7%CAE%8E%9Cw%8D%B0%E8%D1%8B%055%1E%7D%EE%D5%A2%D1%83j%3BD%F3v%5D%FF%BB%DD%07%02x%AE%28V%DCk%25%ECf%1F%2B%00%ACT%DCZ%85u%F7%99%80%98%08P%1F%85%2248%00z%08nb%1A%01%DE%15v%9E%7B%A4%0C%00%22%5B%21%86%A0%9EH%F3%15%28%5B%87%1B%28%06%A1-%00%C8F%D8%092%3EE%96%8D%18F%B5%E1%8CK%F1H%95%8E%1D%10x%D0%88%3DvRcg%17%99%98%22%05%E7%99%A5%21%90%AD%2Cv%E3%02%26%15%00%23%042%EE%94%23%2C%8A%91%24%8EQ%01%A5%26%C1n%06%8D8%13%91%B6%98t%E5%01N2%B0%A1J%20R%B5%E1%96%60%CAf%968%06%89C%95g%0D%20%19%8C%85o%D6%F8%A6%9F%04%99%08P%97%BD%18%BA%93%85d%1E%80%E8%02%16%EE%A4%60%92%A8%E8%97L%9D%E1%94%A7f%A0O%EAb%E8E%93V%E4%19%A6m%96%AA%80%AAp%BEy%5Dw%0E%B0z%1E%AA%C1%CC%F9%DF%AD%B8%E6%AA%EB%AE%BC%F6%EA%EB%AF%C0%06%2B%EC%B0%C4%16k%EC%B1%C8%26%AB%EC%B2%3F%CC6%EB%EC%B3%D0F%2B%ED%B4%D4Vk%ED%B5%D8f%AB%ED%B6%DCv%EB%ED%B7%E0%86%2B%EE%B8%E4%96k%EE%B9%E8%A6%AB%EE%BA%EC%B6%EB%EE%BB%F0%C6%2B%EF%BC%F4%D6k%EF%BD%F8%E6%AB%EF%BEm%24%00%00%21%F9%04%05%0A%00%07%00%2CK%00K%00B%00A%00%00%03%FFx%BA%DC%FE%AD%C0I%ABu%F2%EA%CD%BB%FF%20%00%8E%24%A1%0D%86%D9%10%2A%09eO%5B%C9%87%60%18n%CE%DD%B4%DE%0C%11C%802t%10n%3E%17%8Cr%13%24%21G%E0%A2%D89.%15%01%82%B3%23%7D2lB%07%0FtUtGGZ%E0%86%F3%EA%CE%0Av%AEP%10%B9%A7%F2%BB%FBV%26%F5%7D%60%1F%7F5z%0A%5B%0E%00%01v%2F%85%1F%01%87%13%05%29%8D%17%01T%15%03t%94%13%89%96%97%1A%83%85%02%9F%9B.%8B%A5%A8%A9O%A1%AA%0F%9D%A3%0B%04t%9A%AD%13%8F%B0%14t%3D%AD%8F%A4%B5%BF%C0%C1%C2%C3%C4%1B%B2%B3%B3%BB%BC%02%CC%CD%B8%C8%B4%C3%B7%CE%B8%C5%D6%D7%D8%D9%DA.%02%2C%D6%CD%BE%C7%BA%D7%CD1%DB_%E7%E9z%90%EA%0A%CA%94%CC%1E%B2%EF%8D%CE%95%EE%F4%A5%CD%A71%04%BE%BC%86%26%B0k%F0%2F%5D%3E%12%B7%9E%1C%E4%A6P%DF%80%81%F2ZA4%F6%60%22%87%82%84%3E%BC%5Bx%81A_%8D%01%18%B9h%F9%01%02b%C8%1C%16%A7%C0I%D5c%00%01~g%02%AC%94%99%F2%CD%85%95%07V%D6%BC%93e%E0%CA%95%1E%9FX%FC4%F3%A1%03K%AAp%E6t%A0%B4%D6O%08%20%85%055sTG%02%00%21%F9%04%05%0A%00%07%00%2CL%00L%00%40%00A%00%00%03%FFx%BA%DC%FE%90%95H%ABm%F3%EA%CDW1A%27%8E%C3%93%8D%A8v%8A%84Q%A6%DD%AA%00%86%DC%BD0do%F2P%E7%95%02%80%81%5B%10%1AE%E0c%10r%14%8E%8D%26EJ%19%8Av%87%02vCU%2A%A0%DEErf%A8uU%E1%86%20%BA%D5%80%D3%0E%2B%90%D0%86%CF%ED%CE3J%8FG%1A%DE%1EO%7D%1D%02e%7F%10tu%83%0A%01%1Fek%11%02Z%05c%8B_%86%80%96%22%3E%87%9A%40%03%90%9E%A2%A3%23%02%01t%04%04%A1%A4S%03%8E%06%AB%07%04%95%A4%92%86%86%0B%00%02%03%99%AC%0A%B7%01%7C%0A%B1%BE%07r%C5%C8%C9%CA%CB%9A%A8%82%CC%8C%C1%D2%A7O%D5%BD%C8%01%A6%A6%D0%DC%DD%DE%DF%91%C2%CC%BA%BC%A9%CB%D9Mr%02%A9%A8%DD%C1%DAM%D7%D0%00%EF%E2%E0%F7%22%C7%F8%0C%F2%7D%BA%DB%1BR%11%D3%94%0D%20%85r%B4D%15%14%96%2A%21%29z%03%97%E9c%60%CF%81C%20%13S%F0%BA%08%24%5C%22%87%8D%04%3D%5E%00%19%A5%8F%C8%83%B3%96t%D4s%F2%C1%BA1%00R%E6%88%98%ADC%CD%0B%19%1D%088vs%D0%801L%18%B4%3C%20%60%28%0A%5Eg%92%24%01%00J%A7%CF%25%40%D5%400%BAIg%D4%0DT9%9C%D9ElL%D6%3EW%9D%22c%0A%C1%EB%80%9C%0A-N%05W%14O%02%00%21%F9%04%05%0A%00%07%00%2CK%00K%00B%00A%00%00%03%FFx%BA%DC%FE%8C%C0I%AB%85%C2%95%CB%7B%DF%1A%C8%88%5E%C9%15%40C.%C5j%96%C3%B7fO%FCvA%23%B8%AEB%AB7%CBN%02T%ADZ%9A%20%87%98%1C%29%9F%8D%40%CF%C5T%F0%A0%8ET%ADA%F8y%AA%8C%DC%0B%7C%D0B%7B%D2%20%D1%CC%F2%DEl%CE%F2%8DP%20c%27%3D%93%FD%CE2%E4%C7%7C%0F%7FJb%81%0DlKn%86o%18u%8BA%83%5Cp%8F%1FK%8E%94%1C%93Bu%85%98%7C%88%9EQ%A1%A3Y%A4%86%04%04%03%02%A0%A6%17%24%A8%A8%AD%15%04%06%B5%B6%9A%0B%A8%B8%B2%05%B6%05%03%9D%B2%1D%02%04%C1%C2%C7%C8%C9%CA%CB%0D%03%B0%CF%BB%C2%B6%D3%B5%CE%CF%BA%CC%07%BD%D4~%D9%DE%DF%E0%E1%E2%25%C4%8A5%D8%CA%D3%BF%C1%CE%D6%AA%AC%AD%C4%DCD%ED%C0%E2%01%03%DB%06%0B%F0%E1%01%C6%E3%02%96z%21%60%404O%FFL%B4K%F6%2F%40%BFf%AA%98%25%A4P%F0%20%B2%7F%FD%2C%22%7BXAf%E3%93%89w%22b%0A%20%00%E0%0B%8Fw%40%06%11i%08%14I%93%99%1E%E0%83IH%A5%07%96%0C%0Cr%B4%40r%C2%CE%81%0E%0A%06%7D%08%8F%26%1FsAu%04%23%F93%88P%1DA%DD%28%02Pr%24%CE%05R%15%292%FADg%14snz%06%E5z%C3dU%06%02%CC%19kz%F4A%DA%A4%DE%B4b%C8%06V-%94%04%00%21%F9%04%05%0A%00%07%00%2CL%00K%00A%00B%00%00%03%FFx%BA%DC%FE%8C%C0I%ABe%80%8CW%9E%BC%60%D8%7CW%27%9E%17%D9%98h%2B%0E%85PB%9BK%11%84%EC%D4%0C%BB%F8%3F%9BE%15%11%1A-%BA%05Q%01%042%8F%C3Gr%C2%0BB%A9%90%00%25%90%5B%5D%15%CB%037%8Cr%02%0A%CE%CB%80%0C-%B0ma%EDWqN%BF%DE%F3%2F%BE%FD%5D%E7%8FS%7F%15r%278%04%84%82%28U%0D~%89%21%7B%23%8E%20v%13%90y%02%06%94%92%9B%9C%9D%9Ew%8B%9F%29%8C%86%1A%03%00%A2%10%05%06%AC%99%0D%01%02%A1%A9%0Ex%A8%B3%3B%B7%B9%BA%BB%BC%B7k%BF%1A%BD%07%AB%AD%AD%05%BF%BF%C2%CA%CB%CC%CD%CE%22%B6%CF%0C%B0%03%D5%BC%9A%07%D5%D6%D25%D5%02%81%D2%E1%0D%D1%E2%21%88%9E%87%E5%0B%03%AC%D8%D3%DA%E7%9D%04%AD%B2%0D%E0%B3%01%C4%06%F7b%DE%C2%EC%AC%D8%C4%EB%24%60%20%3BK%0Bb%91%9B%83%C9%C0%40%14%FC%E6%B4%024%20%E2%97V%0F%2FX%FCC%CCEE%AC%7B%1B-%00%18%88%F1D%C6%90%20H%1A%40%B8%E0aA%14%F1%1E%A6%3B%02%00%1C%ACW%29o%85%0Cp%8E%A7%24%90%17%1E%06Xx%E5%5B%16%7B%10%88%A6%CA8N%19J%05L%09B%B0%A9%0E%834%9F%82%12%00%00%21%F9%04%05%0A%00%07%00%2CK%00L%00A%00%40%00%00%03%FFx%BA%DC%CE%C2%11%E2%E2%BB8kE_g%DF%26%8E%9E%14%1E%40q%92%EC%22X%CDz%C8Ck%3B%81d6%83%3C%DF%9B%00%A1%16%2B%81%0A%80X%01%28%EA%19%17%13%1DD%C5%14%AD%04%3EW%B6%0A%B9%10%60%0A%A2%26%B7%18%14%C4%0C%F4%08%ABFqG%EDf%1B%CB%15%14%C0%1C%EA%AD%17%7Fc%B6r~%1A%04%2AdL%7C%82%19%80%2C%7D~%01z%8C%89%89K%17%03%96%92%5C%05%94%18%96%03I%98%2C%9A%22%01%9Dx%A0%0Ff%9B%24%97%A7%1B%8D%ADL%A6%B0%B3%B4%B3%96%02%86%B5-%A2%07%01%02%9D%B7%BA%19d%05%06%AA%0E%AC%C2%17%C5%94%9F%17%01%CE%CA%0C%B9%D2%D5%D6%D7%D8%D9%18%BF%C0%C1%DA%0A%C5%06%C6%E2%BF%E5%03%E5%DF%0C%E1%C6%E9%ED%EE%EF%F06%D4%D7%AF.%E7%B2%D7%27%BE%E7%F7%E9B%EB%EC%0E%BCx1%EF%1B%80%1E%CC%E2%8DQ%C8%10%94%2F%01%D1j%09%10G%A0%E0%85%81%0D%17%00%C0%A8%8D%7B%80%B8c%0D%06F%BCfg%18%3E7%B3F%96%B1q2%91%CA%1B%B8f1%B3H%C2%17ML%20%5B%C8z%19%09SLP%1E%F5%25di%F1%E6%28r%0D%1EI%2Ah%D4%0C%98%A1%D30%CD%9B%9A%26%E0%02q%F5%AA%F8%8A%18%80ZW%08%E2x%84%85E5%295q%D4%8A-%BAQ%14GZ%03j%26%1Ah%A5%12%9AY%B1%20%9D%08%FBzw%DA%D8lL%E7%21%05%3C%92%EF%11%A3%1A%12%00%00%21%F9%04%05%0A%00%07%00%2CL%00K%00A%00B%00%00%03%FFx%BA%DC%FEk%0CH%AB%BDm%E2%CD%BB%D3%0C%01%89%5Ei%81%17i%AE%10%AA%A8%E1%23%B0%A7%7B%044NW%82%AD%B8%B0E%F05%DBQl%03%02%C02%3C4%8D%0C%C9E%CA%2C%E8v%CB%D6%23%7Bt%3CW%BEC%92k%02%14%9A_K%F1%11%EE%10%DA%AB%1E%F4q%15%CE%D7%F3%0A%19%9C%1F%A5%3Dx%7D9%03u%0C%7B%82%14%81%0C%01%12%8A%88%1B%7F%00%3D%03%8E%8F%5BB%85%96F%7F%0D%99%9A%0D%05%2C%9E%9F%A4%A5%10%87%A6%1E%3A%3D%95%A9%14d0%AC%AD%AE%0C%05%B6t%94%94%B4%5E%B7%07%B3%BB%C0%C1%C2%C3%C4%C5j%02%C8%C9%C6N%06%B6%CE%B6%AC%B9%BF%A9%04%CD%D6%05%06%9C%CB%DB%DC%DD%DE%07%A8%BB%A3%0B%01%C8%DB%BD%0E%C9%C8%E3%C0%D8%A1%9D%DF%F1%1C%E1%F2%F1p%16%EC%A4%F4%0E%F9%A4%EF%18%E5%04%F4%DB6%90V%98%82%B4%FEq%40%C8Ba%8EztL94Q%8E%A1%91%89%1B%02%8C%0A%B0oK%CA%25Q%10%2CV%28%D4%91b%03%01%06f%29zR%B2C%A6j0%9Ay%91%B1%CB%80%81%3A67%60%84%02%20S%80%9C%0C%80%0E%13%E8EfP%03%C5Pas%21%D4c%2A%9B%85%9AnC%89%B4%81%D4e%3Fm%5C%BD7%0C%9B%A5%04%00%21%F9%04%05%0A%00%07%00%2CK%00L%00B%00A%00%00%03%FFx%BA%DC%CE%C1%8D%F1%E8%BB8%EB%03l%9B%12%01ld%89y%0B%CA%A8f%0B%3D%C2%10%ADj%40%08%B0k%C6%E3%87%D3%0D%01a%C6%20%E8L%81%C1oU%F94%8F%3B%99%E4%83%02%10X%07%2C%F4%D1%93%10%1F%B6%A5b%60%DC%96%04b%8E%E0%7B%E9%1E%D2fE%00%7D%D1%B6%08%A2%10%7C%E7H%B2%8F%7Be%5Bt%0Dnq%2BWq%7B%87%17%82%8A%84%8C%15%89%91%0A%86%94%07%8E-%8B%97%3A7%18h%02%96%9C%246x%1B%90%A3%A4d%99%19%A0%7F%A9%0Ex%9E%9A%A1%B0%18%A6%B6%B9%BA%BB%BC%B9h%AF%BD%18s%03%05%8Es%A0k%C1%27%04%C5%C5%AC%00%C7%9B%C1%CC%93%CA%D6%D7%D8%D9%DA%DB%B0%D1%C8%C0%D6%05%E2%E3%C5s%E6k%C9%DC%07%E2%CC%E3%EA%EF%F0%F1%F2%F3%B0%D0%E6%E0%BC%CC%0Bp%E7%01%F8%CA%ED%0A4%F0%E7O%D4%B69%0A%8A%D1%5B%A8%CB%E0Bh%D8%C4%B9%B0%F7%2F%97%C4%12%FE%D4%5D%CC%901q%DEF%07%D0%0C%DAYh%C0%80%B48%02%23%05%28i%80%97C%13%2Cy%89%7B%A9ae%C9%29%A9%C4U%BC%10%B3%01%01%03%AC%5C%A4t0%B3%D3%CD%81%25O%C6%19yA%C8%83%92%99%86%B6%90%CA%24%92%80%92%FF%A8%5E%D0%3A%AA%24S0%06%B8%E6%1Ap%94R%81%AFP%92~%00%BA%21hBX%D5%A0%B8%7D%F8n%E7%82%02%06%EC%DA%12%CB0%03%DF8%09%00%00%21%F9%04%05%0A%00%07%00%2CL%00K%00A%00B%00%00%03%FFx%BA%DC%FEK%08H%AB%BDm%E2%13%B6%FF%91%C6%88%E3%00%9E%179%3A%26%EArN%A0%1E%F3%D1%BEg%5D%3F73%F48%87NU%03%2A%06%9D%20e%A6k%0CT%01%A32%03%25%AA%A4RW%B2%21%DB.%00%15%80%C0kk%A2%C8%0A%89%F2%07%C9Zd%90%DD%07%CB%3E%8F%A7%F8%0B%3CO%F9%B9%3D%5D%7C%3Cy%7B%82%0Bu%1Eb%60%868n%81%8C%27%03%04%04r2w%90%17%8B6%99%8F%98q%93%7F%0Fh%9E%0A%01%93ra%A4%A2%9A%AA%AD%AEJ%60%01%B2%01%AC%AF%A9%07%04_%A5c%A3%B6%87%93%A0%2Ab%B3%BEN%93%C5%2F%A8%C8%CB%CC%CD%CE%98%B3%D1%CF%0A%C0%D5%04%D1%C4%CF%92%0B%93%05%A1%D3%E0%E1%E2%E3%02%94%CE%A8Q%05%06%EB%06%CE%04%05%04%40%04%EC%EC%D7%CE-%EF%A7%07%EC%DE%BD%CBb%DBJ%F9%1BG%F0%85%A9%82%0F%E6%19%F8f%28%9E%07%85%06r%F9%1AP%A0%A22%01%EA%0C%14%18%E8%09j%00Ex%14%20%2Aku0%E4%C28%C8%CA%8D%0B%00r%8A%BA%02%9E%DE%E5%81I%2A%1F%8E%97%1CQ%CCxW%A0%D6%07%9A%2C%D6p%B1%89b%23%84%9C%16%2A%26%04%0A%08%02S%10h%242%40%0A%C2g%A8%A7%0A%B0%F2%D1%8A%F5%29%C6%07Z%B7%82%BD%A0%AE%96%D4f%5C%C72%92r%96A%D7ga%9D%C2U%DB%20.B%84m%F3%24%00%00%21%F9%04%05%0A%00%07%00%2CK%00L%00B%00%40%00%00%03%FFx%BA%DC%FEL%887%A1%BD8%BB%AA%BB%D7%DC%22%0C%D4g%9E%5B%FA%04%A8%C6B%AF%18%2As%FB%01B%7C%0Ds%7D%F8%B6%15%A4%E7%01%06%8F%0C%1Dr%99%014%8C%CE%93r1e2%AB%87h%2B0%C0%1A%5D%D6%CC%E8%1A.%C3%CC%25%B4%19%C0%93b%D5H-%FC4%20a%02%EFy%A3%FE%C9%EB%F9%28~jvz%85%86p%01_%87%1F%06%8D%05%5D%8B%1F%03%04v%03%8D%97%06%05%8A%85%15%84%0D%5C%05%97%05%91%16u~%02%04%9B%85r%A4%AD%AE%AF%B0%B1%0E%98%B4%B2%07%93%04%B9%BA%03%A1%B4%99%B6%0A%BA%BA%C0%C4%C5%C6%C7%C8%19%82%0E%A3%B2%04%0Br%9E%22%C0%C3%C9%18%CF%D6%D9h%D2%86%AA%C6%04%CD%1E%DC%A4%D5%DAT%C1%04%82%E1%B6%E0%DE%E6%17%01%EB%EF%8B%D8A%F1%F3%0E%ACs%F5%26%F7%91%FA%28%00%CA%2B%B6l%19%BF%5B%10%00%1E%198%D0%C32C%EB%AA%08%28p%F0U%C3%86sBM%19%F8K%15%19%B1%81%40%DC%85%D1%27%CF_%B2P%C9%14%16hH%40%A1%87%04%00%21%F9%04%05%0A%00%07%00%2CK%00K%00A%00B%00%00%03%FFx%BA%DC%FE%2C%04H%AB%BDm%E2%CD%7B%D6%D1%13%08%5Ey%81%0D%99%9A%EC%01%40%C1%1B%8A%0E%DA%C2%8E%7C%3E%80%A0%DE%B8%9A%CD%A6%F81%8C%40%91NA%7C%20%8BI%8B%A4%D1%5BN%8F%0E%DF%B2%25%204%89%CD%8C8%D8%21%18%0A%DF%A4%CF9%08W%0C%F0%DC%95%EB%BC%C1%0D%EE%D6%B6%F8%EC%DC%A3%16%02%03%7D%1E%7F%80N%84%26%05%06%89%87e%06%04%22%8DI%7BLm%0Ffp%03%8E%5C%03%97Nwh%9C%1D%82%83%95%0C%03%A1%A3%27%9E%02y%11%99%93%A3%9E%AFl%AB%B7%B8%B9%BA%BB%BC%19%A5%0B%8Bw%90%BD%142%9E%C7%B5%C4%0E%C7%93%C9%BA%00%CE%CA%D2%D3%D4%D5%D4%C1%C2g%D6%A8%C7%C7%DB%17%03%04%E1%E3%DF%E5%E6%E7%E8%40%9B%E9%10%91%E6%E3%B4%0C%04%D8g%5E%DF%82%E2%04%E2%0A%C1%E2%A7%DB%F86%FDK7%90%9DA%40%B2%1C%05%D0%97%10%98%A6i%0D%1B%B8%A3%06%20%DC%3E%08%EB%D0Y%C4%C8%88iZ%9E%88.%0A%14%C85%11H%C1C%17%81%8C%E4U%B2%C4%3F%90%1C%C2%DDX%E9%80%26%8B.%EDX%D8d%B0%93%C5%BC%3D2MT%EA%D9%B2%06%A6b%80zf%5C%A0o%99%C4%A2%9Cz%1E%90%CA%00%40%01%A8%B9%A4j%95%D8%0E%26%87%9E%7D%94%16%E8%83%F5%D6%D8%0DK%17x%9Di%A3%A7%D5%B2%BD%A8%12%FD%B6%B0%E1Z%96%B7%12%00%00%21%F9%04%05%0A%00%07%00%2CL%00L%00A%00A%00%00%03%FFx%BA%DC~%C1%0C%17%82%03%F6%E9%CD%BB0%C6%931%C2%D8%9D%A8%06%9A%10%DB%A60G%10N%21Q%0D%16%EF%0F81%03C%A1Qy%00D%3CT0%C4%880%9BDW1%89%F25%40%02%28Q%E3%A2%3E%3E%06%93%8D%C6%91za%E3%A6%21%CB%EB%9E%8F%A4%D5%19%B2a%EF%86%0F%82%81%FC%A6%94%92%016%06p%0B%3Fs%87%0F6%05n%88%0A%01%7F%88x%8D%93%941%90%3B%86%0C%84%95%28v%0DKk%9C%3C%00%02%A5%1C%92%A2%96%9E%28%7C%A9%1A%A60%9B%AE%AF%AB%29%8C%B3%B8%B9%BA%A2p%82%AD%BB0%02%03%B5%07%A8%C0_%C2%C9%9A%03%BF%C7%0D%A5%C3%B7%0A%99%CE%D5%D6%D7%D8%D9%DA%DB%9D%03%DE%DF%C3%8AB%20%CD%D5%C9%C3%E8%C4%DC%EB%EC%ED%EE%EF%07%B2%89B%DA%C2%DE%AB%3F%8A%DCp%E0%03%19%05%C6%D8e%F8%21%0D%9E%C1%83%9A%92%00%AC%E6%8D%C7%C2k%DE%0A%16%0B%E8L%00%01j5%28bk%A8%A1n%00%C6l%01%3E%96%29WI%A4B%92%8D8%BE%01%88r%123%93%29%0A%10%90%B8%C3%0D%CC%0D%00X%3A%B8%19l%E7E%1E%03d%BA%91%C7c%E6%2B%A0y%3C%E2%E0%40%CD%E2GuT%CAA%3D%60%B1%1A%81%02%AB%9A%CDh%D2%2C%C0OW%BFrju%D0%8C%A7%28%8Cc%C9%BA%AA%F5qk%83%96%BB%AE%CAK%AB%8D%EE%DBlD%15%943%CB%D0U%02%00%3B"
                                                        alt="#"></div>
                                            <div id="font-warning"><span class="dashicons dashicons-warning"></span>
                                            </div>
                                            <span id="success"></span>
                                        </div>
                                        <div class="woo-invoice-col-2">
                                            <a style="color:#fff" id="wpifw_pdf_invoice_download_font"
                                               class="woo-invoice-button woo-invoice-button-primary"
                                               href="javascript:"><?php echo esc_html__( 'Upload', 'webappick-pdf-invoice-for-woocommerce' ); ?></a>
                                            <a style="color:#fff" id="wpifw_pdf_invoice_font_downloading"
                                               class="woo-invoice-button woo-invoice-button-primary"
                                               href="javascript:"><?php echo esc_html__( 'Uploading', 'webappick-pdf-invoice-for-woocommerce' ); ?></a>
                                        </div>
                                    </div>
                                </form>

                                <div class="woo-invoice-card-footer" style="margin-top:25px">
                                    <span style="color:red" id="errors"></span>
                                </div>
                            </div><!-- end .woo-invoice-card-body -->
                        </div><!-- end .woo-invoice-card -->
                    </div><!-- end .woo-invoice-col-8 -->
                </div><!-- end .woo-invoice-row -->
            </li>
            <!--END FONTS DOWNLOAD TAB-->

            <!-- SYSTEM STATUS TAB-->
            <li>
                <div class="woo-invoice-row">
                    <div class="woo-invoice-col-sm-8">
                        <div class="woo-invoice-card woo-invoice-mr-0">
                            <div class="woo-invoice-card-body">
                                <table class="system-status-table">
                                    <tbody>
									<?php
									// Read plugin header data.
									$chalan_plugin_data = get_plugin_data( WOO_INVOICE_FREE_FILE );

									// WordPress check upload file size.
									function calan_wp_minimum_upload_file_size() {
										$wp_size = wp_max_upload_size();
										if ( ! $wp_size ) {
											$wp_size = 'unknown';
										} else {
											$wp_size = round( ( $wp_size / 1024 / 1024 ) );
											$wp_size = $wp_size == 1024 ? '1GB' : $wp_size . 'MB'; //phpcs:ignore
										}

										return $wp_size;
									}

									// Minimum upload size set by hosting provider.
									function calan_wp_upload_size_by_from_hosting() {
										$ini_size = ini_get( 'upload_max_filesize' );
										if ( ! $ini_size ) {
											$ini_size = 'unknown';
										} elseif ( is_numeric( $ini_size ) ) {
											$ini_size .= ' bytes';
										} else {
											$ini_size .= 'B';
										}

										return $ini_size;
									}

									function convertToBytes( string $from ): ?int {
										$units  = [ 'B', 'KB', 'MB', 'GB', 'TB', 'PB' ];
										$number = substr( $from, 0, - 2 );
										$suffix = strtoupper( substr( $from, - 2 ) );

										//B or no suffix
										if ( is_numeric( substr( $suffix, 0, 1 ) ) ) {
											return preg_replace( '/[^\d]/', '', $from );
										}

										$exponent = array_flip( $units )[ $suffix ] ?? null;
										if ( $exponent === null ) { //phpcs:ignore
											return null;
										}

										return $number * ( 1024 ** $exponent );
									}

									// Check upload folder is writable.
									function calan_upload_filter_is_writable() {
										$upload_dir                   = wp_upload_dir();
										$base_dir                     = $upload_dir['basedir'];
										$wpifw_invoice_dir            = $base_dir . "/WOO-INVOICE";
										$upload_dir_permission_status = '';
										$upload_dir_permission_status = ! file_exists( $wpifw_invoice_dir ) && ! is_writable( $wpifw_invoice_dir ) && ! is_writable( $base_dir ) ? 0 : '1';

										return $upload_dir_permission_status;
									}

									// Check zipArchive extension enable from hosting.
									function chalan_check_zip_extension() {
										$extension = '';
										$extension = in_array( 'zip', get_loaded_extensions() );

										return $extension;
									}

									// Check MBstring extension enable from hosting.
									function chalan_check_mbstring_extension() {
										$extension = '';
										$extension = in_array( 'mbstring', get_loaded_extensions() );

										return $extension;
									}

									// Check dom extension

									function chalan_check_dom_extension() {
										$extension = '';
										$extension = in_array( 'dom', get_loaded_extensions() );

										return $extension;
									}

									// Minimum PHP version.
									$chalan_current_php_version = phpversion();
									$chalan_minimum_php_version = $chalan_plugin_data['RequiresPHP'] ? $chalan_plugin_data['RequiresPHP'] : '5.6';
									$chalan_php_version_status         = $chalan_current_php_version < $chalan_minimum_php_version ? 0 : 1;

									// Minimum WordPress Version.
									$chalan_wp_current_version = get_bloginfo( 'version' );
									$chalan_minimum_wp_version = $chalan_plugin_data['RequiresWP'] ? $chalan_plugin_data['RequiresWP'] : '4.4';
									$chalan_wp_version_status         = $chalan_wp_current_version < $chalan_minimum_wp_version ? 0 : 1;

									// Minimum Woocommerce Version.
									if ( class_exists('woocommerce') ) {
										$chalan_wc_current_version = WC_VERSION;
									}else {
										$chalan_wc_current_version = 'Not Active Woocommerce';
									}

									$chalan_minimum_wc_version = isset( $chalan_plugin_data['WC requires at least'] ) ? $chalan_plugin_data['WC requires at least'] : '3.2';
									$chalan_wc_status = $chalan_wc_current_version < $chalan_minimum_wc_version ? 0 : 1;

									// WordPress minimum upload size .
									$calan_wp_minimum_upload_file_size = '40MB';

									// Minimum WordPress upload size..
									$chalan_wp_upload_size_status = convertToBytes( calan_wp_minimum_upload_file_size() ) < convertToBytes( $calan_wp_minimum_upload_file_size ) ? 0 : 1;

									// Minimum upload file size from hosting provider.
									$chalan_wp_upload_size_status_from_hosting = convertToBytes( calan_wp_upload_size_by_from_hosting() ) < convertToBytes( $calan_wp_minimum_upload_file_size ) ? 0 : 1;

									// PHP Limit Time
									$chalan_php_minimum_limit_time = '120';
									$chalan_php_current_limit_time = ini_get('max_execution_time');
									$chalan_php_limit_time_status = $chalan_php_minimum_limit_time <= $chalan_php_current_limit_time ? 1 : 0;

									// Check WordPress debug status.
									$chalan_wp_debug_status = WP_DEBUG == true ? 1 : 0;

									// Check upload folder is writable.
									$chalan_uplaod_folder_writable_status = calan_upload_filter_is_writable() == 0 ? 0 : 1;

									// Check if zipArchie extension is enable in hosting.
									$chalan_check_zip_extension_status = chalan_check_zip_extension() != '1' ? 0 : '1';

									// Check MBstring extension from hsoting.
									$chalan_check_mbstring_extension_status = chalan_check_mbstring_extension() != '1' ? 0 : '1';

									// Check dom extension.
									$chalan_check_dom_extension_status = chalan_check_dom_extension() != '1' ? 0 : '1';

									$system_status = array(

										array(
											'title'   => esc_html__( 'PHP Version', 'webappick-pdf-invoice-for-woocommerce' ),
											'version' => esc_html__('Current Version:  ', 'webappick-pdf-invoice-for-woocommerce') . $chalan_current_php_version,
											'status'  => $chalan_php_version_status,
											'success_message' => esc_html__( '- ok', 'webappick-pdf-invoice-for-woocommerce' ),
											'error_message' => esc_html__( 'Required Version: ', 'webappick-pdf-invoice-for-woocommerce' ) . $chalan_minimum_php_version,//phpcs:ignore
										),

										array(
											'title'   => esc_html__( 'WordPress Version', 'webappick-pdf-invoice-for-woocommerce' ),
											'version' => $chalan_wp_current_version,
											'status'  => $chalan_wp_version_status,
											'success_message' => esc_html__( '- ok', 'webappick-pdf-invoice-for-woocommerce' ),
											'error_message' => esc_html__( 'Required: ', 'webappick-pdf-invoice-for-woocommerce') . $chalan_minimum_wp_version , //phpcs:ignore
										),

										array(
											'title'   => esc_html__( 'Woocommerce Version', 'webappick-pdf-invoice-for-woocommerce' ),
											'version' => $chalan_wc_current_version,
											'status'  => $chalan_wc_status,
											'success_message' => esc_html__( '- ok', 'webappick-pdf-invoice-for-woocommerce' ),
											'error_message' => esc_html__( 'Required: ', 'webappick-pdf-invoice-for-woocommerce') . $chalan_minimum_wc_version, //phpcs:ignore
										),

										array(
											'title'   => esc_html__( 'WordPress Upload Limit', 'webappick-pdf-invoice-for-woocommerce' ),
											'version' => calan_wp_minimum_upload_file_size(),
											'status'  => $chalan_wp_upload_size_status,
											'success_message' => esc_html__( '- ok', 'webappick-pdf-invoice-for-woocommerce' ),
											'error_message' => esc_html__( 'Required:', 'webappick-pdf-invoice-for-woocommerce' ) . $calan_wp_minimum_upload_file_size,	//phpcs:ignore
										),

										array(
											'title'   => esc_html__( 'WordPress Upload Limit Set By Hosting Provider', 'webappick-pdf-invoice-for-woocommerce' ),
											'version' => calan_wp_upload_size_by_from_hosting(),
											'status'  => $chalan_wp_upload_size_status_from_hosting,
											'success_message' => esc_html__( '- ok', 'webappick-pdf-invoice-for-woocommerce' ),
											'error_message' => esc_html__( 'Required:', 'webappick-pdf-invoice-for-woocommerce' ) . $calan_wp_minimum_upload_file_size, //phpcs:ignore
										),

										array(
											'title'   => esc_html__( 'PHP Limit Time', 'webappick-pdf-invoice-for-woocommerce' ),
											'version' => esc_html__('Current Limit Time: ', 'webappick-pdf-invoice-for-woocommerce') . $chalan_php_current_limit_time,
											'status'  => $chalan_php_limit_time_status,
											'success_message' => esc_html__( '- Ok', 'webappick-pdf-invoice-for-woocommerce' ),
											'error_message' => esc_html__( 'Required:', 'webappick-pdf-invoice-for-woocommerce' ) . $chalan_php_minimum_limit_time,	//phpcs:ignore
										),


										array(
											'title'   => esc_html__( 'WordPress Upload Directory Writable Permission', 'webappick-pdf-invoice-for-woocommerce' ),
											'version' => '',
											'status'  => $chalan_uplaod_folder_writable_status,
											'success_message' => esc_html__( 'Writable - Ok', 'webappick-pdf-invoice-for-woocommerce' ),
											'error_message' => esc_html__( 'Upload folder not writable permission', 'webappick-pdf-invoice-for-woocommerce' ),
										),

										array(
											'title'   => esc_html__( 'WordPress Debug Mode', 'webappick-pdf-invoice-for-woocommerce' ),
											'version' => '',
											'status'  => $chalan_wp_debug_status,
											'success_message' => esc_html__( 'WordPress Debug Mode is On', 'webappick-pdf-invoice-for-woocommerce' ),
											'error_message' => __( '<b>WP_DEBUG_LOG</b> is false. Plugin can not write error logs if WP_DEBUG_LOG is set to false. You can learn more about debugging in WordPress from <a target="_blank" href="https://wordpress.org/support/article/debugging-in-wordpress/">here</a>', 'webappick-pdf-invoice-for-woocommerce' ),
										),

										array(
											'title'   => esc_html__( 'zipArchive Extension', 'webappick-pdf-invoice-for-woocommerce' ),
											'version' => '',
											'status'  => $chalan_check_zip_extension_status,
											'success_message' => esc_html__( 'Enable', 'webappick-pdf-invoice-for-woocommerce' ),
											'error_message' => esc_html__( 'Please enable zip extension from hosting.', 'webappick-pdf-invoice-for-woocommerce' ),
										),

										array(
											'title'   => esc_html__( 'MBString extension', 'webappick-pdf-invoice-for-woocommerce' ),
											'version' => '',
											'status'  => $chalan_check_mbstring_extension_status,
											'success_message' => esc_html__( 'Enable', 'webappick-pdf-invoice-for-woocommerce' ),
											'error_message' => esc_html__( 'Please enable MBString extension from hosting.', 'webappick-pdf-invoice-for-woocommerce' ),
										),

										array(
											'title'   => esc_html__( 'Dom extension', 'webappick-pdf-invoice-for-woocommerce' ),
											'version' => '',
											'status'  => $chalan_check_dom_extension_status,
											'success_message' => esc_html__( 'Enable', 'webappick-pdf-invoice-for-woocommerce' ),
											'error_message' => esc_html__( 'Dom extension is not enable from hosting.', 'webappick-pdf-invoice-for-woocommerce' ),
										),
									);
									?>
                                    <tr>
                                        <th><?php esc_html_e('Title','webappick-pdf-invoice-for-woocommerce');?></th>
                                        <th><?php esc_html_e('Status', 'webappick-pdf-invoice-for-woocommerce');?></th>
                                        <th><?php esc_html_e('Message', 'webappick-pdf-invoice-for-woocommerce');?></th>
                                    </tr>
                                    <!-- PHP Version -->
									<?php
									foreach ( $system_status as $value ) { ?>
                                        <tr>
                                            <td><?php printf( '%s', esc_html( $value['title'] ) ); ?></td>

                                            <td>
												<?php if ( 1 == $value['status'] ) { ?>
                                                    <span class="dashicons dashicons-yes"></span>
												<?php } else { ?>
                                                    <span class="dashicons dashicons-warning"></span>

												<?php }; ?>
                                            </td>
                                            <td>
												<?php if ( 1 == $value['status'] ) { ?>
                                                    <p class="wpifw_status_message">  <?php printf( '%s', esc_html( $value['version'] ) ); ?> <?php echo $value['success_message']; //phpcs:ignore ?></p>
												<?php } else { ?>
													<?php printf( '%s', esc_html( $value['version'] ) ); ?>
                                                    <p class="wpifw_status_message"><?php echo $value['error_message']; //phpcs:ignore ?></p>

												<?php }; ?>

                                            </td>
                                        </tr>
									<?php } ?>

                                    </tbody>
                                </table>

                            </div><!-- end .woo-invoice-card-body -->
                        </div><!-- end .woo-invoice-card -->
                    </div><!-- end .woo-invoice-col-sm-8 -->
                    <div class="woo-invoice-col-sm-4">
                        <div class="woo-invoice-card">

                        </div>
                    </div><!-- end .woo-invoice-col-sm-4 -->
                </div>
            </li>
            <!--END SYSTEM STATUS TAB-->


            <!--START FREE VS PREMIUM TAB-->
            <li>
                <div class="woo-invoice-row">
                    <div class="woo-invoice-col-8">
                        <div class="woo-invoice-card woo-invoice-mr-0">
                            <div class="woo-invoice-card-body">
                                <table width="100%">
                                    <tr>
                                        <th style="padding: 20px;font-size:18px" width="50%">Features</th>
                                        <th width="25%" style="text-align: center;font-size:18px">Free</th>
                                        <th width="25%" style="text-align: center;font-size:18px">Premium</th>
                                    </tr>
									<?php
									$woo_invoice_comparetable = array(
										array(
											'title' => __( 'Automatic Invoicing', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => true,
										),
										array(
											'title' => __( 'Attach to Order Email', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => true,
										),
										array(
											'title' => __( 'Invoice Download From My Account', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => true,
										),
										array(
											'title' => __( 'Custom Date Format', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => true,
										),
										array(
											'title' => __( 'Display ID/SKU', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => true,
										),
										array(
											'title' => __( 'Display Currency Code', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => true,
										),
										array(
											'title' => __( 'Display Payment Method', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => true,
										),
										array(
											'title' => __( 'Packing Slip', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => true,
										),
										array(
											'title' => __( 'Footer Info Section', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => true,
										),
										array(
											'title' => __( 'Bulk Invoice/Packing Slip Download', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => true,
										),
										array(
											'title' => __( 'Invoice Template Translation', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => true,
										),
										array(
											'title' => __( 'Display Shipping Cost With Tax / Without Tax', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => true,
										),
										array(
											'title' => __( 'Total Tax', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => true,
										),

										array(
											'title' => __( 'Individual Product Tax & Tax %', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
										array(
											'title' => __( 'Total Without Tax', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
										array(
											'title' => __( 'Paid Stamp', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
										array(
											'title' => __( 'Authorized Signature', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
										array(
											'title' => __( 'Custom Background', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
										array(
											'title' => __( 'Product per Page', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
										array(
											'title' => __( 'Custom Invoice Numbering Options', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
										array(
											'title' => __( 'Display Product Image', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
										array(
											'title' => __( 'Display Product Category', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
										array(
											'title' => __( 'Display Product Short Description', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
										array(
											'title' => __( 'Display Discounted Price', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
										array(
											'title' => __( 'Proforma Invoice', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
										array(
											'title' => __( 'WPML Compatibility', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
										array(
											'title' => __( 'WooCommerce Subscription Compatibility', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
										array(
											'title' => __( 'Order Shipping Label Print', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
										array(
											'title' => __( 'Download Bulk Shipping Label Print', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
										array(
											'title' => __( 'Custom Paper Size', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
										array(
											'title' => __( 'Pagination Style', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),

										array(
											'title' => __( 'Write Custom CSS', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
										array(
											'title' => __( 'Invoice Backup To Dropbox', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
										array(
											'title' => __( 'Bar Code', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
										array(
											'title' => __( 'QR Code', 'webappick-pdf-invoice-for-woocommerce' ),
											'free'  => false,
										),
									);
									foreach ( $woo_invoice_comparetable as $invoice_feature ) {
										?>
                                        <tr>
                                            <td class="woo-invoice-proFree-feature"><?php printf( esc_html__( '%1$s', 'webappick-pdf-invoice-for-woocommerce' ), $invoice_feature['title'] ); //phpcs:ignore ?></td>
											<?php if ( false === $invoice_feature['free'] ) { ?>
                                                <td class="woo-invoice-proFree-free"><span
                                                            class="dashicons dashicons-no"></span></td>
											<?php } else { ?>
                                                <td class="woo-invoice-proFree-pro"><span
                                                            class="dashicons dashicons-yes"></span></td>
											<?php } ?>
                                            <td class="woo-invoice-proFree-pro"><span
                                                        class="dashicons dashicons-yes"></span></td>
                                        </tr>
									<?php } ?>
                                    </tfoot>
                                </table>
                            </div><!-- end .woo-invoice-card -->
                        </div><!-- end .woo-invoice-card -->
                    </div><!-- end .woo-invoice-col-8 -->
                </div><!-- end .woo-invoice-row -->
            </li>
            <!--END FREE VS PREMIUM TAB-->
        </div>
    </div><!-- end .woo-invoice-dashboard-content -->
</div><!-- end .woo-invoice-dashboard-body -->