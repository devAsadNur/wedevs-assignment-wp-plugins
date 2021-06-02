;(function ($) {

    $(document).ready(function() {

        $('#asd-student-form').submit(function(e) {
            e.preventDefault();

            // Form submision values
            let firstName = $('#si-fname').val();
            let lastName  = $('#si-lname').val();
            let stdClass  = $('#si-class').val();
            let stdRoll   = $('#si-roll').val();
            let stdReg    = $('#si-reg').val();
            let markEng   = $('#si-mark-eng').val();
            let markMath  = $('#si-mark-math').val();
            let markSci   = $('#si-mark-sci').val();
            let markAcc   = $('#si-mark-acc').val();
            let submit    = $('#si-submit').val();

            // Regular expresions
            let regExName = /^[a-z ,.'-]+$/i;
            let regExNum  = /^[0-9]+$/;

            // Validate values using regular expresion
            let validFname    = regExName.test(firstName);
            let validLname    = regExName.test(lastName);
            let validClass    = regExNum.test(stdClass);
            let validRoll     = regExNum.test(stdRoll);
            let validReg      = regExNum.test(stdReg);
            let validMarkEng  = regExNum.test(markEng);
            let validMarkMath = regExNum.test(markMath);
            let validMarkSci  = regExNum.test(markSci);
            let validMarkAcc  = regExNum.test(markAcc);

            // Remove previousely shown status/messages
            $(".msg-error").remove();
            $('.submision-status').remove();

            // Throw error if first name validation failed
            let fNamePassed = false;
            if (firstName.length < 1) {
                $('#si-fname').after('<p class="msg-error">First name is required</p>');
            } else if (!validFname) {
                $('#si-fname').after('<p class="msg-error">Enter a valid first name</p>');
            } else {
                fNamePassed = true;
            }

            // Throw error if last name validation failed
            let lNamePassed = false;
            if (lastName.length < 1) {
                $('#si-lname').after('<p class="msg-error">Last name is required</p>');
            } else if (!validLname) {
                $('#si-lname').after('<p class="msg-error">Enter a valid last name</p>');
            } else {
                lNamePassed = true;
            }

            // Throw error if class validation failed
            let classPassed = false;
            if (stdClass.length < 1) {
                $('#si-class').after('<p class="msg-error">Class is required</p>');
            } else if (!validClass) {
                $('#si-class').after('<p class="msg-error">Enter a valid class</p>');
            } else {
                classPassed = true;
            }

            // Throw error if roll number validation failed
            let rollPassed = false;
            if (stdRoll.length < 1) {
                $('#si-roll').after('<p class="msg-error">Roll number is required</p>');
            } else if (!validRoll) {
                $('#si-roll').after('<p class="msg-error">Enter a valid roll number</p>');
            } else {
                rollPassed = true;
            }

            // Throw error if reg number validation failed
            let regPassed = false;
            if (( 0 !== stdReg.length) && (!validReg)) {
                $('#si-reg').after('<p class="msg-error">Enter a valid reg number</p>');
            } else {
                regPassed = true;
            }

            // Throw error if english mark validation failed
            let markEngPassed = false;
            if (( 0 !== markEng.length) && (!validMarkEng)) {
                $('#si-mark-eng').after('<p class="msg-error">Enter a valid mark</p>');
            } else {
                markEngPassed = true;
            }

            // Throw error if math mark validation failed
            let markMathPassed = false;
            if (( 0 !== markMath.length) && (!validMarkMath)) {
                $('#si-mark-math').after('<p class="msg-error">Enter a valid mark</p>');
            } else {
                markMathPassed = true;
            }

            // Throw error if science mark validation failed
            let markSciPassed = false;
            if (( 0 !== markSci.length) && (!validMarkSci)) {
                $('#si-mark-sci').after('<p class="msg-error">Enter a valid mark</p>');
            } else {
                markSciPassed = true;
            }

            // Throw error if accounting mark validation failed
            let markAccPassed = false;
            if (( 0 !== markAcc.length) && (!validMarkAcc)) {
                $('#si-mark-acc').after('<p class="msg-error">Enter a valid mark</p>');
            } else {
                markAccPassed = true;
            }

            // Return if found any error
            if ( !fNamePassed || !lNamePassed || !classPassed || !rollPassed || !regPassed || !markEngPassed || !markMathPassed || !markSciPassed || !markAccPassed ) {
                return;
            }

            // Serialize form data for ajax request
            let formData = $(this).serialize();

            // Ajax request
            $.post(objStudentInfo.ajaxurl, formData, function(response) {
                if (response.success) {
                    $('#asd-student-form').prepend('<div class="submision-status status-success"><p class="msg-success">' + response.data.message + '</p></div>');
                    $('#asd-student-form').trigger("reset");
                    window.scrollTo(0, 500);
                } else {
                    $('#asd-student-form').prepend('<div class="submision-status status-error"><p class="msg-error">' + response.data.message + '</p></div>');
                }
            })
            .fail(function () {
                alert(objStudentInfo.error);
            });

        });

    });

})(jQuery);
