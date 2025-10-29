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

// Create class attribute allowing for custom "className".
$className = 'emt-content bg-lighter bg-skew';

if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<div class="emt-content-inner">
    	<div class="emt-content-text">
    	
    		<InnerBlocks  />

    	</div>
	</div>
</div>
