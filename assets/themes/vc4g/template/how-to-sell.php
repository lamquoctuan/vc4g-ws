<?php
$pageLinks = [
    'in-store-service' => get_permalink( get_page_by_path( 'in-store-service' ) ),
    'mail-in-service' => get_permalink( get_page_by_path( 'mail-in-service' ) )
];

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
        <div class="col-sm-5 col-md-6 text-right"><button type="submit" class="btn body-content mt20" onclick="window.location.href='<?php echo $pageLinks['in-store-service'];?>';"><span class="btn1">In-store service</span></div>
        <div class="col-sm-5 col-md-6 text-left"><button type="submit" class="btn body-content mt20" onclick="window.location.href='<?php echo $pageLinks['mail-in-service'];?>';"><span class="btn2">Mail-in service</span></div>
    </div>
    <div class="row list-price">
    	<div class="col-md-4">
    		<div class="tables mb10">
    			<h3>Gold Rates</h3>
    			<table class="table table-striped table-hover footable toggle-medium">
                    <thead>
                        <th>Scrap Gold</th>
                        <th class="text-right">Individuals (<100g)</th>
                        <th class="text-right">Lots (>=100g)</th>
                    </thead>
<?php if ($goldRates) : ?>
                    <tbody>
<?php foreach ($goldRates as $goldRate) :?>
                        <tr>
                            <td><?php echo $goldRate->purity_name;?></td>            
                            <td class="text-right">$<?php echo $goldRate->price_individuals;?>/g</td>            
                            <td class="text-right">$<?php echo $goldRate->price_lots;?>/g</td>            
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
                         <th class="text-right">Buy Price</th>
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
    		<div class="tables">
    			<h3>Gold Bars</h3>
    			<table class="table table-striped table-hover footable toggle-medium">
                    <thead>
                         <th>Gold Bars</th>
                         <th class="text-right">Buy Price</th>
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
    	<div class="col-md-4">
    		<div class="tables">
    			<h3>Silver and Platinum</h3>
    			<table class="table table-striped table-hover footable toggle-medium">
                    <thead>
                         <th width="70%">silver jewellery and other siver</th>
                         <th class="text-right">Price</th>
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
                 <table class="table table-striped table-hover footable toggle-medium">
                    <thead>
                         <th width="70%">Platinum </th>
                         <th class="text-right">Price</th>
                     </thead>
<?php if (! empty($platinumIds)) : ?>
                    <tbody>
    <?php foreach ($platinumIds as $priceId) :
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
    		<!--<button type="submit" class="btn body-content download" onclick="window.location.href='<?php echo site_url('/cash-gold/blog/');?>';"><span>Download pdf</span></button>-->
    		<!--<p class="note">Date Published: <strong>June 11 2015, 13:26:31</strong></p>-->
    		<!--<p class="note">-->
    		<!--    <a href="http://www.kitco.com/connecting.html">-->
    		<!--        <img src="http://www.kitconet.com/charts/metals/gold/t24_au_en_caoz_2.gif" border="0" alt="[Most Recent Quotes from www.kitco.com]"-->
    		<!--                style="width: 58%;">-->
      <!--          </a>-->
      <!--      </p>-->
            
            <div class="tables">
    			<h3>Download pricing</h3>
    			<div class="downloadForm">
    			        <?php get_template_part('template/download-pricing', 'form-home');?>
    			</div>
    			
    		</div>
    	</div>
    	<div class="col-md-4">
    	    <div class="tables">
    			<h3 class="right">Cad Gold Price in Last 5 Days</h3>
                <script type="text/javascript"
                      src="https://www.google.com/jsapi?autoload={
                        'modules':[{
                          'name':'visualization',
                          'version':'1',
                          'packages':['corechart']
                        }]
                      }"></script>
            
                 <div id="chart_div" style="padding-bottom: 11px;"></div>
    		</div>
    		
    		<div class="tables ">
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
                                        <div class="col-xs-4 selectContainer sizemin">
                                            <select name="unit" class="form-control">
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
                                <a href="el:16045582026" class="btn download call"><i class="fa fa-phone"></i><span>Call for better prices</span></a>
                                <p class="text-center small">Today's Gold Price: <strong>$<?php echo $theGoldIndicator->troy_oz_price;?>/oz</strong></p>
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
                                        <div class="col-xs-4 selectContainer sizemin">
                                            <select name="unit" class="form-control">
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
                                <a href="el:16045582026" class="btn download call"><i class="fa fa-phone"></i><span>Call for better prices</span></a>
    <?php
    $theSilverIndicator = $wpdb->get_row("SELECT id, troy_oz_price, ratio_individuals, ratio_lots FROM `vc4g_silver_indicator` ORDER BY modified_time DESC LIMIT 0,1");
    ?>
                                <p class="text-center small">Today's Siver Price: <strong>$<?php echo $theSilverIndicator->troy_oz_price;?>/oz</strong></p>
                            </div>
                        </div>
                    </div>
    			    
    			
    			
    		</div>
    	</div>
    </div>
</div>
<script type="text/javascript">
// google.setOnLoadCallback(drawChart);

function drawChart(chartData) {
    var data = google.visualization.arrayToDataTable(chartData);
    
    var optionsAxisStyle = {bold: true, fontName: "Roboto", fontSize: 11};
    var options = {
    //   title: 'CAD Gold Price in last 5 days',
    //   curveType: 'function',
      legend: { position: 'none' },
      backgroundColor: '#e9ebee',
      colors: ['#d19f42'],
      is3D:true,
      width:'100%',
      vAxis: {textStyle: optionsAxisStyle, format: '$#,###'},
      hAxis: {textStyle: optionsAxisStyle, format: 'MMM dd'}
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

    chart.draw(data, options);
}

$.ajax({
    url: vc4g.ajax_url + '?action=ajax_gold_prices',
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