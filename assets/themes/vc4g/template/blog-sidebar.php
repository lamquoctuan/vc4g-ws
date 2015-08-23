<div class="pricing mt40">
    <?php get_template_part('template/download-pricing', 'form');?>
</div>
<?php
$args = array(
    'category_name'     => 'blog',
    'orderby'           => 'date',
    'order'             => 'DESC',
    'posts_per_page'    => 4,
    'post__not_in'      => array(get_the_ID())
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
?>
    <div class="recent-post mt30">
        <h4>Recent Posts</h4>
        <ul class="list-unstyled">
<?php
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
    }
?>
        </ul>
    </div>
<?php
}
wp_reset_postdata();
?>
<div class="whatwepay mt30">
     <?php get_template_part('template/ads-image', 'whatwebuy');?>
</div>