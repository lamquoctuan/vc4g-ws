<section class="webuy diamond">
    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <?php get_template_part('template/buy-diamond', 'load');?>
                <img src="/assets/images/diamond.png" class="img-responsive" alt="we buy diamond"/>
            </div>
            <div class="col-md-4">
                <div class="pricing mt40">
                    <?php get_template_part('template/download-pricing', 'form');?>
                </div>
                <div class="whatwepay mt30">
                    <?php
                        $imgAds = (get_field('ads_image'))?get_field('ads_image'):'/assets/images/whatwepay.png';
                        $imgAdsRes = (get_field('ads_image_responsive')) ? get_field('ads_image_responsive') : '/assets/images/img-ads.jpg';
                    ?>
                    <a href="/what-we-buy/">
                        <div class="text-ads">
                            <div class="text-cnt">
                                <img src="<?php echo $imgAds;?>" alt="What we pay"/>
                            </div>
                        </div>
                        <img src="<?php echo $imgAdsRes;?>" class="img-responsive" alt="What we pay">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>