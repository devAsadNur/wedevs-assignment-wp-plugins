<?php

namespace VerticalButton\Frontend;

/**
 * Frontend view handler class
 */
class View {

    /**
     * Initializes the class
     */
    public function __construct() {
        add_filter( 'button_label_text', [ $this, 'button_label_changer' ] );
        add_action( 'button_description', [ $this, 'add_button_description' ] );
        
        $this->html_content_handler();     
    }

    /**
     * HTML button handler function
     *
     * @return void
     */
    public function html_content_handler() {
        $content = '<div id="vertical-button-content"><button id="btn-coupon" class="btn-grad"><label>';

        $content .= apply_filters( 'button_label_text', 'Click Here!' );
        
        $content .= '</label></button></div>';

        echo $content;

        do_action( 'button_description' );
    }

    /**
     * Button label updater function
     *
     * @param [string] $content
     * @return $content
     */
    public function button_label_changer( $content ) {
        $content = "Coupon Code!";

        return $content;
    }

    /**
     * Button desctiption text adding function
     *
     * @return void
     */
    public function add_button_description() {
        $description_text = '<div id="vertical-button-description"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div>';

        echo $description_text;
    }

}