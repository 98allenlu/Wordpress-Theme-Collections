<?php
/**
 * ACF Image template
 *
 * @package GoodwillNJ2020
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Create id attribute allowing for custom "anchor" value.
$id = 'gw-image-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Images
$image_one = get_field('image_one');
$title_one = $image_one['title'];
$alt_one = $image_one['alt'];
$thumb_one = $image_one['sizes'][ 'img6x4' ];

$image_two = get_field('image_two');
$title_two = $image_two['title'];
$alt_two = $image_two['alt'];
$thumb_two = $image_two['sizes'][ 'img6x4' ];

$image_three = get_field('image_three');
$title_three = $image_three['title'];
$alt_three = $image_three['alt'];
$thumb_three = $image_three['sizes'][ 'img6x4' ];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'gw-collage-wrapper lab-width-full mb-5';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<div class="gw-collage clearfix">
		<figure class="collage-img collage-img-one">
			<?php if( !empty( $image_one ) ): ?>
				<img src="<?php echo esc_url($thumb_one); ?>" alt="<?php echo esc_attr($alt_one); ?>" class="one shadow-img" />			
			<?php endif; ?>
		</figure>
		<figure class="collage-img collage-img-two">
			<?php if( !empty( $image_two ) ): ?>
				<img src="<?php echo esc_url($thumb_two); ?>" alt="<?php echo esc_attr($alt_two); ?>" class="two shadow-img" />
			<?php endif; ?>
		</figure>
		<figure class="collage-img collage-img-three">
			<?php if( !empty( $image_three ) ): ?>
				<img src="<?php echo esc_url($thumb_three); ?>" alt="<?php echo esc_attr($alt_three); ?>" class="three shadow-img" />
			<?php endif; ?>
		</figure>
	</div>
</section>