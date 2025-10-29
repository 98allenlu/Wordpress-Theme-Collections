<?php
/**
 * ACF social media template
 *
 * @package GoodwillNJ2020
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( is_active_sidebar( 'social' ) ) : ?>

	<!-- ******************* The Footer Full-width Widget Area ******************* -->

	<div class="wrapper-social d-flex">

		<?php dynamic_sidebar( 'social' ); ?>

	</div>

	<?php
endif;
