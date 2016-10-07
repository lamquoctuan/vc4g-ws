<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top navbar-shrink">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="pull-right phone-call" href="tel:16045582026"><img src="/images/m/icon-phone.png" alt="16045582026"> 604-558-2026</a>
            <a class="navbar-brand page-scroll" href="<?php echo site_url();?>"><img src="/images/logo.png" /></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php
            $menu_name = 'primary';

            if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
                $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

                $menu_items = wp_get_nav_menu_items($menu->term_id);

                $menu_list = '<ul class="nav navbar-nav navbar-right">';

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
                $menu_list .= '<li><a class="page-scroll" href="tel:16045582026"><b class="icon-phone"></b>604-558-2026</a></li>';
                $menu_list .= '</ul>';
                echo $menu_list;
            }
            //li class hidden|active|none
            ?>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>