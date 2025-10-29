<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<section class="no-results not-found wrapper col-md-12">

	<header class="page-header">

		<h1 class="page-title text-center"><?php esc_html_e( 'Nothing Found', 'labtheme' ); ?></h1>

	</header><!-- .page-header -->

	<div class="page-content text-center">

		<?php printf(
			'<p class="mb-0">%s<p>',
			esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'labtheme' )
		); ?>

	</div><!-- .page-content -->

</section><!-- .no-results -->
