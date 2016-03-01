<section class="webuy diamond blog">
    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <div class="body-blog">
                    <?php get_template_part('template/blog', 'load');?>
                </div>
                <div class="pagination-share mt40">
                    <?php
                    $next_post = get_next_post(true);
                    $prev_post = get_previous_post(true);
                    ?>
                    <div class="pagi">
                        <?php if ( is_a( $prev_post , 'WP_Post' ) ) { ?>
                            <a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="mr20"Z><i class="fa fa-angle-left"></i> Back</a>
                        <?php } ?><?php if ( is_a( $next_post , 'WP_Post' ) ) { ?>
                             <a href="<?php echo get_permalink( $next_post->ID ); ?>">Next <i class="fa fa-angle-right"></i></a>
                         <?php } ?>
                    </div>
                    <div class="share">
                    <?php 
                        $shareTitle = urlencode(get_the_title());
                        $shareUrl   = urlencode(get_permalink());
                    ?>
                        <ul class="list-inline social-buttons">
                            <li>Share</li>
                            <li class="text-center"><a href="//twitter.com/intent/tweet?status=<?php echo $shareTitle;?>+<?php echo $shareUrl;?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li class="text-center"><a href="//www.facebook.com/share.php?u=<?php echo $shareTitle;?>&title=<?php echo $shareUrl;?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php get_template_part('template/blog', 'sidebar');?>
            </div>
        </div>
    </div>
</section>