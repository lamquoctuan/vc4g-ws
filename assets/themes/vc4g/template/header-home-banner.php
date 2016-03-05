<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" >
  <div class="modal-dialog signup">

    <!-- Modal content-->
    <div class="modal-content">
      <!--<div class="modal-header">-->
      <!--  <button type="button" class="close" data-dismiss="modal">&times;</button>-->
      <!--  <h4 class="modal-title">Modal Header</h4>-->
      <!--</div>-->
      <div class="modal-body">
        <div class="container">
            
                <div class="col-left text-center">
                    <div class="downloadPopup">
                        <?php get_template_part('template/download-pricing', 'form-popup');?>
                    </div>
                </div>

             
         </div>
      </div>
      <!--<div class="modal-footer">-->
      <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      <!--</div>-->
    </div>

  </div>
</div>
<script type="text/javascript">
    $(window).load(function(){
        $('#myModal').modal('show');
    });
</script>

<!-- Header -->
<header class="bg-header">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-left pt20">
                <img src="/assets/images/logo.png" />
            </div>
            <div class="col-md-6 text-right pt20">
    			<a class="sub-phone" href="tel:16045582026"><b class="icon-phone"></b>604-558-2026</a>
    			<span class="address-banner">3515 Kingsway, Vancouver, BC V5R 5L8</span>
    		</div>
        </div>
        <div class="intro-text">
            <div class="intro-lead-in">Payment in Cash Gold, Silver</div>
            <div class="intro-heading">We Buy Diamond <span>At</span> Any Size<acronym title=""><img src="/assets/images/logo-gia-small.jpg" alt=""></acronym></div>
            <a href="#services" class="page-scroll btn btn-xl">How it works</a>
            <p class="phone-banner">or call <strong><a href="tel:16045582026">604-558-2026</a></strong></p>
        </div>
    </div>
</header>

