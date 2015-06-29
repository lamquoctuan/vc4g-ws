<?php
get_header();
?>

<?php if ( have_posts() ) : ?>
    <?php
    // Start the loop.
    while ( have_posts() ) : the_post();

        get_template_part( 'template/home', 'services' );
        get_template_part( 'template/home', 'whatwebuy' );
        get_template_part( 'template/home', 'buydiamond' );
        get_template_part( 'template/home', 'howtosell' );
        get_template_part( 'template/home', 'blogs' );
        get_template_part( 'template/home', 'about' );
        // End the loop.
    endwhile;
else :
    get_template_part( 'template/content', 'none' );

endif;
?>

<?php get_footer(); ?>