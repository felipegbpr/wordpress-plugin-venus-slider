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

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'VENUS_SLIDER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-venus-slider-activator.php
 */
function activate_venus_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-venus-slider-activator.php';
	Venus_Slider_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-venus-slider-deactivator.php
 */
function deactivate_venus_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-venus-slider-deactivator.php';
	Venus_Slider_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_venus_slider' );
register_deactivation_hook( __FILE__, 'deactivate_venus_slider' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-venus-slider.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_venus_slider() {

	$plugin = new Venus_Slider();
	$plugin->run();

}
run_venus_slider();
