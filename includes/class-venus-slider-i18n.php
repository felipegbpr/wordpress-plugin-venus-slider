<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://authorurl.com
 * @since      1.0.0
 *
 * @package    Venus_Slider
 * @subpackage Venus_Slider/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Venus_Slider
 * @subpackage Venus_Slider/includes
 * @author     Felipe Borges <felipetecacc@gmail.com>
 */

if ( ! class_exists( 'Venus_Slider_i18n' ) ):

	class Venus_Slider_i18n {
		protected static $instance = null;
		protected $plugin_name = 'venus-slider';
		
		/**
		 * Ensures only one instance of this class is loaded or can be loaded.
		 *
		 * @return Venus_Slider_i18n
	     */
		public static function init() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function __construct() {
			add_action( 'init', array( $this, 'load_textdomain' ) );
		}

		/**
		 * Load plugin textdomain
		 */
		public function load_textdomain() {
			$locale_file = sprintf( '%1$s-%2$s.mo', 'venus-slider', get_locale() );
			$global_file = join( DIRECTORY_SEPARATOR, [ WP_LANG_DIR, 'venus-slider', $locale_file ] );

			// Look in global /wp-content/languages/venus-slider folder
			if ( file_exists( $global_file ) ) {
				load_textdomain( $this->plugin_name, $global_file );
			}
		}
	}

endif;

Venus_Slider_i18n::init();