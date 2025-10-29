<?php
/**
 * Template Name: Publications Template
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
$hero_copy = get_field('hero_copy', $current);
$tax_terms = get_terms( array(
    'taxonomy'   => 'pub_type',
    'hide_empty' => false,
) );
?>

<div class="<?php echo ($hero_image) ? 'hasImage' : 'noImage'; ?>" id="hero">

	<?php if( $hero_image ) { ?>

		<div class="page-image d-flex justify-content-center align-items-center" style="background-image:url('<?php echo $hero_image; ?>');">

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

	<div class="container-fluid" tabindex="-1">

		<div class="row">

			<div class="col-md">

				<?php the_content(); ?>

			</div>

		</div>

	</div>

</div><!-- #page-wrapper -->

<div class="wrapper" id="archive-wrapper">

	<div class="container-fluid" tabindex="-1">

		<?php foreach ( $tax_terms as $term ): ?>

			<div class="row wrapper top">

				<div class="col-md">

					<?php
					if($term->name) { ?>

						<h3 class="title mb-4"><?php echo apply_filters('the_title', wp_kses_post($term->name)); ?></h3>

					<?php } ?>

					<?php //print_r($term); ?>

				</div>

			</div>

			<div class="row">

				<?php
				$args = array(
					'post_type'  => 'lab_publication',
					'posts_per_page' => -1,
					'orderby' => 'date',
					'order' => 'DESC',
					'tax_query' => array(
						array(
							'taxonomy' => 'pub_type',
							'field'    => 'slug',
							'terms'    => $term->slug,
						),
					),
				);
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) :
					$i == 0;
					$j == 0;
					while ( $query->have_posts() ) :
						$query->the_post();

						if( $term->slug == 'journals' ) {
							if( $j == 0 ) {
								get_template_part( 'loop-templates/content', 'journal-lrg' );
								$j++;
							} else {
								get_template_part( 'loop-templates/content', 'journal' );
							}
						} elseif( $i == 0 ) {
							get_template_part( 'loop-templates/content', 'pub-lrg' );
							$i++;
						} else {
							get_template_part( 'loop-templates/content', 'pub' );
						} ?>

					<?php endwhile; ?>

				<?php endif; ?>

				<?php wp_reset_postdata(); ?>

			</div>
			
		<?php endforeach ?>

		<div class="row wrapper">

			<div class="col-md-12">

				<hr>

			</div>

		</div>

	</div>

	<?php lab_get_template('inc/page-builder.php'); ?>

</div>

<?php
get_footer();
