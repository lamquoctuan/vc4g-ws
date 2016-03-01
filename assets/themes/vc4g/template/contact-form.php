<?php
$strContactForm = CUR_THEME_NAME . gmdate('Y-m-d') . '-ajax_contact';
$ajaxContactForm = wp_create_nonce( $strContactForm );
?>
<section class="form-message">
    <div class="container">
        <div class="row">
            <div class="col-md-2"><p class="title-form">Send us a message</p></div>
            <div class="col-md-10">
                <hr/>
            </div>
        </div>
        <p class="small">Questions? Comments? We Would Love to Hear From You!</p>

        <form name="contactForm" id="contactUsForm" novalidate>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 pr5">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Name *" id="name" name="name"
                                        required=""
                                        data-validation-required-message="Please enter your name." aria-invalid="false">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6 pl5">
                            <div class="form-group">
                                <input type="tel" class="form-control" placeholder="Your Phone" id="phone" name="phone">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Email *" id="email" name="email"
                                        required=""
                                        data-validation-email-message="Please enter your email address." aria-invalid="false">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Subject *" id="subject" name="subject"
                                        required=""
                                        data-validation-required-message="Please enter your subject." aria-invalid="false">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Your Message" id="message" name="message"
                                        required=""
                                        data-validation-required-message="Please enter your message."
                                        aria-invalid="false"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <div id="success"></div>
                            <button type="submit" class="btn btn-yellow mail"><span>Send message</span></button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="action" value="ajax_contact"/>
                <input type="hidden" name="security" value="<?php echo $ajaxContactForm;?>"/>
                <input type="hidden" id="thanks" value="/thank/contact/"/>
            </div>
        </form>
    </div>
</section>