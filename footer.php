<?php
/**
 * The template for displaying the footer
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; ?>

<?php
$current = get_the_ID();
$site_address = get_field('site_address', 'option');
$site_address_two = get_field('site_address_two', 'option');
$site_phone = get_field('site_phone', 'option');
$social_media = get_field('social_media', 'option');
$ft_eyebrow = get_field('ft_eyebrow', 'option');
$ft_headline = get_field('ft_headline', 'option');
$ft_button_text = get_field('ft_button_text', 'option');
$ft_button_link = get_field('ft_button_link', 'option');
?>

<div id="wrapper-footer">

	<div class="container-fluid">

		<div class="row">

			<div class="col-md">

				<footer class="site-footer wrapper">

					<div class="footer-info">

						<div class="d-flex flex-column flex-lg-row">

							<div class="footer-info-left pt-1">

								<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url">
									<img src="<?php echo get_template_directory_uri(); ?>/img/logo-footer.png" width="220" height="72">
								</a>

								<?php if( $site_address || $site_address_two || $site_phone ) {
									echo '<div class="site-address mt-4 mb-4">';
										echo '<h6 class="text-uppercase mb-0">' . __('Administration Building', 'labtheme') . '</h6>';
										echo '<p>';
											if ( $site_address ) { echo wp_kses_post( $site_address ) . '<br>'; }
											if ( $site_address_two ) { echo wp_kses_post( $site_address_two ) . '<br>'; }
											if ( $site_phone ) { echo wp_kses_post( $site_phone ); }
										echo '</p>';
									echo '</div>';
								} ?>

							</div>

							<div class="footer-info-right mt-2">

								<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'menu-footer d-flex' ) ); ?>

								<?php if( $social_media ) { ?>

									<div class="footer-info-social">

										<?php foreach ($social_media as $icon) {
											
											printf( '<a class="icon-social" href="%1$s" target="_blank"><i class="fa-brands fa-%2$s fa-2xl"></i></a>',
												esc_url( $icon['url'] ),
												esc_html( $icon['icon'] )
											);

										} ?>

									</div>

								<?php } ?>

							</div>

						</div>

					</div>

				</footer><!-- #colophon -->

			</div><!-- col end -->

		</div><!-- row end -->

	</div><!-- container end -->

	<div class="container-fluid">

		<div class="row">

			<div class="col-md">

				<div class="footer-copyright"><p class="text-sm mb-0">&#169; <?php esc_html_e( date("Y") ); ?> <?php bloginfo( 'name' ); ?> All rights reserved.</p></div>

			</div><!-- col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- #wrapper-sub-footer end -->

</div><!-- #page we need this extra closing tag here -->

<div class="navbar-collapse offcanvas-collapse" id="offcanvasNav">
	<div class="offcanvas-header">
		<h5 class="offcanvas-title" id="offcanvasExampleLabel">MENU</h5>
		<button type="button" class="btn-close" data-toggle="offcanvas" data-bs-dismiss="offcanvas" aria-label="Close">&#10005;</button>
	</div>
	<div class="offcanvas-body">
		<!-- The WordPress Menu goes here -->
		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'side',
				'menu_class'      => 'accordion',
				'menu_id'         => 'side',
				'depth'           => 2,
				'walker'          => new LAB_WP_Bootstrap_Accwalker(),
			)
		); ?>
	</div>
</div>
<div class="offcanvas-bg" data-toggle="offcanvas" data-bs-dismiss="offcanvas"></div>

<?php wp_footer(); ?>

</body>

</html>
