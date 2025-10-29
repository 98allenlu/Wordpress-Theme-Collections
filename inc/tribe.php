<?php
/**
 * Tribe functions and definitions
 *
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Remove subscribe to calendar dropdown from main calendar page
add_filter( 'tribe_template_html:events/v2/components/subscribe-links/list', '__return_false' );
