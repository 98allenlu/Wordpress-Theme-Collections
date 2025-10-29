<?php
/**
 * Sidebar setup for footer full
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>

<?php if ( is_active_sidebar( 'footerfull' ) ) : ?>

	<!-- ******************* The Footer Full-width Widget Area ******************* -->

	<div class="wrapper text-center" id="wrapper-footer-full">

		<div class="container" id="footer-full-content" tabindex="-1">

			<div class="row">

				<?php dynamic_sidebar( 'footerfull' ); ?>

				<div class="col-md-12"><?php echo do_shortcode( '[contact-form-7 id="54" title="Newsletter" html_class="form-inline"]' ); ?></div>

			</div>

		</div>

	</div><!-- #wrapper-footer-full -->

	<?php
endif;
