<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @package    Link_Attributes_For_Publishers
 * @subpackage Link_Attributes_For_Publishers/includes
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
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @package    Link_Attributes_For_Publishers
 * @subpackage Link_Attributes_For_Publishers/includes
 * @author     Devio Digital <contact@deviodigital.com>
 * @license    GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link       https://deviodigital.com
 * @since      1.0.0
 */
class Link_Attributes_For_Publishers {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    Link_Attributes_For_Publishers_Loader $loader - Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $plugin_name - The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string    $version - The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->plugin_name = 'link-attributes-for-publishers';
        $this->version     = '1.0.0';

		if ( defined( 'LINK_ATTRIBUTES_FOR_PUBLISHERS_VERSION' ) ) {
			$this->version = LINK_ATTRIBUTES_FOR_PUBLISHERS_VERSION;
		}

        $this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Link_Attributes_For_Publishers_Loader. Orchestrates the hooks of the plugin.
	 * - Link_Attributes_For_Publishers_i18n. Defines internationalization functionality.
	 * - Link_Attributes_For_Publishers_Admin. Defines all hooks for the admin area.
	 * - Link_Attributes_For_Publishers_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-link-attributes-for-publishers-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-link-attributes-for-publishers-i18n.php';

		/**
		 * The file responsible for defining the core helper functions used throughout the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/helper-functions.php';

		/**
		 * The file responsible for defining the core helper functions used throughout the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/content-filters.php';

        /**
		 * The class responsible for defining the custom settings API.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wposa-settings.php';

		/**
		 * The file responsible for defining all of the custom settings.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/admin-link-attributes-for-publishers-settings.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-link-attributes-for-publishers-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-link-attributes-for-publishers-public.php';

		$this->loader = new Link_Attributes_For_Publishers_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Link_Attributes_For_Publishers_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @access private
	 * @since  1.0.0
     * @return void
	 */
	private function set_locale() {

		$plugin_i18n = new Link_Attributes_For_Publishers_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @access private
	 * @since  1.0.0
     * @return void
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Link_Attributes_For_Publishers_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @access private
	 * @since  1.0.0
     * @return void
	 */
	private function define_public_hooks() {

		$plugin_public = new Link_Attributes_For_Publishers_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 * 
	 * @since  1.0.0
     * @return void
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since  1.0.0
	 * @return Link_Attributes_For_Publishers_Loader - Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since  1.0.0
	 * @return string - The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
