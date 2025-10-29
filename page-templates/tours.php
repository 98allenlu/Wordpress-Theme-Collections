<?php
/**
 * Template Name: Tours Template
 *
 * Template for displaying the Publications page.
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
					printf( wp_kses_post( __( '<h1>%s</h1>', 'labtheme' ) ), $title ); ?>

				</div>

			</div>

		</div>

	</div><!-- .page-image -->

</div><!-- #hero -->

<div class="wrapper" id="page-wrapper">

	<?php if( get_the_content() ) { ?>

		<div class="wrapper bottom" id="content">

			<div class="container-fluid" tabindex="-1">

				<div class="row">

					<div class="col-md">

						<?php the_content(); ?>

					</div>

				</div>

			</div>

		</div>

	<?php } ?>

	<?php lab_get_template('inc/page-builder.php'); ?>

	<div class="container-fluid" tabindex="-1">

		<div class="row">

			<?php
			$args = array(
				'post_type'  => 'lab_tour',
				'posts_per_page' => -1,
				'orderby' => 'menu_order title',
				'order' => 'ASC',
			);
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) :
				while ( $query->have_posts() ) :
					$query->the_post();

					$current_tour = $post->ID;
					$tour_price = get_field( 'tour_price', $current_tour );
					$tour_duration = get_field( 'tour_dur', $current_tour );
					$tour_distance = get_field( 'tour_dis', $current_tour );
					$tour_avail = get_field( 'tour_avail', $current_tour );
					$tour_fareharbor = get_field( 'tour_fareharbor', $current_tour );
					$tour_url = get_field( 'tour_url', $current_tour );  ?>

					<article <?php post_class('col-sm-6 padder bottom'); ?> id="post-<?php the_ID(); ?>">

						<div class="card offset equal">

							<div class="card-img-top">

								<?php echo get_the_post_thumbnail( $post->ID, 'wide', array('style' => '-o-object-fit:contain;object-fit:cover;') ); ?>

							</div>

							<div class="card-body offset d-flex justify-content-between">

								<div class="entry-content">

									<h4 class="entry-title mt-0 mb-1"><?php the_title(); ?></h4>

									<?php
									if( $tour_price && $tour_duration && $tour_distance ) {

										echo '<p class="text-sm mt-0 mb-0"><b>' . esc_html($tour_price) . '</b>&nbsp;|&nbsp;<b>' . esc_html($tour_duration) . '</b>&nbsp;|&nbsp;<b>' . esc_html($tour_distance) . '</b></p>';

									} ?>

									<?php
									if( $tour_avail ) {

										echo '<p class="text-sm mt-0 mb-0"><b>' . esc_html($tour_avail) . '</b></p>';

									} ?>

									<div class="mt-2">

										<?php the_content(); ?>

									</div>

									<?php
									if( $tour_fareharbor ) { ?>

										<div class="mt-2 d-block">
											<?php echo do_shortcode('[lightframe class="btn d-inline-block" items="' . esc_html( $tour_fareharbor ) . '"]Book now[/lightframe]'); ?>
										</div>

									<?php } elseif( $tour_url ) { ?>

										<div class="mt-2">
											<a href="<?php echo esc_url( $tour_url ); ?>" class="btn d-inline-block">Learn More</a>
										</div>

									<?php } ?>

								</div><!-- .entry-content -->

							</div>

						</div>

					</article><!-- #post-## -->

				<?php endwhile; ?>

			<?php endif; ?>

			<?php wp_reset_postdata(); ?>

		</div>

	</div>

</div>

<?php
get_footer();
