<?php
/**
 * Class Chalan_Review_Reminder
 */
class Chalan_Notifications{
	/**
	 * Chalan_Review_Reminder constructor.
	 */
	public function __construct(){
	    $this->notifications_load_hooks();
	}

	/**
	 * Load all Notifications hooks.
	 */
	public function notifications_load_hooks(){
		add_action( 'admin_notices', [ $this, 'woo_invoice_review_notice' ] );
		add_action('wp_ajax_woo_invoice_save_review_notice', [ $this, 'woo_invoice_save_review_notice' ] );
		add_action('wp_ajax_woo_invoice_hide_notice', [ $this, 'woo_invoice_hide_notice' ] );
    }
	/**
	 * Review notice action.
	 */
	public function woo_invoice_review_notice() {

//	    delete_option('woo_invoice_review_notice_next_show_time');
//	    delete_user_meta('1', 'woo_invoice_review_notice_dismissed');

		$nonce         = wp_create_nonce( 'woo_invoice_notice_nonce' );
		$pluginName    = sprintf( '<b>%s</b>', esc_html__( 'Chalan', 'webappick-pdf-invoice-for-woocommerce' ) );
		$has_notice    = false;
		$user_id       = get_current_user_id();
		$next_timestamp = get_option('woo_invoice_review_notice_next_show_time');
		$review_notice_dismissed = get_user_meta( $user_id, 'woo_invoice_review_notice_dismissed', true );
		if ( ! empty($next_timestamp) ) {
			if ( ( time() > $next_timestamp ) ) {
				$show_notice = true;
			}else {
				$show_notice = false;
			}
		} else {
			if ( isset($review_notice_dismissed) && ! empty($review_notice_dismissed) ) {
				$show_notice = false;
			}else {
				$show_notice = true;
			}
		}
		// Review Notice.
		if ( $show_notice ) {
			$has_notice = true;
			?>
			<div class="woo-invoice-notice notice notice-info is-dismissible" style="line-height:1.5;" data-which="rating" data-nonce="<?php echo esc_attr( $nonce ); ?>">
				<p><?php
					printf(
					/* translators: 1: plugin name,2: Slightly Smiling Face (Emoji), 3: line break 'br' tag */
						esc_html__( '%3$s %2$s We have spent countless hours developing this free plugin for you, and we would really appreciate it if you dropped us a quick rating. Your opinion matters a lot to us.%4$s It helps us to get better. Thanks for using %1$s.', 'webappick-pdf-invoice-for-woocommerce' ),
						$pluginName, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'<span style="font-size: 16px;">&#128516</span>',
						'<div class="woo-invoice-review-notice-logo"></div>',
						'<br>'
					);
					?></p>
				<p>
					<a class="button button-secondary" data-response="later" href="#"><?php esc_html_e( 'Remind me later', 'webappick-pdf-invoice-for-woocommerce' ); ?></a>
					<a class="button button-secondary" data-response="never" href="#"><?php esc_html_e( 'I would not', 'webappick-pdf-invoice-for-woocommerce' ); ?></a>
					<a class="button button-secondary" data-response="done" href="#" target="_blank"><?php esc_html_e( 'I already did!', 'webappick-pdf-invoice-for-woocommerce' ); ?></a>
					<a class="button button-primary" data-response="given" href="#" target="_blank"><?php esc_html_e( 'Review Here', 'webappick-pdf-invoice-for-woocommerce' ); ?></a>
				</p>
			</div>
			<?php
		}

		if ( true === $has_notice ) {
			add_action( 'admin_print_footer_scripts', function() use ( $nonce ) {
				?>
				<script>
                    (function($){
                        "use strict";
                        $(document)
                            .on('click', '.woo-invoice-notice a.button', function (e) {
                                e.preventDefault();
                                // noinspection ES6ConvertVarToLetConst
                                var self = $(this), notice = self.attr('data-response');
                                if ( 'given' === notice ) {
                                    window.open('https://wordpress.org/support/plugin/webappick-pdf-invoice-for-woocommerce/reviews/?rate=5#new-post', '_blank');
                                }
                                self.closest(".woo-invoice-notice").slideUp( 200, 'linear' );
                                wp.ajax.post( 'woo_invoice_save_review_notice', { _ajax_nonce: '<?php echo esc_attr( $nonce ); ?>', notice: notice } );
                            })

                            .on('click', '.woo-invoice-notice .notice-dismiss', function (e) {
                                e.preventDefault();
                                // noinspection ES6ConvertVarToLetConst
                                var self = $(this), invoice_notice = self.closest('.woo-invoice-notice'), which = invoice_notice.attr('data-which');
                                wp.ajax.post( 'woo_invoice_hide_notice', { _wpnonce: '<?php echo esc_attr( $nonce ); ?>', which: which } );
                            });
                    })(jQuery)
				</script><?php
			}, 99 );
		}

	}

	/**
	 * Show Review request admin notice
	 * @return string
	 */
	public function woo_invoice_save_review_notice() {
		check_ajax_referer( 'woo_invoice_notice_nonce' );

		update_option('review_test', 'review');
		$review_actions = [ 'later', 'never', 'done', 'given' ];
		if ( isset( $_POST['notice'] ) && ! empty( $_POST['notice'] ) && in_array( $_POST['notice'], $review_actions ) ) {
			$value  = [
				'review_notice' => sanitize_text_field( $_POST['notice'] ), //phpcs:ignore
				'updated_at'    => time(),
			];
			if ( 'never' === $_POST['notice'] || 'done' === $_POST['notice'] ) {
				$user_id = get_current_user_id();
				add_user_meta( $user_id, 'woo_invoice_review_notice_dismissed', true, true );
			}elseif ( 'given' !== $_POST['notice'] ) {
				update_option( 'woo_invoice_review_notice_next_show_time', time() + ( DAY_IN_SECONDS * 30 ) );
			}
			update_option( 'woo_invoice_review_notice', $value );
			wp_send_json_success( $value );
			wp_die();
		}
		wp_send_json_error( esc_html__( 'Invalid Request.', 'webappick-pdf-invoice-for-woocommerce' ) );
		wp_die();
	}
	/**
	 * Ajax Action For Hiding Compatibility Notices
	 */
	public function woo_invoice_hide_notice() {
		check_ajax_referer( 'woo_invoice_notice_nonce' );
		$notices = [ 'rp-wcdpd', 'wpml', 'rating', 'product_limit' ];
		if ( isset( $_REQUEST['which'] ) && ! empty( $_REQUEST['which'] ) && in_array( $_REQUEST['which'], $notices ) ) {
			$user_id = get_current_user_id();
			$updated_user_meta = add_user_meta( $user_id, 'woo_invoice_review_notice_dismissed', true, true );
			update_option( 'woo_invoice_review_notice_next_show_time', time() + ( DAY_IN_SECONDS * 30 ) );
			if ( $updated_user_meta ) {
				wp_send_json_success( esc_html__( 'Request Successful.', 'webappick-pdf-invoice-for-woocommerce' ) );
			}else {
				wp_send_json_error( esc_html__( 'Something is wrong.', 'webappick-pdf-invoice-for-woocommerce' ) );
			}
			wp_die();
		}
		wp_send_json_error( esc_html__( 'Invalid Request.', 'webappick-pdf-invoice-for-woocommerce' ) );
		wp_die();
	}

}

/**
 * Instance of the notification.
 */
new Chalan_Notifications();