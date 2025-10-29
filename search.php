<?php
/**
 * The template for displaying search results pages
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<div id="search-wrapper">

	<div id="title-area">

		<div class="container-fluid" tabindex="-1">

			<div class="row">

				<div class="col-md">

					<h1 class="entry-title">
						<?php
						printf(
							/* translators: %s: query term */
							esc_html__( 'Search Results for: %s', 'understrap' ),
							'<span>' . get_search_query() . '</span>'
						);
						?>
					</h1>

				</div>

			</div>

		</div>

	</div>

	<div class="container-fluid" id="content" tabindex="-1">

		<div class="row">

			<div class="col-md content-area" id="primary">

				<main class="site-main wrapper" id="main">

					<?php if ( have_posts() ) : ?>

						<div class="row">

							<?php
							while ( have_posts() ) {
								the_post();

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'loop-templates/content', 'search' );
							} ?>

						</div>

					<?php else : ?>

						<?php get_template_part( 'loop-templates/content', 'none' ); ?>

					<?php endif; ?>

				</main><!-- #main -->

			</div>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #search-wrapper -->

<?php
get_footer();
