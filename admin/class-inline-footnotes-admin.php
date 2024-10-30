<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://gavinr.com
 * @since      1.0.0
 *
 * @package    Inline_Footnotes
 * @subpackage Inline_Footnotes/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Inline_Footnotes
 * @subpackage Inline_Footnotes/admin
 * @author     Gavin Rehkemper <gavin@gavinr.com>
 */
class Inline_Footnotes_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'inline_footnotes';

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


	/**
	 * Register the stylesheets for the admin area.
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
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/inline-footnotes-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/inline-footnotes-admin.js', array('jquery', 'wp-color-picker' ), $this->version, false );

	}



	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Inline Footnotes Settings', 'inline-footnotes' ),
			__( 'Inline Footnotes', 'inline-footnotes' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);
	}

	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() {
		include_once 'partials/inline-footnotes-admin-display.php';
	}

	/**
	 * Register all related settings of this plugin
	 *
	 * @since  1.0.0
	 */
	public function register_setting() {
		// Add a General section
		add_settings_section(
			$this->option_name . '_general',
			__( 'General', 'inline-footnotes' ),
			array( $this, $this->option_name . '_general_cb' ),
			$this->plugin_name
		);
		add_settings_field(
			$this->option_name . '_background_color',
			__( 'Background Color', 'inline-footnotes' ),
			array( $this, $this->option_name . '_background_color' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_background_color' )
		);
		register_setting( $this->plugin_name, $this->option_name . '_background_color', 'sanitize_text_field' );

		add_settings_field(
			$this->option_name . '_text_color',
			__( 'Text Color', 'inline-footnotes' ),
			array( $this, $this->option_name . '_text_color' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_text_color' )
		);
		register_setting( $this->plugin_name, $this->option_name . '_text_color', 'sanitize_text_field' );

		add_settings_field(
			$this->option_name . '_text_popup_background_color',
			__( 'Text Popup Background Color', 'inline-footnotes' ),
			array( $this, $this->option_name . '_text_popup_background_color' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_text_popup_background_color' )
		);
		register_setting( $this->plugin_name, $this->option_name . '_text_popup_background_color', 'sanitize_text_field' );

		add_settings_field(
			$this->option_name . '_text_popup_text_color',
			__( 'Text Popup Text Color', 'inline-footnotes' ),
			array( $this, $this->option_name . '_text_popup_text_color' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_text_popup_text_color' )
		);
		register_setting( $this->plugin_name, $this->option_name . '_text_popup_text_color', 'sanitize_text_field' );

		add_settings_field(
			$this->option_name . '_hover',
			__( 'Show Footnote on Hover', 'inline-footnotes' ),
			array( $this, $this->option_name . '_hover' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_hover' )
		);
		register_setting( $this->plugin_name, $this->option_name . '_hover', 'sanitize_text_field' );


	}


	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function inline_footnotes_general_cb() {
		echo '<p>' . __( 'Choose your colors', 'inline-footnotes' ) . '</p>';
	}

	public function inline_footnotes_background_color() {
		$background_color = get_option( $this->option_name . '_background_color' );
		echo '<input type="text" name="' . $this->option_name . '_background_color' . '" id="' . $this->option_name . '_background_color' . '" value="' . $background_color . '" class="color-field">';
	}
	public function inline_footnotes_text_color() {
		$text_color = get_option( $this->option_name . '_text_color' );
		echo '<input type="text" name="' . $this->option_name . '_text_color' . '" id="' . $this->option_name . '_text_color' . '" value="' . $text_color . '" class="color-field">';
	}
	public function inline_footnotes_text_popup_background_color() {
		$text_color = get_option( $this->option_name . '_text_popup_background_color' );
		echo '<input type="text" name="' . $this->option_name . '_text_popup_background_color' . '" id="' . $this->option_name . '_text_popup_background_color' . '" value="' . $text_color . '" class="color-field">';
	}
	public function inline_footnotes_text_popup_text_color() {
		$text_color = get_option( $this->option_name . '_text_popup_text_color' );
		echo '<input type="text" name="' . $this->option_name . '_text_popup_text_color' . '" id="' . $this->option_name . '_text_popup_text_color' . '" value="' . $text_color . '" class="color-field">';
	}
	public function inline_footnotes_hover() {
		$checked = get_option( $this->option_name . '_hover' );
		echo '<input type="checkbox" name="' . $this->option_name . '_hover' . '" id="' . $this->option_name . '_hover' . '" ' . (($checked == 'on') ? 'checked=checked' : '') . ' class="">';
	}

}
