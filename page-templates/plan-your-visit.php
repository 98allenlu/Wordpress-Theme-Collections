<?php
/**
 * Template Name: Plan Your Visit Template
 *
 * Template for displaying the Plan Your Visit page.
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

$free_headline = get_field('free_headline', $current);
$free_copy = get_field('free_copy', $current);
$free_buttons = get_field('free_buttons', $current);

$dir_headline = get_field('dir_headline', $current);
$dir_copy = get_field('dir_copy', $current);
$dir_buttons = get_field('dir_buttons', $current);
$dir_map = get_field('dir_image', $current);

$tours_headline = get_field('tours_headline', $current);
$tours_copy = get_field('tours_copy', $current);
$tours_buttons = get_field('tours_buttons', $current);
$tours_images = get_field('tours_images', $current);
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

<div class="wrapper top" id="page-wrapper">

	<div class="" id="hours-wrapper">

		<div class="container-fluid" tabindex="-1">

			<div class="row">

				<div class="col-md">

					<h2><?php echo __( 'Hours <font color="#CDA82B">&</font> Admission', 'labtheme' ); ?></h2>

					<div class="lab-equal-heights row" id="hours">

						<?php
						$query_hours = new WP_Query( array( 'post_type' => 'lab_loc', 'post_status' => 'publish', 'orderby' => array( 'date' => 'DESC', 'menu_order' => 'ASC' ) ) );

						// The Loop
						while ( $query_hours->have_posts() ) :
							$query_hours->the_post();

							$hide_loc = get_field('hide_loc');
							if( $hide_loc ) {
								continue;
							}
							$link = get_permalink();
							$address_one = get_field('address_one');
							$address_two = get_field('address_two');
							$dir_link = get_field('dir_link');
							$hours = get_field('hours');
							$admission = get_field('admission');

							echo '<div class="col-sm-12 col-md-6 col-lg-4">';
								echo '<div class="location card equal">';
									echo '<div class="card-top">';
										echo '<h4 class="card-title">' . get_the_title() . '</h4>';
									echo '</div>';
									echo '<div class="card-body">';
										echo '<div class="card-text has-icon">';
											echo '<div class="icon"><i class="fa-solid fa-location-dot"></i></div>';
											echo '<p class="mt-1">';
												echo esc_html( $address_one );
												if($address_two) { echo '<br>' . esc_html( $address_two ); }
												if($dir_link) { echo '<br><small><a href="' . esc_html( $dir_link ) . '" target="_blank">' . __( 'DIRECTIONS', 'labtheme' ) . '</a></small>'; }
											echo '</p>';
										echo '</div>';
										echo '<div class="card-text has-icon">';
											echo '<div class="icon"><i class="fa-regular fa-calendar-days"></i></div>';
											if( $hours ) {
												foreach ( $hours as $hour ) {
													echo '<p class="mt-1">';
														if( $hour['label'] ) { echo '<span><b>' . $hour['label'] . '</b></span><br>'; }
														echo '<span>' . esc_html( $hour['days_hours'] ) . '</span>';
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
							echo '</div>';
							
						endwhile; ?>
						<?php wp_reset_postdata(); ?>

						<?php if( $free_headline && $free_copy ) { ?>

							<div class="col-sm-12 col-md-6 col-lg-4">
								<div class="location location-admission card equal">
									
									<div class="card-body">

										<?php printf( wp_kses_post( __( '<h4 class="text-uppercase"><b>%s</b></h4>', 'labtheme' ) ), $free_headline ); ?>

										<?php if( $free_copy ) {

											echo apply_filters( 'the_content', wp_kses_post( $free_copy ) );

										}
										
										if( $free_buttons ) {

											foreach ( $free_buttons as $button ) {
												
												printf( '<a class="btn btn-outline mt-2 mr-2" href="%1$s">%2$s</a>',
													esc_url( $button['button_link']['url'] ),
													esc_html( $button['button_text'] )
												);

											}

										} ?>

									</div>
								</div>
							</div>

						<?php } ?>

					</div>

				</div>

			</div>

		</div>

	</div>

	<div class="padder" id="directions-wrapper">

		<div class="container-fluid" tabindex="-1">

			<div class="row">

				<div class="col-md col-lg-6 d-flex align-items-center justify-content-center">

					<?php
					if( $dir_map ) { ?>

						<figure class="dir-figure">
							<img class="dir-map" src="<?php echo esc_url($dir_map['url']); ?>" alt="<?php echo esc_attr($dir_map['alt']); ?>" />
						</figure>

					<?php } ?>

				</div>

				<div class="col-md col-lg-6">

					<?php
					printf( wp_kses_post( __( '<h2>%s</h2>', 'labtheme' ) ), $dir_headline );

					if( $dir_copy ) {

						echo apply_filters( 'the_content', wp_kses_post( $dir_copy ) );

					}

					if( $dir_buttons ) {

						foreach ( $dir_buttons as $button ) {
							
							printf( '<a class="btn btn-outline mt-2 mr-2" href="%1$s">%2$s</a>',
								esc_url( $button['button_link']['url'] ),
								esc_html( $button['button_text'] )
							);

						}

					} ?>

				</div>

			</div>

		</div>

	</div>

	<div class="wrapper padder freyed" id="about-wrapper">

		<div class="container-fluid" tabindex="-1">

			<div class="row">

				<div class="col-md col-lg-6 d-flex align-items-center justify-content-center order-md-last">

					<?php
					if( $tours_images ) { ?>

						<?php $image_count = count( $tours_images ); ?>

						<?php if( $image_count == 3 ) { ?>

							<div class="grid-gallery grid-three">

						<?php } elseif( $image_count == 2 ) { ?>

							<div class="grid-gallery grid-two">

						<?php } elseif( $image_count == 1 ) { ?>

							<div class="grid-gallery grid-one">

						<?php } ?>

							<?php
							$i = 0;
							foreach( $tours_images as $image ): ?>

								<figure class="gallery-item gallery-item-<?php echo $i; ?>">
									<img class="gallery-img" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
								</figure>

								<?php $i++ ?>

							<?php endforeach; ?>

						</div>

					<?php } ?>

				</div>

				<div class="col-md col-lg-6 order-md-first">

					<?php
					printf( wp_kses_post( __( '<h2>%s</h2>', 'labtheme' ) ), $tours_headline );

					if( $tours_copy ) {

						echo apply_filters( 'the_content', wp_kses_post( $tours_copy ) );

					}

					if( $tours_buttons ) {

						foreach ( $tours_buttons as $button ) {
							
							printf( '<a class="btn btn-outline mt-2 mr-2" href="%1$s">%2$s</a>',
								esc_url( $button['button_link']['url'] ),
								esc_html( $button['button_text'] )
							);

						}

					} ?>

				</div>

			</div>

		</div>

	</div>

	<div class="wrapper" id="locations-wrapper">

		<div class="container-fluid" tabindex="-1">

			<div class="row">

				<div class="col-md">

					<h2><?php echo __( 'Explore Our Locations', 'labtheme' ); ?></h2>

					<div class="slick-locations lab-equal-heights row" id="locations">

						<?php
						$query_loc = new WP_Query( array( 'post_type' => 'lab_loc', 'post_status' => 'publish', 'orderby' => array( 'date' => 'DESC', 'menu_order' => 'ASC' ) ) );

						// The Loop
						while ( $query_loc->have_posts() ) :
							$query_loc->the_post();

							$hide_loc = get_field('hide_loc');
							if( $hide_loc ) {
								continue;
							}
							$link = get_permalink();
							$address_one = get_field('address_one');
							$address_two = get_field('address_two');

							echo '<div class="col">';
								echo '<div class="location card equal">';
									echo '<div class="card-img-top">';
										if(has_post_thumbnail()){
											the_post_thumbnail('img6x4');
										}
									echo '</div>';
									echo '<div class="card-body justify-content-between">';
										echo '<div>';
											echo '<h4 class="card-title">' . get_the_title() . '</h4>';
											echo '<p class="card-text">' . esc_html( $address_one ) . '<br>' . esc_html( $address_two ) . '</p>';
										echo '</div>';
										echo '<a href="' . esc_url( $link ) . '" class="btn btn-outline">Learn More</a>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
							
						endwhile; ?>
						<?php wp_reset_postdata(); ?>

					</div>

				</div><!-- #locations -->

			</div>

		</div>

	</div><!-- #locations-wrapper -->

</div><!-- #page-wrapper -->

<?php
get_footer();
