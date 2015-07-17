<section class="webuy diamond blog">
    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <div class="body-blog">
                    <?php get_template_part('template/blog', 'load');?>
                </div>
                <div class="pagination-share mt40">
                    <div class="pagi">
                        <a href="#" class="mr20"><i class="fa fa-angle-left"></i> Back</a><a href="#">Next <i class="fa fa-angle-right"></i></a>
                    </div>
                    <div class="share">
                        <ul class="list-inline social-buttons">
                            <li>Share</li>
                            <li class="text-center"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="text-center"><a href="#"><i class="fa fa-facebook"></i></a></li>
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