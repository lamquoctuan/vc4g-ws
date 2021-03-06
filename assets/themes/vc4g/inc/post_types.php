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

// hook into the init action and call create_price_taxonomies when it fires
add_action( 'init', 'create_price_taxonomies', 0 );

function create_price_taxonomies() {
    $labels = array(
        'name'              => _x( 'Rates', 'taxonomy general name' ),
        'singular_name'     => _x( 'Rate', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Rates' ),
        'all_items'         => __( 'All Rates' ),
        'parent_item'       => __( 'Parent Rate' ),
        'parent_item_colon' => __( 'Parent Rate:' ),
        'edit_item'         => __( 'Edit Rate' ),
        'update_item'       => __( 'Update Rate' ),
        'add_new_item'      => __( 'Add New Rate' ),
        'new_item_name'     => __( 'New Rate Name' ),
        'menu_name'         => __( 'Rate' ),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'			=> false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => false,
        'rewrite'           => false,
    );

    register_taxonomy( 'rate', array( 'price' ), $args );
}

add_action( 'init', 'vc4g_price_init' );
/**
 * Register a price post type.
 *
 */
function vc4g_price_init() {
    $labels = array(
        'name'               => _x( 'Prices', 'post type general name', 'vc4g' ),
        'singular_name'      => _x( 'Price', 'post type singular name', 'vc4g' ),
        'menu_name'          => _x( 'Prices', 'admin menu', 'vc4g' ),
        'name_admin_bar'     => _x( 'Price', 'add new on admin bar', 'vc4g' ),
        'add_new'            => _x( 'Add New', 'price', 'vc4g' ),
        'add_new_item'       => __( 'Add New Price', 'vc4g' ),
        'new_item'           => __( 'New Price', 'vc4g' ),
        'edit_item'          => __( 'Edit Price', 'vc4g' ),
        'view_item'          => __( 'View Price', 'vc4g' ),
        'all_items'          => __( 'All Prices', 'vc4g' ),
        'search_items'       => __( 'Search Prices', 'vc4g' ),
        'parent_item_colon'  => __( 'Parent Prices:', 'vc4g' ),
        'not_found'          => __( 'No prices found.', 'vc4g' ),
        'not_found_in_trash' => __( 'No prices found in Trash.', 'vc4g' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'show_ui'             => true,
        'query_var'          => false,
        'can_export'         => true,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'revisions' )
    );

    register_post_type( 'price', $args );
}

add_action( 'init', 'vc4g_testimonial_init' );
/**
 * Register a testimonial post type.
 *
 */
function vc4g_testimonial_init() {
    $labels = array(
        'name'               => _x( 'Testimonials', 'post type general name', 'vc4g' ),
        'singular_name'      => _x( 'Testimonial', 'post type singular name', 'vc4g' ),
        'menu_name'          => _x( 'Testimonials', 'admin menu', 'vc4g' ),
        'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'vc4g' ),
        'add_new'            => _x( 'Add New', 'testimonial', 'vc4g' ),
        'add_new_item'       => __( 'Add New Testimonial', 'vc4g' ),
        'new_item'           => __( 'New Testimonial', 'vc4g' ),
        'edit_item'          => __( 'Edit Testimonial', 'vc4g' ),
        'view_item'          => __( 'View Testimonial', 'vc4g' ),
        'all_items'          => __( 'All Testimonials', 'vc4g' ),
        'search_items'       => __( 'Search Testimonials', 'vc4g' ),
        'parent_item_colon'  => __( 'Parent Testimonials:', 'vc4g' ),
        'not_found'          => __( 'No testimonials found.', 'vc4g' ),
        'not_found_in_trash' => __( 'No testimonials found in Trash.', 'vc4g' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'show_ui'             => true,
        'query_var'          => false,
        'can_export'         => true,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'revisions' )
    );

    register_post_type( 'testimonial', $args );
}

add_action( 'init', 'vc4g_thank_init' );
/**
 * Register a thank post type.
 *
 */
function vc4g_thank_init() {
    $labels = array(
        'name'               => _x( 'Thanks Pages', 'post type general name', 'vc4g' ),
        'singular_name'      => _x( 'Thanks Page', 'post type singular name', 'vc4g' ),
        'menu_name'          => _x( 'Thanks Pages', 'admin menu', 'vc4g' ),
        'name_admin_bar'     => _x( 'Thanks Page', 'add new on admin bar', 'vc4g' ),
        'add_new'            => _x( 'Add New', 'thank', 'vc4g' ),
        'add_new_item'       => __( 'Add New Thanks Page', 'vc4g' ),
        'new_item'           => __( 'New Thanks Page', 'vc4g' ),
        'edit_item'          => __( 'Edit Thanks Page', 'vc4g' ),
        'view_item'          => __( 'View Thanks Page', 'vc4g' ),
        'all_items'          => __( 'All Thanks Pages', 'vc4g' ),
        'search_items'       => __( 'Search Thanks Pages', 'vc4g' ),
        'parent_item_colon'  => __( 'Parent Thanks Pages:', 'vc4g' ),
        'not_found'          => __( 'No thanks found.', 'vc4g' ),
        'not_found_in_trash' => __( 'No thanks found in Trash.', 'vc4g' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'query_var'          => false,
        'can_export'         => true,
        'rewrite'            => array( 'slug' => 'thank' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'revisions' )
    );

    register_post_type( 'thank', $args );
}