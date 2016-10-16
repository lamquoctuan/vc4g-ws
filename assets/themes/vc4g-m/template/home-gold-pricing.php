<?php
$strDownloadForm = CUR_THEME_NAME . gmdate('Y-m-d') . '-ajax_download';
$ajaxDownloadForm = wp_create_nonce( $strDownloadForm );
?>
<section class="download-section" id="download">
    <div class="tables">
        <h3>Download pricing</h3>
        <div class="downloadForm">
            <form class="form-horizontal" accept-charset="UTF-8" id="downloadForm" novalidate="" siq_id="autopick_3384">
                <div class="form-group">
                    <label class="control-label">First Name</label>
                    <div class="input-theme">
                        <input type="text" class="form-control" placeholder="Your Name" id="name" name="name" required="" data-validation-required-message="Please enter your name." aria-invalid="false">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Email Address</label>
                    <div class="input-theme">
                        <input type="text" class="form-control" placeholder="Email Address" id="email" name="email" required="" data-validation-required-message="Please enter your mail." aria-invalid="false">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <a href="javascript:void(0);" class="btn download" style="cursor: pointer;"><span>Download</span></a>
                <input type="hidden" name="action" value="ajax_download">
                <input type="hidden" name="security" value="<?php echo $ajaxDownloadForm;?>"/>
                <input type="hidden" id="thanks" value="/thank/download/">
            </form>
            <p class="text-center small pl30 pr30">Enter your name and email above and click "DOWNLOAD!"</p>
        </div>
    </div>
</section>
<script type="text/javascript">
/*global $, analytics*/
var $formDownload = $('#downloadForm');
$formDownload.find('.btn.download').click(function(){
    if (typeof(analytics) != 'undefined') {
        analytics.track('form_action', {
            action: 'download',
            source: 'Home-HowToSell'
        }, function(){
            $formDownload.submit();
        });
    }
    else {
        $formDownload.submit();
    }
});
</script>