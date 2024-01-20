<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://deviodigital.com
 * @since      1.0.0
 *
 * @package    Link_Attributes_For_Publishers
 * @subpackage Link_Attributes_For_Publishers/includes
 */

// If this file is called directly, abort.
 if ( ! defined( 'WPINC' ) ) {
	wp_die();
}

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Link_Attributes_For_Publishers
 * @subpackage Link_Attributes_For_Publishers/includes
 * @author     Devio Digital <contact@deviodigital.com>
 */
class Link_Attributes_For_Publishers_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'link-attributes-for-publishers',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
