<?php
if ( ! defined( 'ABSPATH' ) ) { exit;}
/*
Plugin Name: Admin Order Columns
Description: Admin Order Columns add the delivery type columns in admin order list.
Author: Maruf Ahmed
Version: 0.1.1
Author URI: http://maufahmedbd.com/
Plugin URI: https://github.com/MarufAhmedRatul/wp_adminOrderColumns/
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/agpl-3.0.html
Requires at least: 5.7.1
Tested up to: 5.7.1
WC requires at least: 3.0.0
WC tested up to: 5.2.2
Last Updated Date: 27-April-2021
Requires PHP: 7.0
*/
if( !class_exists( 'Admin_Order_Columns' ) ) {
	class Admin_Order_Columns{
		public function __construct(){	
			include_once('includes/order-columns-main.php'); 
			$order_columns_main = new Order_Columns_Main();
	
		}
	}
	$obj = new Admin_Order_Columns();
}
?>
