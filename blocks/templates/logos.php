<?php
/**
 * The template for displaying all pages
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<?php
$current = get_the_ID();
// Removed hero-related variables as they are no longer used.

$wh_copy = get_field('wh_copy', $current);
$wh_link = get_field('wh_link', $current);
$tour_link = get_field('tours_link', $current);

$about_copy = get_field('about_copy', $current);
$about_buttons = get_field('about_buttons', $current);
$about_images = get_field('about_images', $current);

$featured_events = get_field('featured_events', $current);

// Removed CTA-related variables as they are no longer used.
?>

<?php /* HERO section removed */ ?>
<?php /* site-content wrapper removed */ ?>

	<div class="wrapper" id="events-wrapper">

		<div class="container-fluid" tabindex="-1">

			<div class="row">

				<div class="col-md-8 col-lg-9">

					<h2 class="h1">What's Happening</h2>

					<?php
					if( $wh_copy ) {

						echo apply_filters( 'the_content', wp_kses_post( $wh_copy ) );

					} ?>

				</div>

				<div class="col-md-4 col-lg-3 d-flex align-items-center justify-content-start justify-content-md-end">

					<?php if($wh_link) { ?>
						<a class="btn btn-outline mr-2" href="<?php echo esc_url($wh_link); ?>"><?php echo __( 'Events', 'labtheme' ); ?></a>
					<?php } ?>
					
					<?php if($tour_link) { ?>
						<a class="btn btn-outline mr-2" href="<?php echo esc_url($tour_link); ?>"><?php echo __( 'Tours', 'labtheme' ); ?></a>
					<?php } ?>

				</div>

			</div>

			<?php
			if( $featured_events && class_exists( 'Tribe__Events__Main' ) ) { ?>

				<div class="row">

					<?php
					foreach( $featured_events as $event_id ):

						$event = tribe_get_event( $event_id );
						$event_link = get_the_permalink( $event_id );
						$event_image = wp_get_attachment_image_src( get_post_thumbnail_id( $event_id ), 'wide' );
						$event_image_width = $event_image[1];
						$event_image_height = $event_image[2];
						$event_image_url = $event_image[0];
						$event_title = $event->post_title;
						$event_excerpt = $event->post_excerpt;
						if( ! $event_excerpt ) {
							$event_content_full = $event->post_content;
							$event_excerpt = lab_closetags( lab_substrwords( $event_content_full, 300 ) );
						}

						//print_r($event_image);

						echo '<div class="col-md-6 padder-sm top">';
							echo '<div class="card offset equal">';
								echo '<div class="card-img-top">';
									if( $event_image_url ){
										echo '<img src="' . esc_url( $event_image_url ) . '" width="' . esc_html( $event_image_width ) . '" height="' . esc_html( $event_image_height ) . '" alt="">';
									}
								echo '</div>';
								echo '<div class="card-body offset d-flex justify-content-between">';
									echo '<div>';
										echo '<h4 class="card-title">' . esc_html( $event_title ) . '</h4>';
										echo apply_filters( 'the_content', wp_kses_post( $event_excerpt ) );
									echo '</div>'; 
									echo '<a href="' . esc_url( $event_link ) . '" class="btn btn-outline mt-2">Learn More</a>';
								echo '</div>';
							echo '</div>';
						echo '</div>';

					endforeach; ?>

				</div>

			<?php } ?>

		</div>

	</div><?php if ( is_active_sidebar( 'front-page-events-below' ) ) : ?>
		<div class="wrapper padder" id="front-page-events-below-wrapper">
			<div class="container-fluid" tabindex="-1">
				<div class="row">
					<div class="col-md">
						<?php dynamic_sidebar( 'front-page-events-below' ); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<div class="wrapper padder freyed" id="about-wrapper">

		<div class="container-fluid" tabindex="-1">

			<div class="row">

				<div class="col-md col-lg-6 d-flex align-items-center justify-content-center order-md-last">

					<?php
					if( $about_images && ( is_array( $about_images ) || $about_images instanceof Countable ) ) {

						$image_count = count( $about_images ); 
						
						if( $image_count == 3 ) { ?>

							<div class="grid-gallery grid-three">

						<?php } elseif( $image_count == 2 ) { ?>

							<div class="grid-gallery grid-two">

						<?php } elseif( $image_count == 1 ) { ?>

							<div class="grid-gallery grid-one">

						<?php } else { ?>

                            <div class="grid-gallery grid-one">

                        <?php } ?>

							<?php
							$i = 0;
							foreach( $about_images as $image ): ?>

								<figure class="gallery-item gallery-item-<?php echo $i; ?>">
									<img class="gallery-img" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
								</figure>

								<?php $i++ ?>

							<?php endforeach; ?>

						</div>

					<?php } ?>

				</div>

				<div class="col-md col-lg-6 order-md-first">

					<h2>Take a <font color="#CDA82B">Step Back in Time</font></h2>

					<?php
					if( $about_copy ) {

						echo apply_filters( 'the_content', wp_kses_post( $about_copy ) );

					}

					if( $about_buttons ) {

						foreach ( $about_buttons as $button ) {
							
							printf( '<a class="btn btn-outline mt-2 mr-2" href="%1$s">%2$s</a>',
								esc_url( $button['button_link']['url'] ),
								esc_html( $button['button_text'] )
							);

						}

					} ?>

				</div>

			</div>

		</div>

	</div><?php if ( is_active_sidebar( 'front-page-locations-above' ) ) : ?>
		<div class="wrapper padder" id="front-page-locations-above-wrapper">
			<div class="container-fluid" tabindex="-1">
				<div class="row">
					<div class="col-md">
						<?php dynamic_sidebar( 'front-page-locations-above' ); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
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
									echo '<div class="card-body d-flex justify-content-between">';
										echo '<div>';
											echo '<h4 class="card-title">' . get_the_title() . '</h4>';
											echo '<p class="card-text text-sm">' . esc_html( $address_one ) . '<br>' . esc_html( $address_two ) . '</p>';
										echo '</div>';
										echo '<a href="' . esc_url( $link ) . '" class="btn btn-outline">Learn More</a>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
							
						endwhile; ?>
						<?php wp_reset_postdata(); ?>

					</div>

				</div></div>

		</div>

	</div><?php /* CTA-wrapper removed */ ?>

<?php
get_footer();