<?php
if (! (is_single() || is_page('buy-diamond'))) {
    get_template_part( 'template/footer', 'onedaydeal' );
}
get_template_part( 'template/footer', 'contact' );
get_template_part( 'template/footer' );
?>
<?php wp_footer(); ?>

</body>
</html>
