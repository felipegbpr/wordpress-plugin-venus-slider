<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'VenusSliderDocumentation' ) ) {

    class VenusSliderDocumentation {

        protected static $instance = null;

        /**
         * Ensures only one instance of this class is loaded or can be loaded.
         * 
         * @return VenusSliderDocumentation
         */
        public static function init() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }

            return self::$instance; 
        }

        public function __construct() {
            add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        }

        public function admin_menu() {
            add_submenu_page(
                'edit.php?post_type=venus-carousels',
                'Documentation',
                'Documentation',
                'manage_options',
                'venus-slider-documentation',
                array( $this, 'submenu_page_callback' )
            );
        }

        public function submenu_page_callback() {
            include_once VENUS_SLIDER_TEMPLATES . '/documentation.php';
        }
    }

}

VenusSliderDocumentation::init();
