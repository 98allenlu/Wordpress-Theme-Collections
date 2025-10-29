<?php
/**
 * The Template for displaying a single 'object' post type (Culture Object Display).
 *
 * This template enables the display of object metadata via the_content() and
 * activates the theme's sidebar for widgets on single object pages.
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<?php 
$current = get_the_ID();
// Note: Object posts often don't have custom ACF 'hero_copy' but keep variables for structural consistency
$hero_image = get_the_post_thumbnail_url($current);
$title = get_the_title($current);
?>

<div class="<?php echo ($hero_image) ? 'hasImage' : 'noImage'; ?>" id="hero">

	<?php if( $hero_image ) { ?>

		<div class="page-image para-container d-flex justify-content-center align-items-center">
			<img class="para-img" src="<?php echo $hero_image; ?>">
		</div>

	<?php } else { ?>

		<div class="page-image">
	<?php } ?>

		<div class="hero-content">
			<div class="container-fluid">
				<div class="hero-content-inner">

					<div class="flag-content">
						<div class="flag"></div>
					</div>

					<?php
					// Display the Object Title
					printf( wp_kses_post( __( '<h1>%s</h1>', 'labtheme' ) ), $title );
					// Note: Removed $hero_copy logic as it's typically unused on single objects
					?>

				</div>
			</div>
		</div>

	</div></div><div class="wrapper" id="page-wrapper">

	<div class="container-fluid" id="content" tabindex="-1">

		<div class="row">

			<div class="col-md-8 content-area" id="primary">

				<main class="site-main">

					<?php
					while ( have_posts() ) {
						the_post();
						
						// CRITICAL: This call tells the Culture Object Display plugin to inject the object's metadata.
						the_content(); 
					}
					?>

				</main></div><?php get_sidebar(); ?>

		</div></div></div><?php
get_footer();