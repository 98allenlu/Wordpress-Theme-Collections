<?php
/**
 * UnderStrap functions and definitions
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Array of files to include.
$labtheme_includes = array(
	'/custom-post-types.php',
	'/theme-settings.php',                   // Initialize theme default settings.
	'/setup.php',                            // Theme setup and custom theme supports.
	'/widgets.php',                          // Register widget area.
	'/enqueue.php',                          // Enqueue scripts and styles.
	'/template-tags.php',                    // Custom template tags for this theme.
	'/pagination.php',                       // Custom pagination for this theme.
	'/hooks.php',                            // Custom hooks.
	'/extras.php',                           // Custom functions that act independently of the theme templates.
	'/customizer.php',                       // Customizer additions.
	'/custom-comments.php',                  // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',     // Load custom WordPress nav walker.
	'/class-wp-bootstrap-accordian-walker.php',
	'/editor.php', 
	'/tribe.php',
	'/lab.php',
	'/page-builder-function.php',
	'/deprecated.php',
);

$labtheme_includes_blocks = array(
	'/category.php',
	'/blocks.php',
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$labtheme_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activated.
// FIXED: Changed class_classes() to class_exists()
if ( class_exists( 'Jetpack' ) ) {
	$labtheme_includes[] = '/jetpack.php';
}

// Include files.
foreach ( $labtheme_includes as $file ) {
	require_once get_template_directory() . '/inc' . $file;
}

foreach ( $labtheme_includes_blocks as $file ) {
	//require_once get_template_directory() . '/blocks' . $file;
}

// ---
## Custom Front Page Widget Areas

/**
 * Register custom widget areas for the front page.
 */
function labtheme_front_page_widgets_init() {

    // A widget area below the "What's Happening" section
    register_sidebar( array(
        'name'          => esc_html__( 'Homepage - Events Area Below', 'labtheme' ),
        'id'            => 'front-page-events-below',
        'description'   => esc_html__( 'Widgets added here will appear below the Featured Events section on the homepage.', 'labtheme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    // A widget area above the "Locations" section
    register_sidebar( array(
        'name'          => esc_html__( 'Homepage - Locations Area Above', 'labtheme' ),
        'id'            => 'front-page-locations-above',
        'description'   => esc_html__( 'Widgets added here will appear above the Explore Our Locations section on the homepage.', 'labtheme' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

}
add_action( 'widgets_init', 'labtheme_front_page_widgets_init' );
// ---

// --- FIX: Resolve Fatal Error on Search Results Page ---

if ( ! function_exists( 'understrap_entry_footer' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 * Placeholder function to prevent fatal error in content-search.php.
	 */
	function understrap_entry_footer() {
		// Leave empty to avoid crashing the search results page.
	}
}
// --- END FIX ---