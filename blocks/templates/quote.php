<?php
/**
 * ACF quote template
 *
 * @package GoodwillNJ2020
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Create id attribute allowing for custom "anchor" value.
$id = 'title-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Load values and assing defaults.
$text = get_field('title_text');

// Create class attribute allowing for custom "className".
$className = 'emt-h';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<h2><?php echo esc_html( $text ); ?></h2>
</div>
