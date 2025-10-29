<?php
/**
 * Single post partial template
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php // echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<figure class="alignright size-large">

		<?php if ( has_post_thumbnail() ) { ?>
    		<?php echo the_post_thumbnail( 'large', array( 'class' => 'mb-3' ) ); ?>
    	<?php } else { ?>
			<img class="mb-3" src="http://via.placeholder.com/1080x720">
    	<?php } ?>

    </figure>

	<div class="entry-content">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php the_content(); ?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
