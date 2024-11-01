<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package    WP_Head_Optimizer
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option('wpho_activated_on');
delete_option('wpho_deactivated_on');
delete_option('_wpho_saved_values');