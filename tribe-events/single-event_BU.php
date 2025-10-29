<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = Tribe__Events__Main::postIdHelper( get_the_ID() );

/**
 * Allows filtering of the event ID.
 *
 * @since 6.0.1
 *
 * @param numeric $event_id
 */
$event_id = apply_filters( 'tec_events_single_event_id', $event_id );

/**
 * Allows filtering of the single event template title classes.
 *
 * @since 5.8.0
 *
 * @param array   $title_classes List of classes to create the class string from.
 * @param numeric $event_id      The ID of the displayed event.
 */
$title_classes = apply_filters( 'tribe_events_single_event_title_classes', [ 'tribe-events-single-event-title' ], $event_id );
$title_classes = implode( ' ', tribe_get_classes( $title_classes ) );

/**
 * Allows filtering of the single event template title before HTML.
 *
 * @since 5.8.0
 *
 * @param string  $before   HTML string to display before the title text.
 * @param numeric $event_id The ID of the displayed event.
 */
//$before = apply_filters( 'tribe_events_single_event_title_html_before', '<h1 class="' . $title_classes . '">', $event_id );

/**
 * Allows filtering of the single event template title after HTML.
 *
 * @since 5.8.0
 *
 * @param string  $after    HTML string to display after the title text.
 * @param numeric $event_id The ID of the displayed event.
 */
//$after = apply_filters( 'tribe_events_single_event_title_html_after', '</h1>', $event_id );

/**
 * Allows filtering of the single event template title HTML.
 *
 * @since 5.8.0
 *
 * @param string  $after    HTML string to display. Return an empty string to not display the title.
 * @param numeric $event_id The ID of the displayed event.
 */
$title = apply_filters( 'tribe_events_single_event_title_html', the_title( $before, $after, false ), $event_id );
$cost  = tribe_get_formatted_cost( $event_id );

$ev_fareharbor_link = get_field( 'ev_fareharbor', $event_id );
$ev_gallery = get_field( 'ev_gallery', $event_id );
$ev_category_override = get_field( 'ev_category_override', $event_id );
$ev_category = wp_get_object_terms( $event_id, array( 'tribe_events_cat' ), array( 'orderby' => 'name', 'order' => 'ASC', 'fields' => 'all' ) );
$ev_category_formatted = NULL;
if( $ev_category_override ) {
	$ev_category_formatted = $ev_category_override . ':&nbsp;';
} elseif( ! empty( $ev_category ) ) {
	$ev_category_formatted = $ev_category[0]->name . ':&nbsp;';
}
$website = strip_tags( tribe_get_event_website_link( $event_id ) );
//$website_title = tribe_events_get_event_website_title();
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
					printf( wp_kses_post( __( '<h1 class="%1s">%2s%3s</h1>', 'labtheme' ) ), $title_classes, $ev_category_formatted, $title ); ?>

				</div>

			</div>

		</div>

	</div><!-- .page-image -->

</div><!-- #hero -->

<div id="tribe-events-content" class="tribe-events-single container-fluid mt-2">

	<p class="tribe-events-back">
		<a href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( '<i class="fa fa-angle-left mr-1"></i>' . esc_html_x( 'All %s', '%s Events plural label', 'the-events-calendar' ), $events_label_plural ); ?></a>
	</p>

	<?php //echo $ev_category[0]->name; ?>

	<!-- Notices -->
	<?php //tribe_the_notices() ?>

	<div class="row wrapper bottom">

		<div class="col-md-7 col-lg-8 content-area" id="primary">

			<?php //echo $title; ?>

			<?php /*
			<div class="tribe-events-schedule tribe-clearfix">
				<?php echo tribe_events_event_schedule_details( $event_id, '<h2>', '</h2>' ); ?>
				<?php if ( ! empty( $cost ) ) : ?>
					<span class="tribe-events-cost"><?php echo esc_html( $cost ) ?></span>
				<?php endif; ?>
			</div>
			

			<!-- Event header -->
			<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
				<!-- Navigation -->
				<nav class="tribe-events-nav-pagination" aria-label="<?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?>">
					<ul class="tribe-events-sub-nav">
						<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
						<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
					</ul>
					<!-- .tribe-events-sub-nav -->
				</nav>
			</div>
			<!-- #tribe-events-header -->
			*/ ?>

			<?php while ( have_posts() ) :  the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php if ( tribe_event_featured_image( $event_id, 'full', false ) ) : ?>

						<?php
						$main_image = wp_get_attachment_image_src( get_post_thumbnail_id(  $event_id ), 'full' );
						$main_image_width = $main_image[1];
						$main_image_height = $main_image[2];
						$fill = 'contain';
						if( $main_image_width > 899 && $main_image_width > $main_image_height ) {
							$fill = 'cover';
						} 
						//print_r($main_image); ?>

						<figure class="text-center sixteen-nine-img bg-lighter wrapper-sm bottom <?php echo $fill; ?>">

							<!-- Event featured image, but exclude link -->
							<?php echo tribe_event_featured_image( $event_id, 'full', false ); ?>

						</figure>

					<?php endif ?>

					<!-- Event content -->
					<?php //do_action( 'tribe_events_single_event_before_the_content' ) ?>
					<div class="tribe-events-single-event-description tribe-events-content">
						<?php the_content(); ?>
					</div>
					<!-- .tribe-events-single-event-description -->
					<?php //do_action( 'tribe_events_single_event_after_the_content' ) ?>

					
				</div> <!-- #post-x -->
				<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
			<?php endwhile; ?>

		</div><!-- #primary -->

		<div class="col-md-5 col-lg-4 content-area" id="secondary">

			<div class="location card">

				<div class="card-body">

					<!-- Event meta -->
					<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
					<?php tribe_get_template_part( 'modules/meta' ); ?>
					<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>

				</div>

			</div>

			<?php
			// Event Website
			//print_r($website);
			if ( $website ): ?>
				<div class="mt-3">
					<a href="<?php echo esc_url( $website ); ?>" class="btn btn-secondary w-100" target="_blank">LEARN MORE</a>
				</div>
			<?php endif ?>

			<?php
			if( $ev_fareharbor_link ) { ?>

				<div class="mt-3">
					<?php echo do_shortcode('[lightframe items="' . esc_html( $ev_fareharbor_link ) . '"]Book now[/lightframe]'); ?>
				</div>

			<?php } ?>

		</div><!-- #secondary -->

	</div>

</div><!-- #tribe-events-content -->

<?php
if( $ev_gallery ) { ?>

	<div class="wrapper">

		<div class="container-fluid" id="gallery-wrapper">

			<div class="row">

				<div class="col-12">

					<div class="slick-gallery lab-equal-heights row">

						<?php foreach( $ev_gallery as $image ): ?>

							<div class="col">
								<?php //print_r($image); ?>
								<?php $caption = $image['caption']; ?>
								<figure class="gallery-item">
									<a href="<?php echo esc_url($image['url']); ?>" data-fancybox="gallery" data-caption="<?php echo ( $caption ) ? esc_attr( $caption ) : esc_attr( $image['name'] ); ?>"><img class="gallery-img" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" /></a>
								</figure>
							</div>

						<?php endforeach; ?>

					</div>

				</div>

			</div>

		</div>

	</div>

<?php } ?>

<div class="container-fluid">

	<div class="row">

		<div class="col-md-12">

			<!-- Event footer -->
			<div class="wrapper" id="tribe-events-footer">
				<!-- Navigation -->
				<nav class="tribe-events-nav-pagination" aria-label="<?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?>">
					<ul class="tribe-events-sub-nav">
						<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
						<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
					</ul>
					<!-- .tribe-events-sub-nav -->
				</nav>
			</div>
			<!-- #tribe-events-footer -->

		</div>

	</div>

</div>
