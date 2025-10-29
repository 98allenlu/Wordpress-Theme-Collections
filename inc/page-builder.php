<?php
/**
 * Page Builder File
 *
 * @package LAB Theme
 */

defined('ABSPATH') || exit;

$page_builder = pageBuilder();

if (isset($page_builder)) :

    echo '<div id="builder-wrapper">';

        foreach ($page_builder as $module) :
            $path = '';
            switch ($module->module_type) {
                case 'image_full_module':
                    $path = 'modules/image-full-module.php';
                    break;
                case 'image_text_module':
                    $path = 'modules/image-text-module.php';
                    break;
                case 'three_col_module':
                    $path = 'modules/three-col-module.php';
                    break;
                case 'two_col_module':
                    $path = 'modules/two-col-module.php';
                    break;
                case 'gallery_module':
                    $path = 'modules/gallery-module.php';
                    break;
                case 'wysiwyg_module':
                    $path = 'modules/wysiwyg-module.php';
                    break;
                default:
                    break;
            }
            if (!empty($path)) {
                lab_get_template($path, array('module' => $module));
            }

        endforeach;

    echo '</div>';

endif;
