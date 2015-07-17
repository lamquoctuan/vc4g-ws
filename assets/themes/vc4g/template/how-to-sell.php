<div class="container text-center">
    <h2>How To Sell</h2>
    <hr />
    <p>Listed below are our current prices. Precious metal pricing is changing constantly so please contact us by phone for our most up-to-date pricing.</p>
    <p>Current buying rates are below We will match all local competitors, guaranteed!</p>
    <div class="row">
        <div class="col-sm-5 col-md-6 text-right"><button type="submit" class="btn body-content mt20" onclick="window.location.href='/sell-gold-in-person/';"><i class="fa btn1">&nbsp;</i>In-store service</button></div>
        <div class="col-sm-5 col-md-6 text-left"><button type="submit" class="btn body-content mt20" onclick="window.location.href='/mail-in-service/';"><i class="fa btn2">&nbsp;</i>Mail-in service</button></div>
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
                <ul class="nav nav-tabs responsive">
                    <li class="active">
                        <a data-toggle="tab" href="#tab1">Gold Rates</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab2">Gold Bullion and Coin Rates</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab3">Dental Gold Rates & Silver Rates</a>
                    </li>
                </ul>
                <div class="tab-content">
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
                            <tr>
                                <td class="text-left">
                                    <table class="table table-striped table-hover toggle-medium">
                                        <tbody>
                                        <?php
                                        $goldBarsArgs = array();
                                        $goldBarsIds = get_objects_in_term( $termsMap['gold-bars-999']['id'], 'rate', $goldBarsArgs );
                                        foreach ($goldBarsIds as $goldBarsId) :
                                            $type = get_field('type', $goldBarsId);
                                            $price = get_field('price', $goldBarsId);
                                            if ($price == false) {
                                                $price = 0;
                                            }
                                            $dateModified = strtotime(get_the_date('Y-m-d H:i:s', $goldBarsId));
                                            if ($dateModified > $datePublished) {
                                                $datePublished = $dateModified;
                                            } ?>
                                            <tr>
                                                <td class="text-left"><?php echo $type;?></td>
                                                <td class="text-right">$<?php echo number_format($price, 2);?>/g</td>
                                            </tr>
                                        <?php
                                        endforeach; ?>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-striped table-hover toggle-medium">
                                        <tbody>
                                        <?php
                                        $coinCanArgs = array();
                                        $coinCanIds = get_objects_in_term( $termsMap['canadian-gold-coins']['id'], 'rate', $coinCanArgs );
                                        foreach ($coinCanIds as $coinCanId) :
                                            $type = get_field('type', $coinCanId);
                                            $price = get_field('price', $coinCanId);
                                            if ($price == false) {
                                                $price = 0;
                                            }
                                            $dateModified = strtotime(get_the_date('Y-m-d H:i:s', $coinCanId));
                                            if ($dateModified > $datePublished) {
                                                $datePublished = $dateModified;
                                            } ?>
                                            <tr>
                                                <td class="text-left"><?php echo $type;?></td>
                                                <td class="text-right">$<?php echo number_format($price, 2);?>/g</td>
                                            </tr>
                                        <?php
                                        endforeach; ?>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="text-right">
                                    <?php
                                    $coinOtherArgs = array();
                                    $coinOtherIds = get_objects_in_term( $termsMap['canadian-gold-coins']['id'], 'rate', $coinOtherArgs );
                                    foreach ($coinOtherIds as $coinOtherId) :
                                    $type = get_field('type', $coinOtherId);
                                    $price = get_field('price', $coinOtherId);
                                    if ($price == false) {
                                        $price = 0;
                                    }
                                    $dateModified = strtotime(get_the_date('Y-m-d H:i:s', $coinOtherId));
                                    if ($dateModified > $datePublished) {
                                        $datePublished = $dateModified;
                                    } ?>
                            <tr>
                                <td class="text-left"><?php echo $type;?></td>
                                <td class="text-right">$<?php echo number_format($price, 2);?>/g</td>
                            </tr>
                            <?php
                            endforeach; ?>
                            </td>
                            </tr>
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
                            <tr>
                                <td class="text-left">
                                    <table class="table table-striped table-hover toggle-medium">
                                        <tbody>
                                        <?php
                                        $dentalArgs = array();
                                        $dentalIds = get_objects_in_term( $termsMap['dental-gold-rates']['id'], 'rate', $dentalArgs );
                                        foreach ($dentalIds as $dentalId) :
                                            $type = get_field('type', $dentalId);
                                            $price = get_field('price', $dentalId);
                                            if ($price == false) {
                                                $price = 0;
                                            }
                                            $dateModified = strtotime(get_the_date('Y-m-d H:i:s', $dentalId));
                                            if ($dateModified > $datePublished) {
                                                $datePublished = $dateModified;
                                            } ?>
                                            <tr>
                                                <td class="text-left"><?php echo $type;?></td>
                                                <td class="text-right">$<?php echo number_format($price, 2);?>/g</td>
                                            </tr>
                                        <?php
                                        endforeach; ?>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-striped table-hover toggle-medium">
                                        <tbody>
                                        <?php
                                        $silverRateArgs = array();
                                        $silverRateIds = get_objects_in_term( $termsMap['silver-rates']['id'], 'rate', $silverRateArgs );
                                        foreach ($silverRateIds as $silverRateId) :
                                            $type = get_field('type', $silverRateId);
                                            $price = get_field('price', $silverRateId);
                                            if ($price == false) {
                                                $price = 0;
                                            }
                                            $dateModified = strtotime(get_the_date('Y-m-d H:i:s', $silverRateId));
                                            if ($dateModified > $datePublished) {
                                                $datePublished = $dateModified;
                                            } ?>
                                            <tr>
                                                <td class="text-left"><?php echo $type;?></td>
                                                <td class="text-right">$<?php echo number_format($price, 2);?>/g</td>
                                            </tr>
                                        <?php
                                        endforeach; ?>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="text-right">
                                    <table class="table table-striped table-hover toggle-medium">
                                        <tbody>
                                        <?php
                                        $silverBarArgs = array();
                                        $silverBarIds = get_objects_in_term( $termsMap['silver-bars']['id'], 'rate', $silverBarArgs );
                                        foreach ($silverBarIds as $silverBarId) :
                                            $type = get_field('type', $silverBarId);
                                            $price = get_field('price', $silverBarId);
                                            if ($price == false) {
                                                $price = 0;
                                            }
                                            $dateModified = strtotime(get_the_date('Y-m-d H:i:s', $silverBarId));
                                            if ($dateModified > $datePublished) {
                                                $datePublished = $dateModified;
                                            } ?>
                                            <tr>
                                                <td class="text-left"><?php echo $type;?></td>
                                                <td class="text-right">$<?php echo number_format($price, 2);?>/g</td>
                                            </tr>
                                        <?php
                                        endforeach; ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
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