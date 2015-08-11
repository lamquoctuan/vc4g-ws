<footer>
    <div class="container pt20">
        <div class="row">
            <div class="col-md-6">
                <span class="copyright">Copyright &copy; <?php echo get_bloginfo() . ' ' . date('Y');?></span>
            </div>
            <div class="col-md-6 text-right">
                <ul class="list-inline social-buttons">
                    <li class="text-center"><a href="//www.yelp.com/biz/vancouver-cash-for-gold-vancouver" target="_blank"><i class="fa fa fa-yelp"></i></a></li>
                    <li class="text-center"><a href="//twitter.com/VanCash4Gold" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li class="text-center"><a href="//www.facebook.com/VancouverCashforGold" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li class="text-center"><a href="//plus.google.com/+Vancouvercashforgoldbuyer/about" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div>

        </div>
    </div>
</footer>
<script type="text/javascript">
$(document).ready(function() {
    $("form .btn").ajaxStart(function() {
        $(this).css('cursor', 'wait');
    });

    $("form .btn").ajaxComplete(function() {
        $(this).css('cursor', 'auto');
    });
});
</script>