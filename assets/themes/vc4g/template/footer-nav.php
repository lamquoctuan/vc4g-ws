<?php
$menu_name = 'primary';

if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
    $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

    $menu_items = wp_get_nav_menu_items($menu->term_id);

    $menu_list = '<ul class="list-unstyled menu-footer">';

    foreach ( (array) $menu_items as $key => $menu_item ) {
        $title = $menu_item->title;
        $url = $menu_item->url;
        $class = '';
        error_log(print_r($menu_item,true));
        error_log(print_r($cat,true));
        if ($menu_item->object_id == get_the_ID() || $menu_item->object_id == $cat) {
            $class = ' class="active"';
        }
        $menu_list .= '<li'. $class . '><a href="' . $url . '">' . $title . '</a></li>';
    }
    $menu_list .= '</ul>';
    echo $menu_list;
}
//li class hidden|active|none
?>