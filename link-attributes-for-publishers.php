<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @since             1.0.0
 * @package           Link_Attributes_For_Publishers
 * @author            Devio Digital <contact@deviodigital.com>
 * @license           GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link              https://deviodigital.com
 *
 * @wordpress-plugin
 * Plugin Name:       Link Attributes for Publishers
 * Plugin URI:        https://github.com/deviodigital/link-attributes-for-publishers
 * Description:       Add custom link attributes to the external URL's of your choice
 * Version:           1.0.0
 * Author:            Devio Digital
 * Author URI:        https://deviodigital.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       link-attributes-for-publishers
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	wp_die();
}

/**
 * Current plugin version.
 */
define( 'LINK_ATTRIBUTES_FOR_PUBLISHERS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-link-attributes-for-publishers-activator.php
 * 
 * @since  1.0.0
 * @return void
 */
function lafp_activate_link_attributes_for_publishers() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-link-attributes-for-publishers-activator.php';
	Link_Attributes_For_Publishers_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-link-attributes-for-publishers-deactivator.php
 * 
 * @since  1.0.0
 * @return void
 */
function lafp_deactivate_link_attributes_for_publishers() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-link-attributes-for-publishers-deactivator.php';
	Link_Attributes_For_Publishers_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'lafp_activate_link_attributes_for_publishers' );
register_deactivation_hook( __FILE__, 'lafp_deactivate_link_attributes_for_publishers' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-link-attributes-for-publishers.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since  1.0.0
 * @return void
 */
function lafp_run_plugin() {

	$plugin = new Link_Attributes_For_Publishers();
	$plugin->run();

}
lafp_run_plugin();
