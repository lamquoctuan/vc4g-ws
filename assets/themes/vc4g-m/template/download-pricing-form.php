<?php
$strDownloadForm = CUR_THEME_NAME . gmdate('Y-m-d') . '-ajax_download';
$ajaxDownloadForm = wp_create_nonce( $strDownloadForm );
?>
<h4>Download Pricing</h4>
<form accept-charset="UTF-8" id="downloadForm" novalidate>
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Your Name" id="name" name="name"
                required="" data-validation-required-message="Please enter your name." aria-invalid="false">
        <p class="help-block text-danger"></p>
    </div>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="Email Address" id="email" name="email"
                required="" data-validation-required-message="Please enter your mail." aria-invalid="false">
        <p class="help-block text-danger"></p>
    </div>
    <a href="javascript:void(0);" class="btn download"><span>DOWNLOAD</span></a>
    <input type="hidden" name="action" value="ajax_download"/>
    <input type="hidden" name="security" value="<?php echo $ajaxDownloadForm;?>"/>
    <input type="hidden" id="thanks" value="/thank/download/"/>
</form>
<p class="text-center small">Enter your name and email above and click, "DOWNLOAD!"</p>
<script type="text/javascript">
var $formDownload = $('#downloadForm');
$formDownload.find('.btn.download').click(function(){
    $formDownload.submit();    
});
</script>