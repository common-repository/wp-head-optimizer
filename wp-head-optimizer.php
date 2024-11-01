<?php
/**
 * @link              http://wphound.com
 * @since             1.0.0
 * @package           WP_HEAD_OPTMIZER
 *
 * Plugin Name:       WP Head Optimizer
 * Plugin URI:        http://store.wphound.com/wp-head-optimizer/
 * Description:       This plugin allow you to remove unnecessary tags, urls, scrips and manymore additional things from your WordPress header to speed up site loading time and hide some details form visitors for security purpose
 * Version:           1.0.0
 * Author:            Nilay Patel
 * Author URI:        http://www.nilaypatel.info/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-head-optimizer
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-head-optimizer-activator.php
 */
function activate_wp_head_optimizer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-head-optimizer-activator.php';
	WP_Head_Optimizer_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-head-optimizer-deactivator.php
 */
function deactivate_wp_head_optimizer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-head-optimizer-deactivator.php';
	WP_Head_Optimizer_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_head_optimizer' );
register_deactivation_hook( __FILE__, 'deactivate_wp_head_optimizer' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-head-optimizer.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_head_optimizer() {

	$plugin = new WP_Head_Optimizer();
	$plugin->run();

}
run_wp_head_optimizer();
