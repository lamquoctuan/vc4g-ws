<?php
function getPurchasedItems($types = array())
{
    $purchasedItems = [];
    if (!empty($types)) {
        foreach ($types as $type) {
            $purchasedItems[$type] = [];
        }
    }
    $args = array(
        'post_type' => 'purchased_item',
        'orderby' => 'meta_value',
        'meta_key' => 'type',
        'posts_per_page' => -1,
    );
    $theQuery = new WP_Query($args);
    while ($theQuery->have_posts()) {
        $theQuery->the_post();
        global $post;

        $item = new \StdClass();
        $item->title = get_the_title();
        $item->type = get_field('type');
        $item->price = get_field('price');
        $item->image = get_field('image');

        if (!isset($purchasedItems[$item->type])) {
            $purchasedItems[$item->type] = [];
        }
        array_push($purchasedItems[$item->type], $item);
    }
    wp_reset_postdata(); // reset the query
    return $purchasedItems;
}

function new_excerpt_more($more)
{
    return '...';
}

add_filter('excerpt_more', 'new_excerpt_more');

/**
 * set weather icon by condition code
 *
 * @param $conditionId
 * @return string
 */
function setWeatherIcon($conditionId)
{
    switch ($conditionId) {
        case '0':
            $iconTag = '<i class="wi wi-tornado"></i>';
            break;
        case '1':
            $iconTag = '<i class="wi wi-storm-showers"></i>';
            break;
        case '2':
            $iconTag = '<i class="wi wi-tornado"></i>';
            break;
        case '3':
            $iconTag = '<i class="wi wi-thunderstorm"></i>';
            break;
        case '4':
            $iconTag = '<i class="wi wi-thunderstorm"></i>';
            break;
        case '5':
            $iconTag = '<i class="fa icon-snow"></i>';
            break;
        case '6':
            $iconTag = '<i class="fa icon-rainy"></i>';
            break;
        case '7':
            $iconTag = '<i class="fa icon-rainy"></i>';
            break;
        case '8':
            $iconTag = '<i class="wi wi-sprinkle"></i>';
            break;
        case '9':
            $iconTag = '<i class="wi wi-sprinkle"></i>';
            break;
        case '10':
            $iconTag = '<i class="wi wi-hail"></i>';
            break;
        case '11':
            $iconTag = '<i class="wi wi-showers"></i>';
            break;
        case '12':
            $iconTag = '<i class="wi wi-showers"></i>';
            break;
        case '13':
            $iconTag = '<i class="fa icon-snow"></i>';
            break;
        case '14':
            $iconTag = '<i class="wi wi-storm-showers"></i>';
            break;
        case '15':
            $iconTag = '<i class="fa icon-snow"></i>';
            break;
        case '16':
            $iconTag = '<i class="fa icon-snow"></i>';
            break;
        case '17':
            $iconTag = '<i class="wi wi-hail"></i>';
            break;
        case '18':
            $iconTag = '<i class="wi wi-hail"></i>';
            break;
        case '19':
            $iconTag = '<i class="wi wi-cloudy-gusts"></i>';
            break;
        case '20':
            $iconTag = '<i class="wi wi-fog"></i>';
            break;
        case '21':
            $iconTag = '<i class="wi wi-fog"></i>';
            break;
        case '22':
            $iconTag = '<i class="wi wi-fog"></i>';
            break;
        case '23':
            $iconTag = '<i class="wi wi-cloudy-gusts"></i>';
            break;
        case '24':
            $iconTag = '<i class="wi wi-cloudy-windy"></i>';
            break;
        case '25':
            $iconTag = '<i class="wi wi-thermometer"></i>';
            break;
        case '26':
            $iconTag = '<i class="fa icon-cool"></i>';
            break;
        case '27':
            $iconTag = '<i class="wi wi-night-cloudy"></i>';
            break;
        case '28':
            $iconTag = '<i class="wi wi-day-cloudy"></i>';
            break;
        case '29':
            $iconTag = '<i class="wi wi-night-cloudy"></i>';
            break;
        case '30':
            $iconTag = '<i class="wi wi-day-cloudy"></i>';
            break;
        case '31':
            $iconTag = '<i class="wi wi-night-clear"></i>';
            break;
        case '32':
            $iconTag = '<i class="fa icon-sunny"></i>';
            break;
        case '33':
            $iconTag = '<i class="wi wi-night-clear"></i>';
            break;
        case '34':
            $iconTag = '<i class="wi wi-day-sunny-overcast"></i>';
            break;
        case '35':
            $iconTag = '<i class="wi wi-hail"></i>';
            break;
        case '36':
            $iconTag = '<i class="fa icon-sunny"></i>';
            break;
        case '37':
            $iconTag = '<i class="wi wi-thunderstorm"></i>';
            break;
        case '38':
            $iconTag = '<i class="wi wi-thunderstorm"></i>';
            break;
        case '39':
            $iconTag = '<i class="wi wi-thunderstorm"></i>';
            break;
        case '40':
            $iconTag = '<i class="wi wi-storm-showers"></i>';
            break;
        case '41':
            $iconTag = '<i class="fa icon-snow"></i>';
            break;
        case '42':
            $iconTag = '<i class="fa icon-snow"></i>';
            break;
        case '43':
            $iconTag = '<i class="fa icon-snow"></i>';
            break;
        case '44':
            $iconTag = '<i class="fa icon-cool"></i>';
            break;
        case '45':
            $iconTag = '<i class="fa icon-lightning"></i>';
            break;
        case '46':
            $iconTag = '<i class="fa icon-snow"></i>';
            break;
        case '47':
            $iconTag = '<i class="wi wi-thunderstorm"></i>';
            break;
        case '3200':
            $iconTag = '<i class="wi wi-cloud"></i>';
            break;
        default:
            $iconTag = '<i class="wi wi-cloud"></i>';
            break;
    }

    return $iconTag;

}

function setWarmMessageBy($conditionId) {
    switch ($conditionId) {
        case '0':
        case '1':
        case '2':
            $message = 'Do you want to visit us right now? The weather didn\'t agree with you.';
            break;
        case '3':
        case '4':
        case '5':
        case '6':
        case '7':
        case '8':
        case '9':
        case '10':
        case '11':
        case '12':
        case '13':
        case '14':
        case '15':
        case '16':
        case '17':
        case '18':
        case '19':
        case '20':
        case '21':
        case '22':
        case '23':
        case '35':
        case '35':
        case '37':
        case '38':
        case '39':
        case '40':
        case '41':
        case '42':
        case '43':
        case '45':
        case '46':
        case '47':
            $message = 'Visit us only if well prepared. Ensure you access the latest weather forecast.';
            break;
        case '24':
        case '25':
        case '26':
        case '27':
        case '28':
        case '29':
        case '30':
        case '31':
        case '44':
        case '3200':
            $message = 'The weather is not expected to have any noticeable impacts. See you in Vancouver!';
            break;
        case '32':
        case '33':
        case '34':
        case '36':
            $message = 'Make the most of this beautiful weather. The ideal time for travelling around Vancouver.';
            break;
        default:
            $message = 'Visit us only if well prepared. Ensure you access the latest weather forecast.';
            break;
    }

    return $message;
}