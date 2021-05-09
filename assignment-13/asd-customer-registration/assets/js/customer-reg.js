;(function($){

    $(document).ready(function() {

        $('#asd-cr-form').on('submit', function(e) {
            e.preventDefault();

            // Form submision values
            let name            = $('#crf-name').val();
            let username        = $('#crf-username').val();
            let email           = $('#crf-email').val();
            let password        = $('#crf-psw').val();
            let passwordConfirm = $('#crf-psw-confirm').val();
            let customerType    = $('#crf-type').val();
            let submit          = $('#crf-submit').val();

            // Regular expresions
            let regExName = /^[a-z ,.'-]+$/i;
            let regExEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            // Validate values using regular expresion
            let validName = regExName.test(name);
            let validEmail = regExEmail.test(email);

            // Remove previousely shown status/messages
            $(".msg-error").remove();
            $('.submision-status').remove();

            // Throw error if name validation failed
            let namePassed = false;
            if (name.length < 1) {
                $('#crf-name').after('<p class="msg-error">Name is required</p>');
            } else if (!validName) {
                $('#crf-name').after('<p class="msg-error">Enter a valid name</p>');
            } else {
                namePassed = true;
            }

            // Throw error if username validation failed
            let usernamePassed = false;
            if (username.length < 1) {
                $('#crf-username').after('<p class="msg-error">Username is required</p>');
            } else {
                usernamePassed = true;
            }

            // Throw error if email validation failed
            let emailPassed = false;
            if (email.length < 1) {
                $('#crf-email').after('<p class="msg-error">Email is required</p>');
            } else if (!validEmail) {
                $('#crf-email').after('<p class="msg-error">Enter a valid email</p>');
            } else {
                emailPassed = true;
            }

            // Throw error if password validation failed
            let passwordPassed = false;
            if (password.length < 1) {
                $('#crf-psw').after('<p class="msg-error">Email is required</p>');
            } else {
                passwordPassed = true;
            }

            // Throw error if comfired password validation failed
            let passwordConfirmPassed = false;
            if (passwordConfirm.length < 1) {
                $('#crf-psw-confirm').after('<p class="msg-error">Password confirmation is required</p>');
            } else if (password !== passwordConfirm) {
                $('#crf-psw-confirm').after('<p class="msg-error">Password not matched</p>');
            } else {
                passwordConfirmPassed = true;
            }

            // Throw error if customer type validation failed
            let customerTypePassed = false;
            if (customerType.length < 1) {
                $('#crf-type').after('<p class="msg-error">Customer type is required</p>');
            } else {
                customerTypePassed = true;
            }

            // Return if found any error
            if ( true !== namePassed || true !== usernamePassed || true !== emailPassed || true !== passwordPassed || true !== passwordConfirmPassed || true !== customerTypePassed ) {
                return;
            }

            // Serialize form data for ajax request
            let formData = $(this).serialize();

            // Ajax request
            $.post(objCustomerReg.ajaxurl, formData, function(response) {
                if(response.success) {
                    $('#asd-cr-form').prepend('<div class="submision-status status-success"><p class="msg-success">' + response.data.message + '</p></div>');
                } else {
                    $('#asd-cr-form').prepend('<div class="submision-status status-error"><p class="msg-error">' + response.data.message + '</p></div>');
                }
            })
            .fail(function() {
                alert(objCustomerReg.error);
            });

        });

    });

})(jQuery);
