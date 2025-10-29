<?php
/**
 * ACF quote template
 *
 * @package GoodwillNJ2020
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Create id attribute allowing for custom "anchor" value.
$id = 'faq-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Load values and assing defaults.
$answer = apply_filters( 'acf_the_content', get_field('answer') );
$question = get_field('question');

// Create class attribute allowing for custom "className" and "align" values.
$className = 'accordion';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

?>

<div class="faq-wrapper <?php echo esc_attr($className); ?>">
	<a data-toggle="collapse" href="#<?php echo esc_attr($id); ?>" role="button" aria-expanded="false" aria-controls="<?php echo esc_attr($id); ?>" class="collapsed">
		<div class="faq-question-wrapper">
			<h4 class="faq-question"><?php echo $question; ?></h4>
			<div class="faq-cross">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>cross</title><rect id="cross-vert" x="9" width="2" height="20" fill="#7BC143" style=""></rect><rect y="9" width="20" height="2" fill="#7BC143"></rect></svg>
			</div>
	    </div>
    </a>
    <div class="faq-answer collapse" id="<?php echo esc_attr($id); ?>">
    	<span><?php echo $answer; ?></span>
    </div>
</div>