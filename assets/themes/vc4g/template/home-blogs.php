<!-- blog Section -->
<section id="blog" class="bg-light-white">
    <div class="bg-blue-dark">
        <div class="container text-center">
            <div class="title">
                <h2>Blog</h2>
                <hr />
            </div>
            <ul id="myRoundabout">
<?php
$args = array(
    'category_name'     => 'blog',
    'orderby'           => 'date',
    'order'             => 'DESC',
    'posts_per_page'    => 3
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
    ?>
    <?php
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        global $post;
        $excerpt = get_the_excerpt();?>
        <li>
            <div class="sphere-content">
                <h3><?php echo get_the_title();?></h3>
                <p><?php echo str_replace( '[...]', '...', $excerpt );?></p>
                <p>&nbsp;</p>
                <a href="<?php echo get_the_permalink();?>" class="btn body-content">read more ></a>
            </div>
        </li>
    <?php }
    ?>

<?php
}
wp_reset_postdata();
?>

            </ul>
        </div>
    </div>
<!--    <script type="text/javascript" src="--><?php //echo WP_CONTENT_URL . '/js/jquery.roundabout.js';?><!--"></script>-->
    <script type="text/javascript">
        $(document).ready(function() {
            $('ul#myRoundabout').roundabout();
        });
    </script>
</section>