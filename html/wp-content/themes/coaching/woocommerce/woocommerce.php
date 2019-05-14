<?php
if ( !defined( 'ABSPATH' ) ) {
	exit;
}


// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'thim_jk_dequeue_styles' );
function thim_jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-smallscreen'] );    // Remove the smallscreen optimisation
	return $enqueue_styles;
}

// remove woocommerce_breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
//remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5, 0 );


add_filter( 'loop_shop_per_page', 'thim_loop_shop_per_page' );
function thim_loop_shop_per_page() {
	$thim_options_data = get_theme_mods();
	parse_str( $_SERVER['QUERY_STRING'], $params );
	if ( isset( $thim_options_data['thim_woo_product_per_page'] ) && $thim_options_data['thim_woo_product_per_page'] ) {
		$per_page = $thim_options_data['thim_woo_product_per_page'];
	} else {
		$per_page = 12;
	}
	$pc = !empty( $params['product_count'] ) ? $params['product_count'] : $per_page;

	return $pc;
}

/*****************quick view*****************/
//remove_action( 'woocommerce_single_product_summary_quick', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_rating', 15 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary_quick', 'thim_woocommerce_template_loop_add_to_cart_quick_view', 20 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_excerpt', 30 );

//remove_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_meta', 7 );

add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_sharing', 50 );

//overwrite content product.
//remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item_title_rating', 'woocommerce_template_loop_rating', 5 );


if ( ! function_exists( 'thim_woocommerce_template_loop_add_to_cart_quick_view' ) ) {
	function thim_woocommerce_template_loop_add_to_cart_quick_view() {
		global $product;
		do_action( 'woocommerce_' . $product->product_type . '_add_to_cart'  );
	}
}

/* PRODUCT QUICK VIEW */
add_action( 'wp_head', 'thim_lazy_ajax', 0, 0 );
function thim_lazy_ajax() {
	?>
	<script type="text/javascript">
		/* <![CDATA[ */
		var ajaxurl = "<?php echo esc_js(admin_url('admin-ajax.php')); ?>";
		/* ]]> */
	</script>
<?php
}

add_action( 'wp_ajax_jck_quickview', 'thim_jck_quickview' );
add_action( 'wp_ajax_nopriv_jck_quickview', 'thim_jck_quickview' );
/** The Quickview Ajax Output **/
function thim_jck_quickview() {
	global $post, $product;
	$prod_id = $_POST["product"];
	$post    = get_post( $prod_id );
	$product = wc_get_product( $prod_id );
	// Get category permalink
	ob_start();
	?>
	<?php wc_get_template( 'content-single-product-lightbox.php' ); ?>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	echo ent2ncr( $output );
	die();
}

/* End PRODUCT QUICK VIEW */


/* Share Product */
add_action( 'woocommerce_share', 'thim_social_share' );

/* custom WC_Widget_Cart */
function thim_get_current_cart_info() {
	global $woocommerce;
	$items = count( $woocommerce->cart->get_cart() );

	return array(
		$items,
		get_woocommerce_currency_symbol()
	);
}

add_filter( 'woocommerce_add_to_cart_fragments', 'thim_add_to_cart_success_ajax' );
function thim_add_to_cart_success_ajax( $count_cat_product ) {
	list( $cart_items ) = thim_get_current_cart_info();
	if ( $cart_items < 0 ) {
		$cart_items = '0';
	} else {
		$cart_items = $cart_items;
	}
	$count_cat_product['#header-mini-cart .cart-items-number .items-number'] = '<span class="items-number">' . $cart_items . '</span>';

	return $count_cat_product;
}

// Override WooCommerce Widgets
add_action( 'widgets_init', 'thim_override_woocommerce_widgets', 15 );
function thim_override_woocommerce_widgets() {
	if ( class_exists( 'WC_Widget_Cart' ) ) {
		unregister_widget( 'WC_Widget_Cart' );
		$file_child = get_stylesheet_directory().'/woocommerce/widgets/class-wc-widget-cart.php';
		if( file_exists($file_child) ) {
			include_once( get_stylesheet_directory().'/woocommerce/widgets/class-wc-widget-cart.php' );
		}else{
			include_once( 'widgets/class-wc-widget-cart.php' );
		}
		register_widget( 'Thim_Custom_WC_Widget_Cart' );
	}
}


// New Product
function thim_woo_add_custom_general_fields() {
	echo '<div class="options_group" id="product_custom_affiliate">';
	woocommerce_wp_checkbox(
			array(
					'id'       => 'thim_product_new',
					'label'    => esc_html__( 'Product New', 'coaching' ),
					'desc_tip' => 'true',
			)
	);

	woocommerce_wp_checkbox(
			array(
					'id'       => 'thim_product_hot',
					'label'    => esc_html__( 'Product Hot', 'coaching' ),
					'desc_tip' => 'true',
			)
	);

	woocommerce_wp_text_input(
		array(
			'id'       => 'thim_product_author',
			'label'    => esc_html__( 'Product Author', 'coaching' ),
			'desc_tip' => 'true',
		)
	);
	echo '</div>';
}

function thim_woo_add_custom_general_fields_save( $post_id ) {
	$thim_product_new = isset( $_POST['thim_product_new'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, 'thim_product_new', $thim_product_new );
	// Checkbox
	$thim_product_hot = isset( $_POST['thim_product_hot'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, 'thim_product_hot', $thim_product_hot );

	$thim_product_author = esc_attr($_POST['thim_product_author']);
	update_post_meta($post_id, 'thim_product_author', $thim_product_author );
}

// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'thim_woo_add_custom_general_fields' );

// Save Fields
add_action( 'woocommerce_process_product_meta', 'thim_woo_add_custom_general_fields_save' );

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
