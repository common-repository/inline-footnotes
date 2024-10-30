<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://gavinr.com
 * @since      1.0.0
 *
 * @package    Inline_Footnotes
 * @subpackage Inline_Footnotes/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Inline_Footnotes
 * @subpackage Inline_Footnotes/public
 * @author     Gavin Rehkemper <gavin@gavinr.com>
 */
class Inline_Footnotes_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Inline_Footnotes_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Inline_Footnotes_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/inline-footnotes-public.compressed.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Inline_Footnotes_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Inline_Footnotes_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/inline-footnotes-public.compressed.js', array( 'jquery' ), $this->version, false );
		$translation_array = array(
			'hover' => get_option( 'inline_footnotes_hover')
		);
		wp_localize_script( $this->plugin_name, 'inlineFootNotesVars', $translation_array );
		wp_enqueue_script( $this->plugin_name );

	}

	public function head_init() {
		include_once 'partials/inline-footnotes-public-display.php';
	}
}
