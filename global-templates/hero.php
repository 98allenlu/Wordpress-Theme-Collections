<?php
/**
 * Hero setup
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; ?>

<div class="slide-full">

	<?php
	if ( is_active_sidebar( 'herocanvas' ) ) : ?>

		<div class="wrapper" id="wrapper-hero">

			<div class="slide-text loading"><?php get_template_part( 'sidebar-templates/sidebar', 'herocanvas' ); ?></div>

		</div>

	<?php endif; ?>

</div>
