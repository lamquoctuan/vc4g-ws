<?php
function getPurchasedItems($types = array()) {
    $purchasedItems = [];
    if (! empty($types)) {
        foreach ($types as $type) {
            $purchasedItems[$type] = [];
        }
    }
    $args = array(
        'post_type'         => 'purchased_item',
        'orderby'           => 'meta_value',
        'meta_key'          => 'type',
        'posts_per_page'    => -1,
    );
    $theQuery = new WP_Query( $args );
    while( $theQuery->have_posts() ) {
        $theQuery->the_post();
        global $post;

        $item = new \StdClass();
        $item->title = get_the_title();
        $item->type = get_field('type');
        $item->price = get_field('price');
        $item->image = get_field('image');

        if (! isset($purchasedItems[$item->type])) {
            $purchasedItems[$item->type] = [];
        }
        array_push($purchasedItems[$item->type], $item);
    }
    wp_reset_postdata(); // reset the query
    return $purchasedItems;
}

function new_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');