<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    Link_Attributes_For_Publishers
 * @subpackage Link_Attributes_For_Publishers/admin
 * @author     Devio Digital <contact@deviodigital.com>
 * @license    GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link       https://deviodigital.com
 * @since      1.0.0
 */

// If this file is called directly, abort.
 if ( ! defined( 'WPINC' ) ) {
	wp_die();
}

/**
 * Actions/Filters
 *
 * Related to all settings API.
 *
 * @since  1.0.0
 */
if ( class_exists( 'LAFP_OSA' ) ) {
	/**
	 * Object Instantiation.
	 *
	 * Object for the class `LAFP_OSA`.
	 */
	$wposa_obj = new LAFP_OSA();

	// Section: General Settings.
	$wposa_obj->add_section(
		array(
			'id'    => 'wposa_general',
			'title' => esc_attr__( 'General', 'link-attributes-for-publishers' ),
		)
	);

	// Field: Nofollow domains.
	$wposa_obj->add_field(
		'wposa_general',
		array(
			'id'   => 'nofollow_domains',
			'type' => 'textarea',
			'name' => esc_attr__( 'Nofollow Domains', 'link-attributes-for-publishers' ),
			'desc' => esc_attr__( 'Separate by comma. Example: google.com, amzn.to', 'link-attributes-for-publishers' ),
		)
	);

	// Field: Separator.
	$wposa_obj->add_field(
		'wposa_general',
		array(
			'id'   => 'separator1',
			'type' => 'separator',
		)
	);

	// Field: Sponsored domains.
	$wposa_obj->add_field(
		'wposa_general',
		array(
			'id'   => 'sponsored_domains',
			'type' => 'textarea',
			'name' => esc_attr__( 'Sponsored Domains', 'link-attributes-for-publishers' ),
			'desc' => esc_attr__( 'Separate by comma. Example: google.com, amzn.to', 'link-attributes-for-publishers' ),
		)
	);

	// Field: Separator.
	$wposa_obj->add_field(
		'wposa_general',
		array(
			'id'   => 'separator2',
			'type' => 'separator',
		)
	);

	// Field: UGC domains.
	$wposa_obj->add_field(
		'wposa_general',
		array(
			'id'   => 'ugc_domains',
			'type' => 'textarea',
			'name' => esc_attr__( 'UGC Domains', 'link-attributes-for-publishers' ),
			'desc' => esc_attr__( 'Separate by comma. Example: google.com, amzn.to', 'link-attributes-for-publishers' ),
		)
	);

	// Field: Separator.
	$wposa_obj->add_field(
		'wposa_general',
		array(
			'id'   => 'separator3',
			'type' => 'separator',
		)
	);

}