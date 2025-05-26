<?php

if ( ! class_exists( 'VenusSliderCredit' ) ):

    class VenusSliderCredit {

        protected static $instance = null;

        /**
         * Ensures only one instance of this class is loaded or can be loaded.
         * 
         * @return VenusSliderCredit
         */
        public static function init() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }   

            return self::$instance;
        }

        public function __construct() {
            add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ) );
        }

        /**
         * Add custom footer text on plugins page.
         * 
         * @param string $text
         * 
         * @return string  
         */
        public function admin_footer_text( $text ) {
            global $post_type, $hook_suffix;

            $footer_text = sprintf( __( 'If you like %1$s Venus Slider %2$s please leave us a %3$s rating. A huge thanks in advance!', 'venus-slider' ), '<strong>', '</strong>', '<a href="https://wordpress.org/support/view/plugin-reviews/venus-slider?filter=5#postform" target="_blank" data-rated="Thanks :)">&starf;&starf;&starf;&starf;&starf;</a>' );

            if ( $post_type == 'venus-carousels' || $hook_suffix == 'carousels_page_venus-slider-documentation' ) {
                return $footer_text;
            }

            return $text;
        }   
    }

endif;

VenusSliderCredit::init();