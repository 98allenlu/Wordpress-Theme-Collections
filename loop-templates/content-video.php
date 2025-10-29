<?php
/**
 * Single post partial template
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php
$tube_link  = get_post_meta( get_the_ID(), 'video_id' );
$tube = $tube_link[0];
$vim_link  = get_post_meta( get_the_ID(), 'vimeo_id' );
$vim = $vim_link[0];
?>

<article <?php post_class('col-md-4 padder-sm top'); ?> id="post-<?php the_ID(); ?>">

	<?php // echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php if( $tube ) { ?>

			<a class="fancybox" data-fancybox data-caption="<?php the_title(); ?>" href="https://www.youtube.com/watch?v=<?php echo $tube; ?>?autoplay=1">
				<?php if ( has_post_thumbnail() ) {
					echo '<figure class="img sixteen-nine-img">'; the_post_thumbnail('video'); echo '</figure>';
				} else { ?>
					<figure class="img sixteen-nine-img"><img src="https://img.youtube.com/vi/<?php echo $tube ?>/mqdefault.jpg" alt="<?php the_title(); ?>"></figure>
				<?php } ?>
				<div class="info text-center mt-2 text-decoration-none">
					<h5 class="entry-title"><?php the_title(); ?></h5>
				</div>
			</a>

		<?php } elseif( $vim ) { ?>

			<a class="fancybox" data-fancybox data-caption="<?php the_title(); ?>" href="https://vimeo.com/<?php echo $vim; ?>?background=1">
				<?php if ( has_post_thumbnail() ) {
					echo '<figure class="img sixteen-nine-img">'; the_post_thumbnail('video'); echo '</figure>';
				} else { ?>
					<figure class="img sixteen-nine-img"><img src="http://ts.vimeo.com.s3.amazonaws.com/235/662/<?php echo $tube ?>/_640.jpg" alt="<?php the_title(); ?>"></figure>
				<?php } ?>
				<div class="info text-center mt-2 text-decoration-none">
					<h5 class="entry-title"><?php the_title(); ?></h5>
				</div>
			</a>

			<?php /*
				<figure class="img sixteen-nine-img"><iframe title="vimeo-player" src="https://player.vimeo.com/video/<?php echo $vim; ?>" width="640" height="360" frameborder="0" allowfullscreen></iframe></figure>
				<div class="info text-center text-decoration-none">
					<h5 class="entry-title"><?php the_title(); ?></h5>
				</div>
			*/ ?>

		<?php } else { ?>

			<a href="<?php the_permalink(); ?>" class="text-center" title="<?php the_title(); ?>"><?php the_title(); ?></a>

		<?php } ?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
