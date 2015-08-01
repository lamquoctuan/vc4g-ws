<div class="container text-center">
    <h2>How To Sell</h2>
    <hr />
    <p>Listed below are our current prices. Precious metal pricing is changing constantly so please contact us by phone for our most up-to-date pricing.</p>
    <p>Current buying rates are below We will match all local competitors, guaranteed!</p>
    <div class="row">
        <div class="col-sm-5 col-md-6 text-right"><button type="submit" class="btn body-content mt20" onclick="window.location.href='/in-store-service/';"><span class="btn1">In-store service</span></div>
        <div class="col-sm-5 col-md-6 text-left"><button type="submit" class="btn body-content mt20" onclick="window.location.href='/mail-in-service/';"><span class="btn2">Mail-in service</span></div>
    </div>
    <div class="row mt30">
        <div class="col-lg-12">
            <div class="bs-component">
                <?php
                $taxonomies = array(
                    'rate',
                );

                $args = array(
                    'orderby'           => 'name',
                    'order'             => 'ASC',
                    'hide_empty'        => true,
                    'exclude'           => array(),
                    'exclude_tree'      => array(),
                    'include'           => array(),
                    'number'            => '',
                    'fields'            => 'all',
                    'slug'              => '',
                    'parent'            => '',
                    'hierarchical'      => true,
                    'child_of'          => 0,
                    'childless'         => false,
                    'get'               => '',
                    'name__like'        => '',
                    'description__like' => '',
                    'pad_counts'        => false,
                    'offset'            => '',
                    'search'            => '',
                    'cache_domain'      => 'core'
                );

                $terms = get_terms($taxonomies, $args);
                $termsMap = array();
                foreach($terms as $term) {
                    $item = array(
                        'name'  => $term->name,
                        'id'    => $term->term_id
                    );
                    $termsMap[$term->slug] = $item;
                }
                $datePublished = 0;
                ?>
                <!--<ul class="nav nav-tabs responsive row row-offset-0">
                    <li class="col-md-2 active">
                        <a data-toggle="tab" href="#tab1">Gold Rates</a>
                    </li>
                    <li class="col-md-5">
                        <a data-toggle="tab" href="#tab2">Gold Bullion and Coin Rates</a>
                    </li>
                    <li class="col-md-5">
                        <a data-toggle="tab" href="#tab3">Dental Gold Rates & Silver Rates</a>
                    </li>
                </ul>-->
                <div class="tab-content" style="display:none;">
                    <?php
                    $goldRatesArgs = array();
                    $goldRatesIds = get_objects_in_term( $termsMap['gold-rates']['id'], 'rate', $goldRatesArgs );
                    ?>
                    <div id="tab1" class="tab-pane fade active in">
                        <table class="table table-striped table-hover footable toggle-medium">
                            <thead>
                                <th>Scrap Gold</th>
                                <th data-hide="all">Individuals (<100g)</th>
                                <th data-hide="all" class="text-right">Lots (>=100g)</th>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($goldRatesIds as $goldRatesId) :
                                $scrapGold = get_field('scrap_gold', $goldRatesId);
                                $individuals = get_field('individuals', $goldRatesId);
                                if ($individuals == false) {
                                    $individuals = 0;
                                }
                                $lots = get_field('lots', $goldRatesId);
                                if ($lots == false) {
                                    $lots = 0;
                                }
                                $dateModified = strtotime(get_the_date('Y-m-d H:i:s', $goldRatesId));
                                if ($dateModified > $datePublished) {
                                    $datePublished = $dateModified;
                                } ?>
                                <tr>
                                    <td class="text-left"><?php echo $scrapGold;?></td>
                                    <td>$<?php echo number_format($individuals, 2);?>/g</td>
                                    <td class="text-right">$<?php echo number_format($lots, 2);?>/g</td>
                                </tr>
                            <?php
                            endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="tab2" class="tab-pane fade">
                        <table class="table table-striped table-hover footable toggle-medium">
                            <thead>
                                <th>Gold bar .999</th>
                                <th data-hide="all">Canadian Gold Coin</th>
                                <th data-hide="all">Other Gold Coins</th>
                            </thead>
                            <tbody>
                                <?php
                                $tab2Data = array();
                                $goldBarsArgs = array();
                                $goldBarsIds = get_objects_in_term( $termsMap['gold-bars-999']['id'], 'rate', $goldBarsArgs );
                                $coinCanArgs = array();
                                $coinCanIds = get_objects_in_term( $termsMap['canadian-gold-coins']['id'], 'rate', $coinCanArgs );
                                $coinOtherArgs = array();
                                $coinOtherIds = get_objects_in_term( $termsMap['canadian-gold-coins']['id'], 'rate', $coinOtherArgs );
                                array_push($tab2Data, $goldBarsIds, $coinCanIds, $coinOtherIds);
                                $idx = 0;
                                while (isset($goldBarsIds[$idx]) || isset($coinCanIds[$idx]) || isset($coinOtherIds[$idx])) : ?>
                                <tr>
                                <?php
                                    for ($i=0; $i<3;$i++) : ?> 
                                    <td class="text-left">
                                    <?php
                                        if (isset($tab2Data[$i][$idx])) {
                                            $type = get_field('type', $tab2Data[$i][$idx]);
                                            $price = get_field('price', $tab2Data[$i][$idx]);
                                            if ($price == false) {
                                                $price = 0;
                                            }
                                            $dateModified = strtotime(get_the_date('Y-m-d H:i:s', $tab2Data[$i][$idx]));
                                            if ($dateModified > $datePublished) {
                                                $datePublished = $dateModified;
                                            } ?>
                                        <div class="row">
                                            <div class="col-md-6"><?php echo $type;?></div>
                                            <div class="col-md-6 text-right">$<?php echo number_format($price, 2);?>/g</div>
                                        </div>
                                        <?php
                                        } ?>
                                    </td>
                                    <?php
                                    endfor;
                                    $idx++; ?>
                                </tr>
                                <?php
                                endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="tab3" class="tab-pane fade">
                        <table class="table table-striped table-hover footable toggle-medium">
                            <thead>
                                <th>Dental Gold Rates</th>
                                <th data-hide="all">Silver Rates</th>
                                <th data-hide="all">Silver Bars</th>
                            </thead>
                            <tbody>
                                <?php
                                $tab3Data = array();
                                $dentalArgs = array();
                                $dentalIds = get_objects_in_term( $termsMap['dental-gold-rates']['id'], 'rate', $dentalArgs );
                                $silverRateArgs = array();
                                $silverRateIds = get_objects_in_term( $termsMap['silver-rates']['id'], 'rate', $silverRateArgs );
                                $silverBarArgs = array();
                                $silverBarIds = get_objects_in_term( $termsMap['silver-bars']['id'], 'rate', $silverBarArgs );
                                array_push($tab3Data, $goldBarsIds, $coinCanIds, $coinOtherIds);
                                $idx = 0;
                                while (isset($dentalIds[$idx]) || isset($silverRateIds[$idx]) || isset($silverBarIds[$idx])) : ?>
                                <tr>
                                <?php
                                    for ($i=0; $i<3;$i++) : ?> 
                                    <td class="text-left">
                                    <?php
                                        if (isset($tab3Data[$i][$idx])) {
                                            $type = get_field('type', $tab3Data[$i][$idx]);
                                            $price = get_field('price', $tab3Data[$i][$idx]);
                                            if ($price == false) {
                                                $price = 0;
                                            }
                                            $dateModified = strtotime(get_the_date('Y-m-d H:i:s', $tab3Data[$i][$idx]));
                                            if ($dateModified > $datePublished) {
                                                $datePublished = $dateModified;
                                            } ?>
                                        <div class="row">
                                            <div class="col-md-6"><?php echo $type;?></div>
                                            <div class="col-md-6 text-right">$<?php echo number_format($price, 2);?>/g</div>
                                        </div>
                                        <?php
                                        } ?>
                                    </td>
                                    <?php
                                    endfor;
                                    $idx++; ?>
                                </tr>
                                <?php
                                endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <p class="tfoot-tbl text-right">
                    Date Published: <strong><?php echo date('F d Y, H:i:s', $datePublished);?></strong>
                </p>
            </div>
        </div>
    </div>
<?php if (is_page('what-we-pay') || is_page('how-to-sell')) { ?>
    <div class="row">
        <div class="col-md-6 text-left pt30"><a href="<?php echo site_url();?>" class="bthome">Back to Home</a></div>
        <div class="col-md-6 text-right"><button type="submit" class="btn body-content dload mt20" onclick="<?php echo site_url('/blog');?>"><span>Download now</span></button></div>
    </div>
<?php } ?>
    <script type="text/javascript">
        $(document).ready(function(){

            fakewaffle.responsiveTabs(['xs']);
//                $('.footable').footable();

        });
    </script>
</div>