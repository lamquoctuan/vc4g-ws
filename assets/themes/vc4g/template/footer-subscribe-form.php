<?php
$strContactForm = CUR_THEME_NAME . gmdate('Y-m-d') . '-ajax_subscribe';
$ajaxContactForm = wp_create_nonce( $strContactForm );
?>
<form name="subscribeForm" id="contactForm" novalidate>
    <div class="row">
        <div class="col-md-7">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Email *" id="email" name="email"
                    required 
                    data-validation-required-message="Please enter your mail." aria-invalid="false">
                <p class="help-block text-danger"></p>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" name="phone"
                    required
                    data-validation-required-message="Please enter your phone number." aria-invalid="false">
                <p class="help-block text-danger"></p>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <textarea class="form-control" placeholder="Your Message" id="message" name="message"
                    required
                    data-validation-required-message="Please enter your message." aria-invalid="false"></textarea>
                <p class="help-block text-danger"></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div id="success"></div>
            <button type="submit" class="btn btn-yellow">Send</button>
        </div>
    </div>
    <input type="hidden" name="action" value="ajax_subscribe"/>
    <input type="hidden" name="security" value="<?php echo $ajaxContactForm;?>"/>
    <input type="hidden" id="thanks" value="/thank/newsletter/"/>
</form>