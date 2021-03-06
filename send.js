(function ($) {
    'use strict';
    var form = $('.contact__form'),
        message = $('.contact__msg'),
        form_data;
    // Success function
    function done_func(response) {
        message.fadeIn().removeClass('error').addClass('success');
        message.text(response);
        form.find('input:not([type="submit"]), textarea').val('');
    }
    // fail function
    function fail_func(data) {
        message.fadeIn().removeClass('success').addClass('success error');
        message.text(data.responseText);
    }
    
    form.submit(function (e) {
        e.preventDefault();
        form_data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form_data
        })
        .done(done_func)
        .fail(fail_func);
    });
    
})(jQuery);
