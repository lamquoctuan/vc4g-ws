<?php
//skip One day deal event
// if (! (is_single() || is_page('buy-diamond'))) {
    // get_template_part( 'template/footer', 'onedaydeal' );
    // get_template_part( 'template/footer', 'coming-soon' );
// }
//get_template_part( 'template/footer', 'contact' );
?>
<!-- Contact Section -->
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-md-6">
                <div class="col-md-5">
                    <?php get_template_part('template/footer', 'nav');?>
                </div>
                <div class="col-md-7">
                    <?php get_template_part('template/footer', 'contact');?>
                </div>
            </div>
            <div class="col-sm-5 col-md-6">
                <div class="col-md-5 text-center">
                    <?php get_template_part('template/footer', 'weather');?>
                </div>
                <div class="col-md-7">
                    <?php get_template_part('template/footer', 'subscribe-form');?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
get_template_part( 'template/footer', 'bottom' );
?>
<?php wp_footer(); ?>

</body>
</html>
