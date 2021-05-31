;(function($) {

    $(document).ready(function() {

        // Mailchimp subscription form handler
        $("#mc-subscription-form").on("submit", function(e) {
            e.preventDefault();

            // Serialize the form data
            let = formData = $(this).serialize();

            // Handle AJAX request
            $.post(objMcSubs.ajaxurl, formData, function(response) {
                if(true === response.success) {
                    $(".subscription-message").removeClass("message-error").addClass("message-success");
                } else {
                    $(".subscription-message").removeClass("message-success").addClass("message-error");
                }

                $(".subscription-message").text(response.data.message);
            })
            .fail(function() {
                alert(objMcSubs.error);
            });
        });

    });

})(jQuery);
