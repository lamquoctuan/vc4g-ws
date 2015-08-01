<?php
include_once CUR_THEME_DIR . '/inc/Connectors/Zoho.php';
use \LNR\Helper;
use \LNR\Connectors\Zoho;
$connector = new Zoho();
$result = $connector->insertRecords();
echo '<pre>';
var_dump($result);
echo '</pre>';
?>