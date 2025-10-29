<?php
/**
 * Custom Post Types
 *
 * @package labtheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'init', 'lab_register_cpt' );
function lab_register_cpt() {

    register_post_type(
        'lab_loc', array(
            'labels' => array(
                'name' => _x( __( 'Our Locations', 'labtheme' ), 'lab_loc' ),
                'singular_name' => _x( 'Location', 'labtheme' ),
                'add_new' => _x( 'Add New', 'labtheme' ),
                'add_new_item' => _x( 'Add New', 'labtheme' ),
                'edit_item' => _x( 'Edit', 'labtheme' ),
                'new_item' => _x( 'New', 'labtheme' ),
                'view_item' => _x( 'View', 'labtheme' ),
                'search_items' => _x( 'Search', 'labtheme' ),
                'not_found' => _x( 'None found', 'labtheme' ),
                'not_found_in_trash' => _x( 'None found in Trash', 'labtheme' ),
                'parent_item_colon' => _x( 'Parent Location:', 'labtheme' ),
                'menu_name' => _x( 'Locations', 'labtheme' ),
            ),
            'hierarchical' => FALSE,
            'description' => 'Locations custom post type',
            'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail', 'page-attributes' ),
            'public' => TRUE,
            'show_ui' => TRUE,
            'show_in_menu' => TRUE,
            'show_in_nav_menus' => TRUE,
            'publicly_queryable' => TRUE,
            'exclude_from_search' => TRUE,
            'has_archive' => TRUE,
            'menu_icon' => 'dashicons-store',
            'query_var' => TRUE,
            'can_export' => TRUE,
            'show_in_rest' => TRUE,
            'rewrite' => array("slug" => "locations"),
            'capability_type' => 'post',
        )
    );

}

add_action( 'init', 'register_cpt_lab_video' );
function register_cpt_lab_video() {

    $labels = array(
        'name' => _x( __( 'Videos', 'labtheme' ), 'lab_video' ),
        'singular_name' => _x( __( 'Video', 'labtheme' ), 'lab_video' ),
        'add_new' => _x( 'Add New', 'labtheme' ),
        'add_new_item' => _x( 'Add New Video', 'labtheme' ),
        'edit_item' => _x( 'Edit', 'labtheme' ),
        'new_item' => _x( 'New', 'labtheme' ),
        'view_item' => _x( 'View', 'labtheme' ),
        'search_items' => _x( 'Search', 'labtheme' ),
        'not_found' => _x( 'None found', 'labtheme' ),
        'not_found_in_trash' => _x( 'None found in Trash', 'labtheme' ),
        'parent_item_colon' => _x( 'Parent Videos:', 'labtheme' ),
        'menu_name' => _x( 'Videos', 'labtheme' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => FALSE,
        'description' => 'Videos custom post type',
        'supports' => array( 'title', 'excerpt', 'custom-fields', 'thumbnail', 'page-attributes', ),
        'public' => TRUE,
        'show_ui' => TRUE,
        'show_in_menu' => TRUE,
        'show_in_nav_menus' => FALSE,
        'publicly_queryable' => TRUE,
        'exclude_from_search' => FALSE,
        'has_archive' => FALSE,
        'menu_icon' => 'dashicons-video-alt3',
        'query_var' => TRUE,
        'can_export' => TRUE,
        'show_in_rest' => FALSE,
        'rewrite' => array("slug" => "videos"),
        'capability_type' => 'post',
    );

    register_post_type( 'lab_video', $args );
}

add_action( 'init', 'register_cpt_lab_exhibit' );
function register_cpt_lab_exhibit() {

    $labels = array(
        'name' => _x( __( 'Exhibits', 'labtheme' ), 'lab_exhibit' ),
        'singular_name' => _x( __( 'Exhibit', 'labtheme' ), 'lab_exhibit' ),
        'add_new' => _x( 'Add New', 'labtheme' ),
        'add_new_item' => _x( 'Add New Exhibit', 'labtheme' ),
        'edit_item' => _x( 'Edit', 'labtheme' ),
        'new_item' => _x( 'New', 'labtheme' ),
        'view_item' => _x( 'View', 'labtheme' ),
        'search_items' => _x( 'Search', 'labtheme' ),
        'not_found' => _x( 'None found', 'labtheme' ),
        'not_found_in_trash' => _x( 'None found in Trash', 'labtheme' ),
        'parent_item_colon' => _x( 'Parent Exhibits:', 'labtheme' ),
        'menu_name' => _x( 'Exhibits', 'labtheme' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => FALSE,
        'description' => 'Exhibits custom post type',
        'supports' => array( 'title', 'excerpt', 'editor', 'custom-fields', 'thumbnail', 'page-attributes', ),
        'public' => TRUE,
        'show_ui' => TRUE,
        'show_in_menu' => TRUE,
        'show_in_nav_menus' => TRUE,
        'publicly_queryable' => TRUE,
        'exclude_from_search' => FALSE,
        'has_archive' => FALSE,
        'menu_icon' => 'dashicons-visibility',
        'query_var' => TRUE,
        'can_export' => TRUE,
        'show_in_rest' => FALSE,
        'rewrite' => array("slug" => "exhibits"),
        'capability_type' => 'post',
    );

    register_post_type( 'lab_exhibit', $args );
}

add_action( 'init', 'register_cpt_lab_tour' );
function register_cpt_lab_tour() {

    $labels = array(
        'name' => _x( __( 'Tours', 'labtheme' ), 'lab_exhibit' ),
        'singular_name' => _x( __( 'Tour', 'labtheme' ), 'lab_exhibit' ),
        'add_new' => _x( 'Add New', 'labtheme' ),
        'add_new_item' => _x( 'Add New Tour', 'labtheme' ),
        'edit_item' => _x( 'Edit', 'labtheme' ),
        'new_item' => _x( 'New', 'labtheme' ),
        'view_item' => _x( 'View', 'labtheme' ),
        'search_items' => _x( 'Search', 'labtheme' ),
        'not_found' => _x( 'None found', 'labtheme' ),
        'not_found_in_trash' => _x( 'None found in Trash', 'labtheme' ),
        'parent_item_colon' => _x( 'Parent Tours:', 'labtheme' ),
        'menu_name' => _x( 'Tours', 'labtheme' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => FALSE,
        'description' => 'Tours custom post type',
        'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail', 'page-attributes', ),
        'public' => TRUE,
        'show_ui' => TRUE,
        'show_in_menu' => TRUE,
        'show_in_nav_menus' => FALSE,
        'publicly_queryable' => FALSE,
        'exclude_from_search' => FALSE,
        'has_archive' => FALSE,
        'menu_icon' => 'dashicons-camera-alt',
        'query_var' => TRUE,
        'can_export' => TRUE,
        'show_in_rest' => FALSE,
        'rewrite' => array("slug" => "tours"),
        'capability_type' => 'post',
    );

    register_post_type( 'lab_tour', $args );
}

add_action( 'init', 'register_cpt_lab_publication' );
function register_cpt_lab_publication() {

    $labels = array(
        'name' => _x( __( 'Publications', 'labtheme' ), 'lab_exhibit' ),
        'singular_name' => _x( __( 'Publication', 'labtheme' ), 'lab_exhibit' ),
        'add_new' => _x( 'Add New', 'labtheme' ),
        'add_new_item' => _x( 'Add New Publication', 'labtheme' ),
        'edit_item' => _x( 'Edit', 'labtheme' ),
        'new_item' => _x( 'New', 'labtheme' ),
        'view_item' => _x( 'View', 'labtheme' ),
        'search_items' => _x( 'Search', 'labtheme' ),
        'not_found' => _x( 'None found', 'labtheme' ),
        'not_found_in_trash' => _x( 'None found in Trash', 'labtheme' ),
        'parent_item_colon' => _x( 'Parent Publications:', 'labtheme' ),
        'menu_name' => _x( 'Publications', 'labtheme' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => FALSE,
        'description' => 'Publications custom post type',
        'supports' => array( 'title', 'excerpt', 'editor', 'custom-fields', 'thumbnail', 'page-attributes', ),
        'public' => TRUE,
        'show_ui' => TRUE,
        'show_in_menu' => TRUE,
        'show_in_nav_menus' => FALSE,
        'publicly_queryable' => FALSE,
        'exclude_from_search' => FALSE,
        'has_archive' => FALSE,
        'menu_icon' => 'dashicons-book',
        'query_var' => TRUE,
        'can_export' => TRUE,
        'show_in_rest' => FALSE,
        'rewrite' => array("slug" => "publications"),
        'capability_type' => 'post',
    );

    register_post_type( 'lab_publication', $args );
}

add_action( 'init', 'lab_create_taxonomies' );
function lab_create_taxonomies() {

    $labels = array(
        'name' => _x( 'Category', 'taxonomy general name', 'labtheme' ),
        'singular_name' => _x( 'Category', 'taxonomy singular name', 'labtheme' ),
        'search_items' => __( 'Search Categories', 'labtheme' ),
        'all_items' => __( 'All Categories', 'labtheme' ),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __( 'Edit', 'labtheme' ),
        'update_item' => __( 'Update', 'labtheme' ),
        'add_new_item' => __( 'Add New', 'labtheme' ),
        'new_item_name' => __( 'New Category Name', 'labtheme' ),
        'separate_items_with_commas' => __( 'Separate Categories with commas', 'labtheme' ),
        'add_or_remove_items' => __( 'Add or remove Categories', 'labtheme' ),
        'choose_from_most_used' => __( 'Choose from the most used Category', 'labtheme' ),
        'not_found' => __( 'No Categories found.', 'labtheme' ),
        'menu_name' => __( 'Categories', 'labtheme' ),
    );
 
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'show_in_rest' => true,
        'rewrite' => array( 'slug' => 'video-categories' ),
    );
 
    register_taxonomy( 'vid_category', 'lab_video', $args );

    unset( $args );
    unset( $labels );

    $labels = array(
        'name' => _x( 'Types', 'taxonomy general name', 'labtheme' ),
        'singular_name' => _x( 'Type', 'taxonomy singular name', 'labtheme' ),
        'search_items' => __( 'Search Types', 'labtheme' ),
        'all_items' => __( 'All Types', 'labtheme' ),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __( 'Edit', 'labtheme' ),
        'update_item' => __( 'Update', 'labtheme' ),
        'add_new_item' => __( 'Add New', 'labtheme' ),
        'new_item_name' => __( 'New Type Name', 'labtheme' ),
        'separate_items_with_commas' => __( 'Separate Types with commas', 'labtheme' ),
        'add_or_remove_items' => __( 'Add or remove Types', 'labtheme' ),
        'choose_from_most_used' => __( 'Choose from the most used Type', 'labtheme' ),
        'not_found' => __( 'No Types found.', 'labtheme' ),
        'menu_name' => __( 'Types', 'labtheme' ),
    );
 
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'show_in_rest' => true,
        'rewrite' => array( 'slug' => 'publication-types' ),
    );
 
    register_taxonomy( 'pub_type', 'lab_publication', $args );

}

