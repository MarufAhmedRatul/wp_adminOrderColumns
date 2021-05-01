<?php
if ( ! defined( 'ABSPATH' ) ) { exit;}
if( !class_exists( 'Order_Columns_Main' ) ) {
	class Order_Columns_Main{
	    function __construct(){	
			add_filter('manage_edit-shop_order_columns', array(&$this,'add_custom_column'), 11);
			add_action( 'manage_shop_order_posts_custom_column' ,  array(&$this,'add_custom_column_content'), 11, 2 );
			add_action( 'woocommerce_admin_order_data_after_order_details', array(&$this, 'editable_order_custom_field'), 12, 1 );
			add_action( 'woocommerce_process_shop_order_meta', array(&$this, 'save_order_custom_field_meta_data'), 12, 2 );
			add_action( 'woocommerce_admin_order_totals_after_discount', array(&$this, 'vp_add_sub_total'), 10, 1);
			add_action( 'woocommerce_admin_order_item_headers', array(&$this, 'calculate_advance_payment'), 10, 1);
		}


		 // Output a custom editable field in backend edit order pages under general section
		 function editable_order_custom_field( $order ){			
		
			// Get "Delivery Type" from meta data (not item meta data)
			$updated_delivery_type = $order->get_meta('_delivery_type');
			$updated_advance_payment = $order->get_meta('_advance_payment');
		
			// Replace "Delivery Type" value by the meta data if it exist
			$deliveryType = $updated_delivery_type ? $updated_delivery_type : ( isset($item_value) ? $item_value : '');
			$advancePayment = $updated_advance_payment ? $updated_advance_payment : ( isset($item_value) ? $item_value : '');
		
			// Display the custom editable field
			woocommerce_wp_text_input( 
				array(
					'id'            => 'delivery_type',
					'label'         => __("Delivery Type:", "woocommerce"),
					'value'         => $deliveryType,
					'wrapper_class' => 'form-field-wide',
				)
			);
			woocommerce_wp_text_input( 
				array(
					'id'            => 'advance_payment',
					'label'         => __("Advance Payment:", "woocommerce"),
					'value'         => $advancePayment,
					'wrapper_class' => 'form-field-wide',
				)
			);
		}

		// Save the custom editable field value as order meta data and update order item meta data	
		function save_order_custom_field_meta_data( $post_id, $post ){
			if( isset( $_POST[ 'delivery_type' ] ) ||  isset( $_POST[ 'advance_payment' ] )){
				// Save "Delivery Type" as order meta data
				update_post_meta( $post_id, '_delivery_type', sanitize_text_field( $_POST[ 'delivery_type' ] ) );
				update_post_meta( $post_id, '_advance_payment', sanitize_text_field( $_POST[ 'advance_payment' ] ) );

				// Update the existing "Delivery Type" item meta data
				if( isset( $_POST[ 'item_id_ref' ] ) ){
					wc_update_order_item_meta( $_POST[ 'item_id_ref' ], 'Delivery Type', $_POST[ 'delivery_type' ] );
					wc_update_order_item_meta( $_POST[ 'item_id_ref' ], 'Advance Payment', $_POST[ 'advance_payment' ] );
				}
			}
		}

		/**
		 * @return custom column
		 */
		function add_custom_column($columns){
			$new_columns = array();
			
			foreach ( $columns as $column_name => $column_info ) {
				$new_columns[ $column_name ] = $column_info;
				if ( 'order_total' === $column_name ) {
					$new_columns['delivery_type'] = __( 'Delivery Type', 'woocommerce' );
					
				}
			}
			return $new_columns;
		}

		/**
		 * @return data to custom column
		 */
		function add_custom_column_content($column){

			global $post, $the_order;
			if ( empty( $the_order ) || $the_order->get_id() !== $post->ID ) {
				$the_order = wc_get_order( $post->ID );
			}
			
			switch ( $column ) {
				case 'delivery_type' :					
				if((get_post_meta( $post->ID, "_delivery_type", true )) == NULL){
					echo 'No Data Available!';
				}
				else{
					echo get_post_meta( $post->ID, "_delivery_type", true );
				}
			}

		}


		function calculate_advance_payment( $the_order ) {
			$getTotal = $the_order->get_total();
			$updateTotal = $getTotal - get_post_meta($the_order->get_id(), "_advance_payment", true);
			$the_order->set_total($updateTotal);
			$the_order->save();
		}

		//Display Advance Payment and calculate
		function vp_add_sub_total( $the_order ) {
			global $post, $the_order;
			if ( empty( $the_order ) || $the_order->get_id() !== $post->ID ) {
				$the_order = wc_get_order( $post->ID );
			}
			?>
			
			<tr>
			<td class="label">Advance Payment:</td>
			<td width="1%"></td>
			<td class="total"><?php echo wc_price(get_post_meta($post->ID, "_advance_payment", true));?></td>
			</tr>
			
			<?php
		}
		 
	}
}


?>