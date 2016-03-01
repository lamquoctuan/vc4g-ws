<?php
    $imgAds = (get_field('ads_image'))?get_field('ads_image'):'/assets/images/whatwepay.png';
    $imgAdsRes = (get_field('ads_image_responsive')) ? get_field('ads_image_responsive') : '/assets/images/img-ads.jpg';
?>
<a href="<?php echo site_url();?>/what-we-buy/">
    <div class="text-ads">
        <div class="text-cnt">
            <img src="<?php echo $imgAds;?>" alt="What we pay"/>
        </div>
    </div>
    <img src="<?php echo $imgAdsRes;?>" class="img-responsive" alt="What we pay">
</a>