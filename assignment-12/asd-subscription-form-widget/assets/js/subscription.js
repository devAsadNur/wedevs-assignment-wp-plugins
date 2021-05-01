;(function($) {

    $(document).ready(function() {

        $("#mc-subscription-form").on("submit", function(e) {
            e.preventDefault();

            let = formData = $(this).serialize();

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
