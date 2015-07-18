<form name="subscribeForm" id="subscribeForm">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Email *" id="email" required="" data-validation-required-message="Please enter your mail." aria-invalid="false">
                <p class="help-block text-danger"></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" required="" data-validation-required-message="Please enter your phone number." aria-invalid="false">
                <p class="help-block text-danger"></p>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <textarea class="form-control" placeholder="Your Message" id="message" required="" data-validation-required-message="Please enter your message." aria-invalid="false"></textarea>

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

</form>