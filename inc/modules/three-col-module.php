<?php
$colorbg = FALSE;
$image_1 = wp_get_attachment_image($module->image_1, 'full');
$image_2 = wp_get_attachment_image($module->image_2, 'full');
$image_3 = wp_get_attachment_image($module->image_3, 'full');
$color = $module->color_bg;
if ($color && $color != '#FFFFFF') {
	$colorbg = TRUE;
}
?>

<div class="cta-module module <?php echo ($colorbg) ? 'padder' : 'wrapper bottom'; ?> <?= $module->custom_container_classes ?> <?php echo ($colorbg) ? 'mt-lab' : ''; ?>" style="background-color:<?php echo ($colorbg) ? $color : 'transparent'; ?>">

	<div class="container-fluid">

		<div class="row">

			<div class="col-md">

				<?php
				if($module->title) { ?>

					<h3 class="title"><?php echo apply_filters( 'the_title', wp_kses_post( $module->title )); ?></h3>

				<?php } ?>

			</div>

		</div>

		<div class="row">

			<div class="col-md-4">

				<?php
				if($image_1) { ?>

					<figure class="sixteen-nine-img">
						<?php echo $image_1; ?>
					</figure>

				<?php } ?>

				<?php echo apply_filters( 'the_content', wp_kses_post( $module->copy_1 ) ); ?>

			</div>

			<div class="col-md-4">

				<?php
				if($image_2) { ?>

					<figure class="sixteen-nine-img">
						<?php echo $image_2; ?>
					</figure>

				<?php } ?>

				<?php echo apply_filters( 'the_content', wp_kses_post( $module->copy_2 ) ); ?>

			</div>

			<div class="col-md-4">

				<?php
				if($image_3) { ?>

					<figure class="sixteen-nine-img">
						<?php echo $image_3; ?>
					</figure>

				<?php } ?>

				<?php echo apply_filters( 'the_content', wp_kses_post( $module->copy_3 ) ); ?>

			</div>

		</div>

	</div>

</div>