<?php
require_once WP_CONTENT_DIR . '/lib/dompdf/dompdf_config.inc.php';

function generatePdf () {
    global $wpdb;
    $datePublished = $wpdb->get_var('SELECT MAX( modified_time ) date_published FROM  `vc4g_gold_table`');
    if ($datePublished) {
        $datePublishedStr = gmdate('Y-m-d', strtotime($datePublished)).strtotime($datePublished);
    }
    else {
        $datePublishedStr = gmdate('Y-m-d').strtotime('now');
    }
    
    $fileName = "vancouver-cash-for-gold-{$datePublishedStr}.pdf";
    $fileUri = "/pdf/{$fileName}";
    
    if (! file_exists( ABSPATH . $fileUri)) {
        $goldTableQuery = "SELECT purity.id purity_id, purity.name purity_name, purity purity_value, price.id price_id, price.table_id, price.purity_id price_purity_id, price.price_individuals, price.price_lots
            FROM  `vc4g_gold_purity` purity
            LEFT JOIN  `vc4g_gold_price` price ON ( purity.id = price.purity_id ) 
            LEFT JOIN  `vc4g_gold_table` gtable ON ( price.table_id = gtable.id ) 
            WHERE gtable.modified_time = '{$datePublished}'
            GROUP BY price.table_id, purity.purity
            ORDER BY purity.purity DESC , purity.modified_time DESC";
        $goldTableRes = $wpdb->get_results($goldTableQuery);
        $tblGoldRates = '';
        if ($goldTableRes) {
            $alternative = false;
            foreach ($goldTableRes as $goldTableRec) {
                $class = ($alternative) ? 'tableColumn alternative' : 'tableColumn';
                $tblGoldRates .= '<tr>
                            <td align="left" class="'.$class.' tableColumnNotLast">'.$goldTableRec->purity_name.'</td>
                            <td align="left" class="'.$class.' tableColumnNotLast">$'.$goldTableRec->price_individuals.'/g</td>
                            <td align="left" class="'.$class.'">$'.$goldTableRec->price_lots.'/g</td>
                        </tr>';
                $alternative = ($alternative == false) ? true : $alternative;
            }
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
        
        $tblGoldCoin = '';
        if (! empty($goldCoinIds)) {
            $alternative = false;
            foreach ($goldCoinIds as $priceId) {
                $class = ($alternative) ? 'tableColumn alternative' : 'tableColumn';
                $type   = get_field('type', $priceId);
                $price  = get_field('price', $priceId);
                $unit   = get_field('unit', $priceId); 
                $unitStr = ($unit) ? '/' . $unit : '';
                $tblGoldCoin = '<tr>
                                    <td align="left" class="'.$class.' tableColumnNotLast">'.$type.'</td>
                                    <td align="left" class="'.$class.'">$'.$price.$unitStr.'</td>
                                </tr>';
                $alternative = ($alternative == false) ? true : $alternative;
            }
        }
        
        $tblGoldBullion = '';
        if (! empty($goldBullionIds)) {
            $alternative = false;
            foreach ($goldBullionIds as $priceId) {
                $class = ($alternative) ? 'tableColumn alternative' : 'tableColumn';
                $type   = get_field('type', $priceId);
                $price  = get_field('price', $priceId);
                $unit   = get_field('unit', $priceId); 
                $unitStr = ($unit) ? '/' . $unit : '';
                $tblGoldBullion = '<tr>
                                    <td align="left" class="'.$class.' tableColumnNotLast">'.$type.'</td>
                                    <td align="left" class="'.$class.'">$'.$price.$unitStr.'</td>
                                </tr>';
                $alternative = ($alternative == false) ? true : $alternative;
            }
        }
        
        $tblSilver = '';
        if (! empty($silverIds)) {
            $alternative = false;
            foreach ($silverIds as $priceId) {
                $class = ($alternative) ? 'tableColumn alternative' : 'tableColumn';
                $type   = get_field('type', $priceId);
                $price  = get_field('price', $priceId);
                $unit   = get_field('unit', $priceId); 
                $unitStr = ($unit) ? '/' . $unit : '';
                $tblSilver = '<tr>
                                    <td align="left" class="'.$class.' tableColumnNotLast">'.$type.'</td>
                                    <td align="left" class="'.$class.'">$'.$price.$unitStr.'</td>
                                </tr>';
                $alternative = ($alternative == false) ? true : $alternative;
            }
        }
        
        $tblPlatinum = '';
        if (! empty($platinumIds)) {
            $alternative = false;
            foreach ($platinumIds as $priceId) {
                $class = ($alternative) ? 'tableColumn alternative' : 'tableColumn';
                $type   = get_field('type', $priceId);
                $price  = get_field('price', $priceId);
                $unit   = get_field('unit', $priceId); 
                $unitStr = ($unit) ? '/' . $unit : '';
                $tblPlatinum = '<tr>
                                    <td align="left" class="'.$class.' tableColumnNotLast">'.$type.'</td>
                                    <td align="left" class="'.$class.'">$'.$price.$unitStr.'</td>
                                </tr>';
                $alternative = ($alternative == false) ? true : $alternative;
            }
        }
        
        $html = file_get_contents ( DOMPDF_DIR. '/pricing/download-pricing-content.html' );
        $html = isset($_SERVER['APP_CDN']) ? str_replace('{{SITE_URL}}', 'https://' . $_SERVER['APP_CDN'], $html) : str_replace('{{SITE_URL}}', site_url(), $html);
        $html = str_replace('{{GOLD_RATE}}', $tblGoldRates, $html);
        $html = str_replace('{{GOLD_COIN}}', $tblGoldCoin, $html);
        $html = str_replace('{{GOLD_BULLION}}', $tblGoldBullion, $html);
        $html = str_replace('{{SILVER}}', $tblSilver, $html);
        $html = str_replace('{{PLATINUM}}', $tblPlatinum, $html);
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        $dompdf = new DOMPDF();
        set_time_limit(500);
        $paperSize = array(0,0,600,900);
        $dompdf->set_paper($paperSize);
        $dompdf->load_html($html);
        // $dompdf->load_html_file(DOMPDF_DIR. '/pricing/download-pricing-content.html');
        $dompdf->render();
        $pdf = $dompdf->output();
        
        file_put_contents(ABSPATH . $fileUri, $pdf);
    }

    return $fileUri;
}
?>