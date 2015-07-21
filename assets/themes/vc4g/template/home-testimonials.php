<h3 class="text-center">What Our Customers Say</h3>
<?php
$args = array(
        'post_type' => 'testimonial',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => -1,
    );
    $theQuery = new WP_Query($args);
    $testimonials = array();
    while ($theQuery->have_posts()) {
        $theQuery->the_post();
        global $post;

        $item = new \StdClass();
        $item->title = get_the_title();
        $item->author_name = get_field('author_name');
        $item->author_from = get_field('author_from');
        $item->author_image = get_field('author_image');
        $item->quote = get_field('quote');

        array_push($testimonials, $item);
    }
    wp_reset_postdata(); // reset the query
?>
<?php
if (count($testimonials) > 0) : ?>
<div id="testimonialCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
    <?php for ($idx=0; $idx<count($testimonials);$idx++) :
        $class = ($idx==0)?' class="active"':'';
        echo '<li data-target="#testimonialCarousel" data-slide-to="' . $idx . '"' . $class . '></li>';
    endfor;?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
    <?php for ($idx=0; $idx<count($testimonials);$idx++) :
        $item = $testimonials[$idx];
        $class = ($idx==0)?' active"':''; ?>
        <div class="item <?php echo $class;?>">
            <div class="team-member">
                <img src="<?php echo $item->author_image;?>" class="img-responsive img-circle" alt="<?php echo "-{$item->author_name}, {$item->author_from}";?>">
                <blockquote><?php echo $item->quote;?></blockquote>
                <p class="text-muted"><?php echo "-{$item->author_name}, {$item->author_from}";?></p>
            </div>
        </div>
    <?php
    endfor;?>
    </div>
</div>
<?php
endif;
?>