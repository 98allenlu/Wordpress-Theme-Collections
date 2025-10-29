<?php
/**
 * UnderStrap enqueue scripts
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


if ( ! function_exists( 'labtheme_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function labtheme_scripts() {
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/theme.min.css' );
		wp_enqueue_style( 'labtheme-styles', get_template_directory_uri() . '/css/theme.min.css', array(), $css_version );
		wp_enqueue_style( 'slick-styles', get_stylesheet_directory_uri() . '/css/slick-theme.css', array(), null);
		wp_enqueue_style( 'slick-styles-more', get_stylesheet_directory_uri() . '/css/slick.css', array(), null);
		wp_enqueue_style( 'fancybox-styles', get_stylesheet_directory_uri() . '/css/fancybox.css', array(), null);

		wp_enqueue_script( 'jquery' );

		//wp_enqueue_script( 'imagesloaded-scripts', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('jquery'), null, true);

		wp_enqueue_script( 'fancybox-scripts', get_template_directory_uri() . '/js/fancybox.umd.js', array('jquery'), null, true);

		//wp_enqueue_script( 'isotope-scripts', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), null, true);

		wp_enqueue_script( 'slick-scripts', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), null, true);

		wp_enqueue_script( 'gsap-js', get_template_directory_uri() . '/js/gsap.min.js', array(), false, true );
		// ScrollTrigger - with gsap.js passed as a dependency
		wp_enqueue_script( 'gsap-st', get_template_directory_uri() . '/js/ScrollTrigger.min.js', array('gsap-js'), false, true );

		$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/theme.min.js' );
		wp_enqueue_script( 'labtheme-scripts', get_template_directory_uri() . '/js/theme.min.js', array('jquery','gsap-js','slick-scripts','fancybox-scripts'), $js_version, true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'labtheme_scripts' );


/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function lab_enqueue_custom_admin_style() {
        wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/css/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'lab_enqueue_custom_admin_style' );
