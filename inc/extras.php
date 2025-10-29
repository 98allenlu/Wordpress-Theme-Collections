<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Filter custom logo with correct classes.
add_filter( 'get_custom_logo', 'labtheme_change_logo_class' );
if ( ! function_exists( 'labtheme_change_logo_class' ) ) {
	/**
	 * Replaces logo CSS class.
	 *
	 * @param string $html Markup.
	 *
	 * @return string
	 */
	function labtheme_change_logo_class( $html ) {

		$html = str_replace( 'class="custom-logo"', 'class="img-fluid"', $html );
		$html = str_replace( 'class="custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html );
		$html = str_replace( 'alt=""', 'title="Home" alt="logo"', $html );

		return $html;
	}
}

if ( ! function_exists( 'labtheme_post_nav' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function labtheme_post_nav() {

		$navObj = get_post_type_object( get_post_type( get_the_ID() ) );
		$navType = $navObj->labels->singular_name;
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		$prevText = '<i class="fa fa-angle-left mr-1">&nbsp;</i>Previous&nbsp;' . $navType;
		$nextText = 'Next&nbsp;' . $navType . '<i class="fa fa-angle-right ml-1"></i>';

		if ( ! $next && ! $previous ) {
			return;
		}
		?>

		<nav class="navigation post-navigation wrapper top">
			<h2 class="sr-only"><?php esc_html_e( 'Post navigation', 'labtheme' ); ?></h2>
			<div class="nav-links d-flex justify-content-between">
				<div>
					<?php
					if ( get_next_post_link() ) {
						next_post_link( '<span class="nav-next">%link</span>', $prevText );
					} ?>
				</div>
				<div>
					<?php
					if ( get_previous_post_link() ) {
						previous_post_link( '<span class="nav-previous">%link</span>', $nextText );
					}
					?>
				</div>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
}

if ( ! function_exists( 'labtheme_pingback' ) ) {
	/**
	 * Add a pingback url auto-discovery header for single posts of any post type.
	 */
	function labtheme_pingback() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">' . "\n";
		}
	}
}
add_action( 'wp_head', 'labtheme_pingback' );

if ( ! function_exists( 'labtheme_mobile_web_app_meta' ) ) {
	/**
	 * Add mobile-web-app meta.
	 */
	function labtheme_mobile_web_app_meta() {
		echo '<meta name="mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-title" content="' . esc_attr( get_bloginfo( 'name' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'labtheme_mobile_web_app_meta' );

if ( ! function_exists( 'labtheme_default_body_attributes' ) ) {
	/**
	 * Adds schema markup to the body element.
	 *
	 * @param array $atts An associative array of attributes.
	 * @return array
	 */
	function labtheme_default_body_attributes( $atts ) {
		$atts['itemscope'] = '';
		$atts['itemtype']  = 'http://schema.org/WebSite';
		return $atts;
	}
}
add_filter( 'labtheme_body_attributes', 'labtheme_default_body_attributes' );

// Escapes all occurances of 'the_archive_description'.
add_filter( 'get_the_archive_description', 'labtheme_escape_the_archive_description' );

if ( ! function_exists( 'labtheme_escape_the_archive_description' ) ) {
	/**
	 * Escapes the description for an author or post type archive.
	 *
	 * @param string $description Archive description.
	 * @return string Maybe escaped $description.
	 */
	function labtheme_escape_the_archive_description( $description ) {
		if ( is_author() || is_post_type_archive() ) {
			return wp_kses_post( $description );
		}

		/*
		 * All other descriptions are retrieved via term_description() which returns
		 * a sanitized description.
		 */
		return $description;
	}
} // End of if function_exists( 'labtheme_escape_the_archive_description' ).

// Escapes all occurances of 'the_title()' and 'get_the_title()'.
add_filter( 'the_title', 'labtheme_kses_title' );

// Escapes all occurances of 'the_archive_title' and 'get_the_archive_title()'.
add_filter( 'get_the_archive_title', 'labtheme_kses_title' );

if ( ! function_exists( 'labtheme_kses_title' ) ) {
	/**
	 * Sanitizes data for allowed HTML tags for post title.
	 *
	 * @param string $data Post title to filter.
	 * @return string Filtered post title with allowed HTML tags and attributes intact.
	 */
	function labtheme_kses_title( $data ) {
		// Tags not supported in HTML5 are not allowed.
		$allowed_tags = array(
			'abbr'             => array(),
			'aria-describedby' => true,
			'aria-details'     => true,
			'aria-label'       => true,
			'aria-labelledby'  => true,
			'aria-hidden'      => true,
			'b'                => array(),
			'bdo'              => array(
				'dir' => true,
			),
			'blockquote'       => array(
				'cite'     => true,
				'lang'     => true,
				'xml:lang' => true,
			),
			'cite'             => array(
				'dir'  => true,
				'lang' => true,
			),
			'dfn'              => array(),
			'em'               => array(),
			'i'                => array(
				'aria-describedby' => true,
				'aria-details'     => true,
				'aria-label'       => true,
				'aria-labelledby'  => true,
				'aria-hidden'      => true,
				'class'            => true,
			),
			'code'             => array(),
			'del'              => array(
				'datetime' => true,
			),
			'ins'              => array(
				'datetime' => true,
				'cite'     => true,
			),
			'kbd'              => array(),
			'mark'             => array(),
			'pre'              => array(
				'width' => true,
			),
			'q'                => array(
				'cite' => true,
			),
			's'                => array(),
			'samp'             => array(),
			'span'             => array(
				'dir'      => true,
				'align'    => true,
				'lang'     => true,
				'xml:lang' => true,
			),
			'small'            => array(),
			'strong'           => array(),
			'sub'              => array(),
			'sup'              => array(),
			'u'                => array(),
			'var'              => array(),
		);
		$allowed_tags = apply_filters( 'labtheme_kses_title', $allowed_tags );

		return wp_kses( $data, $allowed_tags );
	}
} // End of if function_exists( 'labtheme_kses_title' ).
