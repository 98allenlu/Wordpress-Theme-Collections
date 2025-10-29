<?php
/**
 * Template Name: Archive
 *
 * Template for displaying the custom Archives page.
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
$post_type = get_field('archive_post_type', $current);
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

	<?php if( $post_type ) { ?>

		<div class="container-fluid" tabindex="-1">

			<div class="row">

				<?php
				$query_archive = new WP_Query( array( 'post_type' => $post_type, 'post_status' => 'publish', 'orderby' => array( 'date' => 'DESC', 'menu_order' => 'ASC' ) ) );

				// The Loop
				while ( $query_archive->have_posts() ) :
					$query_archive->the_post();
					$current_id = get_the_ID();
					$image = get_the_post_thumbnail( $current_id, 'img6x4' );
					$link = get_permalink();
					$excerpt = NULL;
					if( ! $excerpt ) {
						$content_full = get_the_content( $current_id );
						$excerpt = lab_substrwords( $content_full, 300 );
						$excerpt = lab_closetags( $excerpt );
					}

					echo '<div class="col-md-12 col-lg-6">';
						echo '<div class="card offset equal">';
							if( $image ) {
								echo '<div class="card-img-top">';
									echo $image;
								echo '</div>';
							}
							echo '<div class="card-body offset">';
								echo '<div>';
									echo '<h4 class="card-title">' . get_the_title() . '</h4>';
									echo apply_filters( 'the_content', wp_kses_post( $excerpt ) );
								echo '</div>';
								echo '<a href="' . esc_url( $link ) . '" class="btn btn-outline">Learn More</a>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
					
				endwhile; ?>
				<?php wp_reset_postdata(); ?>

			</div>

		</div>

	<?php } ?>

</div><!-- #page-wrapper -->

<?php
get_footer();
