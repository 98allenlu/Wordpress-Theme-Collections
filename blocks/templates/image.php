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

// Load values and assing defaults.
$type = get_field('type') ?: 'shadow-img';
$image_shape = get_field('image_shape') ?: 'img540x540';
$show_caption = get_field('image_caption') ?: 'false';

// Image variables.
$image = get_field('image');
$title = $image['title'];
$alt = $image['alt'];
$caption = $image['caption'];

// Thumbnail size attributes.
$size = $image_shape; //img540x540, img540x360, img360x540
$thumb = $image['sizes'][ $size ]; //url for size

// Create class attribute allowing for custom "className" and "align" values.
$className = 'gw-image';
$className .= ' ' . $type;
$className .= ' cap-show-' . $show_caption;
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

?>
<figure id="<?php echo esc_attr($id); ?>" class="gw-content-img">
	<?php if( !empty( $image ) ): ?>
		<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" class="<?php echo esc_attr($className); ?>" />
		<?php if ( $caption && $show_caption ) {
			echo '<figcaption class="text-center text-sm">' . esc_html( $caption ) . '</figcaption>';
		} ?>
	<?php endif; ?>
</figure>
