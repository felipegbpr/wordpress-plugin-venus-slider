<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://authorurl.com
 * @since             1.0.0
 * @package           Venus_Slider
 *
 * @wordpress-plugin
 * Plugin Name:       Venus Slider
 * Plugin URI:        https://pluginurl.com
 * Description:       Create responsive slideshows and carousels with ease! Ideal for displaying images, videos, products, or testimonials with smooth transitions and customizable design. Fully compatible with mobile devices and builders like Elementor and Gutenberg.
 * Version:           1.0.0
 * Author:            Felipe Borges
 * Author URI:        https://authorurl.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       venus-slider
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Venus_Slider' ) ) {

	final class VenusSlider {
		private $plugin_name = 'venus-slider';
		private $version = '1.0.0';

		protected static $instance = null;

		/**
		 * Main Venus_Slider Instance
		 * Ensures only one instance of Carousel_Slider is loaded or can be loaded.
		 *
		 *
		 * @since 1.0.0
		 * @return VenusSlider - Main instance
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * VenusSlider constructor.
		 */
		public function __construct() {
			$this->define_constants();
			$this->includes();

			register_activation_hook( __FILE__, array( $this, 'activation' ) );
			register_deactivation_hook( __FILE__, array( $this, 'deactivation' ) );

			do_action( 'venus_slider_init' );
		}

		public function define_constants() {
			define( 'VENUS_SLIDER_VERSION', $this->version );
			define( 'VENUS_SLIDER_FILE', __FILE__ );
			define( 'VENUS_SLIDER_PATH', dirname( VENUS_SLIDER_FILE ) );
			define( 'VENUS_SLIDER_INCLUDES', VENUS_SLIDER_PATH . '/includes' );
			define( 'VENUS_SLIDER_TEMPLATES', VENUS_SLIDER_PATH . '/templates' );
			define( 'VENUS_SLIDER_WIDGETS', VENUS_SLIDER_PATH . '/widgets' );
			define( 'VENUS_SLIDER_URL', plugins_url( '',  VENUS_SLIDER_FILE ) );
			define( 'VENUS_SLIDER_ASSETS', VENUS_SLIDER_URL . '/assets' );
		}

		/**
		 * Define constant if not already set.
		 *
		 * @param  string $name
		 * @param  string|bool $value
		 */
		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * Include admin and front facing files
		 */
		public function includes() {
			require_once VENUS_SLIDER_INCLUDES . '/class-venus-slider-i18n.php';
			require_once VENUS_SLIDER_INCLUDES . '/functions-venus-slider.php';
			require_once VENUS_SLIDER_INCLUDES . '/class-venus-slider-activator.php';
			require_once VENUS_SLIDER_INCLUDES . '/class-venus-slider-product.php';
			require_once VENUS_SLIDER_INCLUDES . '/class-venus-slider-scripts.php';
			require_once VENUS_SLIDER_WIDGETS . '/widget-venus_slider.php';

			if ( is_admin() ) {
				$this->admin_includes();
			}

			if ( ! is_admin() ) {
				$this->frontend_includes();
			}
		}

		/**
		 * Include admin files
		 */
		public function admin_includes() {
			require_once VENUS_SLIDER_INCLUDES . '/class-venus-slider-credit.php';
			require_once VENUS_SLIDER_INCLUDES . '/class-venus-slider-vc-element.php';
			require_once VENUS_SLIDER_INCLUDES . '/class-venus-slider-documentation.php';
			require_once VENUS_SLIDER_INCLUDES . '/class-venus-slider-form.php';
			require_once VENUS_SLIDER_INCLUDES . '/class-venus-slider-admin.php';
		}

		/**
		 * Load front facing files
		 */
		public function frontend_includes() {
			require_once VENUS_SLIDER_PATH . '/shortcodes/class-venus-slider-shortcode.php';
			require_once VENUS_SLIDER_PATH . '/shortcodes/class-venus-slider-depracated-shortcode.php';
			// TO-DO
			// require_once VENUS_SLIDER_INCLUDES . '/class/venus-slider-structured-data.php';
		}

		/**
		 * To be run when the plugin is activated
		 * @return void
		 */
		public function activation() {
			do_action( 'venus_slider_activation' );
			flush_rewrite_rules();
		}

		/**
		 * To be run when the plugin is deactivated
		 * @return void
		 */
		public function deactivation() {
			do_action( 'venus_slider_deactivation' );
			flush_rewrite_rules();
		}
	}
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 */
VenusSlider::instance();