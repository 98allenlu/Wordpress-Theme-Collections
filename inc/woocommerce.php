<?php
/**
 * Add WooCommerce support
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', 'labtheme_woocommerce_support' );
if ( ! function_exists( 'labtheme_woocommerce_support' ) ) {
	/**
	 * Declares WooCommerce theme support.
	 */
	function labtheme_woocommerce_support() {
		add_theme_support( 'woocommerce' );

		// Add Product Gallery support.
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Add Bootstrap classes to form fields.
		add_filter( 'woocommerce_form_field_args', 'labtheme_wc_form_field_args', 10, 3 );
	}
}

// First unhook the WooCommerce content wrappers.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Then hook in your own functions to display the wrappers your theme requires.
add_action( 'woocommerce_before_main_content', 'labtheme_woocommerce_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'labtheme_woocommerce_wrapper_end', 10 );

// Remove button on shop page
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');

// remove single product page stuff we don't need
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// Move the product description from tabs to under price
function lab_woocommerce_template_product_description() {
	wc_get_template( 'single-product/tabs/description.php' );
}
add_action( 'woocommerce_single_product_summary', 'lab_woocommerce_template_product_description', 45 );

// Move the product description from tabs to under price
function lab_woocommerce_template_product_back_to_inventory() {
	$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
	if( $shop_page_url ) {
		echo '<p class="text-uppercase text-sm mb-0"><a href="' . esc_url( $shop_page_url ) . '">&lt; ' . __( "Back to Inventory", "labtheme" ) . '</a></p>';
	}
}
add_action( 'woocommerce_single_product_summary', 'lab_woocommerce_template_product_back_to_inventory', 1 );

// Add Product Contact Widget info to product
function lab_woocommerce_template_product_contact_widget() {
	if ( is_active_sidebar( 'woo-sidebar' ) ) {
		dynamic_sidebar( 'woo-sidebar' );
	}
}
add_action( 'woocommerce_single_product_summary', 'lab_woocommerce_template_product_contact_widget', 25 );

// Change the product description title
// add_filter('woocommerce_product_description_heading', 'change_product_description_heading');
function change_product_description_heading() {
	return __('', 'woocommerce');
}

// Change No. of Thumbnails per Row @ Product Gallery
add_filter( 'woocommerce_single_product_image_gallery_classes', 'lab_5_columns_product_gallery' );
function lab_5_columns_product_gallery( $wrapper_classes ) {
   $columns = 5; // change this to 2, 3, 5, etc. Default is 4.
   $wrapper_classes[2] = 'woocommerce-product-gallery--columns-' . absint( $columns );
   return $wrapper_classes;
}

if ( ! function_exists( 'labtheme_woocommerce_wrapper_start' ) ) {
	/**
	 * Display the theme specific start of the page wrapper.
	 */
	function labtheme_woocommerce_wrapper_start() {
		$container = get_theme_mod( 'labtheme_container_type' );
		echo '<div id="woocommerce-wrapper">';
		echo '<div class="' . esc_attr( $container ) . '" id="content" tabindex="-1">';
		echo '<div class="row">';
		echo '<div class="col-md content-area primary-woo" id="primary">';
	}
}

if ( ! function_exists( 'labtheme_woocommerce_wrapper_end' ) ) {
	/**
	 * Display the theme specific end of the page wrapper.
	 */
	function labtheme_woocommerce_wrapper_end() {
		echo '</div><!-- #primary -->';
		get_template_part( 'global-templates/right-sidebar-check' );
		echo '</div><!-- .row -->';
		echo '</div><!-- Container end -->';
		echo '</div><!-- Wrapper end -->';
	}
}

add_action( 'lab_after_single_product_output', 'lab_woo_related_products', 10 );
function lab_woo_related_products() {
		global $product;

		if ( ! $product ) {
			return;
		}

		$table = get_post_meta( $current, 'intro_text', true );

		if ( $product ) : ?>

			<?php print_r( $product ); ?>

			<?php
		endif;

		wp_reset_postdata();
}

if ( ! function_exists( 'labtheme_wc_form_field_args' ) ) {
	/**
	 * Filter hook function monkey patching form classes
	 * Author: Adriano Monecchi http://stackoverflow.com/a/36724593/307826
	 *
	 * @param string $args Form attributes.
	 * @param string $key Not in use.
	 * @param null   $value Not in use.
	 *
	 * @return mixed
	 */
	function labtheme_wc_form_field_args( $args, $key, $value = null ) {
		// Start field type switch case.
		switch ( $args['type'] ) {
			// Targets all select input type elements, except the country and state select input types.
			case 'select':
				/*
				 * Add a class to the field's html element wrapper - woocommerce
				 * input types (fields) are often wrapped within a <p></p> tag.
				 */
				$args['class'][] = 'form-group';
				// Add a class to the form input itself.
				$args['input_class'] = array( 'form-control' );
				// Add custom data attributes to the form input itself.
				$args['custom_attributes'] = array(
					'data-plugin'      => 'select2',
					'data-allow-clear' => 'true',
					'aria-hidden'      => 'true',
				);
				break;

			/*
			 * By default WooCommerce will populate a select with the country names - $args
			 * defined for this specific input type targets only the country select element.
			 */
			case 'country':
				$args['class'][] = 'form-group single-country';
				break;

			/*
			 * By default WooCommerce will populate a select with state names - $args defined
			 * for this specific input type targets only the country select element.
			 */
			case 'state':
				$args['class'][]           = 'form-group';
				$args['custom_attributes'] = array(
					'data-plugin'      => 'select2',
					'data-allow-clear' => 'true',
					'aria-hidden'      => 'true',
				);
				break;
			case 'password':
			case 'text':
			case 'email':
			case 'tel':
			case 'number':
				$args['class'][]     = 'form-group';
				$args['input_class'] = array( 'form-control' );
				break;
			case 'textarea':
				$args['input_class'] = array( 'form-control' );
				break;
			case 'checkbox':
					$args['class'][] = 'form-group';
					// Wrap the label in <span> tag.
					$args['label'] = isset( $args['label'] ) ? '<span class="custom-control-label">' . $args['label'] . '<span>' : '';
					// Add a class to the form input's <label> tag.
					$args['label_class'] = array( 'custom-control custom-checkbox' );
					$args['input_class'] = array( 'custom-control-input' );
				break;
			case 'radio':
				$args['label_class'] = array( 'custom-control custom-radio' );
				$args['input_class'] = array( 'custom-control-input' );
				break;
			default:
				$args['class'][]     = 'form-group';
				$args['input_class'] = array( 'form-control' );
				break;
		} // End of switch ( $args ).
		return $args;
	}
}

if ( ! is_admin() && ! function_exists( 'wc_review_ratings_enabled' ) ) {
	/**
	 * Check if reviews are enabled.
	 *
	 * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
	 *
	 * @return bool
	 */
	function wc_reviews_enabled() {
		return 'yes' === get_option( 'woocommerce_enable_reviews' );
	}

	/**
	 * Check if reviews ratings are enabled.
	 *
	 * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
	 *
	 * @return bool
	 */
	function wc_review_ratings_enabled() {
		return wc_reviews_enabled() && 'yes' === get_option( 'woocommerce_enable_review_rating' );
	}
}
