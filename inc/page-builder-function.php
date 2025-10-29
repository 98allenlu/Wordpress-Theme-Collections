<?php
/**
 * Page Builder Function
 *
 * @package LAB Theme
 */

defined('ABSPATH') || exit;

function pageBuilder() {

    if (have_rows('page_builder')) {

        $page_builder = get_field('page_builder');

        $data = [];

        foreach ($page_builder as $module) {

            $module_data = [];
            switch ($module['acf_fc_layout']) {
                case 'image_full_module':
                    $module_data = [
                        'module_type' => $module['acf_fc_layout'],
                        'link_id' => removeSpecialChars( strtolower($module['link_id'])),
                        'custom_container_classes' => $module['custom_container_classes'],
                        'image' => $module['image']
                    ];
                    break;
                case 'image_text_module':
                    $module_data = [
                        'module_type' => $module['acf_fc_layout'],
                        'link_id' => removeSpecialChars( strtolower($module['link_id'])),
                        'custom_container_classes' => $module['custom_container_classes'],
                        'image_side' => $module['image_side'],
                        'title' => $module['title'],
                        'copy' => $module['copy'],
                        'image' => $module['image']
                    ];
                    break;
                case 'three_col_module':
                    $module_data = [
                        'module_type' => $module['acf_fc_layout'],
                        'link_id' => removeSpecialChars( strtolower($module['link_id'])),
                        'custom_container_classes' => $module['custom_container_classes'],
                        'title' => $module['title'],
                        'color_bg' => $module['color_bg'],
                        'image_1' => $module['col_1']['image_1'],
                        'copy_1' => $module['col_1']['copy_1'],
                        'image_2' => $module['col_2']['image_2'],
                        'copy_2' => $module['col_2']['copy_2'],
                        'image_3' => $module['col_3']['image_3'],
                        'copy_3' => $module['col_3']['copy_3']
                    ];
                    break;
                case 'two_col_module':
                    $module_data = [
                        'module_type' => $module['acf_fc_layout'],
                        'link_id' => removeSpecialChars( strtolower($module['link_id'])),
                        'custom_container_classes' => $module['custom_container_classes'],
                        'title' => $module['title'],
                        'color_bg' => $module['color_bg'],
                        'image_1' => $module['col_1']['image_1'],
                        'copy_1' => $module['col_1']['copy_1'],
                        'image_2' => $module['col_2']['image_2'],
                        'copy_2' => $module['col_2']['copy_2']
                    ];
                    break;
                case 'gallery_module':
                    $module_data = [
                        'module_type' => $module['acf_fc_layout'],
                        'link_id' => removeSpecialChars( strtolower($module['link_id'])),
                        'custom_container_classes' => $module['custom_container_classes'],
                        'title' => $module['title'],
                        'gallery_images' => $module['gallery_images'],
                    ];
                    break;
                case 'wysiwyg_module':
                    $module_data = [
                        'module_type' => $module['acf_fc_layout'],
                        'link_id' => removeSpecialChars( strtolower($module['link_id'])),
                        'custom_container_classes' => $module['custom_container_classes'],
                        'title' => $module['title'],
                        'wysiwyg' => $module['wysiwyg']
                    ];
                    break;
                default:
                    break;
            }
            
            $this_module = (object) $module_data;
            array_push($data, $this_module);

        }

        $data = (object) $data;

        return $data;

    }
}
