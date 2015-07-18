<?php
include_once CUR_THEME_DIR . '/inc/Connectors/Yahoo.php';
use \LNR\Connectors\Yahoo;
$connector = new Yahoo();
$condition = $connector->getCondition();
//var_dump($condition->code);
echo setWeatherIcon($condition->code);
?>
<p><?php echo $condition->text;?></p>
<!--<i class="fa icon-snow"></i>-->
<p class="temperature"><?php echo $condition->temp;?><sup>o</sup>F</p>
<p><?php echo setWarmMessageBy($condition->code);?></p>