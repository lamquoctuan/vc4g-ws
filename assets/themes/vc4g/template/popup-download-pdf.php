<!-- Modal -->
<div id="popupModal" class="modal fade" role="dialog" >
  <div class="modal-dialog signup">

    <!-- Modal content-->
    <div class="modal-content">
      <!--<div class="modal-header">-->
      <!--  <button type="button" class="close" data-dismiss="modal">&times;</button>-->
      <!--  <h4 class="modal-title">Modal Header</h4>-->
      <!--</div>-->
      <div class="modal-body">
        <div class="container">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
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
    var delayTime = 6000;
    $(window).ready(function(){
        setTimeout(function(){
            $('#popupModal').modal('show');
        }, 6000);
    });
    
    $('#popupModal').on('show.bs.modal', function (e) {
        analytics.track('popup', {
            form: 'Download PDF',
            delayTime: delayTime
        });
    })
</script>