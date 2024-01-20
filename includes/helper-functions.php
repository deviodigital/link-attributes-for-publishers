<?php

/**
 * The file that defines the core helper functions
 *
 * @package    Link_Attributes_For_Publishers
 * @subpackage Link_Attributes_For_Publishers/includes
 * @author     Devio Digital <contact@deviodigital.com>
 * @license    GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link       https://deviodigital.com
 * @since      1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Attributes Array
 * 
 * Return an array of attibutes and the links that have been added
 * through the admin settings
 * 
 * @since  1.0.0
 * @return array
 */
function lafp_attributes_array() {
    $nofollow_domains  = array();
    $sponsored_domains = array();
    $ugc_domains       = array();
    $rows_nofollow     = '';
    $rows_sponsored    = '';
    $rows_ugc          = '';

    // Access all WP Dispensary Display Settings.
    $admin_settings = get_option( 'wposa_general' );

    // Check nofollow domains settings.
    if ( isset ( $admin_settings['nofollow_domains'] ) && '' !== $admin_settings['nofollow_domains'] ) {
        $rows_nofollow = $admin_settings['nofollow_domains'];
    }

    // Check sponsored domains settings.
    if ( isset ( $admin_settings['sponsored_domains'] ) && '' !== $admin_settings['sponsored_domains'] ) {
        $rows_sponsored = $admin_settings['sponsored_domains'];
    }

    // Check ugc domains settings.
    if ( isset ( $admin_settings['ugc_domains'] ) && '' !== $admin_settings['ugc_domains'] ) {
        $rows_ugc = $admin_settings['ugc_domains'];
    }

    // Create array from the string.
    $rows_nofollow = explode( ', ', $rows_nofollow );

    // Create array from the string.
    $rows_sponsored = explode( ', ', $rows_sponsored );

    // Create array from the string.
    $rows_ugc = explode( ', ', $rows_ugc );

    // Create final array for JS file.
    $array = array(
        'nofollow_domains'  => $rows_nofollow,
        'sponsored_domains' => $rows_sponsored,
        'ugc_domains'       => $rows_ugc
    );

    return apply_filters( 'lafp_attributes_array', $array );
}
