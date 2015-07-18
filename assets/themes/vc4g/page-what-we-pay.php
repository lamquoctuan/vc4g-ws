<?php
get_header();
?>
<?php if (have_posts()) : ?>
    <section id="howwepay" class="bg-light-white howtosell">
    <?php
    // Start the loop.
    while (have_posts()) : the_post();
        get_template_part('template/how-to-sell');
        // End the loop.
    endwhile; ?>
    </section>
<?php else :
    get_template_part('template/content', 'none');

endif;
?>
<?php get_footer(); ?>