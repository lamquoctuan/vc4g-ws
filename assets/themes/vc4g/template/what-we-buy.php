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
                    <a href="/#what-we-buy" class="viewall mb10">View list</a>
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
                                    <strong>$<?php echo $item->price;?></strong>
                                    <span>Call for</span>
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
            <div class="col-sm-3 mt30 sidebar-whywepay">
                <div class="calculator mt40">
                    <h4>Gold Calculator</h4>
                    <div class="bar-prd">
                        <a class="active" href="">Gold</a>
                        <a href="">Silver</a>
                    </div>
                    <form accept-charset="UTF-8" action=""  id="bootstrapSelectForm" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Weight</label>
                            <div class="col-xs-5">
                                <input type="text" class="form-control" name="" value="0" />
                            </div>
                            <div class="col-xs-4 selectContainer">
                                <select name="language" class="form-control">
                                    <option value="grain">Grains</option>
                                    <option value="milligram">Milligrams</option>
                                    <option selected="" value="gram">Grams</option>
                                    <option value="dwt">DWT (Pennyweight)</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Purity</label>
                            <div class="col-xs-9 selectContainer">
                                <select name="purity" class="form-control" size="1">
                                    <option value="24k">24 Karat (.999+ pure)</option>
                                    <option value="23k">23 Karat</option>
                                    <option value="22k">22 Karat</option>
                                    <option value="21.6k">21.6 Karat</option>
                                    <option value="21k">21 Karat</option>
                                    <option value="20k">20 Karat</option>
                                    <option value="19k">19 Karat</option>
                                    <option selected="" value="18k">18 Karat</option>
                                    <option value="16k">16 Karat</option>
                                    <option value="15k">15 Karat</option>
                                    <option value="14k">14 Karat</option>
                                    <option value="12k">12 Karat</option>
                                    <option value="10k">10 Karat</option>
                                    <option value="9k">9 Karat</option>
                                    <option value="8k">8 Karat</option>
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label btn">Calculate</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control result" name="" value="$0" />
                            </div>
                        </div>
                    </form>
                    <a href="" class="btn call">Call for better price</a>
                    <p class="text-center small">Today's Gold Price: $1314.36/oz</p>
                </div>
                <p class="text-center mt20 small">This calculator is for reference purpose only and might not be 100% accurate. Please contact us directly for updated pricing</p>
                <h3>Recent Pay</h3>
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