<?php
/**
 * ACF Button template
 *
 * @package GoodwillNJ2020
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Create id attribute allowing for custom "anchor" value.
$id = 'button-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Load values and assing defaults.
$text = get_field('text') ?: 'Learn More';
$link = get_field('link') ?: '#';
//$type = get_field('type') ?: 'primary';
$type = 'primary';
$target = get_field('target') ?: FALSE;

// Create class attribute allowing for custom "className" and "align" values.
$className = 'btn';
$className .= ' btn-' . $type;
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

?>
<a href="<?php echo esc_url( $link ); ?>" id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>"<?php echo ($target === TRUE ? ' target="_blank"' : '' ); ?>>
    <?php echo esc_html( $text ); ?>
</a>
