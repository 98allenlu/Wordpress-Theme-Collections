<?php
/**
 * Theme basic setup
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

add_action( 'after_setup_theme', 'labtheme_setup' );

if ( ! function_exists( 'labtheme_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function labtheme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on labtheme, use a find and replace
		 * to change 'labtheme' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'labtheme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'labtheme' ),
				'footer'  => __( 'Footer Menu', 'labtheme' ),
				'side'  => __( 'Side Menu', 'labtheme' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		/*
		 * Adding Thumbnail basic support
		 */
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'wide', 1920, 700);
		add_image_size( 'img6x4', 650, 433, array( 'center', 'center' ) );
		add_image_size( 'img16x9', 916, 515, array( 'center', 'center' ) );
		add_image_size( 'img450', 450, 450, array( 'center', 'center' ) );

		/*
		 * Adding support for Widget edit icons in customizer
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
			)
		);

		// Set up the WordPress Theme logo feature.
		// add_theme_support( 'custom-logo' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Check and setup theme default settings.
		labtheme_setup_theme_default_settings();

	}
}


add_filter( 'excerpt_more', 'labtheme_custom_excerpt_more' );

if ( ! function_exists( 'labtheme_custom_excerpt_more' ) ) {
	/**
	 * Removes the ... from the excerpt read more link
	 *
	 * @param string $more The excerpt.
	 *
	 * @return string
	 */
	function labtheme_custom_excerpt_more( $more ) {
		if ( ! is_admin() ) {
			$more = '';
		}
		return $more;
	}
}

//add_filter( 'wp_trim_excerpt', 'labtheme_all_excerpts_get_more_link' );

if ( ! function_exists( 'labtheme_all_excerpts_get_more_link' ) ) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function labtheme_all_excerpts_get_more_link( $post_excerpt ) {
		if ( /*! is_admin() && is_home()*/ FALSE ) {
			$post_excerpt = $post_excerpt . '<p class="mt-0 mb-0"><a class="labtheme-read-more-link" href="javascript:void(0);" data-toggle="modal" data-target="#modal-' . esc_html( get_the_ID() ) . '">' . __(
				'Read More...',
				'labtheme'
			) . '</a></p>';
		} else {
			$post_excerpt = $post_excerpt . '<p class="mt-0 mb-0"><a class="labtheme-read-more-link" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . __(
				'Read More...',
				'labtheme'
			) . '</a></p>';
		}
		return $post_excerpt;
	}
}
