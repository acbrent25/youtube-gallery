<?php

// Create custom post type

function yg_register_video(){
    $singular_name = apply_filters('yg_label_single', 'Video');
    $plural_name = apply_filters('yg_label_plural', 'Videos');

    $labels = array(
        'name'                  => $plural_name,
        'singular_name'         => $singular_name,
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New ' .$singular_name,
        'edit'                  => 'Edit',
        'edit_item'             => 'Edit ' .$singular_name,
        'new_item'              => 'New ' . $singular_name,
        'view'                  => 'View ',
        'view_item'             => 'View ' .$singular_name,
        'search_items'          => 'Search ' .$plural_name,
        'not_found'             => 'No ' .$plural_name . ' Found',
        'not_found_in_trahs'    => 'No ' .$plural_name . ' Found',
        'menu_name'             => $plural_name,
    );

    $args = apply_filters('yg_video_args', array(
        'labels'            => $labels,
        'description'       => 'Videos by categor',
        'taxonomies'        => array('category'),
        'public'            => true,
        'show_in_menu'      => true,
        'menu_position'     => 5,
        'menu_icon'         => 'dashicons-video-alt',
        'show_in_nav_menu'  => true,
        'capability_type'   => 'post',
        'supports'          => array(
            'title'
        )
    ));

    // Register Post type
    register_post_type('video', $args);

    
}

add_action('init', 'yg_register_video');