$(function() {

    $("input,textarea").not('[type="submit"]').jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
            console.log($form);
            console.log(vc4g);
            console.log('submit error');
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            // get values from FORM
            console.log($form);
            console.log('submit success');
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
                done: function(response) {
                    if (typeof(response.id) != 'undefined') {
                        window.location.href = $form.find('#thanks').val();
                    }
                },
                fail: function() {
                    // $form.css('cursor', 'default');
                },
                alwawys: function() {
                    $form.css('cursor', 'default');
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
    $('#success').html('');
});
