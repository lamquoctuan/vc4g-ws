<!-- Header -->
<header>
    <div class="container mb20">
        <div class="row">
            <div class="col-md-6 text-left pt20">
                <img src="/assets/images/logo.png" />
            </div>
            <div class="col-md-6 text-right pt20">
    			<a class="sub-phone" href="tel:16045582026"><b class="icon-phone"></b>604-558-2026</a>
    			<span class="address-banner">3515 Kingsway, Vancouver, BC V5R 5L8</span>
    		</div>
        </div>
    </div>
    
    <div class="row row-no-padding" style="background:#e31d27;">
        <div class="col-lg-5">
            <div class="post post-variant-1">
                <div class="post-inner">
                    <img src="/assets/images/banners/img1-days.jpg" alt="" class="img-responsive post-image">
                    <div class="post-caption">
                        <div class="intro-text">
                            <div class="intro-lead-in">Payment in <span>Cash Gold, Silver</span></div>
                            <div class="intro-heading">We Buy Diamond <span>At Any Size</span></div>
                            <a href="#services" class="page-scroll btn btn-xl">How it works</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 dpl-none days">
<?php
$idxBanner = (date('d') % 3) + 1;
$srcBanner = "//s3-us-west-2.amazonaws.com/assets.vancouvercashforgold.com/assets/images/banners/2016-xmas/banner+{$idxBanner}.png";
?>
            <img src="<?php echo $srcBanner;?>" alt="Vancouver Cash for gold - Merry Christmas 2016" class="img-responsive post-image">
            <!--<img src="/assets/images/days.png" alt="" class="img-responsive post-image">-->
        </div>
    </div>
</header>

