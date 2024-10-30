<?php

/**
 * The plugin bootstrap file
 *
 * @link              http://gavinr.com
 * @since             1.0.0
 * @package           Inline_Footnotes
 *
 * @wordpress-plugin
 * Plugin Name:       Inline Footnotes
 * Plugin URI:        http://www.gavinr.com/wordpress-plugins/
 * Description:       Enables adding footnotes via shortcodes in your content.
 * Version:           2.3.0
 * Author:            Gavin Rehkemper
 * Author URI:        http://gavinr.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       inline-footnotes
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-inline-footnotes-activator.php
 */
function activate_inline_footnotes() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-inline-footnotes-activator.php';
	Inline_Footnotes_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-inline-footnotes-deactivator.php
 */
function deactivate_inline_footnotes() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-inline-footnotes-deactivator.php';
	Inline_Footnotes_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_inline_footnotes' );
register_deactivation_hook( __FILE__, 'deactivate_inline_footnotes' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-inline-footnotes.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_inline_footnotes() {

	$plugin = new Inline_Footnotes();
	$plugin->run();

}
run_inline_footnotes();
