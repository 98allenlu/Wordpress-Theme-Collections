<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class('col-md-4'); ?> id="post-<?php the_ID(); ?>">

		<div class="card">
			<?php if ( has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<div class="card-image wide"><?php the_post_thumbnail('large'); ?></div>
				</a>
			<?php endif; ?>
			<div class="card-body">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><h4 class="mt-2 mb-0"><?php the_title(); ?></h4></a>
				<time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished" class="single-meta"><?php echo get_the_date(); ?></time>
				<p class="mt-2 mb-0"><?php echo get_the_excerpt(); ?></p>
			</div>
		</div>

</article><!-- #post-## -->
