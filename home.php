<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<?php
//$current = get_the_ID();
$current = get_option( 'page_for_posts' );
?>

<div class="wrapper" id="title-wrapper">

	<div class="container-fluid">

		<div class="row">

			<div class="col-md" id="title-text">

				<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>

			</div><!-- #title-text -->

		</div>

	</div>

</div><!-- #title-wrapper -->

<div class="wrapper" id="page-wrapper">

	<div class="container-fluid" id="content" tabindex="-1">

		<div class="row">

			<div class="col-md content-area" id="primary">

				<main class="site-main">

					<div class="row">

						<?php
						while ( have_posts() ) {
							the_post();
							get_template_part( 'loop-templates/content', 'blog' );
						} ?>

					</div>

				</main><!-- #main -->

				<!-- The pagination component -->
				<?php labtheme_pagination(); ?>

			</div>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
