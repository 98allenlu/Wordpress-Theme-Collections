<?php
/**
 * 3 Across Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function lab_add_block_categories( $categories, $post ) {

    return array_merge(
        $categories,
        array(
            array(
                'slug'  => 'emt-blocks',
                'title' => esc_html__( 'EMT Blocks', 'labtheme' ),
            ),
        )
    );
}
add_filter( 'block_categories', 'lab_add_block_categories', 10, 2 );

// Enqueue scripts & styles if backend
function lab_acf_block_enqueue_assets() {
    // Backend loading
    if( is_admin() ) {
        wp_enqueue_style('lab_acf_blocks', get_template_directory_uri() . '/blocks/css/blocks.css' );
    }
}