<?php 
global $post;
$pContent = get_the_content($post);
if (! empty($pContent) ) {
    echo $pContent;
}
else {
?>
<section class="place-ct">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="p0 map-contact first">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2605.3300847240066!2d-123.02873989999999!3d49.23223069999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5486768de1f9f631%3A0x6a8a503abb839809!2s3515+Kingsway%2C+Vancouver%2C+BC+V5R+5L8%2C+Canada!5e0!3m2!1svi!2s!4v1436262766642"
                        width="100%" height="456" frameborder="0" style="border:0" allowfullscreen>
                    </iframe>
                </div>
                <div class="contact-add">
                    <h2>Vancouver</h2>
                    <ul class="list-unstyled">
                        <li class="place">3515 Kingsway, Vancouver, BC V5R 5L8, The Canada</li>
                        <li class="phone"><a href="">(604) 558-2026</a> <abbr title="Phone">or</abbr> <a href="">(778) 882-8908</a></li>
                        <li class="time"><abbr title="Phone">Mon - Fri:</abbr> 10:00 am – 6:00 pm, <abbr title="Phone">Saturday:</abbr> 10:00 am – 5:00 pm</li>
                        <li class="email"><a href="mailto:info@vancouvercashforgold.com">info@vancouvercashforgold.com</a></li>
                    </ul>
                </div>
                
                
            </div>
            <div class="col-md-6">
                <div class="p0 map-contact">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2607.6628219544305!2d-122.80263518442699!3d49.18798447932115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5485d71351fb2de7%3A0x3b397196201c4131!2s10210+152+St+%23213%2C+Surrey%2C+BC+V3R+6N7!5e0!3m2!1sen!2sca!4v1502744877234"
                        width="100%" height="456" frameborder="0" style="border:0" allowfullscreen>
                    </iframe>
                </div>
                <div class="contact-add">
                    <h2>Surrey</h2>
                    <ul class="list-unstyled">
                        <li class="place">10210 152 St #213, Surrey, BC V3R 6N7, The Canada</li>
                        <li class="phone"><a href="">(604) 999-0606</a> <abbr title="Phone">or</abbr> <a href="">(778) 869-2112</a></li>
                        <li class="time"><abbr title="Phone">Tue - Sat:</abbr> 10:00 am – 6:00 pm</li>
                        <li class="email"><a href="mailto:surreycashforgold@gmail.com">surreycashforgold@gmail.com</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
</section>
<?php
}
?>

<div class="clearfix visible-xs-block"></div>