<footer>
    <div class="container pt20">
        <div class="row">
            <div class="col-md-6 text-center">
                <span class="copyright">Copyright Vancouver Cash for Gold 2016</span>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript">
/*global $*/
    $(document).ready(function() {

        $('.tabs a').click(function() {
            var tab_id = $(this).attr('data-tab');

            $('.tabs a').removeClass('active');
            $('.tab-content').removeClass('current');

            $(this).addClass('active');
            $("#" + tab_id).addClass('active');
        });

        $('#accordion .accordion-toggle').click(function(e) {
            var chevState = $(e.target).siblings("i.indicator").toggleClass('fa-chevron-up fa-chevron-down');
            $("i.indicator").not(chevState).removeClass("fa-chevron-up").addClass("fa-chevron-down");
        });

    });
</script>

</body>

</html>