<?php
get_header();
?>

<?php
// Start the loop.
while ( have_posts() ) : the_post();
    global $post;
    get_template_part( 'template/home', 'banner' );
    // get_template_part( 'template/home', 'gold-forecast' );
    get_template_part( 'template/home', 'about' );
    get_template_part( 'template/home', 'buy-diamond' );
    get_template_part( 'template/home', 'gold-calculator' );
    get_template_part( 'template/home', 'how-to-sell' );
    get_template_part( 'template/home', 'gold-pricing' );
    get_template_part( 'template/home', 'contact' );
    // End the loop.
endwhile;
?>

<?php get_footer(); ?>