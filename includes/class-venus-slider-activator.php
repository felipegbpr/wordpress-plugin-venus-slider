<?php

/**
 * Fired during plugin activation
 *
 * @link       https://authorurl.com
 * @since      1.0.0
 *
 * @package    Venus_Slider
 * @subpackage Venus_Slider/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Venus_Slider
 * @subpackage Venus_Slider/includes
 * @author     Felipe Borges <felipetecacc@gmail.com>
 */
if ( ! class_exists( 'Venus_Slider_Activator' ) ):
	
	class VenusSliderActivator {
		
		protected static $instance = null;

		/**
		 * Ensures only one instance of this class is loaded or can be loaded.
		 * 
		 * @return VenusSliderActivator
		 */
		public static function init() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function __construct() {
			add_action( 'venus_slider_activation', array( $this, 'activate' ) );
		}

		/**
		 * Script that should load upon plugin activation
		 */
		public function activate() {
			$version = get_option( 'venus_slider_version' );

			if ( $version == false ) {
				$this->update_meta();
			}

			// Add plugin version to database
			update_option( 'venus_slider_version', VENUS_SLIDER_VERSION );

			// Flush the rewrite rules on activation
			flush_rewrite_rules();
		}

		/**
		 * Update meta version 1.0.0
		 */
		public function update_meta() {
			$carousels = get_posts( array(
				'post_type'   => 'venus-slider',
				'post_status' => 'any', 
			) );

			if ( count( $carousels ) > 0 ) {
				foreach ( $carousels as $carousel ) {
					$id             = $carousel->ID;
					$_items_desktop = get_post_meta( $id, '_items', true );
					$_lazy_load     = get_post_meta( $id, '_lazy_load_image', true );
					$_lazy_load     = $_lazy_load == 'on' ? 'on' : 'off';

					update_post_meta( $id, '_lazy_load_image', $_lazy_load );
					update_post_meta( $id, '_items_desktop', $_items_desktop );
					update_post_meta( $id, '_slide_type', 'image-carousel' );
					update_post_meta( $id, '_video_width', '560' );
					update_post_meta( $id, '_video_width',  '315');
				}
			}
		}
	}
endif;

VenusSliderActivator::init();