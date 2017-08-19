<?php
get_header();
?>

<?php if (have_posts()) : ?>
    <?php
    // Start the loop.
    while (have_posts()) : the_post();

        get_template_part('template/contact-locations', 'map');
        get_template_part('template/contact-locations');
        get_template_part('template/contact', 'form');
        // End the loop.
    endwhile;
else :
    get_template_part('template/content', 'none');

endif;
?>
<?php get_footer(); ?>