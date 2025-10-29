<?php
/**
 * Template Name: Wide Page
 *
 * @package GoodwillNJ2020
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="page-title title" id="page-title">

	<div class="container-fluid">

		<div class="row">

			<div class="col-12">

				<header id="page-header">

					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

				</header><!-- #page-header -->

			</div>

		</div>

	</div>

</div>

<?php lab_display_submenu( 'Main Menu' ) ?>

<div class="wrapper-top" id="content-wrapper">

	<div class="container-fluid" id="content" tabindex="-1">

		<div class="row">

			<div class="col-md content-area" id="primary">

				<main class="site-main" id="main">

					<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'loop-templates/content', 'page' );
					}
					?>

				</main><!-- #main -->

			</div>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
