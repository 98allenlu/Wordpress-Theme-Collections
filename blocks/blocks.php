<?php
/**
 * ACF extras
 *
 * @package GoodwillNJ2020
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action('acf/init', 'lab_acf_init_block_types');
function lab_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        acf_register_block_type(array(
            'name'              => 'emt-button',
            'title'             => __('EMT Button', 'labtheme'),
            'description'       => __('A custom EMT button.', 'labtheme'),
            'render_template'   => '/blocks/templates/button.php',
            'enqueue_assets'    => 'lab_acf_block_enqueue_assets',
            'category'          => 'emt-blocks',
            'mode'              => 'preview',
            'align'             => 'full',
            'align_text'        => 'center',
            'align_content'     => 'center',
            'icon'              => 'admin-comments',
            'keywords'          => array('EMT Button','Button','EMT'),
            'supports'          => array(
                'mode' => false,
                'multiple' => true,
                'LinkControl' => true,
            ),
        ));

        acf_register_block_type(array(
            'name'              => 'emt-title',
            'title'             => __('EMT Heading block'),
            'description'       => __('A custom EMT Heading.'),
            'render_template'   => '/blocks/templates/title.php',
            'enqueue_assets'    => 'lab_acf_block_enqueue_assets',
            'category'          => 'emt-blocks',
            'mode'              => 'auto',
            'align'             => 'full',
            'icon'              => 'admin-comments',
            'keywords'          => array('EMT Title','Title','Heading','EMT'),
            'supports'          => array(
                'anchor' => true,
            ),
        ));

        acf_register_block_type(array(
            'name'              => 'emt-content',
            'title'             => __('EMT Image & Text container', 'labtheme'),
            'description'       => __('A custom EMT container.', 'labtheme'),
            'render_template'   => '/blocks/templates/content.php',
            'enqueue_assets'    => 'lab_acf_block_enqueue_assets',
            'category'          => 'emt-blocks',
            'mode'              => 'preview',
            'align'             => 'full',
            'icon'              => 'admin-comments',
            'keywords'          => array('EMT Content','Image','EMT'),
            'supports'          => array(
                'mode' => false,
                'multiple' => true,
                'jsx' => true,
            ),
        ));

        acf_register_block_type(array(
            'name'              => 'emt-content-plain',
            'title'             => __('EMT Gray BG container', 'labtheme'),
            'description'       => __('A custom EMT container.', 'labtheme'),
            'render_template'   => '/blocks/templates/content-noimage.php',
            'enqueue_assets'    => 'lab_acf_block_enqueue_assets',
            'category'          => 'emt-blocks',
            'mode'              => 'preview',
            'align'             => 'full',
            'icon'              => 'admin-comments',
            'keywords'          => array('EMT Content','Gray','EMT'),
            'supports'          => array(
                'align_content' => true,
                'mode' => false,
                'multiple' => true,
                'jsx' => true,
            ),
        ));

    }
}
