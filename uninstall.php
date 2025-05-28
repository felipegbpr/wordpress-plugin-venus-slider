<?php

/**
 * Fired when the plugin is uninstalled.
 * @since		1.0.0
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

/**
 * Delete plugin data on uninstall
 *
 * @since 	1.0.0
 */
function venus_slider_delete_plugin_data() {
	$_posts = get_posts( array(
		'posts_per_page' => - 1,
		'post_type'      => 'venus-carousels',
		'post_status'    => 'any',
	) );

	foreach ( $_posts as $_post ) {
		wp_delete_post( $_post->ID, true );
	}

	// Delete plugin options
	if ( get_option( 'venus_slider_version' ) !== false ) {
		delete_option( 'venus_slider_version' );
	}
}

venus_slider_delete_plugin_data();

