;(function($) {

    $(document).ready(function() {
        // Rating Options (Default)
        var options = {
            max_value: 5,
            step_size: 0.5,
            selected_symbol_type: 'utf8_star', // Must be a key from symbols
            cursor: 'pointer',
            readonly: false,
            change_once: false, // Determines if the rating can only be set once
            additional_data: {} // Additional data to send to the server
        }

        // Rating Options (Bulk)
        var options_bulk = {
            max_value: 5,
            step_size: 0.5,
            selected_symbol_type: 'utf8_star', // Must be a key from symbols
            cursor: 'pointer',
            readonly: true,
            change_once: false, // Determines if the rating can only be set once
            additional_data: {} // Additional data to send to the server
        }

        // Activate rating plugin
        $(".book-rating").rate(options);
        $(".rating-bulk").rate(options_bulk);

        // Book rating AJAX handler
        $(".book-rating").on("click", function (e) {
            // Data objct to send PHP via AJAX request
            let userData = {
                _ajax_nonce: objRating.rating_nonce,
                action     : 'asd-book-rating',
                post_id    : $(this).attr("data-post-id"),
                rating     : $(this).attr("data-rate-value"),
                rating_id  : $(this).attr("data-rating-id"),
            }

            // Ajax request handler
            $.post(objRating.ajaxurl, userData, function (response) {
                if(true === response.success) {
                    $(".book-rating").attr("data-rating-id", response.data.rating_id);
                    $(".rating-status").removeClass("status-error").addClass("status-success");
                } else {
                    $(".rating-status").removeClass("status-success").addClass("status-error");
                }
                $(".rating-status").html(response.data.message);
            })
            .fail(function () {
                alert(objRating.error);
            });
        });
    });

})(jQuery);
