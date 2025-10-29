<?php
/**
 * The header for our theme
 *
 * @package labtheme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-QDM0KQ4RVS"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-QDM0KQ4RVS');
	</script>

</head>

<body <?php body_class(); ?> <?php labtheme_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>

<!-- Google Tag Manager (noscript) -->
<?php /* <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M8SQ668" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> */ ?>

<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar">

		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'labtheme' ); ?></a>

		<nav id="main-nav" class="navbar navbar-light" aria-labelledby="main-nav-label">

			<div class="container-fluid">

				<div class="navbar-brand-wrapper position-relative">

					<!-- Your site title as branding in the menu -->
					<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url">
						<img src="<?php echo get_template_directory_uri(); ?>/img/logo-lewes.svg?v=2" width="220" height="72">
					</a>

				</div>

				<div class="navbar-menu-wrapper">

					<!-- The WordPress Menu goes here -->
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'container_class' => '',
							'container_id'    => 'navbarNavDropdown',
							'menu_class'      => 'navbar-nav ml-auto',
							'fallback_cb'     => '',
							'menu_id'         => 'main-menu',
							'depth'           => 2,
							'walker'          => new LAB_WP_Bootstrap_Navwalker(),
						)
					); ?>

					<div class="hamburger">

						<a id="hamburger-icon" class="navbar-toggler js-offcanvas-trigger" data-toggle="offcanvas" data-target="#offcanvasNav" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
							<span class="more">MORE</span>
							<span class="menu">MENU</span>
							<span class="line line-1"></span>
							<span class="line line-2"></span>
						</a>

					</div>

				</div>

			</div><!-- .container -->

		</nav><!-- .site-navigation -->

	</div><!-- #wrapper-navbar end -->
