<?php
/**
 * Sidebar - The Hero Canvas Widget Area
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; ?>

<?php if ( is_active_sidebar( 'herocanvas' ) ) : ?>

	<!-- ******************* The Hero Canvas Widget Area ******************* -->

	<?php dynamic_sidebar( 'herocanvas' ); ?>

<?php endif;
