<?php
/**
 * The template for displaying archive pages
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<div class="noImage" id="hero">

	<div class="page-image">

		<div class="hero-content">

			<div class="container-fluid">

				<div class="hero-content-inner">

					<div class="flag-content">
						<div class="flag"></div>
					</div>

					<?php single_cat_title( '<h1>', '</h1>' ); ?>

				</div>

			</div>

		</div>

	</div><!-- .page-image -->

</div><!-- #hero -->

<div class="wrapper" id="archive-wrapper">

	<div class="container-fluid" id="content" tabindex="-1">

		<?php if( get_the_archive_description() ) { ?>

			<div class="row">

				<div class="col-md content-area">

					<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>

				</div>

			</div>

		<?php } ?>

		<div class="row">

			<div class="col-md content-area" id="primary">

				<main class="site-main" id="main">

					<?php if ( have_posts() ) : ?>

						<div class="row">

							<?php while ( have_posts() ) : the_post(); ?>

								<?php get_template_part( 'loop-templates/content', 'video' ); ?>

							<?php endwhile; ?>

						<?php else : ?>

							<?php get_template_part( 'loop-templates/content', 'none' ); ?>

						<?php endif; ?>

					</div>

				</main><!-- #main -->

			</div>

		</div> <!-- .row -->

	</div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php get_footer();
