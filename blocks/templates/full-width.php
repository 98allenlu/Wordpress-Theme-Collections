<?php
/**
 * ACF Full Width Container template
 *
 * @package GoodwillNJ2020
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Create id attribute allowing for custom "anchor" value.
$id = 'full-width-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Load values and assing defaults.
$background_color = get_field('background_color') ?: 'light';

// Create class attribute allowing for custom "className" and "align" values.
$className = 'lab-width-full';
$className .= ' bg-' . $background_color;
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<div class="lab-width-full-inner">
    	<InnerBlocks  />
    </div>
</div>
