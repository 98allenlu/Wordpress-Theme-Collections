<?php
/**
 * LAB functions and definitions
 *
 *
 * @package LAB Theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function lab_remove_http($url) {
    $disallowed = array('http://', 'https://');
    foreach($disallowed as $d) {
        if(strpos($url, $d) === 0) {
            return str_replace($d, '', $url);
        }
    }
    return $url;
}

// Return an alternate title, without prefix, for every type used in the get_the_archive_title().
add_filter('get_the_archive_title', function ($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_post_type_archive() ) {
    	$title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    } else {
        $title = __( 'Archives' );
    }
    return $title;
});

function removeSpecialChars($string) {
    return preg_replace('/[^a-z-]/i', '', str_replace(' ', '-', $string));
}

function lab_substrwords($text, $maxchar, $end='...') {
    if (strlen($text) > $maxchar || $text == '') {
        $words = preg_split('/\s/', $text);      
        $output = '';
        $i      = 0;
        while (1) {
            $length = strlen($output)+strlen($words[$i]);
            if ($length > $maxchar) {
                break;
            } 
            else {
                $output .= " " . $words[$i];
                ++$i;
            }
        }
        $output .= $end;
    } 
    else {
        $output = $text;
    }
    return $output;
}

function lab_closetags($html) {
    preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
    $openedtags = $result[1];
    preg_match_all('#</([a-z]+)>#iU', $html, $result);
    $closedtags = $result[1];
    $len_opened = count($openedtags);
    if (count($closedtags) == $len_opened) {
        return $html;
    }
    $openedtags = array_reverse($openedtags);
    for ($i=0; $i < $len_opened; $i++) {
        if (!in_array($openedtags[$i], $closedtags)) {
            $html .= '</'.$openedtags[$i].'>';
        } else {
            unset($closedtags[array_search($openedtags[$i], $closedtags)]);
        }
    }
    return $html;
}

// Easy way to access template files throughout site!
function lab_get_template($template_name, $args = array(), $template_path = '', $default_path = '')
{
    if ($args && is_array($args)) {
        extract($args);
    }

    $lab_template_path = empty($template_path) ? apply_filters('lab_template_path', 'inc/') : $template_path;

    $template_names = array();
    if (is_array($template_name)) {
        foreach ($template_name as $name) {
            $template_names[] = trailingslashit($lab_template_path) . $name;
            $template_names[] = $name;
        }
    } else {
        $template_names = array(
            trailingslashit($lab_template_path) . $template_name,
            $template_name
        );
    }

    $located = locate_template($template_names);

    // If the file does not exist, do not load anything, get out of here!
    if (!file_exists($located)) {
        return;
    }

    // Allow a hook to overwrite the located file, if need be!
    $located = apply_filters('lab_get_template', $located, $template_name, $args, $lab_template_path, $default_path);

    // Globally add whatever needed before the template, if need be!
    do_action('lab_before_template_part', $template_name, $lab_template_path, $located, $args);

    include($located);

    // Globally add whatever needed after the template, if need be!
    do_action('lab_after_template_part', $template_name, $lab_template_path, $located, $args);
}
