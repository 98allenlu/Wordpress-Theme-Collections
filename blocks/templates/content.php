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
//$image_shape = get_field('image_shape') ?: 'img6x4';
$image_shape = 'img6x4';
$align = get_field('align') ?: 'top';
$show_caption = get_field('image_caption') ?: 0;

// Image variables.
$image = get_field('image');
$title = $image['title'];
$alt = $image['alt'];
$caption = $image['caption'];

// Thumbnail size attributes.
$size = $image_shape; //img540x540, img540x360, img360x540
$thumb = $image['sizes'][ $size ]; //url for size

// Create class attribute allowing for custom "className".
$className = 'emt-content';
$className .= ' img-' . $image_location;
$className .= ' v-align-' . $align;
$className .= ' cap-show-' . $show_caption;
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
// Create alignment class
$className2 = 'align-items-lg-' . $align;

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<div class="row">
		<div class="emt-content-inner first col-md-5 justify-content-center <?php echo esc_attr($className2); ?>">
			<figure class="emt-content-img">
				<?php if( !empty( $image ) ): ?>
					<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
					<?php if ( $caption && $show_caption ) {
						echo '<figcaption class="text-center text-sm">' . esc_html( $caption ) . '</figcaption>';
					} ?>
				<?php endif; ?>
			</figure>
	    </div>
	    <div class="emt-content-inner second col-md justify-content-center <?php echo esc_attr($className2); ?>">
	    	<div class="emt-content-text">
	    	
	    		<InnerBlocks  />

	    	</div>
	    </div>
	</div>
</div>
