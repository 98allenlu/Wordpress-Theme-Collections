<?php
/**
 * Publication loop template
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php
$pur_link = get_field( 'link', get_the_ID() );
?>

<article <?php post_class('col-sm-6 padder-sm bottom'); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-content row">

		<div class="col-lg-4">

			<?php echo get_the_post_thumbnail( $post->ID, 'medium' ); ?>

		</div>

		<div class="info col-lg pr-lg-5">

			<h5 class="entry-title mt-3 mt-lg-0"><?php the_title(); ?></h5>

			<?php the_content(); ?>

			<?php if( $pur_link ) { ?>

				<a class="btn btn-outline" href="<?php echo esc_url($pur_link); ?>" target="_blank">Purchase</a>

			<?php } ?>

		</div>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
