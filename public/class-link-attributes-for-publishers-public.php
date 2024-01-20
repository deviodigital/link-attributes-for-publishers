<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Link_Attributes_For_Publishers
 * @subpackage Link_Attributes_For_Publishers/public
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
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Link_Attributes_For_Publishers
 * @subpackage Link_Attributes_For_Publishers/public
 * @author     Devio Digital <contact@deviodigital.com>
 * @license    GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link       https://deviodigital.com
 * @since      1.0.0
 */
class Link_Attributes_For_Publishers_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @access private
	 * @var    string  $_plugin_name - The ID of this plugin.
     * 
	 * @since 1.0.0
	 */
	private $_plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @access private
	 * @var    string  $_version - The current version of this plugin.
     * 
	 * @since 1.0.0
	 */
	private $_version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $_plugin_name - The name of the plugin.
	 * @param string $_version     - The version of this plugin.
     * 
	 * @since 1.0.0
	 */
	public function __construct( $_plugin_name, $_version ) {

		$this->plugin_name = $_plugin_name;
		$this->version     = $_version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since  1.0.0
     * @return void
	 */
	public function enqueue_styles() {
        // Public - CSS.
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/link-attributes-for-publishers-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since  1.0.0
     * @return void
	 */
	public function enqueue_scripts() {
        // Public - JS.
		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/link-attributes-for-publishers-public.js', array( 'jquery' ), time(), false );
	}

}
