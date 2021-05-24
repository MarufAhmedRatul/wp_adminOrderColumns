<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link  https://webappick.com
 * @since 1.0.0
 *
 * @package    Woo_Invoice
 * @subpackage Woo_Invoice/includes
 */

/**
 * The core plugin class that generate PDF Invoice.
 *
 * This is used to generate PDF Invoice
 *
 * @since      1.0.0
 * @package    Woo_Invoice
 * @subpackage Woo_Invoice/includes
 * @author     Md Ohidul Islam <wahid@webappick.com>
 */
class Woo_Invoice_Hooks
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since  1.0.0
     * @access public
     */
    public function __construct() {
        if ( ! empty(get_option('wpifw_invoicing')) ) {

            // ############################################################################################
            // ####################### EMAIL HOOKS START HERE #############################################
            // ############################################################################################
            // Filter to add Invoice attachment with order email.
            if ( ! empty(get_option('wpifw_order_email')) ) {
                add_filter('woocommerce_email_attachments', array( $this, 'attach_invoice_to_order_email' ), 90, 4);
                // Filter to add Invoice download link with order email.
                // add_filter( 'woocommerce_email_after_order_table', array( $this, 'add_invoice_download_link' ), 91, 4 );// !
            }
            // ####################### EMAIL HOOKS END HERE #############################################

            // ############################################################################################
            // ### START ### Add Custom MetaBox for PDF Download Button at Admin Order Detail Page ########
            // ############################################################################################
            // Add Custom MetaBox for PDF Download Button.
            add_action('add_meta_boxes', array( $this, 'add_custom_meta_box' ));
            // ##################################### END ##################################################

            // ####################################################################################
            // ##### START ##### WooCommerce Admin Order List Bulk Action Drop-down Hooks. ########
            // ####################################################################################
            // Register bulk Invoice Making action.
            add_filter('bulk_actions-edit-shop_order', array( $this, 'register_bulk_invoice_actions' ), 11);
            // Register bulk Invoice Packing Slip Making action.
            add_filter('bulk_actions-edit-shop_order', array( $this, 'register_bulk_packing_slip_actions' ), 11);
            // Handle bulk Invoice Making action.
            add_filter('handle_bulk_actions-edit-post', array( $this, 'woo_invoice_bulk_action_handler' ), 10, 3);
            // ###################################### END ##########################################

            // ####################################################################################
            // ####### Start ###### WooCommerce Admin Order List Action Buttons Hooks. ############
            // ####################################################################################
            // Add a invoice button on admin orders page.
            add_action('woocommerce_admin_order_actions_end', array( $this, 'add_invoice_order_action_button' ));
            // Add a invoice packing slip button on admin orders page.
          //  add_action('woocommerce_admin_order_actions_end', array( $this, 'add_packing_slip_order_action_button' ));
            // ###################################### END ##########################################

            // ####################################################################################
            // ######################### MY ACCOUNT HOOKS START HERE ##############################
            // ####################################################################################

            // Add Download Invoice button to My Account Order List Page.
            if ( ! empty( get_option( 'wpifw_download' ) ) ) {
                add_filter('woocommerce_my_account_my_orders_actions',array( $this, 'add_my_account_order_action_download_invoice' ),10,2);

                // Redirect to new tab
                if ( 'new_tab' == get_option( 'wpifw_pdf_invoice_button_behaviour' ) || empty( 'new_tab' == get_option( 'wpifw_pdf_invoice_button_behaviour' ) ) ) {
                    add_action( 'woocommerce_after_account_orders', array( $this, 'action_after_account_orders_js' ) );
                }
            }
            // Add Download Button in Order View Page.
            if ( ! empty( get_option( 'wpifw_download' ) ) ) {
                add_action('woocommerce_order_details_after_order_table',array( $this, 'add_my_account_order_view_action_download_invoice' ));
            }

            // ################ MY ACCOUNT HOOKS END HERE ###########################################

            // ####################################################################################
            // ################## PDF GENERATING HOOKS START HERE #################################
            // ####################################################################################
            // Generate Invoice.
            add_action('wp_ajax_wpifw_generate_invoice', array( $this, 'generate_invoice' ));
            // Generate Packing Slip.
            add_action('wp_ajax_wpifw_generate_invoice_packing_slip', array( $this, 'generate_packing_slip' ));
            // Generate Shipping label.
	        add_action( 'wp_ajax_wpifw_generate_shipping_label', array( $this, 'woo_invoice_pro_generate_shipping_label' ) );
            // ################## PDF GENERATING HOOKS END HERE ###################################

            // ####################################################################################
            // ################## PLUGIN SETTINGS HOOKS START HERE ################################
            // ####################################################################################
            // Add invoice number to order.
            // add_action( 'woocommerce_new_order', array( $this, 'add_invoice_number_to_order' ) ); !
            add_action('woocommerce_checkout_create_order', array( $this, 'add_invoice_number_to_order' ));
            // Add LOGO Selection script to admin footer.
            add_action('admin_footer', array( $this, 'logo_selector_print_scripts' ));
            // Template selection hook to save template id/number.
            add_action('wp_ajax_wpifw_save_pdf_template', array( $this, 'save_pdf_template' ));
            // ################## PLUGIN SETTINGS HOOKS END HERE ###################################

            // ################## WCFM Marketplace Hooks ######################
            // if ( class_exists( 'WCFM' ) ) {
            // add_filter( 'wcfm_orders_module_actions', array( $this, 'wcfm_orders_module_actions_callback' ), 10, 3 );
            // }

            // Download Custom Fonts.
            add_action('wp_ajax_woo_invoice_font_download_ajax', array( $this, 'woo_invoice_font_download_ajax' ));
        }
    }


    /**
     * Callback for download custom fonts.
     *
     * @return void
     */

	public function woo_invoice_font_download_ajax() {
	    // Check valid request form user.
		check_ajax_referer('wpifw_pdf_nonce');

		$get_font_content = file_get_contents($_FILES["file"]["tmp_name"]); //phpcs:ignore
		$file_name = sanitize_text_field(wp_unslash($_FILES["file"]["name"])); //phpcs:ignore
		if ( ! empty( $get_font_content ) ) {
            // Make lowercase uploaded file name.
		    $get_name_lowercase = strtolower($file_name);
		    // Get last extension of file name.
			$get_last_extension = strrchr( $get_name_lowercase, '.' );
			// Check last name if zip.
		    if ( '.zip' !== $get_last_extension ) {
		        // Validate only mpdf predefine fonts.
			    $default_fonts = ( new Mpdf\Config\FontVariables() )->getDefaults()['fontdata'];
			    $regular_font = array_column($default_fonts, 'R');
			    $italic_font = array_column($default_fonts, 'I');
			    $bold_italic_font = array_column($default_fonts, 'BI');
			    $bold_font = array_column($default_fonts, 'B');
			    $array_collection = array_merge($regular_font, $bold_font, $bold_italic_font, $italic_font);
			    if ( in_array($file_name, $array_collection) ) {
				    file_put_contents( WOO_INVOICE_FONT_DIR . $file_name, $get_font_content );
				    // Success response message.
				    $response = array(
					    'font_name'      => $file_name,
					    'last_extension' => $get_last_extension,
				    );
				    wp_send_json_success( $response );
				    wp_die();

			    }else {
			        // Error response message.
				    wp_send_json_error( 'Upload only mpdf fonts');
				    wp_die();
                }
            }else {
		       //  Upload zip file.
			    file_put_contents( WOO_INVOICE_FONT_DIR . $file_name, $get_font_content );
			    // Extract Zip file.
			    if ( class_exists('ZipArchive') ) {
				    $zip = new ZipArchive();
				    if ( $zip->open( WOO_INVOICE_FONT_DIR . $file_name ) === true ) {
					    $zip->extractTo( WOO_INVOICE_FONT_DIR );
					    $zip->close();
					    unlink( WOO_INVOICE_FONT_DIR . $file_name );
					    $response = array(
						    'font_name' => $file_name,
					    );
					    wp_send_json_success( $response );
					    wp_die();
				    }
			    }else {
				    wp_send_json_error( 'Please enable ZipArchive php extension for uploading zip file.' );
				    wp_die();
			    }
            }
		}
		wp_send_json_error('Something went wrong');
		wp_die();
	}

	/**
     * Add Download Invoice button into My Account Order Actions for Customer
     *
     * @param array    $actions My Account Order List table actions.
     * @param WC_Order $order   Order Object.
     *
     * @return mixed
     */
    public function add_my_account_order_action_download_invoice( $actions, $order ) {
        $order_id                          = $order->get_id();
        $wpifw_invoice_download_check_list = ( get_option( 'wpifw_invoice_download_check_list' ) == false || is_null( get_option( 'wpifw_invoice_download_check_list' ) ) ) ? array() : get_option( 'wpifw_invoice_download_check_list' );
        $output_type = (get_option('wpifw_output_type_html')) ? '&output=html' : '';
        if ( in_array( 'always_allow', $wpifw_invoice_download_check_list )
            || in_array( $order->get_status(), $wpifw_invoice_download_check_list )
            || ( $order->is_paid() && in_array( 'payment_complete', $wpifw_invoice_download_check_list ) )
        ) {
            $download_invoice_text               = get_option( 'wpifw_DOWNLOAD_INVOICE_TEXT' );
            $download_invoice_text               = ( $download_invoice_text ) ? $download_invoice_text : 'Download Invoice';
            $actions['wpifw-my-account-invoice'] = array(
                'url'   => wp_nonce_url( admin_url( 'admin-ajax.php?action=wpifw_generate_invoice&order_id=' . $order_id.$output_type ), 'woo_invoice_ajax_nonce' ),
                'name'  => __( 'Download Invoice', 'webappick-pdf-invoice-for-woocommerce' ),
                'class' => 'wpifw_invoice_action_button',
            );
        }

        return $actions;
    }

    /**
     * Js load after order action
     */
    public function action_after_account_orders_js() {
        $action_slug = 'wpifw-my-account-invoice';
        ?>
        <script>
            jQuery(function ($) {
                $('a.<?php echo esc_html( $action_slug ); ?>').each(function () {
                    $(this).attr('target', '_blank');
                })
            });
        </script>
        <?php
    }


    /**
     * Add download invoice button in order view actions.
     *
     * @param WC_Order $order Order Object.
     */
    public function add_my_account_order_view_action_download_invoice( $order ) {
        $order_id                          = $order->get_id();
        $wpifw_invoice_download_check_list = ( get_option( 'wpifw_invoice_download_check_list' ) == false || is_null( get_option( 'wpifw_invoice_download_check_list' ) ) ) ? array() : get_option( 'wpifw_invoice_download_check_list' );
        $output_type = (get_option('wpifw_output_type_html')) ? '&output=html' : '';
        if ( in_array( 'always_allow', $wpifw_invoice_download_check_list )
            || in_array( $order->get_status(), $wpifw_invoice_download_check_list )
            || ( $order->is_paid() && in_array( 'payment_complete', $wpifw_invoice_download_check_list ) )
        ) {
            if ( $order->get_customer_id() ) {
                $download_invoice_text = get_option( 'wpifw_DOWNLOAD_INVOICE_TEXT' );
                $download_invoice_text = ( $download_invoice_text ) ? $download_invoice_text : 'Download Invoice';

                $url = wp_nonce_url( admin_url( 'admin-ajax.php?action=wpifw_generate_invoice&order_id=' . $order_id.$output_type ), 'woo_invoice_ajax_nonce' );
                ?>
                <a class="woocommerce-button button wpifw-my-account-invoice" href="<?php echo esc_url( $url ); ?>"
                   target="_blank"><?php echo esc_attr__( 'Download Invoice', 'webappick-pdf-invoice-for-woocommerce' ); ?></a>
                <?php
            }
        }
    }

    /**
     * Register MetaBox to add PDF Download Button to Admin Order Detail page
     */
    public function add_custom_meta_box() {
        add_meta_box('wpifw-meta-box', 'Woo Invoice', array( $this, 'pdf_meta_box_markup' ), 'shop_order', 'side', 'high', null);
    }


    /**
     * Add Invoice and Packing Slip Download button to Admin Order Details page Metabox
     */
    public function pdf_meta_box_markup() {
        global $post;
        $invoice      = wp_nonce_url(admin_url('admin-ajax.php?action=wpifw_generate_invoice&order_id=' . $post->ID), 'woo_invoice_ajax_nonce');
        $packing_slip = wp_nonce_url(admin_url('admin-ajax.php?action=wpifw_generate_invoice_packing_slip&order_id=' . $post->ID), 'woo_invoice_ajax_nonce');
	    $shipping_label = wp_nonce_url(admin_url('admin-ajax.php?action=wpifw_generate_shipping_label&order_id=' . $post->ID), 'woo_invoice_ajax_nonce');
        ?>
        <div class="wpifw_invoice_info">
            <a href="<?php echo esc_url($invoice); ?>" target="_blank">
                <button type="button"
                        class="wpifw_button_invoice button wpifw_info_invoice"><?php esc_html_e('Invoice', 'webappick-pdf-invoice-for-woocommerce'); ?></button>
            </a>
            <a href="<?php echo esc_url($packing_slip); ?>" target="_blank">
                <button type="button"
                        class="wpifw_button_invoice_packing_slip button wpifw_info_packing_slip"><?php esc_html_e('Packing Slip', 'webappick-pdf-invoice-for-woocommerce'); ?></button>
            </a>

            <a href="<?php echo esc_url( $shipping_label ); ?>" target="_blank" style="margin-top:8px;display: block">
                <button type="button"
                        class="wpifw_button_invoice_packing_slip button button-default _winvoice-info-shipping-label"><?php echo esc_attr__( 'Shipping Label', 'webappick-pdf-invoice-for-woocommerce' ); ?>
                </button>
            </a>

        </div>

        <?php
    }


    /**
     * Add Invoice & Packing Slip bulk action to order list actions
     *
     * @param  string $redirect_to URL.
     * @param  string $doaction    Action.
     * @param  array  $post_ids    Order Ids.
     * @return string
     */
    public function woo_invoice_bulk_action_handler( $redirect_to, $doaction, $post_ids ) {
        if ( 'wpifw_bulk_invoice' !== $doaction ) {
            return $redirect_to;
        }
        if ( 'wpifw_bulk_invoice_packing_slip' !== $doaction ) {
            return $redirect_to;
        }
        // foreach ( $post_ids as $post_id ) {
        // Perform action for each post.
        // }//.
        $redirect_to = add_query_arg('bulk_emailed_posts', count($post_ids), $redirect_to);
        return $redirect_to;
    }

    /**
     * Register bulk invoice making action
     *
     * @param  array $bulk_actions Order List Bulk Actions.
     * @return mixed
     */
    public function register_bulk_invoice_actions( $bulk_actions ) {
        $bulk_actions['wpifw_bulk_invoice'] = __('Make PDF Invoice', 'webappick-pdf-invoice-for-woocommerce');
        return $bulk_actions;
    }

    /**
     * Register bulk invoice packing slip making action
     *
     * @param  array $bulk_actions Order List Bulk Actions.
     * @return mixed
     */
    public function register_bulk_packing_slip_actions( $bulk_actions ) {
        $bulk_actions['wpifw_bulk_invoice_packing_slip'] = __('Make Packing Slip', 'webappick-pdf-invoice-for-woocommerce');
        return $bulk_actions;
    }

    /**
     * Add a invoice button on admin orders page.
     *
     * @param  WC_Order $order Order Object.
     * @return mixed
     */
    public function add_invoice_order_action_button( $order ) {
        // Get Order ID (compatibility all WC versions).
        $order_id = method_exists($order, 'get_id') ? $order->get_id() : '';
        $output_type = (get_option('wpifw_output_type_html')) ? '&output=html' : '';

        // Invoice button.
        $url         = wp_nonce_url(admin_url('admin-ajax.php?action=wpifw_generate_invoice&order_id=' . $order_id.$output_type), 'woo_invoice_ajax_nonce');
        $text        = __('PDF Invoice', 'webappick-pdf-invoice-for-woocommerce');
        $class       = 'tips parcial wpifw_invoice wpifw_invoice_action_button';
        $src         = WOO_INVOICE_FREE_PLUGIN_URL . 'admin/images/invoice.svg';
        $image_class = 'width: 19px;margin-top: 4px;margin-left: 2px;';
        echo '<a href="' . esc_url($url) . '" target="_blank" class="button ' . esc_html($class) . '" data-tip="' . esc_html($text) . '" title="' . esc_html($text) . '"> <img src="' . esc_url($src) . '" style="' . esc_html($image_class) . '"/></a>';

        // Packing slip button.
	    $url         = wp_nonce_url(admin_url('admin-ajax.php?action=wpifw_generate_invoice_packing_slip&order_id=' . $order_id.$output_type), 'woo_invoice_ajax_nonce');
	    $text        = __('Packing Slip', 'webappick-pdf-invoice-for-woocommerce');
	    $class       = 'tips parcial wpifw_invoice_packing_slip wpifw_button_invoice_packing_slip';
	    $src         = WOO_INVOICE_FREE_PLUGIN_URL . 'admin/images/shipping_list.svg';
	    $image_class = 'width: 19px;margin-top: 4px;margin-left: 3px;';
	    echo '<a href="' . esc_url($url) . '" target="_blank"  class="button ' . esc_html($class) . '" data-tip="' . esc_html($text) . '" title="' . esc_html($text) . '"><img src="' . esc_url($src) . '" style="' . esc_html($image_class) . '"/></a>';

	    // Shipping label button.
	    $url         = wp_nonce_url(admin_url('admin-ajax.php?action=wpifw_generate_shipping_label&order_id=' . $order_id.$output_type), 'woo_invoice_ajax_nonce');
	    $text        = __('Shipping Label', 'webappick-pdf-invoice-for-woocommerce');
	    $class       = 'tips parcial wpifw_invoice_packing_slip wpifw_button_invoice_packing_slip';
	    $src         = WOO_INVOICE_FREE_PLUGIN_URL . 'admin/images/shipping-label.svg';
	    $image_class = 'width: 19px;margin-top: 4px;margin-left: 3px;';
	    echo '<a href="' . esc_url($url) . '" target="_blank"  class="button ' . esc_html($class) . '" data-tip="' . esc_html($text) . '" title="' . esc_html($text) . '"><img src="' . esc_url($src) . '" style="' . esc_html($image_class) . '"/></a>';


    }

    /**
     * Add a packing slip action button on admin order list page.
     *
     * @param WC_Order $order Order Object.
     */
//   public function add_packing_slip_order_action_button( $order ) {
//        // Get Order ID (compatibility all WC versions).
//        $order_id = method_exists($order, 'get_id') ? $order->get_id() : '';
//
//        $url         = wp_nonce_url(admin_url('admin-ajax.php?action=wpifw_generate_invoice_packing_slip&order_id=' . $order_id), 'woo_invoice_ajax_nonce');
//        $text        = __('Packing Slip', 'webappick-pdf-invoice-for-woocommerce');
//        $class       = 'tips parcial wpifw_invoice_packing_slip wpifw_button_invoice_packing_slip';
//        $src         = WOO_INVOICE_FREE_PLUGIN_URL . 'admin/images/shipping_list.svg';
//        $image_class = 'width: 19px;margin-top: 4px;margin-left: 3px;';
//        echo '<a href="' . esc_url($url) . '" target="_blank"  class="button ' . esc_html($class) . '" data-tip="' . esc_html($text) . '" title="' . esc_html($text) . '"><img src="' . esc_url($src) . '" style="' . esc_html($image_class) . '"/></a>';
//   }

    /**
     * Attach Invoice with Order Email
     *
     * @param  array    $attachments Order Attachments.
     * @param  string   $status      order status.
     * @param  WC_Order $order       Order Object.
     * @return array
     * @throws \Mpdf\MpdfException //phpcs:ignore.
     */

    public function attach_invoice_to_order_email( $attachments, $status, $order ) {
        if ( ! $order instanceof WC_Order ) {
            return $attachments;
        }

        $order_id = $order->get_id();

        $allowed_statuses = ( get_option( 'wpifw_email_attach_check_list' ) == false || is_null( get_option( 'wpifw_email_attach_check_list' ) ) ) ? array() : get_option( 'wpifw_email_attach_check_list' );

        if ( empty( $allowed_statuses ) ) {
            $allowed_statuses = array(
                'new_order',
                'customer_invoice',
                'customer_completed_order',
                'customer_refunded_order',
                'customer_processing_order',
            );
        }



        $allowed_statuses = apply_filters( 'woo_invoice_email_types', $allowed_statuses );

        // Delete old pdf files before generating new one.
        array_map( 'unlink', glob( WOO_INVOICE_DIR . '*.pdf' ) ); // Delete files.

        // Generate & Save Invoice.
        woo_invoice_engine()->save_invoice($order_id);

        // Attach invoice with email.
        $invoice_no = woo_invoice_get_invoice_number( $order_id );
        $file_name  = 'Invoice-' . $invoice_no;
        $file_name  = apply_filters( 'woo_invoice_file_name', $file_name, 'invoice', $order_id );

        // Return file path.
        if ( isset( $status ) && in_array( $status, $allowed_statuses ) ) {
            $pdf_path      = WOO_INVOICE_DIR . $file_name . '.pdf';
            $attachments[] = $pdf_path;
        }

        return $attachments;
    }


    /**
     * Add Invoice Download link
     *
     * @param  WC_Order $order Order Object.
     * @return mixed
     */
    public function add_invoice_download_link( $order ) {
        $allowed_statuses = array(
			'new_order',
			'customer_invoice',
			'processing',
			'completed',
        );
        $status           = $order->get_status();
        $order_id         = $order->get_id();

        if ( ( isset($status) && in_array($status, $allowed_statuses, true) ) ) {
            $invoice_download_link = wp_nonce_url(admin_url('admin-ajax.php?action=wpifw_generate_invoice&order_id=' . $order_id), 'woo_invoice_ajax_nonce');
            $download_invoice_text = get_option('wpifw_DOWNLOAD_INVOICE_TEXT');
            $download_invoice_text = ( $download_invoice_text ) ? $download_invoice_text : 'Download Invoice';
            echo ' <a href="' . esc_url($invoice_download_link) . '" target="_blank"  class="button" data-tip="" title="">' . esc_attr($download_invoice_text) . '</a> <br><br/>';
        }
    }


    /**
     * Add Invoice number to order
     *
     * @param integer $order_id Order Id.
     */
    public function add_invoice_number_to_order( $order_id ) {
        // Get next number for custom sequence.
        $next_no = get_option('wpifw_invoice_no');
        $next_no = ! empty($next_no) ? $next_no : 1;
        ++ $next_no;
        update_option('wpifw_invoice_no', $next_no);
    }


    /**
     *  Add Logo uploader script to footer
     */
    public function logo_selector_print_scripts() {
        $my_saved_attachment_post_id = get_option('wpifw_logo_selector_attachment_id', 0);

        ?>
        <script type='text/javascript'>

            jQuery(document).ready(function ($) {

                jQuery(document).on("click", "#wpifw_upload_logo_button", function (e) {
                    e.preventDefault();
                    var $button = $(this);


                    // Create the media frame.
                    var file_frame = wp.media.frames.file_frame = wp.media({
                        title: 'Select or upload image',
                        library: { // remove these to show all
                            type: 'image' // specific mime
                        },
                        button: {
                            text: 'Select'
                        },
                        multiple: false  // Set to true to allow multiple files to be selected
                    });

                    // When an image is selected, run a callback.
                    file_frame.on('select', function () {
                        // We set multiple to false so only get one image from the uploader

                        var attachment = file_frame.state().get('selection').first().toJSON();

                        console.log(attachment);

                        $('#wpifw_logo-preview').attr('src', attachment.url).css('width', 'auto');
                        $('#wpifw_logo_attachment_id').val(attachment.id);

                        $button.siblings('input').val(attachment.id).change();

                    });

                    // Finally, open the modal
                    file_frame.open();
                });
            });


        </script>
        <?php
    }

    /**
     * Add download invoice button in order view actions.
     * My Account Page
     * Order confirmation page
     *
     * @param  WC_Order $order Order Object.
     * @return void
     */
    public function woo_invoice_download_view_order_page( $order ) {
        $order_id = $order->get_id();
        $url      = wp_nonce_url(admin_url('admin-ajax.php?action=wpifw_generate_invoice&order_id=' . $order_id), 'woo_invoice_ajax_nonce');
        if ( is_user_logged_in() ) {
            ?>
            <a class="woocommerce-button button wpifw-my-account-invoice" href="<?php echo esc_url($url); ?>"
               target="_blank"><?php esc_html_e('Download Invoice', 'webappick-pdf-invoice-for-woocommerce'); ?></a>
            <?php
        }
    }

    /**
     * Generate Invoice
     */
    public function generate_invoice() {
        if ( ! is_user_logged_in() ) {
            auth_redirect();
            exit;
        }
        $retrieved_nonce = isset($_REQUEST['_wpnonce']) ? sanitize_text_field(wp_unslash($_REQUEST['_wpnonce'])) : '';
        if ( ! wp_verify_nonce($retrieved_nonce, 'woo_invoice_ajax_nonce') ) {
            die('Failed security check');
        }

        $order_ids = array();
        if ( isset($_REQUEST['order_id']) ) {
            $order_id = ! empty($_REQUEST['order_id']) ? sanitize_text_field(wp_unslash($_REQUEST['order_id'])) : '';

            $order = wc_get_order($order_id);
            $user  = $order->get_user_id();
            if ( wc_user_has_role(get_current_user_id(), 'administrator')
                || wc_user_has_role(get_current_user_id(), 'shop_manager') || get_current_user_id() === $user
            ) {
                $order_ids = $order_id;
            } else {
                die('You are not allowed to download this invoice.');
            }
        } elseif ( isset($_REQUEST['order_ids']) ) {
            if ( wc_user_has_role(get_current_user_id(), 'administrator')
                || wc_user_has_role(get_current_user_id(), 'shop_manager')
            ) {
                $order_ids = sanitize_text_field(wp_unslash($_REQUEST['order_ids']));
            } else {
                die('You are not allowed to download invoices.');
            }
        }

        woo_invoice_engine()->generate_invoice($order_ids);
    }

    /**
     * Generate Packing Slip
     */
    public function generate_packing_slip() {
        if ( ! is_user_logged_in() ) {
            auth_redirect();
            exit;
        }
        $retrieved_nonce = isset($_REQUEST['_wpnonce']) ? sanitize_text_field(wp_unslash($_REQUEST['_wpnonce'])) : '';
        if ( ! wp_verify_nonce($retrieved_nonce, 'woo_invoice_ajax_nonce') ) {
            die('Failed security check');
        }

        $order_ids = array();
        if ( isset($_REQUEST['order_id']) ) {
            $order_id = ! empty($_REQUEST['order_id']) ? sanitize_text_field(wp_unslash($_REQUEST['order_id'])) : '';

            $order = wc_get_order($order_id);
            $user  = $order->get_user_id();
            if ( wc_user_has_role(get_current_user_id(), 'administrator')
                || wc_user_has_role(get_current_user_id(), 'shop_manager')
                || get_current_user_id() === $user
            ) {
                $order_ids = $order_id;
            } else {
                die('You are not allowed to download this packing slip.');
            }
        } elseif ( isset($_REQUEST['order_ids']) ) {
            if ( wc_user_has_role(get_current_user_id(), 'administrator')
                || wc_user_has_role(get_current_user_id(), 'shop_manager')
            ) {
                $order_ids = sanitize_text_field(wp_unslash($_REQUEST['order_ids']));
            } else {
                die('You are not allowed to download packing slip.');
            }
        }
        woo_invoice_engine()->generate_packing_slip($order_ids);
    }


	/**
	 * Process Shipping label action
	 */
	public function woo_invoice_pro_generate_shipping_label() {
	    // Check use is login.
		if ( ! is_user_logged_in() ) {
			auth_redirect();
			exit;
		}

		// Check nonce.
		$retrieved_nonce = isset($_REQUEST['_wpnonce']) ? sanitize_text_field(wp_unslash($_REQUEST['_wpnonce'])) : '';
		if ( ! wp_verify_nonce($retrieved_nonce, 'woo_invoice_ajax_nonce') ) {
			die('Failed security check');
		}

		$order_ids = array();
		if ( isset($_REQUEST['order_id']) ) {
			$order_id = ! empty($_REQUEST['order_id']) ? sanitize_text_field(wp_unslash($_REQUEST['order_id'])) : '';

			$order = wc_get_order($order_id);
			$user  = $order->get_user_id();
			if ( wc_user_has_role(get_current_user_id(), 'administrator')
			     || wc_user_has_role(get_current_user_id(), 'shop_manager')
			     || get_current_user_id() === $user
			) {
				$order_ids = $order_id;
			} else {
				die('You are not allowed to download this shipping label.');
			}
		} elseif ( isset($_REQUEST['order_ids']) ) {
			if ( wc_user_has_role(get_current_user_id(), 'administrator')
			     || wc_user_has_role(get_current_user_id(), 'shop_manager')
			) {
				$order_ids = sanitize_text_field(wp_unslash($_REQUEST['order_ids']));
			} else {
				die('You are not allowed to download shipping label.');
			}
		}

		woo_invoice_engine()->generate_shipping_label($order_ids);

	}


    /**
     * Save invoice template number from plugin settings
     */
    public function save_pdf_template() {
        check_ajax_referer('woo_invoice_ajax_nonce');
        $template = array(
			'template_name' => isset($_POST['template']) ? sanitize_text_field(wp_unslash($_POST['template'])) : '',
			'location'      => WOO_INVOICE_FREE_PLUGIN_URL . 'admin/images/templates',
        );

        if ( ! empty($template) ) {
            update_option('wpifw_templateid', $template['template_name']);
            wp_send_json_success($template);
        }
        wp_send_json_error($_POST);
    }
}

new Woo_Invoice_Hooks();
