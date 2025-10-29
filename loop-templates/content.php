<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$current = get_the_ID();
$link = get_permalink();
$address_one = get_field('address_one', $current);
$address_two = get_field('address_two', $current);
?>

<article <?php post_class('col-md-4 padder-sm top'); ?> id="post-<?php the_ID(); ?>">

	<div class="location card equal">

		<section class="card-img-top">

			<figure>

				<?php if ( has_post_thumbnail() ) { ?>
		    		<?php echo the_post_thumbnail( 'img6x4', array( 'class' => '' ) ); ?>
		    	<?php } else { ?>
					<img src="http://via.placeholder.com/1080x720">
		    	<?php } ?>

		    </figure>
			
		</section>

		<section class="card-body d-flex justify-content-between">

			<div>
				<?php
				the_title(
					sprintf( '<h4 class="card-title">', esc_url( get_permalink() ) ),
					'</h4>'
				);
				?>

				<p class="card-text text-sm">
					<?php echo esc_html( $address_one ); ?><br>
					<?php echo esc_html( $address_two ); ?>
				</p>
			</div>

			<a href="<?php echo esc_url( $link ) ?>" class="btn btn-outline">Learn More</a>

		</section>

	</div>

</article><!-- #post-## -->
