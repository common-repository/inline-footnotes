<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://gavinr.com
 * @since      1.0.0
 *
 * @package    Inline_Footnotes
 * @subpackage Inline_Footnotes/includes
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
 * @package    Inline_Footnotes
 * @subpackage Inline_Footnotes/includes
 * @author     Gavin Rehkemper <gavin@gavinr.com>
 */
class Inline_Footnotes {

	public $footnotes = array();
	public $footnoteCount = 0;
	public $prevPost;

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Inline_Footnotes_Loader    $loader    Maintains and registers all hooks for the plugin.
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

		$this->plugin_name = 'inline-footnotes';
		$this->version = '1.0.0';

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
	 * - Inline_Footnotes_Loader. Orchestrates the hooks of the plugin.
	 * - Inline_Footnotes_i18n. Defines internationalization functionality.
	 * - Inline_Footnotes_Admin. Defines all hooks for the admin area.
	 * - Inline_Footnotes_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-inline-footnotes-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-inline-footnotes-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-inline-footnotes-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-inline-footnotes-public.php';

		$this->loader = new Inline_Footnotes_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Inline_Footnotes_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Inline_Footnotes_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );

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

		$plugin_admin = new Inline_Footnotes_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_options_page' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_setting' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Inline_Footnotes_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_head', $plugin_public, 'head_init' );
		add_shortcode( 'footnote', array($this, 'easy_footnote_shortcode') );

	}

	public function easy_footnote_shortcode($atts, $content = null) {
		$atts = shortcode_atts( array(
			'title' => '',
			
			'symbol_background_color' => '',
			'symbol_text_color' => '',

			'background_color' => '',
			'text_color' => '',
		), $atts, 'footnote' );

		// if the shortcode 'title' attribute is passed, use that. otherwise use the number.
		if ($atts['title'] != '') {
			$title = $atts['title'];
		} else {
			$title = $this->footnoteCount + 1;
		}

		$symbol_background_color = $atts['symbol_background_color'];
		$symbol_text_color = $atts['symbol_text_color'];
		$background_color = $atts['background_color'];
		$text_color = $atts['text_color'];

		$this->inline_footnote_count($this->footnoteCount, get_the_ID());
		$this->inline_footnote_content($content);
		$footnoteLink = '#inline-footnote-bottom-'.$this->footnoteCount;
		$contentNoHtml = strip_tags($content);

		$symbolStyles = array();
		if($symbol_background_color != '') {
			$symbolStyles[] = "background-color:$symbol_background_color;";
		}
		if($symbol_text_color != '') {
			$symbolStyles[] = "color:$symbol_text_color;";
		}

		$footnoteContent = "<span title='$contentNoHtml' class='inline-footnote' style='" . join('', $symbolStyles) . "'>$title";

		$footnoteStyles = array();
		if($background_color != '') {
			$footnoteStyles[] = "background-color:$background_color;";
		}
		if($text_color != '') {
			$footnoteStyles[] = "color:$text_color !important;";
		}

		$footnoteContent = $footnoteContent . "<span class='footnoteContent' style='display:none;" . join('', $footnoteStyles) . "'>$content</span></span>";
		
		return $footnoteContent;
	}

	public function inline_footnote_content($content) {
		$this->footnotes[$this->footnoteCount] = $content;

		return $this->footnotes;
	}

	public function inline_footnote_count($count, $currentPost) {
		if ($this->prevPost != $currentPost) {
			$count = 0;
		}

		$this->prevPost = $currentPost;

		$count++;

		$this->footnoteCount = $count;

		return $this->footnoteCount;
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
	 * @return    Inline_Footnotes_Loader    Orchestrates the hooks of the plugin.
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
