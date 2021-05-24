<?php
/**
 * This file contain available Webappick blog feeds
 *
 * @package Woo_Invoice_Pro
 * Created by PhpStorm.
 * User: wahid
 * Date: 5/22/20
 * Time: 9:02 PM
 */

if ( ! function_exists( 'woo_invoice_add_dashboard_widgets' ) ) {
	/**
	 * Add a widget to the dashboard.
	 *
	 * This function is hooked into the 'wp_dashboard_setup' action below.
	 */
	function woo_invoice_add_dashboard_widgets() {
		global $wp_meta_boxes;

		add_meta_box( 'aaaa_webappick_latest_news_dashboard_widget', __( 'Latest News from WebAppick Blog', 'webappick-pdf-invoice-for-woocommerce' ), 'woo_invoice_dashboard_widget_render', 'dashboard', 'side', 'high' );

	}
	add_action( 'wp_dashboard_setup', 'woo_invoice_add_dashboard_widgets', 1 );
}

if ( ! function_exists( 'woo_invoice_dashboard_widget_render' ) ) {
	/**
	 * Function to get dashboard widget data.
	 */
	function woo_invoice_dashboard_widget_render() {

		// Initialize variable.
		$allposts = '';

		// Enter the name of your blog here followed by /wp-json/wp/v2/posts and add filters like this one that limits the result to 2 posts.
		$response = wp_remote_get( 'https://webappick.com/wp-json/wp/v2/posts?per_page=5' );

		// Exit if error.
		if ( is_wp_error( $response ) ) {
			return;
		}

		// Get the body.
		$posts = json_decode( wp_remote_retrieve_body( $response ) );

		// Exit if nothing is returned.
		if ( empty( $posts ) ) {
			return;
		}
		?>
		<p> <a style="text-decoration: none;font-weight: bold;" href="<?php echo esc_url( 'https://webappick.com' ); ?>" target=_balnk><?php echo esc_html__( 'WEBAPPICK.COM', 'webappick-pdf-invoice-for-woocommerce' ); ?></a></p>
		<hr>
		<?php
		// If there are posts.
		if ( ! empty( $posts ) ) {
			// For each post.
			foreach ( $posts as $post ) {
				$fordate = gmdate( 'M j, Y', strtotime( $post->modified ) );
				?>
				<p class="webappick-feeds"> <a style="text-decoration: none;" href="<?php echo esc_url( $post->link ); ?>" target=_balnk><?php echo esc_html( $post->title->rendered ); ?></a> - <?php echo esc_html( $fordate ); ?></p>
				<span><?php echo esc_html( wp_trim_words( $post->content->rendered, 35, '...' ) ); ?></span>
				<?php
			}
			?>
			<hr>
			<p> <a style="text-decoration: none;" href="<?php echo esc_url( 'https://webappick.com/blog/' ); ?>" target=_balnk><?php echo esc_html__( 'Get more woocommerce tips & news on our blog...', 'webappick-pdf-invoice-for-woocommerce' ); ?></a></p>
			<?php
		}
	}
}

