<?php get_header(); ?>
<?php
if (have_posts()) :
    $args = array(
        'cat'               => $cat,
        'orderby'           => 'date',
        'order'             => 'DESC',
        'posts_per_page'    => 1,
    );
    $the_query = new WP_Query( $args );
    while ( $the_query->have_posts() ) :
        $the_query->the_post();
        get_template_part('template/blog');
    endwhile;
    wp_reset_postdata();
endif; ?>
<?php get_footer();?>