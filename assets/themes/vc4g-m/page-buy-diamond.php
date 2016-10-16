<?php
get_header();
?>

<?php if (have_posts()) : ?>
    <?php
    // Start the loop.
    while (have_posts()) : the_post();

        get_template_part('template/buy-diamond');
        // End the loop.
    endwhile;
else :
    get_template_part('template/content', 'none');

endif;
?>
<?php get_footer(); ?>