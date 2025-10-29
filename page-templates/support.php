<?php
/**
 * Template Name: Support
 *
 * Template for displaying the Support page.
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
$buttons = get_field('dir_buttons', $current);

$bottom_headline = get_field('bottom_headline', $current);
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

				<?php
				if( $buttons ) {

					echo '<div class="row justify-content-center">';

						foreach ( $buttons as $button ) {

							$target = '_self';
							if( $button['new_tab'] ) { $target = '_blank'; }
							
							printf( '<div class="col-sm col-md-6 col-lg-auto"><a class="btn btn-secondary w-100 mt-4" href="%1$s" target="%2$s">%3$s</a></div>',
								esc_url( $button['button_link'] ),
								esc_html( $target ),
								esc_html( $button['button_text'] ),
							);

						}

					echo '</div>';

				} ?>

			</div>

		</div>

	<?php } ?>

	<div class="padder bg-lighter" id="give-options-wrapper">

		<div class="container-fluid" tabindex="-1">

			<div class="row">

				<div class="col-md justify-content-center">

					<?php
					printf( wp_kses_post( __( '<h2>%s</h2>', 'labtheme' ) ), $headline );

					if( $list_items ) {

						echo '<div class="row mt-4">';
							echo '<ul class="col-md-4 list-style-check">';

								$count = count($list_items);
								$chunks = ceil( $count / 3 );
								$i = 1;

								foreach ( $list_items as $list_item ) {
									
									printf( '<li class="pl-4">%1$s</a>',
										esc_html( $list_item['item'] )
									);

									if( ( $i == $chunks ) || ( $i == $chunks * 2 ) ) {
										echo '</ul><ul class="col-md-4 list-style-check">';
									}

									$i++;

								}

							echo '</ul>';
						echo '</div>';

					} ?>

				</div>

			</div>

		</div>

	</div>

	<?php if( $bottom_content ) { ?>

		<div class="container-fluid wrapper" tabindex="-1">

			<div class="row">

				<div class="col-md">

					<?php
					printf( wp_kses_post( __( '<h2>%s</h2>', 'labtheme' ) ), $bottom_headline );

					if( $bottom_content ) {

						echo apply_filters( 'the_content', wp_kses_post( $bottom_content ) );

					} ?>

				</div>

			</div>

		</div>

	<?php } ?>

	<?php lab_get_template('inc/page-builder.php'); ?>

</div><!-- #page-wrapper -->

<?php
get_footer();
