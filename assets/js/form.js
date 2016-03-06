$(function() {

    $("input,textarea").not('[type="submit"]').jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            var errorMessage = 'Your request is temporarily unable to be processed. Please try again later.';
            // get values from FORM
            var actionName  = $form.find('input[name="action"]').val();
            var leadData = $.getQueryParameters($form.serialize());
            $.parseNameInObj(leadData);
            $.ajax({
                url: vc4g.ajax_url,
                type: "POST",
                data: leadData,
                dataType: 'json',
                beforeSend: function() {
                    $form.css('cursor', 'wait');
                },
                success: function(response) {
                    $form.css('cursor', 'default');
                    if (typeof(response.id) != 'undefined') {
                        analytics.identify(response.id, {
                            email: leadData.email,
                            mc_id: response.id
                        }, function(){
                            if (typeof(response.download_url) != 'undefined') {
                                window.location.href = response.download_url;
                            }
                            else {
                                window.location.href = $form.find('#thanks').val();
                            }
                        });
                    }
                    else {
                        alert(errorMessage);
                    }
                },
                error: function(response) {
                    $form.css('cursor', 'default');
                    alert(errorMessage);
                }
            });
        },
        filter: function() {
            return $(this).is(":visible");
        },
    });

    $("a[data-toggle=\"tab\"]").click(function(e) {
        e.preventDefault();
        $(this).tab("show");
    });
});


/*When clicking on Full hide fail/success boxes */
$('#name').focus(function() {
    $(this).closest('form').find('#success').html('');
});
