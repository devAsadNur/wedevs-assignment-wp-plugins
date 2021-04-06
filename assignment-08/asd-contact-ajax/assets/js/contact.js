;(function ($) {

    $("#asd-contact-form").on("submit", function (e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.post(objContactEnquery.ajax_url, formData, function (response) {
            if (response.success) {
                alert(response.data.message);
                console.dir(response.data.form_data);
            } else {
                alert(response.data.message);
            }
        })
        .fail(function () {
            alert(objContactEnquery.error);
        });

    });

})(jQuery);
