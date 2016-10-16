<?php
$queryGTable = 'SELECT id, name, modified_time
                FROM  `vc4g_gold_table` 
                ORDER BY modified_time DESC 
                LIMIT 0 , 1';
$goldTables = $wpdb->get_results( $queryGTable, OBJECT );
if ($goldTables) {
    $goldTable = $goldTables[0];
    $query = "SELECT purity.id purity_id, purity.name purity_name, purity purity_value, price.id price_id, price.table_id, price.purity_id price_purity_id, price.price_individuals, price.price_lots
                    FROM  `vc4g_gold_purity` purity
                    LEFT JOIN  `vc4g_gold_price` price ON ( purity.id = price.purity_id ) 
                    LEFT JOIN  `vc4g_gold_table` gtable ON ( price.table_id = gtable.id ) 
                    WHERE price.table_id = '{$goldTable->id}'
                    GROUP BY price.table_id, purity.purity
                    ORDER BY purity.purity DESC , purity.modified_time DESC";
    $goldRates = $wpdb->get_results( $query, OBJECT );
}

$taxonomy = 'rate';
$termGoldCoin = get_term_by('slug','gold-coin', $taxonomy);
$goldCoinArgs = array();
$goldCoinIds = get_objects_in_term( $termGoldCoin->term_id, $taxonomy, $goldCoinArgs );
$termGoldBullion = get_term_by('slug','gold-bullion', $taxonomy);
$goldBullionArgs = array();
$goldBullionIds = get_objects_in_term( $termGoldBullion->term_id, $taxonomy, $goldBullionArgs );
$termSilver = get_term_by('slug','silver', $taxonomy);
$silverArgs = array();
$silverIds = get_objects_in_term( $termSilver->term_id, $taxonomy, $silverArgs );
$termPlatinum = get_term_by('slug','platinum', $taxonomy);
$platinumArgs = array();
$platinumIds = get_objects_in_term( $termPlatinum->term_id, $taxonomy, $silverArgs );
?>
<section class="howtosell" id="how">

    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>How to sell</h2>
            <p class="pb10">Current buying rates are below We will match all local competitors, guaranteed!</p>
        </div>
    </div>
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
			        Gold Rates</a>
                    <i class="indicator fa fa-chevron-up  pull-right"></i>
                </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse in">
                <div class="panel-body">
                    <table class="table table-striped table-hover footable toggle-medium">
                        <thead>
                            <tr>
                                <th>Scrap Gold</th>
                                <th class="text-center">Individuals (&lt;100g)</th>
                                <th class="text-right">Lots (&gt;=100g)</th>
                            </tr>
                        </thead>
<?php if ($goldRates) : ?>
                    <tbody>
<?php foreach ($goldRates as $goldRate) :?>
                        <tr>
                            <td><?php echo $goldRate->purity_name;?></td>            
                            <td class="text-center">$<?php echo $goldRate->price_individuals;?>/g</td>            
                            <td class="text-right">$<?php echo $goldRate->price_lots;?>/g</td>            
                        </tr>
<?php endforeach;?>
                    </tbody>
<?php endif;?>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
			        Gold Coin</a>
                    <i class="indicator fa fa-chevron-down  pull-right"></i>
                </h4>
            </div>
            <div id="collapse2" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="table table-striped table-hover footable toggle-medium">
                        <thead>
                            <tr>
                                <th width="70%">Coin</th>
                                <th class="text-right">Buy Price</th>
                            </tr>
                        </thead>
<?php if (! empty($goldCoinIds)) : ?>
                    <tbody>
    <?php foreach ($goldCoinIds as $priceId) :
            $type   = get_field('type', $priceId);
            $price  = get_field('price', $priceId);
            $unit   = get_field('unit', $priceId); ?>
                        <tr>
                            <td><?php echo $type; ?></td>
                            <td class="text-right"><?php echo ($unit) ? $price . '/' . $unit: $price; ?></td>
                        </tr>
    <?php endforeach;?>
                    <tbody>
<?php endif;?>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
			        Gold Bars</a>
                    <i class="indicator fa fa-chevron-down  pull-right"></i>
                </h4>
            </div>
            <div id="collapse3" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="table table-striped table-hover footable toggle-medium">
                        <thead>
                            <tr>
                                <th>Gold Bars</th>
                                <th class="text-right">Buy Price</th>
                            </tr>
                        </thead>
<?php if (! empty($goldBullionIds)) : ?>
                    <tbody>
    <?php foreach ($goldBullionIds as $priceId) :
            $type   = get_field('type', $priceId);
            $price  = get_field('price', $priceId);
            $unit   = get_field('unit', $priceId); ?>
                        <tr>
                            <td><?php echo $type; ?></td>
                            <td class="text-right"><?php echo ($unit) ? $price . '/' . $unit: $price; ?></td>
                        </tr>
    <?php endforeach;?>
                    <tbody>
<?php endif;?>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
			        Silver and Platinum</a>
                    <i class="indicator fa fa-chevron-down  pull-right"></i>
                </h4>
            </div>
            <div id="collapse4" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="table table-striped table-hover footable toggle-medium">
                        <thead>
                            <tr>
                                <th width="70%">silver jewellery and other siver</th>
                                <th class="text-right">Price</th>
                            </tr>
                        </thead>
                     </thead>
<?php if (! empty($silverIds)) : ?>
                    <tbody>
    <?php foreach ($silverIds as $priceId) :
            $type   = get_field('type', $priceId);
            $price  = get_field('price', $priceId);
            $unit   = get_field('unit', $priceId); ?>
                        <tr>
                            <td><?php echo $type; ?></td>
                            <td class="text-right"><?php echo ($unit) ? $price . '/' . $unit: $price; ?></td>
                        </tr>
    <?php endforeach;?>
                    <tbody>
<?php endif;?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>