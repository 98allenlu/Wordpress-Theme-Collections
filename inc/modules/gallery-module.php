<?php
$gallery_images_array = $module->gallery_images;
?>

<div class="wrapper <?php echo $module->custom_container_classes; ?>">

	<div class="container-fluid" id="gallery-wrapper">

		<?php if( $gallery_images_array ) { ?>

			<div class="row">
				<div class="col-md">

					<div class="slick-gallery lab-equal-heights row">

						<?php foreach ($gallery_images_array as $gallery_image) { ?>

							<div class="col">
								<?php //print_r($image); ?>
								<?php $caption = $gallery_image['caption']; ?>
								<figure class="gallery-item">
									<a href="<?php echo esc_url($gallery_image['url']); ?>" data-fancybox="gallery" data-caption="<?php echo ( $caption ) ? esc_attr( $caption ) : esc_attr( $gallery_image['name'] ); ?>"><img class="gallery-img" src="<?php echo esc_url($gallery_image['sizes']['img6x4']); ?>" alt="<?php echo esc_attr($gallery_image['alt']); ?>" width="<?php echo esc_attr($gallery_image['width']); ?>" height="<?php echo esc_attr($gallery_image['height']); ?>" /></a>
								</figure>
							</div>

						<?php } ?>

					</div>

				</div>
			</div>

		<?php } ?>

	</div>

</div>
