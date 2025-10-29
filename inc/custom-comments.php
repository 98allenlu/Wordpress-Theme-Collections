<?php
/**
 * Comment layout
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'comment_form_defaults', 'lab_set_comment_form_defaults' );
function lab_set_comment_form_defaults( $defaults ) {
  $defaults['title_reply'] = __( 'Leave a Comment' );
  $defaults['label_submit'] = __( 'Post Comment' );
  $defaults['comment_notes_before'] = '<p class="comment-notes">If you love this recipe, have questions or want to chat, please consider posting a comment below! Your support means a great deal to me. Required fields are marked *</p>'; 
  return $defaults;
}

// define the get_comment_time callback 
add_filter( 'get_comment_time', 'filter_get_comment_time', 10, 5);
function filter_get_comment_time( $date, $d, $gmt, $translate, $comment ) { 
  $d = "g:i:s";
  $date = mysql2date($d, $date, $translate);
  return $date;
};

// Remove website/url field from comment form.
add_filter( 'comment_form_default_fields', 'lab_disable_comment_url' );
function lab_disable_comment_url($fields) { 
    unset($fields['url']);
    return $fields;
}

// Add Bootstrap classes to comment form fields.
add_filter( 'comment_form_default_fields', 'labtheme_bootstrap_comment_form_fields' );
if ( ! function_exists( 'labtheme_bootstrap_comment_form_fields' ) ) {
	/**
	 * Add Bootstrap classes to WP's comment form default fields.
	 *
	 * @param array $fields {
	 *     Default comment fields.
	 *
	 *     @type string $author  Comment author field HTML.
	 *     @type string $email   Comment author email field HTML.
	 *     @type string $url     Comment author URL field HTML.
	 *     @type string $cookies Comment cookie opt-in field HTML.
	 * }
	 *
	 * @return array
	 */
	function labtheme_bootstrap_comment_form_fields( $fields ) {

		$replace = array(
			'<p class="' => '<div class="form-group ',
			'<input'     => '<input class="form-control" ',
			'</p>'       => '</div>',
		);

		if ( isset( $fields['author'] ) ) {
			$fields['author'] = strtr( $fields['author'], $replace );
		}
		if ( isset( $fields['email'] ) ) {
			$fields['email'] = strtr( $fields['email'], $replace );
		}

		$replace = array(
			'<p class="' => '<div class="form-group form-check ',
			'<input'     => '<input class="form-check-input" ',
			'<label'     => '<label class="form-check-label" ',
			'</p>'       => '</div>',
		);
		if ( isset( $fields['cookies'] ) ) {
			$fields['cookies'] = strtr( $fields['cookies'], $replace );
		}

		return $fields;
	}
} // End of if function_exists( 'labtheme_bootstrap_comment_form_fields' )

// Add Bootstrap classes to comment form submit button and comment field.
add_filter( 'comment_form_defaults', 'labtheme_bootstrap_comment_form' );

if ( ! function_exists( 'labtheme_bootstrap_comment_form' ) ) {
	/**
	 * Adds Bootstrap classes to comment form submit button and comment field.
	 *
	 * @param string[] $args Comment form arguments and fields.
	 *
	 * @return string[]
	 */
	function labtheme_bootstrap_comment_form( $args ) {
		$replace = array(
			'<p class="' => '<div class="form-group ',
			'<textarea'  => '<textarea class="form-control" ',
			'</p>'       => '</div>',
		);

		if ( isset( $args['comment_field'] ) ) {
			$args['comment_field'] = strtr( $args['comment_field'], $replace );
		}

		if ( isset( $args['class_submit'] ) ) {
			$args['class_submit'] = 'btn btn-secondary';
		}

		return $args;
	}
} // End of if function_exists( 'labtheme_bootstrap_comment_form' ).


// Add note if comments are closed.
add_action( 'comment_form_comments_closed', 'labtheme_comment_form_comments_closed' );

if ( ! function_exists( 'labtheme_comment_form_comments_closed' ) ) {
	/**
	 * Displays a note that comments are closed if comments are closed and there are comments.
	 */
	function labtheme_comment_form_comments_closed() {
		if ( get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'labtheme' ); ?></p>
			<?php
		}
	}
} // End of if function_exists( 'labtheme_comment_form_comments_closed' ).
