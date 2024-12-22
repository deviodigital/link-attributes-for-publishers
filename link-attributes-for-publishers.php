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

require 'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/deviodigital/link-attributes-for-publishers',
	__FILE__,
	'link-attributes-for-publishers'
);

// Set the branch that contains the stable release.
$myUpdateChecker->setBranch( 'main' );

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

/**
 * Helper function to handle WordPress.com environment checks.
 *
 * @param string $plugin_slug     The plugin slug.
 * @param string $learn_more_link The link to more information.
 * 
 * @since  1.1.0
 * @return bool
 */
function wp_com_plugin_check( $plugin_slug, $learn_more_link ) {
    // Check if the site is hosted on WordPress.com.
    if ( defined( 'IS_WPCOM' ) && IS_WPCOM ) {
        // Ensure the deactivate_plugins function is available.
        if ( ! function_exists( 'deactivate_plugins' ) ) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        // Deactivate the plugin if in the admin area.
        if ( is_admin() ) {
            deactivate_plugins( $plugin_slug );

            // Add a deactivation notice for later display.
            add_option( 'wpcom_deactivation_notice', $learn_more_link );

            // Prevent further execution.
            return true;
        }
    }

    return false;
}

/**
 * Auto-deactivate the plugin if running in an unsupported environment.
 *
 * @since  1.1.0
 * @return void
 */
function wpcom_auto_deactivation() {
    if ( wp_com_plugin_check( plugin_basename( __FILE__ ), 'https://robertdevore.com/why-this-plugin-doesnt-support-wordpress-com-hosting/' ) ) {
        return; // Stop execution if deactivated.
    }
}
add_action( 'plugins_loaded', 'wpcom_auto_deactivation' );

/**
 * Display an admin notice if the plugin was deactivated due to hosting restrictions.
 *
 * @since  1.1.0
 * @return void
 */
function wpcom_admin_notice() {
    $notice_link = get_option( 'wpcom_deactivation_notice' );
    if ( $notice_link ) {
        ?>
        <div class="notice notice-error">
            <p>
                <?php
                echo wp_kses_post(
                    sprintf(
                        __( 'My Plugin has been deactivated because it cannot be used on WordPress.com-hosted websites. %s', 'link-attributes-for-wordpress' ),
                        '<a href="' . esc_url( $notice_link ) . '" target="_blank" rel="noopener">' . __( 'Learn more', 'link-attributes-for-wordpress' ) . '</a>'
                    )
                );
                ?>
            </p>
        </div>
        <?php
        delete_option( 'wpcom_deactivation_notice' );
    }
}
add_action( 'admin_notices', 'wpcom_admin_notice' );

/**
 * Prevent plugin activation on WordPress.com-hosted sites.
 *
 * @since  1.1.0
 * @return void
 */
function wpcom_activation_check() {
    if ( wp_com_plugin_check( plugin_basename( __FILE__ ), 'https://robertdevore.com/why-this-plugin-doesnt-support-wordpress-com-hosting/' ) ) {
        // Display an error message and stop activation.
        wp_die(
            wp_kses_post(
                sprintf(
                    '<h1>%s</h1><p>%s</p><p><a href="%s" target="_blank" rel="noopener">%s</a></p>',
                    __( 'Plugin Activation Blocked', 'link-attributes-for-wordpress' ),
                    __( 'This plugin cannot be activated on WordPress.com-hosted websites. It is restricted due to concerns about WordPress.com policies impacting the community.', 'link-attributes-for-wordpress' ),
                    esc_url( 'https://robertdevore.com/why-this-plugin-doesnt-support-wordpress-com-hosting/' ),
                    __( 'Learn more', 'link-attributes-for-wordpress' )
                )
            ),
            esc_html__( 'Plugin Activation Blocked', 'link-attributes-for-wordpress' ),
            [ 'back_link' => true ]
        );
    }
}
register_activation_hook( __FILE__, 'wpcom_activation_check' );

/**
 * Add a deactivation flag when the plugin is deactivated.
 *
 * @since  1.1.0
 * @return void
 */
function wpcom_deactivation_flag() {
    add_option( 'wpcom_deactivation_notice', 'https://robertdevore.com/why-this-plugin-doesnt-support-wordpress-com-hosting/' );
}
register_deactivation_hook( __FILE__, 'wpcom_deactivation_flag' );
