;(function($) {

    // Document ready function
    $(document).ready(function() {

        // Activate multi step checkout form
        $("#wizard").steps({
            headerTag: "h2",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            enableFinishButton: false
        });
        
    });

})(jQuery);
