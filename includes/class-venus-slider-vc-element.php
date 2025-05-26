<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'VenusSliderVisualComposerElement' ) ):

    class VenusSliderVisualComposerElement {

        protected static $instance = null;

        /**
		 * Ensures only one instance of this class is loaded or can be loaded.
         * 
         * @return VenusSliderVisualComposerElement
         */
        public static function init() {
            if ( is_null( self::$instance ) ) {
                    self::$instance = new self();
            }

            return self::$instance;
        }

        /**
         * VenusSliderVisualComposerElement constructor.
         */
        public function __construct() {
            // We safely integrate with VC with this hook
            add_action( 'init', array( $this, 'integrate_with_vc' ) );
        }

        /**
         * Integrate with visual composer
         */
        public function integrate_with_vc() {
            // Check if Visual Composer is installed
            if ( ! function_exists( 'vc_map' ) ) {
                    return;
            }
            
            vc_map( array(
                    "name"         => __( "Venus Slider", 'venus-slider' ),
                    "description"  => __( "Place Venus Slider", 'venus-slider' ),
                    "base"         => "venus_slide",
                    "controls"     => "full",
                    "icon"         => plugins_url( 'assets/img/icon-images.svg', dirname( __FILE__ ) ),
                    "category"     => __( 'Content', 'venus-slider' ),
                    "params"       => array(
                            array(
                                    "type"       => "dropdown",
                                    "holder"     => "div",
                                    "class"      => "venus-slider-id",
                                    "param_name" => "id",
                                    "value"      => $this->carousels_list(),
                                    "heading"    => __( "Choose Carousel Slide", 'venus-slider' ),
                            ),
                    )
            ) );

        }

        /**
         * Generate array for venus slider
         * 
         * @return array
         */
        private function carousels_list() {
            $carousels = get_posts( array( 
                    'post_type'  => 'venus-carousels',
                    'post_status'  => 'publish',
            ) );

            if ( count( $carousels ) < 1 ) {
                    return array();
            }

            $result = array();

            foreach ( $carousels as $carousel ) {
                    $result[ esc_html( $carousel->post_title ) ] = $carousel->ID;
            }

            return $result;
        }
    }

endif;    
VenusSliderVisualComposerElement::init();