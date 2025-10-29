<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'labtheme_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function labtheme_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) )
		);
		$posted_on   = apply_filters(
			'labtheme_posted_on',
			sprintf(
				'<span class="posted-on">%1$s %2$s</span>',
				esc_html_x( 'Posted on', 'post date', 'labtheme' ),
				apply_filters( 'labtheme_posted_on_time', $time_string )
			)
		);
		echo $posted_on; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'labtheme_entry_footer' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function labtheme_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'labtheme' ) );
			if ( $categories_list && labtheme_categorized_blog() ) {
				/* translators: %s: Categories of current post */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %s', 'labtheme' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'labtheme' ) );
			if ( $tags_list ) {
				/* translators: %s: Tags of current post */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %s', 'labtheme' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'labtheme' ), esc_html__( '1 Comment', 'labtheme' ), esc_html__( '% Comments', 'labtheme' ) );
			echo '</span>';
		}
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'labtheme' ),
				the_title( '<span class="sr-only">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
}

if ( ! function_exists( 'labtheme_categorized_blog' ) ) {
	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @return bool
	 */
	function labtheme_categorized_blog() {
		$all_the_cool_cats = get_transient( 'labtheme_categories' );
		if ( false === $all_the_cool_cats ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(
				array(
					'fields'     => 'ids',
					'hide_empty' => 1,
					// We only need to know if there is more than one category.
					'number'     => 2,
				)
			);
			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );
			set_transient( 'labtheme_categories', $all_the_cool_cats );
		}
		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so labtheme_categorized_blog should return true.
			return true;
		}
		// This blog has only 1 category so labtheme_categorized_blog should return false.
		return false;
	}
}

add_action( 'edit_category', 'labtheme_category_transient_flusher' );
add_action( 'save_post', 'labtheme_category_transient_flusher' );

if ( ! function_exists( 'labtheme_category_transient_flusher' ) ) {
	/**
	 * Flush out the transients used in labtheme_categorized_blog.
	 */
	function labtheme_category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'labtheme_categories' );
	}
}

if ( ! function_exists( 'labtheme_body_attributes' ) ) {
	/**
	 * Displays the attributes for the body element.
	 */
	function labtheme_body_attributes() {
		/**
		 * Filters the body attributes.
		 *
		 * @param array $atts An associative array of attributes.
		 */
		$atts = array_unique( apply_filters( 'labtheme_body_attributes', $atts = array() ) );
		if ( ! is_array( $atts ) || empty( $atts ) ) {
			return;
		}
		$attributes = '';
		foreach ( $atts as $name => $value ) {
			if ( $value ) {
				$attributes .= sanitize_key( $name ) . '="' . esc_attr( $value ) . '" ';
			} else {
				$attributes .= sanitize_key( $name ) . ' ';
			}
		}
		echo trim( $attributes ); // phpcs:ignore WordPress.Security.EscapeOutput
	}
}
