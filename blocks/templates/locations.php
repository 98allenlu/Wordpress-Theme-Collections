<?php
/**
 * ACF locations template
 *
 * @package GoodwillNJ2020
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Create id attribute allowing for custom "anchor" value.
$id = 'locations-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Load values and assing defaults.
$headline = get_field('headline');
$text = get_field('text');
$button_text = get_field('button_text');
$button_link = get_field('button_link');

// Create class attribute allowing for custom "className" and "align" values.
$className = 'locations-wrapper lab-width-full';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<div class="locations-wrapper-inner">
		<div class="lab-width-full-inner">
			<div class="row">
				<div class="col-sm-3 col-md-4 d-flex align-items-center justify-content-center justify-content-sm-end">
					<img class="m-2" src="<?php echo get_template_directory_uri(); ?>/img/pin-3.png" width="113" height="150"></a>
				</div>
				<div class="col-sm-9 col-md-8">
					<div class="locations-content">
						<h3><?php echo esc_html( $headline ); ?></h3>
					    <p><?php echo esc_html( $text ); ?></p>
					    <a href="<?php echo esc_html( $button_link ); ?>" class="btn btn-outline-light"><?php echo esc_html( $button_text ); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
