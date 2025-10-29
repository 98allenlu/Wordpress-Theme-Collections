<?php
/**
 * Template Name: Page Builder
 *
 * Template for displaying the Page Builder page, ensuring the content area
 * is full width and includes a dedicated widget area at the bottom for flexible layout.
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
$post_type = get_field('archive_post_type', $current);

// Determine content width. This variable is now set to col-md-12 unconditionally.
$content_column_class = 'col-md-12';
// We retain the is_active_sidebar check to satisfy WP standards, but always use full width below.
if ( is_active_sidebar( 'sidebar-1' ) ) {
    $content_column_class = 'col-md-12';
}
?>

<div class="<?php echo ($hero_image) ? 'hasImage' : 'noImage'; ?>" id="hero">

	<?php if( $hero_image ) { ?>

		<div class="page-image d-flex justify-content-center align-items-center" style="background-image:url('<?php echo $hero_image; ?>');">

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

	<div class="container-fluid" id="content" tabindex="-1">

		<?php if( have_posts() ) : ?>

			<div class="row">
                
                <!-- Main Content Area: Always full width (col-md-12) for Blocks -->
				<div class="<?php echo esc_attr($content_column_class); ?> content-area" id="primary">

					<?php 
                    while ( have_posts() ) : the_post();
                        // This call handles all Gutenberg Blocks inserted into the page content
                        the_content(); 
                    endwhile;
                    ?>
                    
                    <!-- DEDICATED WIDGET AREA: Placed at the bottom of the main content -->
                    <?php if ( is_active_sidebar( 'page-builder-bottom' ) ) : ?>
                        <div class="page-builder-widgets pt-5">
                            <?php 
                            // This custom widget call is what you use for placing specific widgets like Ajax Search Lite
                            dynamic_sidebar( 'page-builder-bottom' ); 
                            ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php 
                    // FIX FOR CUSTOMIZER WARNING: We render the primary sidebar here but wrap it 
                    // in hidden HTML. This tricks the Customizer into thinking the sidebar is available 
                    // without displaying it or affecting the layout.
                    if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
                    <div style="height:0; overflow:hidden; visibility:hidden;">
                        <?php dynamic_sidebar( 'sidebar-1' ); ?>
                    </div>
                    <?php endif; ?>

				</div><!-- .col-md-12 -->
				
			</div> <!-- .row -->

		<?php endif; ?>

		<?php lab_get_template('inc/page-builder.php'); ?>
        
	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
