<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<?php 
$current = get_the_ID();
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

				<?php the_content(); ?>

			</div><!-- #content -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
