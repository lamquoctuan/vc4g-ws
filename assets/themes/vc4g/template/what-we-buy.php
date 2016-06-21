<?php
$purchasedItems = getPurchasedItems(['Gold', 'Silver', 'Platinum', 'Jewellery']);
?>
<!-- What we buy Section -->
<section id="whatwebuy" class="bg-light-white whatwebuy fullscreen">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php the_title('<h2>','</h2>');?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9">
<?php
if (! empty($purchasedItems)) :
    foreach ($purchasedItems as $type => $items) {
?>
                <div class="title-prd">
                    <h4><?php echo $type;?></h4>
                    <hr />
<?php   if (array_search($type, array_keys($purchasedItems)) == 0) { ?>
                    <!--<a href="/#what-we-buy" class="viewall mb10">View list</a>-->
                    <div class="switch"><a class="display-view list active"></a><a href="<?php echo site_url('/#whatwebuy');?>" class="display-view griditem"></a></div>
<?php   } ?>
                </div>
                <div class="row">
<?php
        foreach ($items as $item) {
?>
                    <div class="col-md-4 whatwebuy-item">
                        <a href="tel:16045582026" class="whatwebuy-link">
                            <div class="whatwebuy-hover">
                                <div class="whatwebuy-hover-content">
<?php if (! empty($item->price)) { ?>
                                    <strong>$<?php echo $item->price;?></strong>
<?php }?>
                                    <span>Call us for</span>
                                    <span class="mb20">better price</span>
                                    <i class="fa icon-call"></i>
                                </div>
                            </div>
                            <img src="<?php echo $item->image;?>" class="img-responsive" alt="<?php echo $item->title;?>">
                        </a>
                        <div class="whatwebuy-caption">
                            <h5><?php echo $item->title;?></h5>
                        </div>
                    </div>
<?php
        }
?>
                </div>
<?php
    }
endif;
?>
            </div>
            <div class="col-sm-3 sidebar-whywepay">
                <div class="tables">
                    <h3 class="right">Gold Calculator</h3>
                    <div class="calculator">
                        <div class="bar-prd">
                            <div class="row">
                                <a class="active col-md-6" href="#calcGold" aria-controls="calcGold" role="tab" data-toggle="tab">Gold</a>
                                <a class="col-md-6" href="#calcSilver" aria-controls="calcSilver" role="tab" data-toggle="tab">Silver</a>
                            </div>
                            
                        </div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="calcGold">
                                <form id="calcGoldForm" method="post" class="form-horizontal">
                                    <input type="hidden" name="type" value="gold"/>
                                    <div class="form-group">
                                        <label class="col-xs-3 control-label">Weight</label>
                                        <div class="col-xs-5">
                                            <input type="number" class="form-control" name="weight" value="0" />
                                        </div>
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <div class="col-xs-4 selectContainer">
                                            <select name="unit" class="form-control arrow">
                                                <option value="oz">Ounce</option>
                                                <option selected="" value="g">Grams</option>
                                                <option value="dwt">DWT (Pennyweight)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-3 control-label">Purity</label>
                                        <div class="col-xs-9 selectContainer">
                                            <select name="purity" class="form-control" size="1">
    <?php 
    global $wpdb;
    $puritiesQuery = 'SELECT id, purity, name FROM `vc4g_gold_purity`';
    $purities = $wpdb->get_results($puritiesQuery);
    foreach ($purities as $purity) {
      echo '<option value="'.$purity->id.'">'.$purity->name.'</option>';  
    }
    ?>
                                            </select>
            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-3 control-label btn calc">Result</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control result" id="calculatedPrice" kname="" value="$0" />
                                        </div>
                                    </div>
                                    <div id="success"></div>
                                </form>
    <?php
    $theGoldIndicator = $wpdb->get_row("SELECT id, troy_oz_price, ratio_individuals, ratio_lots FROM `vc4g_gold_indicator` ORDER BY modified_time DESC LIMIT 0,1");
    ?>
                                <a href="tel:16045582026" class="btn call">Call for better price</a>
                                <p class="text-center small">Today's Gold Price: $<?php echo $theGoldIndicator->troy_oz_price;?>/oz</p>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="calcSilver">
                                <form id="calcSilverForm" method="post" class="form-horizontal">
                                    <input type="hidden" name="type" value="silver"/>
                                    <div class="form-group">
                                        <label class="col-xs-3 control-label">Weight</label>
                                        <div class="col-xs-5">
                                            <input type="number" class="form-control" name="weight" value="0" />
                                        </div>
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <div class="col-xs-4 selectContainer">
                                            <select name="unit" class="form-control arrow">
                                                <option value="oz">Ounce</option>
                                                <option selected="" value="g">Grams</option>
                                                <option value="dwt">DWT (Pennyweight)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-3 control-label">Purity</label>
                                        <div class="col-xs-9 selectContainer">
                                            <select name="purity" class="form-control" size="1">
    <?php 
    global $wpdb;
    $puritiesQuery = 'SELECT id, purity, name FROM `vc4g_silver_purity`';
    $purities = $wpdb->get_results($puritiesQuery);
    foreach ($purities as $purity) {
      echo '<option value="'.$purity->id.'">'.$purity->name.'</option>';  
    }
    ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-3 control-label btn calc">Result</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control result" id="calculatedPrice" name="" value="$0" />
                                        </div>
                                    </div>
                                    <div id="success"></div>
                                </form>
                                <a href="tel:16045582026" class="btn call">Call us for better price</a>
    <?php
    $theSilverIndicator = $wpdb->get_row("SELECT id, troy_oz_price, ratio_individuals, ratio_lots FROM `vc4g_silver_indicator` ORDER BY modified_time DESC LIMIT 0,1");
    ?>
                                <p class="text-center small">Today's Siver Price: $<?php echo $theSilverIndicator->troy_oz_price;?>/oz</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <p class="text-center mt20 small">This calculator is for reference purpose only and might not be 100% accurate. Please contact us directly for updated pricing</p>
                <h3 class="title">Recent Pay</h3>
                <div id="myCarousel" class="carousel slide recentpay">
                    <!-- Wrapper for Slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <!-- Set the first background image using inline CSS below. -->
                            <img src="/assets/images/recent-pay/img1.jpg" />
                            <div class="carousel-caption">
                                <h2>$2079.55</h2>
                            </div>
                        </div>
                        <div class="item">
                            <!-- Set the second background image using inline CSS below. -->
                            <img src="/assets/images/recent-pay/img2.jpg" />
                            <div class="carousel-caption">
                                <h2>$2079.55</h2>
                            </div>
                        </div>
                        <div class="item">
                            <!-- Set the third background image using inline CSS below. -->
                            <img src="/assets/images/recent-pay/img3.jpg" />
                            <div class="carousel-caption">
                                <h2>$2079.55</h2>
                            </div>
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="icon-prev"></span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="icon-next"></span>
                    </a>

                </div>

            </div>
        </div>
    </div>
</section>