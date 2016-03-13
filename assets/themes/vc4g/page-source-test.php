<?php
get_header();
?>

<?php if ( have_posts() ) : ?>
    <?php
    // Start the loop.
    while ( have_posts() ) : the_post();

        the_content();
        get_template_part('template/download-pricing', 'pdf');
        // End the loop.
    endwhile;
else :
    get_template_part( 'template/test-source' );

endif;
?>
<?php get_footer(); ?>