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

/**
 * Allowed HTML tags
 * 
 * This function extends the wp_kses_allowed_html function to include
 * a handful of additional HTML fields that are used throughout
 * this plugin
 * 
 * @since  1.0.0
 * @return array
 */
function lafp_allowed_tags() {
    $my_allowed = wp_kses_allowed_html( 'post' );
    // iframe
    $my_allowed['iframe'] = array(
        'src'             => array(),
        'height'          => array(),
        'width'           => array(),
        'frameborder'     => array(),
        'allowfullscreen' => array(),
    );
    // form fields - input
    $my_allowed['input'] = array(
        'class' => array(),
        'id'    => array(),
        'name'  => array(),
        'value' => array(),
        'type'  => array(),
    );
    // select
    $my_allowed['select'] = array(
        'class' => array(),
        'id'    => array(),
        'name'  => array(),
        'value' => array(),
        'type'  => array(),
    );
    // select options
    $my_allowed['option'] = array(
        'selected' => array(),
        'value'    => array(),
    );
    // style
    $my_allowed['style'] = array(
        'types' => array(),
    );
    // SVG.
    $my_allowed['svg'] = array(
        'xmlns'          => array(),
        'width'          => array(),
        'height'         => array(),
        'viewbox'        => array(),
        'class'          => array(),
        'aria-hidden'    => array(),
        'aria-labeledby' => array()
    );
    $my_allowed['path'] = array(
        'd'    => array(),
        'fill' => array()
    );
    return $my_allowed;
}