<?php
/**
 * The template for displaying all single posts
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<?php 
$current = get_the_ID();
$main_image_id = get_post_thumbnail_id($current);
$main_image = wp_get_attachment_image_src( $main_image_id, 'img16x9', true );
$map_iframe = get_field('map_iframe', $current);
$title = get_the_title($current);
$hero_copy = get_field('hero_copy', $current);
$location_gallery = get_field('location_gallery', $current);
?>

<div class="noImage" id="hero">

	<div class="page-image">

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

<div class="wrapper" id="single-wrapper">

	<div class="container-fluid" id="content" tabindex="-1">

		<div class="row">

			<div class="col-md-7 col-lg-8 content-area" id="primary">

				<?php 
				//print_r($main_image);
				if ( ! empty( $main_image ) ) {
					$main_image_url = $main_image[0];
					$main_image_width = $main_image[1];
					$main_image_height = $main_image[2];
					$main_image_alt = $main_image[3];
					$fill = 'cover'; //or contain
					if( $main_image_width > 899 ) {
						$fill = 'cover';
					}
					echo '<figure class="text-center sixteen-nine-img bg-lighter ' . esc_attr($fill) . '"><img class="gallery-img" src="' . esc_url($main_image_url) . '" width="' . esc_attr($main_image_width) . '" height="' . esc_attr($main_image_height) . '" alt="' . esc_attr($main_image_alt) . '" /></figure>';
				} ?>

				<div class="wrapper-sm top">

					<?php the_content(); ?>

				</div>

			</div><!-- #primary -->

			<div class="col-md-5 col-lg-4 content-area" id="secondary">
				
				<?php
				$address_one = get_field('address_one', $current);
				$address_two = get_field('address_two', $current);
				$dir_link = get_field('dir_link', $current);
				$hours = get_field('hours', $current);
				$admission = get_field('admission', $current);

				echo '<div class="location card">';
					if ( $map_iframe ) {
						echo '<div class="card-img-top"><iframe src="' . esc_url($map_iframe) . '" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>';
					} else {
						echo '<div class="class="card-img-top"><img src="https://via.placeholder.com/600x400" class="w-100"></div>';
					}
					echo '<div class="card-body">';
						echo '<div class="card-text has-icon">';
							echo '<div class="icon"><i class="fa-solid fa-location-dot"></i></div>';
							echo '<p class="mt-1">';
								echo esc_html( $address_one );
								if($address_two) { echo '<br>' . esc_html( $address_two ); }
								if($dir_link) { echo '<br><small><a href="' . esc_html( $dir_link ) . '" target="_blank">' . __( 'DIRECTIONS', 'labtheme' ) . '</small></a>'; }
							echo '</p>';
						echo '</div>';
						echo '<div class="card-text has-icon">';
							echo '<div class="icon"><i class="fa-solid fa-clock"></i></div>';
							if( $hours ) {
								foreach ( $hours as $hour ) {
									echo '<p class="mt-1 mb-2">';
										if( $hour['label'] ) { echo '<span><b>' . $hour['label'] . '</b></span><br>'; }
										echo '<span>' . wp_kses_post( $hour['days_hours'] ) . '</span>';
									echo '</p>';
								}
							}
						echo '</div>';
						echo '<div class="card-text has-icon">';
							echo '<div class="icon"><i class="fa-solid fa-dollar-sign"></i></div>';
							if( $admission ) {
								foreach ( $admission as $admis ) {
									echo '<p class="mt-1">';
										if( $admis["label"] ) { echo '<span><b>' . $admis["label"] . '</b></span><br>'; }
										echo '<span>' . esc_html( $admis['amount'] ) . '</span>';
									echo '</p>';
								}
							}
						echo '</div>';
					echo '</div>';
				echo '</div>';
				?>

			</div><!-- #secondary -->

		</div>

	</div><!-- #content -->

	<?php
	if( $location_gallery ) { ?>

		<div class="wrapper top">

			<div class="container-fluid" id="location-gallery">

				<div class="row">

					<div class="col-12">

						<div class="slick-gallery lab-equal-heights row">

							<?php foreach( $location_gallery as $image ): ?>

								<div class="col">
									<?php //print_r($image); ?>
									<?php $caption = $image['caption']; ?>
									<figure class="gallery-item">
										<a href="<?php echo esc_url($image['url']); ?>" data-fancybox="gallery" data-caption="<?php echo ( $caption ) ? esc_attr( $caption ) : esc_attr( $image['name'] ); ?>"><img class="gallery-img" src="<?php echo esc_url($image['sizes']['img6x4']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" /></a>
									</figure>
								</div>

							<?php endforeach; ?>

						</div>

					</div>

				</div>

			</div>

		</div>

	<?php } ?>

	<div class="d-block text-center" id="submenu-container">

		<div class="container-fluid">

			<div class="row">

				<div class="col-12">
					
					<?php labtheme_post_nav(); ?>

				</div>

			</div>

		</div>

	</div><!-- #submenu-container -->

</div><!-- #page-wrapper -->

<?php
get_footer();
