<?php
$strDownloadForm = CUR_THEME_NAME . gmdate('Y-m-d') . '-ajax_download';
$ajaxDownloadForm = wp_create_nonce( $strDownloadForm );
?>
<h4><img src="/assets/images/text-quick.png"  alt="A Quick Look at our Gold Rate?"></h4>
<p>Sign up to Vancouver Cash for Gold newsletter and get our most recent list price and HOT deal that we ONLY share with my private newsletter subscribers.</p>
<form accept-charset="UTF-8" id="downloadPopupForm" novalidate="">
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Enter your Email" id="email" name="email" 
            required="" data-validation-required-message="Please enter your mail." aria-invalid="false">
        <p class="help-block text-danger"></p>
    </div>
    <a href="javascript:void(0);" class="btn download"><span>DOWNLOAD Now</span></a>
    <input type="hidden" name="action" value="ajax_download">
    <input type="hidden" name="security" value="<?php echo $ajaxDownloadForm;?>"/>
    <input type="hidden" id="thanks" value="/thank/download/">
</form>
<p class="text-center small">Unsubscribe at any time, and of course we hate spam just as much as you do</p>
<script type="text/javascript">
/*global $, analytics*/
var $formDownloadPopup = $('#downloadPopupForm');
$formDownloadPopup.find('.btn.download').click(function(){
    if (typeof(analytics) != 'undefined') {
        analytics.track('form_action', {
            action: 'download',
            source: 'Popup'
        }, function(){
            $formDownloadPopup.submit();
        });
    }
});
</script>