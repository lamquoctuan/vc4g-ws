<section class="calculator-section">
    <div class="tables">
        <h3 class="right">Gold Calculator</h3>
        <div class="calculator">
            <div class="bar-prd">
                <div class="tabs row" data-tabs="tabs">
                    <a class="active col-md-6" href="#calcGold" aria-controls="calcGold" role="tab" data-toggle="tab">Gold</a>
                    <a class="col-md-6" href="#calcSilver" aria-controls="calcSilver" role="tab" data-toggle="tab">Silver</a>
                </div>
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="calcGold">
                    <form id="calcGoldForm" method="post" class="form-horizontal" siq_id="autopick_3487">
                        <input type="hidden" name="type" value="gold">
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Weight</label>
                            <div class="col-xs-5">
                                <input type="number" class="form-control" name="weight" value="0">
                            </div>

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
                                <input type="text" class="form-control result" id="calculatedPrice" kname="" value="$0">
                            </div>
                        </div>
                        <div id="success"></div>
                    </form>
<?php
$theGoldIndicator = $wpdb->get_row("SELECT id, troy_oz_price, ratio_individuals, ratio_lots FROM `vc4g_gold_indicator` ORDER BY modified_time DESC LIMIT 0,1");
?>
                    <a href="tel:16045582026" class="btn call icon-call">Call for better price</a>
                    <p class="text-center small">Today's Gold Price: <strong>$<?php echo $theGoldIndicator->troy_oz_price;?>/oz</strong></p>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="calcSilver">
                    <form id="calcSilverForm" method="post" class="form-horizontal" siq_id="autopick_9481">
                        <input type="hidden" name="type" value="silver">
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Weight</label>
                            <div class="col-xs-5">
                                <input type="number" class="form-control" name="weight" value="0">
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
                                <input type="text" class="form-control result" id="calculatedPrice" name="" value="$0">
                            </div>
                        </div>
                        <div id="success"></div>
                    </form>
                    <a href="tel:16045582026" class="btn call icon-call">Call for better price</a>
<?php
    $theSilverIndicator = $wpdb->get_row("SELECT id, troy_oz_price, ratio_individuals, ratio_lots FROM `vc4g_silver_indicator` ORDER BY modified_time DESC LIMIT 0,1");
?>
                    <p class="text-center small">Today's Siver Price: <strong>$<?php echo $theSilverIndicator->troy_oz_price;?>/oz</strong></p>
                </div>
            </div>
        </div>

    </div>

</section>