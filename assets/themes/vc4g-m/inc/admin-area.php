<?php
add_action( 'admin_menu', 'register_vc4g_adjustment' );

function register_vc4g_adjustment(){
	add_menu_page( 'Adjustment', 'Adjustment', 'manage_options', 'vc4g-adjustment-page', 'vc4g_adjustment_page', 'dashicons-admin-generic', 79 ); 
    
    add_submenu_page( 'vc4g-adjustment-page', 'Gold Rate Generator', 'Generator - Gold Rate', 'manage_options', 'vc4g-gold-rate-generator-page', 'vc4g_gold_rate_generator_page' );
    add_submenu_page( 'vc4g-adjustment-page', 'Silver Rate Generator', 'Generator - Silver Rate', 'manage_options', 'vc4g-silver-rate-generator-page', 'vc4g_silver_rate_generator_page' );
}

function vc4g_adjustment_page(){
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	} ?>
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
<?php
}

function vc4g_gold_rate_generator_page(){
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	} ?>
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
<?php
    vc4g_the_rate_generator_page('gold');
}

function vc4g_silver_rate_generator_page(){
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	} ?>
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
<?php
    vc4g_the_rate_generator_page('silver');
}

function vc4g_the_rate_generator_page($type){
    global $wpdb;
    if (! empty($_POST)) {
        $userId = get_current_user_id();
        $wpdb->insert( 
        	"vc4g_{$type}_table", 
        	array( 
        		'name' => 'value1', 
        		'modified_by' => $userId 
        	), 
        	array( 
        		'%s', 
        		'%d' 
        	) 
        );
        $gtableId = $wpdb->insert_id;

        $pricePerTroyOz         = $_POST['price-per-troy-oz'];
        $priceRatioIndividuals  = $_POST['price-ratio-individuals'];
        $priceRatioLots         = $_POST['price-ratio-lots'];
        $wpdb->insert( 
        	"vc4g_{$type}_indicator", 
        	array( 
        		'table_id' => $gtableId, 
        		'troy_oz_price' => $pricePerTroyOz, 
        		'ratio_individuals' => $priceRatioIndividuals, 
        		'ratio_lots' => $priceRatioLots, 
        		'modified_by' => $userId 
        	), 
        	array(
        	    '%d',
        		'%f', 
        		'%f', 
        		'%f', 
        		'%d' 
        	) 
        );
        
        $rates = $_POST['rate'];
        foreach($rates as $purityId=>$ratesValues) {
            $wpdb->insert( 
            	"vc4g_{$type}_price", 
            	array(
            	    'table_id' => $gtableId,
            		'purity_id' => $purityId, 
            		'price_individuals' => $ratesValues['price_individuals'], 
            		'price_lots' => $ratesValues['price_lots'], 
            		'modified_by' => $userId 
            	), 
            	array(
            	    '%d',
            	    '%d',
            		'%f', 
            		'%f',
            		'%d'
            	) 
            );
        
        }
    }
    $priceTableId = $wpdb->get_var("SELECT id FROM `vc4g_{$type}_table` ORDER BY modified_time DESC LIMIT 0,1");
    
    $pricePerTroyOz         = '';
    $priceRatioIndividuals  = '';
    $priceRatioLots         = '';
    if (! is_null($priceTableId)) {
        $theIndicator = $wpdb->get_row("SELECT id, troy_oz_price, ratio_individuals, ratio_lots FROM `vc4g_{$type}_indicator` WHERE table_id = {$priceTableId} LIMIT 0,1");
        if (! is_null($theIndicator)) {
            $pricePerTroyOz         = $theIndicator->troy_oz_price;
            $priceRatioIndividuals  = $theIndicator->ratio_individuals;
            $priceRatioLots         = $theIndicator->ratio_lots;
        }
    }
    
    $query = "SELECT purity.id purity_id, purity.name purity_name, purity purity_value, price.id price_id, price.table_id, price.purity_id price_purity_id, price.price_individuals, price.price_lots
                FROM  `vc4g_{$type}_purity` purity
                LEFT JOIN  `vc4g_{$type}_price` price ON ( purity.id = price.purity_id ) 
                LEFT JOIN  `vc4g_{$type}_table` gtable ON ( price.table_id = gtable.id ) ";
    if (! is_null($priceTableId)) {
        $query .= "WHERE gtable.id = '{$priceTableId}'";
    }
    $query .= "GROUP BY price.table_id, purity.purity
                ORDER BY purity.purity DESC , purity.modified_time DESC ";
    $theRates = $wpdb->get_results( $query, OBJECT );
?>
    <div class="widget-liquid-left">
        <div id="widgets-left">
            <form id="generateForm" action="#" method="post">
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label for="price-per-troy-oz">Price per Ounce</label>
                            </th>
                            <td>
                                <input type="text" maxlength="10" style="text-align: right;"
                                        value="<?php echo $pricePerTroyOz;?>" id="price-per-troy-oz" name="price-per-troy-oz">/oz
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="price-ratio-individuals">Ratio (Individuals)</label>
                            </th>
                            <td>
                                <input type="text" maxlength="10" style="text-align: right;"
                                        value="<?php echo $priceRatioIndividuals;?>" id="price-ratio-individuals" name="price-ratio-individuals">%
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="price-ratio-lots">Ratio (Lots)</label>
                            </th>
                            <td>
                                <input type="text" maxlength="10" style="text-align: right;"
                                        value="<?php echo $priceRatioLots;?>" id="price-ratio-lots" name="price-ratio-lots">%
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p class="submit"><input type="button" value="Generate" class="button-primary" id="btnGenerate" name="generate"></p>
            </form>
        </div>
    </div>
    <div class="widget-liquid-right">
        <div id="widgets-right">
            <form id="saveRatesForm" method="post">
                <!--<input type="hidden" name="page" value="vc4g-gold-rate-generator-page"/>-->
            	<table class="widefat fixed" cellspacing="0">
                    <thead>
                        <tr>
                            <th id="cb" class="manage-column column-cb check-column" scope="col"></th> <!--this column contains checkboxes-->
                            <th id="columnname" class="manage-column column-columnname" scope="col">Actions</th>
                            <th id="columnname" class="manage-column column-columnname" scope="col">Scrap Gold</th>
                            <th id="columnname" class="manage-column column-columnname num" scope="col">Individuals ($/g)</th> <!--"num" added because the column contains numbers-->
                            <th id="columnname" class="manage-column column-columnname num" scope="col">Lots ($/g)</th> <!--"num" added because the column contains numbers-->
                        </tr>
                    </thead>
        <?php if ($theRates) :?>
                    <tbody>
        <?php
            for($idx = 0; $idx<count($theRates); $idx++) :
                $theRate = $theRates[$idx];
                $isAlternate = ($idx % 2 == 0);
        ?>
                        <tr<?php echo ($isAlternate)?' class="alternate"':'';?>>
                            <th class="check-column" scope="row">
                                <input type="hidden" name="rate[<?php echo $theRate->purity_id;?>][price_id]" value="<?php echo $theRate->price_id;?>"/>
                                <input type="hidden" name="rate[<?php echo $theRate->purity_id;?>][table_id]" value="<?php echo $theRate->table_id;?>"/>
                            </th>
                            <td class="column-columnname">
                                <div class="row-actions">
                                    <span name="#edit"><a href="javascript:void(0);">Edit</a></span>
                                    <span name="#cancel" style="display:none;"><a href="javascript:void(0);">Cancel</a></span>
                                </div>
                            </td>
                            <td class="column-columnname">
                                <?php echo $theRate->purity_name;?>
                                <input type="hidden" name="rate[<?php echo $theRate->purity_id;?>][purity_value]" value="<?php echo $theRate->purity_value;?>"/>
                            </td>
                            <td class="column-columnname" style="text-align: right;">
                                <span><?php echo $theRate->price_individuals;?></span>
                                <input type="hidden" name="rate[<?php echo $theRate->purity_id;?>][price_individuals]" value="<?php echo $theRate->price_individuals;?>"/>
                            </td>
                            <td class="column-columnname" style="text-align: right;">
                                <span><?php echo $theRate->price_lots;?></span>
                                <input type="hidden" name="rate[<?php echo $theRate->purity_id;?>][price_lots]" value="<?php echo $theRate->price_lots;?>"/>
                            </td>
                        </tr>
        <?php
            endfor;?>
                    </tbody>
        <?php endif;?>
                </table>
                <p class="submit">
                    <input type="submit" value="Save Changes" class="button-primary" name="save">
                    <input type="hidden" value="<?php echo $pricePerTroyOz;?>" id="price-per-troy-oz" name="price-per-troy-oz">
                    <input type="hidden" value="<?php echo $priceRatioIndividuals;?>" id="price-ratio-individuals" name="price-ratio-individuals">
                    <input type="hidden" value="<?php echo $priceRatioLots;?>" id="price-ratio-lots" name="price-ratio-lots">
                </p>
            </form>
        </div>
    </div>
<script type="text/javascript">
var $v = jQuery.noConflict();
$v(document).ready(function(){
    $v('[name="#edit"]').click(function(){
        var ele = $v(this);
        ele.hide();
        ele.parent().find('[name="#cancel"]').show();
        ele.closest('tr').find('[name$="[price_individuals]"]').attr('type','text');
        ele.closest('tr').find('[name$="[price_individuals]"]').prev().hide();
        ele.closest('tr').find('[name$="[price_lots]"]').attr('type','text');
        ele.closest('tr').find('[name$="[price_lots]"]').prev().hide();
    });
    $v('[name="#cancel"]').click(function(){
        var ele = $v(this);
        ele.hide();
        ele.parent().find('[name="#edit"]').show();
        ele.closest('tr').find('[name$="[price_individuals]"]').attr('type','hidden');
        ele.closest('tr').find('[name$="[price_individuals]"]').val(ele.closest('tr').find('[name$="[price_individuals]"]').prev().html());
        ele.closest('tr').find('[name$="[price_individuals]"]').prev().show();
        ele.closest('tr').find('[name$="[price_lots]"]').attr('type','hidden');
        ele.closest('tr').find('[name$="[price_lots]"]').val(ele.closest('tr').find('[name$="[price_individuals]"]').prev().html());
        ele.closest('tr').find('[name$="[price_lots]"]').prev().show();
    });
    
    $v('#btnGenerate').click(function(){
        var $form = $v(this).closest('form');
        var priceOz = parseFloat($form.find('#price-per-troy-oz').val());
        var priceRatioInds = parseFloat($form.find('#price-ratio-individuals').val());
        var priceRatioLots = parseFloat($form.find('#price-ratio-lots').val());
        if (isNaN(priceOz) || isNaN(priceRatioInds) || isNaN(priceRatioLots)) {
            alert('Please enter all required fields.');
        }
        else {
            if (priceRatioInds >= 100 || priceRatioInds <= 0 || priceRatioLots >= 100 || priceRatioLots <= 0) {
                alert('Please enter a right ratio.');
            }
            else {
                var $formSave = $v('#saveRatesForm');
                $formSave.find('#price-per-troy-oz').val(priceOz);
                $formSave.find('#price-ratio-individuals').val(priceRatioInds);
                $formSave.find('#price-ratio-lots').val(priceRatioLots);
                
                var pricePerGram = priceOz / 31.1;
                var pricePerGramInds = pricePerGram;
                var pricePerGramLots = pricePerGram;
                if (priceRatioInds < 1) {
                    pricePerGramInds = pricePerGram * priceRatioInds;
                }
                else {
                    pricePerGramInds = (pricePerGram * priceRatioInds) / 100;
                }
                if (priceRatioLots < 1) {
                    pricePerGramLots = pricePerGram * priceRatioLots;
                }
                else {
                    pricePerGramLots = (pricePerGram * priceRatioLots) / 100;
                }
                $v('[name$="[purity_value]"]').each(function(){
                    var proportion = parseFloat($v(this).val());
                    var priceInds = (proportion * pricePerGramInds /100 ).toFixed(2);
                    var priceLots = (proportion * pricePerGramLots /100 ).toFixed(2);

                    $v(this).closest('tr').find('[name$="[price_individuals]"]').val(priceInds);
                    $v(this).closest('tr').find('[name$="[price_individuals]"]').prev().html(priceInds);
                    $v(this).closest('tr').find('[name$="[price_lots]"]').val(priceLots);
                    $v(this).closest('tr').find('[name$="[price_lots]"]').prev().html(priceLots);
                });
                console.log(pricePerGramInds, pricePerGramLots);
            }
        }
    });
});
</script>
<?php
}
?>