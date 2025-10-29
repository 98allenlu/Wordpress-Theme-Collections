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
$title = get_the_title( $current );
$main_image_id = get_post_thumbnail_id($current);
if( $main_image_id ) {
	$main_image = wp_get_attachment_image_src( $main_image_id, 'img16x9', true );
}
$exhibit_location = get_field( 'ex_location', $current );
$exhibit_perm = get_field( 'ex_perm', $current );
$exhibit_open = get_field( 'ex_open', $current );
$exhibit_close = get_field( 'ex_close', $current );
$exhibit_admission = get_field( 'ex_admission', $current );
$exhibit_gallery = get_field( 'ex_gallery', $current );
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
					printf( wp_kses_post( __( '<h1>Exhibit:&nbsp;%s</h1>', 'labtheme' ) ), $title ); ?>

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
				if ( $main_image ) {
					//print_r($main_image);
					$main_image_url = $main_image[0];
					$main_image_width = $main_image[1];
					$main_image_height = $main_image[2];
					$main_image_alt = $main_image[3];
					$fill = 'contain'; //or cover
					if( $main_image_width > 899 ) {
						$fill = 'cover';
					}
					echo '<figure class="text-center sixteen-nine-img bg-lighter ' . esc_attr($fill) . '"><img class="gallery-img" src="' . esc_url($main_image_url) . '" width="' . esc_attr($main_image_width) . '" height="' . esc_attr($main_image_height) . '" alt="' . esc_attr($main_image_alt) . '" /></figure>';
				} ?>

				<div class="<?php echo ($main_image) ? "wrapper-sm top" : "" ?> ">

					<?php the_content(); ?>

				</div>

			</div><!-- #primary -->

			<div class="col-md-5 col-lg-4 content-area" id="secondary">

				<?php
				$exhibit_location_name = $exhibit_location->post_title;
				$exhibit_location_url = get_permalink( $exhibit_location->ID );
				$address_one = get_field( 'address_one', $exhibit_location->ID );
				$address_two = get_field( 'address_two', $exhibit_location->ID );
				$dir_link = get_field( 'dir_link', $exhibit_location->ID );

				echo '<div class="exhibit card">';

					echo '<div class="card-body">';
						echo '<div class="card-text has-icon">';
							echo '<div class="icon"><i class="fa-solid fa-location-dot"></i></div>';
							echo '<p>';
								echo '<a href="' . $exhibit_location_url . '">' . esc_html( $exhibit_location_name ) . '</a><br>';
								echo esc_html( $address_one );
								if($address_two) { echo '<br>' . esc_html( $address_two ); }
								if($dir_link) { echo '<br><small><a href="' . esc_html( $dir_link ) . '" target="_blank">' . __( 'DIRECTIONS', 'labtheme' ) . '</a></small>'; }
							echo '</p>';
						echo '</div>';
						echo '<div class="card-text has-icon">';
							echo '<div class="icon"><i class="fa-regular fa-calendar-days"></i></div>';
							if( $exhibit_perm ) {
								echo '<p>';
									echo '<span><b>Open:</b></span><br>';
									echo '<span>Permanent</span>';
								echo '</p>';
							} elseif( $exhibit_open ) {
								echo '<p>';
									echo '<span><b>Open:</b></span><br>';
									echo '<span>' . esc_html( $exhibit_open ) . '</span>';
								echo '</p>';
							} elseif( $exhibit_close ) {
								echo '<p>';
									echo '<span><b>Close:</b></span><br>';
									echo '<span>' . esc_html( $exhibit_close ) . '</span>';
								echo '</p>';
							}
						echo '</div>';
						echo '<div class="card-text has-icon">';
							if( $exhibit_admission ) {
								echo '<div class="icon"><i class="fa-solid fa-dollar-sign"></i></div>';
								echo '<p>';
									echo '<span><b>Admission:</b></span><br>';
									echo '<span>' . esc_html( $exhibit_admission ) . '</span>';
								echo '</p>';
							}
						echo '</div>';
					echo '</div>';
				echo '</div>';
				?>

			</div><!-- #secondary -->

		</div>

	</div><!-- #content -->

	<?php
	if( $exhibit_gallery ) { ?>

		<div class="wrapper top">

			<div class="container-fluid" id="gallery-wrapper">

				<div class="row">

					<div class="col-12">

						<div class="slick-gallery lab-equal-heights row">

							<?php foreach( $exhibit_gallery as $image ): ?>

								<div class="col">
									<?php //print_r($image); ?>
									<?php $caption = $image['caption']; ?>
									<figure class="gallery-item bg-lighter">
										<a href="<?php echo esc_url($image['url']); ?>" data-fancybox="gallery" data-caption="<?php echo ( $caption ) ? esc_attr( $caption ) : esc_attr( $image['name'] ); ?>"><img class="gallery-img" src="<?php echo esc_url($image['sizes']['img6x4']); ?>" width="<?php echo esc_attr($image['sizes']['img6x4-width']); ?>" height="<?php echo esc_attr($image['sizes']['img6x4-height']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" /></a>
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
