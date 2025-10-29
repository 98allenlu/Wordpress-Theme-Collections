<?php
/**
 * ACF stories template
 *
 * @package GoodwillNJ2020
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$count = get_field('count') ?: '3';
$equal = get_field('equal');
$background_color = get_field('background_color') ?: 'dark';

// Create class attribute allowing for custom "className".
$className = 'slick-stories';
$className .= ' bg-' . $background_color;
if( $equal == TRUE ) {
	$className .= ' ' . 'lab-equal-heights';
}
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

$args = array( 
    'orderby' => array( 'date' => 'DESC', 'menu_order' => 'ASC' ),
    'post_type' => 'gw_stories',
    'posts_per_page' => $count
);

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) : ?>

	<div id="slick-stories" class="<?php echo esc_attr($className); ?>">

		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

			<div class="story-wrapper">
				<div class="story equal">
					<div class="story-content">
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail('img270x270', ['class' => 'img-story rounded-circle']);
						} else {
							echo '<img width="270" height="270" src="/wp-content/uploads/2020/10/fpo-headshot.jpg" class="img-story rounded-circle" alt="Headshot FPO">';
						} ?>
						<?php the_content(); ?>
					</div>
					<div class="story-author mt-3">
						<b><?php the_title(); ?></b><br>
						<small><i><?php the_field('title', get_the_ID()); ?></i></small>
					</div>
				</div>
			</div>

		<?php endwhile; ?>

	</div>

<?php endif; ?>
