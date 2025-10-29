<?php
/**
 * Template Name: Events
 *
 * Template for displaying all events.
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<?php 
$current = get_the_ID();
$hero_image = get_the_post_thumbnail_url($current);
$title = get_the_title($current);
$hero_copy = get_field('hero_copy', $current);
$view = isset($_GET['view']) ? $_GET['view'] : 'list' ;
if( $view == 'month' ) {
	$view === 'month';
} elseif( $view == 'list' ) {
	$view === 'list';
} else {
	$view === 'list';
}
?>

<div class="<?php echo ($hero_image) ? 'hasImage' : 'noImage'; ?>" id="hero">

	<?php if( $hero_image ) { ?>

		<div class="page-image para-container d-flex justify-content-center align-items-center">

			<img class="para-img" src="<?php echo $hero_image; ?>">

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
					printf( wp_kses_post( __( '<h1>%s</h1>', 'labtheme' ) ), $title );

					if( $hero_copy ) {

						echo apply_filters( 'the_content', wp_kses_post( $hero_copy ) );

					} ?>

				</div>

			</div>

		</div>

	</div><!-- .page-image -->

</div><!-- #hero -->

<div class="wrapper bottom" id="page-wrapper">

	<div class="container-fluid" tabindex="-1">

		<div class="row">

			<div class="col-md">

				<?php //the_content(); ?>

				<?php echo do_shortcode('[tribe_events view="' . esc_html( $view ) . '" exclude-tag="exclude"]'); ?>

			</div>

		</div>

	</div>

</div><!-- #page-wrapper -->

<?php
get_footer();
