<?php
/**
 * ACF Full Width Container template
 *
 * @package GoodwillNJ2020
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Create id attribute allowing for custom "anchor" value.
$id = 'content-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Load values and assing defaults.
$image_location = get_field('image_location') ?: 'left';
$align = get_field('align') ?: 'top';
$oembed = get_field('oembed');


// Create class attribute allowing for custom "className".
$className = 'gw-content';
$className .= ' img-' . $image_location;
$className .= ' v-align-' . $align;
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
// Create alignment class
$className2 = 'align-items-lg-' . $align;

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<div class="row">
		<div class="gw-content-inner first col-lg-6 <?php echo esc_attr($className2); ?>">
			<figure class="wp-block-embed-youtube wp-block-embed is-type-rich is-provider-embed-handler wp-embed-aspect-16-9 wp-has-aspect-ratio mb-4 mb-lg-0">
				<div class="wp-block-embed__wrapper">

					<?php if( !empty( $oembed ) ) { ?>
						<?php echo the_field('oembed'); ?>
					<?php } else {
						echo 'video missing';
					} ?>

				</div>
			</figure>
	    </div>
	    <div class="gw-content-inner second col-lg <?php echo esc_attr($className2); ?>">
	    	<div class="gw-content-text <?php echo ($image_location == 'left' ? 'ml-md-4' : '' ); ?>">
	    	
	    		<InnerBlocks  />

	    	</div>
	    </div>
	</div>
</div>
