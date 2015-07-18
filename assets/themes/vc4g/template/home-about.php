<!-- Team Section -->
<section id="team" class="bg-light-white">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-7">
                <h2>About Us</h2>
                <hr />
                <?php get_template_part('template/about', 'intro')?>
                <button type="submit" class="btn body-content mt20" onclick="window.location.href='/about-us/';">Learn More...</button>
            </div>
            <div class="col-xs-12 col-xs-6 col-md-5">
                <?php get_template_part('template/home', 'testimonials');?>
            </div>
        </div>

    </div>
</section>