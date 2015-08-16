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
<div class="container text-center">
	<h2>How To Sell</h2>
	<hr />
	<p>Listed below are our current prices. Precious metal pricing is changing constantly so please contact us by phone for our most up-to-date pricing.</p>
	<p>Current buying rates are below We will match all local competitors, guaranteed!</p>
	<div class="row mb40">
        <div class="col-sm-5 col-md-6 text-right"><button type="submit" class="btn body-content mt20" onclick="window.location.href='/in-store-service/';"><span class="btn1">In-store service</span></div>
        <div class="col-sm-5 col-md-6 text-left"><button type="submit" class="btn body-content mt20" onclick="window.location.href='/mail-in-service/';"><span class="btn2">Mail-in service</span></div>
    </div>
    <div class="row list-price">
    	<div class="col-md-6">
    		<div class="tables mb10">
    			<h3>Gold Rates</h3>
    			<table class="table table-striped table-hover footable toggle-medium">
                    <thead>
                        <th>Scrap Gold</th>
                        <th>Individuals (<100g)</th>
                        <th>Lots (>=100g)</th>
                    </thead>
<?php if ($goldRates) : ?>
                    <tbody>
<?php foreach ($goldRates as $goldRate) :?>
                        <tr>
                            <td><?php echo $goldRate->purity_name;?></td>            
                            <td>$<?php echo $goldRate->price_individuals;?>/g</td>            
                            <td>$<?php echo $goldRate->price_lots;?>/g</td>            
                        </tr>
<?php endforeach;?>
                    </tbody>
<?php endif;?>
                 </table>
    		</div>
    		<div class="tables mb10">
    			<h3>Gold Coin</h3>
    			<table class="table table-striped table-hover footable toggle-medium">
                    <thead>
                         <th width="70%">Coin</th>
                         <th>Buy Price</th>
                    </thead>
<?php if (! empty($goldCoinIds)) : ?>
                    <tbody>
    <?php foreach ($goldCoinIds as $priceId) :
            $type   = get_field('type', $priceId);
            $price  = get_field('price', $priceId);
            $unit   = get_field('unit', $priceId); ?>
                        <tr>
                            <td><?php echo $type; ?></td>
                            <td><?php echo ($unit) ? $price . '/' . $unit: $price; ?></td>
                        </tr>
    <?php endforeach;?>
                    <tbody>
<?php endif;?>
                 </table>
    		</div>
    		<div class="tables">
    			<h3>Gold Bullion</h3>
    			<table class="table table-striped table-hover footable toggle-medium">
                    <thead>
                         <th width="70%">Gold Bullion</th>
                         <th>Buy Price</th>
                     </thead>
<?php if (! empty($goldBullionIds)) : ?>
                    <tbody>
    <?php foreach ($goldBullionIds as $priceId) :
            $type   = get_field('type', $priceId);
            $price  = get_field('price', $priceId);
            $unit   = get_field('unit', $priceId); ?>
                        <tr>
                            <td><?php echo $type; ?></td>
                            <td><?php echo ($unit) ? $price . '/' . $unit: $price; ?></td>
                        </tr>
    <?php endforeach;?>
                    <tbody>
<?php endif;?>
                 </table>
    		</div>
    		
    	</div>
    	<div class="col-md-6">
    		<div class="tables">
    			<h3>Silver and Platinum</h3>
    			<table class="table table-striped table-hover footable toggle-medium">
                    <thead>
                         <th width="70%">Silver</th>
                         <th>Price</th>
                     </thead>
<?php if (! empty($silverIds)) : ?>
                    <tbody>
    <?php foreach ($silverIds as $priceId) :
            $type   = get_field('type', $priceId);
            $price  = get_field('price', $priceId);
            $unit   = get_field('unit', $priceId); ?>
                        <tr>
                            <td><?php echo $type; ?></td>
                            <td><?php echo ($unit) ? $price . '/' . $unit: $price; ?></td>
                        </tr>
    <?php endforeach;?>
                    <tbody>
<?php endif;?>
                 </table>
                 <table class="table table-striped table-hover footable toggle-medium">
                    <thead>
                         <th width="70%">Platinum </th>
                         <th>Price</th>
                     </thead>
<?php if (! empty($platinumIds)) : ?>
                    <tbody>
    <?php foreach ($platinumIds as $priceId) :
            $type   = get_field('type', $priceId);
            $price  = get_field('price', $priceId);
            $unit   = get_field('unit', $priceId); ?>
                        <tr>
                            <td><?php echo $type; ?></td>
                            <td><?php echo ($unit) ? $price . '/' . $unit: $price; ?></td>
                        </tr>
    <?php endforeach;?>
                    <tbody>
<?php endif;?>
                 </table>
    		</div>
    		<button type="submit" class="btn body-content download" onclick="window.location.href='<?php echo site_url('/blog/');?>';"><span>Download pdf</span></button>
    		<p class="note">Date Published: <strong>June 11 2015, 13:26:31</strong></p>
    		<!--<p class="note">-->
    		<!--    <a href="http://www.kitco.com/connecting.html">-->
    		<!--        <img src="http://www.kitconet.com/charts/metals/gold/t24_au_en_caoz_2.gif" border="0" alt="[Most Recent Quotes from www.kitco.com]"-->
    		<!--                style="width: 58%;">-->
      <!--          </a>-->
      <!--      </p>-->
            <p class="note">
                <script type="text/javascript"
                      src="https://www.google.com/jsapi?autoload={
                        'modules':[{
                          'name':'visualization',
                          'version':'1',
                          'packages':['corechart']
                        }]
                      }"></script>
            
              <div id="chart_div"></div>
            </p>
    	</div>
    </div>
</div>
<script type="text/javascript">
google.setOnLoadCallback(drawChart);

function drawChart(chartData) {
    var data = google.visualization.arrayToDataTable(chartData);

    var options = {
      title: 'CAD Gold Price in last 5 days',
      curveType: 'function',
      legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

    chart.draw(data, options);
}

$.ajax({
    url: 'https://vgc-lumpynroo.c9.io/vc4g-ws/wp-admin/admin-ajax.php?action=ajax_gold_prices',
    method: "GET",
    dataType: "json",
    complete: function(response){
        var result = response.responseJSON;
        if (result.success != false) {
            var chartData = result.data;
            drawChart(chartData);
        }
    }
},'json');    
</script>