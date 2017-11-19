<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://www.themepunch.com
 * @since      1.0.0
 *
 * @package    Revslider_Sharing_Addon
 * @subpackage Revslider_Sharing_Addon/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Revslider_Sharing_Addon
 * @subpackage Revslider_Sharing_Addon/includes
 * @author     ThemePunch <info@themepunch.com>
 */
class Revslider_Sharing_Addon {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Revslider_Sharing_Addon_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
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

		$this->plugin_name = 'revslider-sharing-addon';
		$this->version = REV_ADDON_SHARING_VERSION;

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
	 * - Revslider_Sharing_Addon_Loader. Orchestrates the hooks of the plugin.
	 * - Revslider_Sharing_Addon_i18n. Defines internationalization functionality.
	 * - Revslider_Sharing_Addon_Admin. Defines all hooks for the admin area.
	 * - Revslider_Sharing_Addon_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-revslider-sharing-addon-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-revslider-sharing-addon-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-revslider-sharing-addon-admin.php';

		/**
		 * The class responsible for the update process.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-revslider-sharing-addon-update.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-revslider-sharing-addon-public.php';

		$this->loader = new Revslider_Sharing_Addon_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Revslider_Sharing_Addon_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Revslider_Sharing_Addon_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Revslider_Sharing_Addon_Admin( $this->get_plugin_name(), $this->get_version() );
		$update_admin = new RevAddOnSharingUpdate(REV_ADDON_SHARING_VERSION);

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		//updates
		$this->loader->add_filter( 'pre_set_site_transient_update_plugins', $update_admin ,'set_update_transient' );
		$this->loader->add_filter( 'plugins_api', $update_admin ,'set_updates_api_results',10,3 );

		//admin page
		$this->loader->add_filter('rev_addon_dash_slideouts',$plugin_admin,'display_plugin_admin_page');
		$this->loader->add_action( 'wp_ajax_save_sharing', $plugin_admin, 'save_sharing');

		//add actions
		$this->loader->add_action( 'rs_action_add_layer_action', $plugin_admin , 'rs_action_add_layer_actions', 10 );
		$this->loader->add_action( 'rs_action_add_layer_action_details', $plugin_admin , 'rs_action_add_layer_actions_details', 10 );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Revslider_Sharing_Addon_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		// Add actions to output
		$this->loader->add_filter( 'rs_action_output_layer_simple_link', $plugin_public, 'rs_action_output_layer_simple_link', 10, 7 );

		// Get Post Info
		$this->loader->add_action( 'wp_ajax_get_post_info', $plugin_public, 'get_post_info');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Revslider_Sharing_Addon_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
