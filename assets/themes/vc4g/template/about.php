<?php
get_template_part('template/download-pricing', 'pdf');
?>
<!-- About Section -->
<section id="team" class="bg-light-white about-page">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2><?php echo get_the_title();?></h2>
                <hr/>
            </div>
        </div>
        <div class="row">
            <?php if (empty($post->post_content)) { ?>
                <div class="col-xs-12 col-md-7">
                    <?php get_template_part('template/about', 'image'); ?>
                    <?php get_template_part('template/about', 'intro'); ?>
                </div>
                <div class="col-xs-12 col-xs-6 col-md-5">
                    <?php get_template_part('template/about', 'terms')?>
                </div>
            <?php
            }
            else {
                the_content();
            }
            ?>
        </div>
    </div>
</section>