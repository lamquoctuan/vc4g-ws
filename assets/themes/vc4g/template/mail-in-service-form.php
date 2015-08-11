<?php
$strMailInServiceForm = CUR_THEME_NAME . gmdate('Y-m-d') . '-ajax_mail_in_service';
$ajaxMailInServiceForm = wp_create_nonce( $strMailInServiceForm );
?>
<div class="request-form">
    <h4 class="text-center">Mail-in Request Form</h4>
    <p class="small text-center">Please fill out the form below to receive your FREE Mail-in Kit</p>
    <hr/>
    <form id="mailInServiceForm" name="mailInServiceForm" novalidate>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">First Name <span>*</span></label>
                    <input type="text" class="form-control" name="first_name" required=""
                            data-validation-required-message="Please enter your first name." aria-invalid="false">
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Last Name <span>*</span></label>
                    <input type="text" class="form-control" name="last_name" required="" 
                            data-validation-required-message="Please enter your last name." aria-invalid="false">
                    <p class="help-block text-danger"></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Email Address <span>*</span></label>
                    <input type="email" class="form-control" name="email" required="" 
                            data-validation-email-message="Please enter your email." aria-invalid="false">
                    <p class="help-block text-danger"></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Phone number</label>
                    <input type="tel" class="form-control" name="phone">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Address <span>*</span></label>
                    <input type="text" class="form-control" name="address" required="" 
                            data-validation-required-message="Please enter your address." aria-invalid="false">
                    <p class="help-block text-danger"></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">City <span>*</span></label>
                    <input type="text" class="form-control" name="city" required="" 
                            data-validation-required-message="Please enter your city." aria-invalid="false">
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">State <span>*</span></label>
                    <select name="state" class="form-control" size="1" name="state">
                        <option value="BC">British Columbia</option>
                        <option value="AB">Alberta</option>
                        <option value="SK">Saskatchewan</option>
                        <option value="MB">Manitoba</option>
                        <option value="ON">Ontario</option>
                        <option value="QC">Quebec</option>
                        <option value="NB">New Brunswick</option>
                        <option value="NS">Nova Scotia</option>
                        <option value="PE">Prince Edward Island</option>
                        <option value="NL">Newfoundland and Labrador</option>
                    </select>
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Zip <span>*</span></label>
                    <input type="text" class="form-control" name="zip" required="" 
                            pattern="[A-Z]\d[A-Z] \d[A-Z]\d" data-validation-pattern-message="Please enter your zip." aria-invalid="false">
                    <p class="help-block text-danger"></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <hr class="mt10" />
            </div>
            <div class="col-md-8 text-center">
                <label>What are you sending?</label>
                <div class="row radio-check">
                    <div class="col-md-6 text-left">
                        <label class="radio">
                            <input id="radio1" type="radio" name="type" value="gold" checked>
                            <span class="outer"><span class="inner"></span></span>Gold
                        </label>
                        <label class="radio">
                            <input id="radio2" type="radio" name="type" value="silver">
                            <span class="outer"><span class="inner"></span></span>Silver
                        </label>
                    </div>
                    <div class="col-md-6 text-left">
                        <label class="radio">
                            <input id="radio3" type="radio" name="type" value="platinum">
                            <span class="outer"><span class="inner"></span></span>Platinum
                        </label>
                        <label class="radio">
                            <input id="radio4" type="radio" name="type" value="diamond">
                            <span class="outer"><span class="inner"></span></span>Diamond
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <hr class="mt10" />
            </div>
        </div>
        <p class="small text-center">Your email address will NEVER be rented, traded or sold.
            <br/>We Guarantee Your Confidentiality.</p>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div id="success"></div>
                <button type="submit" class="btn btn-yellow mail"><span>Submit</span></button>
            </div>
        </div>
        <input type="hidden" name="action" value="ajax_mail_in_service"/>
        <input type="hidden" name="security" value="<?php echo $ajaxMailInServiceForm;?>"/>
        <input type="hidden" id="thanks" value="/thank/mailing/"/>
    </form>
</div>