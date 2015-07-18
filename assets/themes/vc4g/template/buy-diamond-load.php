<?php
$args = array(
    'post_type' => 'page',
    'name'   => 'buy-diamond',
);
$theQuery = new WP_Query( $args );
while( $theQuery->have_posts() ) {
    $theQuery->the_post();
    global $post;
    the_title('<h2>','</h2><hr/>',true);
    $content = $post->post_content;
    if (empty($content)) :
        get_template_part('template/buy-diamond', 'detail');
    else :
        echo $content;
    endif;
}
wp_reset_postdata(); // reset the query
?>