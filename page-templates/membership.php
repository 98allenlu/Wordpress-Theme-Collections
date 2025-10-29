<?php
/**
 * Template Name: Membership
 *
 * Template for displaying the Membership page.
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

$headline = get_field('headline', $current);
$list_items = get_field('list_items', $current);
$right_image = get_field('right_image', $current);

$bottom_headline = get_field('bottom_headline', $current);
$levels = get_field('member_levels', $current);
$bottom_content = get_field('bottom_content', $current);
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

<div class="wrapper" id="page-wrapper">

	<?php if( get_the_content() ) { ?>

		<div class="wrapper bottom" id="content">

			<div class="container-fluid" tabindex="-1">

				<div class="row">

					<div class="col-md">

						<?php the_content(); ?>

					</div>

				</div>

			</div>

		</div>

	<?php } ?>

	<div class="padder bg-lighter" id="benefits-wrapper">

		<div class="container-fluid" tabindex="-1">

			<div class="row">

				<div class="col-md">

					<?php
					printf( wp_kses_post( __( '<h2>%s</h2>', 'labtheme' ) ), $headline );

					if( $list_items ) {

						echo '<div class="row mt-4">';
							echo '<ul class="col-md-6 col-xl-4 list-style-check">';

								$count = count($list_items);
								$chunks = ceil( $count / 2 );
								$i = 1;

								foreach ( $list_items as $list_item ) {
									
									printf( '<li class="pl-4">%1$s</a>',
										esc_html( $list_item['item'] )
									);

									if( $i == $chunks ) {
										echo '</ul><ul class="col-md-6 col-xl-4 list-style-check">';
									}

									$i++;

								}

							echo '</ul>';
						echo '</div>';

					} ?>

				</div>

				<?php if( $right_image ) { ?>

					<figure class="image-right">
						<img src="<?php echo esc_url($right_image['url']); ?>" alt="<?php echo esc_attr($right_image['alt']); ?>" />
					</figure>

				<?php } ?>

			</div>

		</div>

	</div>

	<?php if( $bottom_content || $member_levels ) { ?>

		<div class="container-fluid wrapper" tabindex="-1">

			<div class="row">

				<div class="col-md">

					<?php
					printf( wp_kses_post( __( '<h2>%s</h2>', 'labtheme' ) ), $bottom_headline );

					if( $levels ) { ?>

						<div class="row lab-equal-heights">

							<?php
							foreach( $levels as $level ):

								$member_list = preg_split("/\r\n|\n|\r/", strip_tags($level['member_list']));

								echo '<div class="col-sm-6 col-lg-3">';
									echo '<div class="level card equal">';
										echo '<div class="card-top">';
											echo '<h4 class="card-title">' . $level['title'] . '</h4>';
										echo '</div>';
										echo '<div class="card-body d-flex justify-content-between">';
											echo '<div class="card-text text-sm">';
												if( ! empty( $member_list ) ):
													foreach( $member_list as $list_item ):
														echo '<p class="mb-2">' . wp_kses_post( $list_item ) . '</p>';
													endforeach;
												endif;
											echo '</div>';
											echo '<div class="card-text">';
												echo '<p>$' . esc_html( $level['member_cost'] ) . '</p>';
												echo '<a href="' . esc_url( $level['member_link'] ) . '" class="btn btn-outline w-100 mt-1" target="_blank">' . $level['link_text'] . '</a>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
								?>

							<?php endforeach; ?>

						</div>

					<?php } ?>

					<?php
					if( $bottom_content ) {

						echo apply_filters( 'the_content', wp_kses_post( $bottom_content ) );

					} ?>

				</div>

			</div>

		</div>

	<?php } ?>

</div><!-- #page-wrapper -->

<?php
get_footer();
