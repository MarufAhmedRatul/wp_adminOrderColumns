<?php
if ( ! defined( 'ABSPATH' ) ) { exit;}
if( !class_exists( 'Order_Columns_Main' ) ) {
	class Order_Columns_Main{
	    function __construct(){	
			add_filter('manage_edit-shop_order_columns', array(&$this,'add_custom_column'), 11);
			add_action( 'manage_shop_order_posts_custom_column' ,  array(&$this,'add_custom_column_content'), 11, 2 );
			add_action( 'woocommerce_admin_order_data_after_order_details', array(&$this, 'editable_order_custom_field'), 12, 1 );
			add_action( 'woocommerce_process_shop_order_meta', array(&$this, 'save_order_custom_field_meta_data'), 12, 2 );
		}


		 // Output a custom editable field in backend edit order pages under general section
		 function editable_order_custom_field( $order ){			
		
			// Get "Delivery Type" from meta data (not item meta data)
			$updated_value = $order->get_meta('_delivery_type');
		
			// Replace "Delivery Type" value by the meta data if it exist
			$value = $updated_value ? $updated_value : ( isset($item_value) ? $item_value : '');
		
			// Display the custom editable field
			woocommerce_wp_text_input( array(
				'id'            => 'delivery_type',
				'label'         => __("Delivery Type:", "woocommerce"),
				'value'         => $value,
				'wrapper_class' => 'form-field-wide',
			) );
		}

		// Save the custom editable field value as order meta data and update order item meta data	
		function save_order_custom_field_meta_data( $post_id, $post ){
			if( isset( $_POST[ 'delivery_type' ] ) ){
				// Save "Delivery Type" as order meta data
				update_post_meta( $post_id, '_delivery_type', sanitize_text_field( $_POST[ 'delivery_type' ] ) );

				// Update the existing "Delivery Type" item meta data
				if( isset( $_POST[ 'item_id_ref' ] ) )
					wc_update_order_item_meta( $_POST[ 'item_id_ref' ], 'Your Reference', $_POST[ 'delivery_type' ] );
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
		
	}
}

?>