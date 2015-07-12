<?php
add_action('init', 'vc4g_purchased_item_init');
function vc4g_purchased_item_init()
{
    $labels = array(
        'name' => _x('Purchased items', 'post type general name', 'vc4g'),
        'singular_name' => _x('Purchased item', 'post type singular name', 'vc4g'),
        'menu_name' => _x('Purchased items', 'admin menu', 'vc4g'),
        'name_admin_bar' => _x('Purchased item', 'add new on admin bar', 'vc4g'),
        'add_new' => _x('Add New', 'purchased_item', 'vc4g'),
        'add_new_item' => __('Add New Purchased item', 'vc4g'),
        'new_item' => __('New Purchased item', 'vc4g'),
        'edit_item' => __('Edit Purchased item', 'vc4g'),
        'view_item' => __('View Purchased item', 'vc4g'),
        'all_items' => __('All Purchased items', 'vc4g'),
        'search_items' => __('Search Purchased items', 'vc4g'),
        'parent_item_colon' => __('Parent Purchased items:', 'vc4g'),
        'not_found' => __('No purchased items found.', 'vc4g'),
        'not_found_in_trash' => __('No purchased items found in Trash.', 'vc4g')
    );

    $args = array(
        'labels' => $labels,
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => false,
        'rewrite' => false,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'author', 'revisions')
    );

    register_post_type('purchased_item', $args);
}